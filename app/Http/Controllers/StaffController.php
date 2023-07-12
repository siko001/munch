<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller {

    public function register(Request $request, Staff $staff) {
        $incomingFields = $request->validate([
            "name" => "required|min:4",
            "email" => [Rule::unique('staff', 'email')->ignore($staff->id), "required"],
            "phone" => "required",
            "password" => "required|min:4",
            "confirm-password" => "required|min:4|same:password",
            "role" => "required",
        ]);

        $incomingFields['password'] = bcrypt($incomingFields['password']);

        $staff = new Staff($incomingFields);
        $staff->save();
        Auth::guard('staff')->login($staff);
        if ($staff) {
            return redirect('/login-staff')->with('success', "Welcome New Staff Member " . Auth::guard('staff')->user()->name . " Please Login");
        } else {
            return redirect('/login-staff')->with('failure', 'Something went wrong');
        }
    }


    public function login(Request $request) {
        $incomingFields = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Clear existing user session
        if (auth()->check()) {
            auth()->logout();
        }
        if (Auth::guard('staff')->attempt($incomingFields)) {
            // Authentication successful
            return redirect('/profile')->with('success', 'Logged in successfully.');
        } else {
            // Authentication failed
            return redirect()->back()->with('failure', 'Invalid login credentials.');
        }
    }


    public function logout() {
        Auth::guard('staff')->logout();
        return redirect('/profile')->with("success", "You successfully logged out");
    }


    public function updatePassword(Request $request, Staff $staff) {

        $incomingFields = $request->validate([
            "currentPassword" => "required",
            "newPassword" => "required",
            "confirmNewPassword" => "required|same:newPassword"
        ]);

        $staff = Auth::guard('staff')->user();

        if (Hash::check($incomingFields['currentPassword'], $staff->password)) {
            if (Hash::check($incomingFields['newPassword'], $staff->password)) {
                return redirect()->back()->withErrors(['newPassword' => 'New password should be different from the current password.']);
            }
            $staff->password = Hash::make($request->newPassword);
            $staff->save();

            return redirect()->back()->with('success', 'Password changed successfully.');
        }
        return redirect()->back()->with('failure', 'Invalid Password!');
    }


    public function getAllActiveStaff() {
        $activeStaff = Staff::where("isActive", "!=", "false")->get();
        $userRole = Auth::guard("staff")->user()->Role;
        return view("restaurant", compact("activeStaff", "userRole"));
    }

    public function getAllInactiveStaff() {
        $inactiveStaff = Staff::where("isActive", "=", "false")->get();
        $userRole = Auth::guard("staff")->user()->Role;
        return view("restaurant", compact("inactiveStaff", "userRole"));
    }


    public function show($id) {
        $staff = Staff::find($id);
        return response()->json($staff);
    }


    public function getStaffToEdit($id) {
        $user = Staff::find($id);
        return view("updateStaff", compact("user"));
    }

    public function getStaffToDelete($id) {
        $user = Staff::find($id);
        return view("deleteUser", compact("user"));
    }

    public function deleteProfile($id) {
        $user = Staff::findOrFail($id);
        $user->delete();
        return redirect("/restaurant/staff/active")->with("success", "Staff Account Deleted");
    }

    public function deactivateAccount($id) {
        $user = Staff::find($id);
        $user->isActive = false;
        $user->save();
        return redirect("/restaurant/staff/inactive")->with("success", $user->name . "'s Account Diactivated Successfully");
    }

    public function activateAccount($id) {
        $user = Staff::find($id);
        $user->isActive = true;
        $user->save();
        return redirect("/restaurant/staff/active")->with("success", $user->name . "'s Account Activated Successfully");
    }

    //Check if the email is avaliable AJAX
    public function checkEmailAvailability(Request $request) {
        $email = $request->input('email');
        // Check if a user with the given email already exists in the database
        $emailExists = Staff::where('email', $email)->exists();
        return response()->json(['available' => !$emailExists]);
    }

    public function updateProfile(Request $request, $id) {
        $staff = Staff::findOrFail($id)->first();
        $incomingFields = $request->validate([
            "name" => "sometimes|max:20",
            "email" => [Rule::unique("staff", "email")->ignore($staff->id), "nullable", 'regex:/^[^\s@]+@munchmunch\.com$/i',],
            "phone" => "sometimes|max:9"
        ]);


        //check if fields are filled, if not give them the previous value
        $fillableFields = ['name', 'email', 'phone'];
        foreach ($fillableFields as $field) {
            if (!isset($incomingFields[$field])) {
                $incomingFields[$field] = $staff->$field;
            }
        }

        $staff->update($incomingFields);
        return redirect()->back()->with("success", "Profile Updated");
    }
}
