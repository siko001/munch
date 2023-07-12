<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller {

    public function registerReservation(Request $request) {
        $userId = Auth::id();
        $incomingFields = $request->validate([
            "name" => "required|min:3",
            "phone" => "required|min:8",
            "email" => "required|email",
            "people" => "required",
            "time" => "required",
            "date" => "required|date|after_or_equal:" . now()->format('d-m-Y') . "|before_or_equal:" . now()->addYear()->format('d-m-Y'),
            "seating_area" => "nullable",
            "requests" => "nullable|max:255"
        ]);
        $date = $incomingFields["date"];
        $formattedDate = Carbon::createFromFormat('Y-m-d', $date)->format('d/m/Y');


        if ($incomingFields) {
            $reservation = new Reservation([
                "name" => $incomingFields["name"],
                "time" => $incomingFields["time"],
                "date" => $formattedDate,
                "people" => $incomingFields["people"],
                "email" => $incomingFields["email"],
                "phone" => $incomingFields["phone"],
                "requests" => $incomingFields["requests"],
                "seating_area" => $incomingFields["seating_area"],
                "user_id" => $userId
            ]);


            $reservation->save();


            //send email to user to me(manager)


            if (Auth::user()) {
                return redirect()->back()->with("success", new HtmlString("Booking Submitted. Please Await Confirmation from the Restaurant! <a href='/profile/reservations'> Go to my Reservations</a>"));
            } else {
                return redirect()->back()->with("success", "Booking Submitted. Please Await Confirmation from the Restaurant for Reservation ID#$reservation->id!");
            }
        } else {
            return redirect()->back()->with("failure", "Something went wrong. Please try again or contact us.");
        }
    }

    public function show($id) {
        $reservation = Reservation::find($id);
        return response()->json($reservation);
    }


    public function getAllActiveReservations() {
        $userRole = Auth::guard("staff")->user()->Role;
        $activeReservation = Reservation::where("status", "!=", "Cancelled by Restaurant")->where("status", "!=", "Completed")->where("status", "!=", "No Show")->where("status", "!=", "Cancelled by Guest")->get();
        return view("restaurant", compact("activeReservation", "userRole"));
    }

    public function getAllInactiveReservations() {
        $selectedOption = request()->query('selected');
        $userRole = Auth::guard("staff")->user()->Role;
        $inactiveReservations = Reservation::where("status", "!=", "Awaiting Confirmation")->where("status", "!=", "Confirmed")->get();
        return view("restaurant", compact("inactiveReservations", "userRole", "selectedOption"));
    }

    public function confirmReservation($id) {
        $reservation = Reservation::findOrFail($id);
        $reservation->status = "Confirmed";
        $reservation->update();
        $reservation->save();

        return redirect()->back()->with("success", "Reservation #" . $reservation->id . " Confirmed");
    }

    public function cancelReservation($id) {
        $reservation = Reservation::findOrFail($id);
        $reservation->status = "Cancelled by Restaurant";
        $reservation->update();
        $reservation->save();
        return redirect()->back()->with("success", new HtmlString("Reservation #" . $reservation->id . " Cancelled and moved to <a href='/restaurant/bookings/past'>past-reservations</a>"));
    }

    public function cancelReservationGuest($id) {
        $reservation = Reservation::findOrFail($id);
        $reservation->status = "Cancelled by Guest";
        $reservation->update();
        $reservation->save();
        return redirect()->back()->with("success", new HtmlString("Reservation #" . $reservation->id . " Cancelled and moved to <a href='/restaurant/bookings/past'>Past Reservations</a>"));
    }

    public function completeReservation($id) {
        $reservation = Reservation::findOrFail($id);
        $reservation->status = "Completed";
        $reservation->update();
        $reservation->save();
        return redirect()->back()->with("success", new HtmlString("Reservation #" . $reservation->id . " Complete and moved to <a href='/restaurant/bookings/past'>Past Reservations</a>"));
    }

    public function noShowReservation($id) {
        $reservation = Reservation::findOrFail($id);
        $reservation->status = "No Show";
        $reservation->update();
        $reservation->save();
        return redirect()->back()->with("success", new HtmlString("Reservation #" . $reservation->id . " Is a No Show and moved to <a href='/restaurant/bookings/past'>Past Reservations</a> No Show Section"));
    }

    public function getEverything() {
        $userId = Auth::user()->id;
        $upcomingReservations = Reservation::where("status", "!=", "Completed")->where("status", "!=", "Cancelled by Guest")->where("status", "!=", "Cancelled by Restaurant")->where("status", "!=", "No Show")->get();
        $pastReservation = Reservation::where("status", "!=", "Awaiting Confirmation")->where("status", "!=", "Confirmed")->get();

        $userUpcomingReservations = $upcomingReservations->where("user_id", "==", $userId);
        $userPastReservations = $pastReservation->where("user_id", "==", $userId);

        return view("reservations", compact("userUpcomingReservations", "userPastReservations"));
    }
}
