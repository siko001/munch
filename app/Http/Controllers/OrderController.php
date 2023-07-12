<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Order;
use App\Mail\OrderReceived;
use Illuminate\Support\Str;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use App\Mail\OrderReceivedUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\SMSController;
use Gloudemans\Shoppingcart\Facades\Cart;

class OrderController extends Controller {

    //Create an order
    public function createOrder(Request $request) {
        $incomingFields = $request->validate([
            "delMethod" => "required",
            "specialNotes" => "nullable",
            "timeToDel" => "required"
        ]);
        $cartItems = Cart::content();
        $orderNumber = Str::random(10);

        $date = date("d/m/Y");
        $carbon = new Carbon();

        // Set the timezone to Malta
        $carbon->setTimezone('Europe/Malta');
        // Get the current time
        $time = $carbon->format('H:i');

        //save order in the DB
        $order = new Order([
            "order_number" => $orderNumber,
            "user_id" => Auth::user()->id,
            "total_including_vat" => Cart::total(),
            "total_excluding_vat" => Cart::subtotal(),
            "only_vat" => Cart::tax(),
            "payment" => "Paid",
            "delivery_method" => $incomingFields['delMethod'],
            "order_notes" => $incomingFields['specialNotes'],
            "date" => $date,
            "time" => $time,
            "time_to_deliver" => $incomingFields['timeToDel']

        ]);
        $order->save();
        //add each item in order as a single item in the db
        foreach ($cartItems as $item) {
            $orderDetails = new OrderDetails();
            $orderDetails->order_id = $orderNumber;
            $orderDetails->product_name = $item->name;
            $orderDetails->quantity = $item->qty;
            $orderDetails->price = $item->price;
            $orderDetails->save();
        }
        //destroy the cart and after order is sent 
        Cart::destroy();
        $userEmail = Auth::user()->email;
        //email user and staff the order
        Mail::to($userEmail)->send(new OrderReceivedUser($order, $orderDetails));
        Mail::to('neil.mallia1@gmail.com')->send(new OrderReceived($order));

        //also to sms an order
        // $smsController = new SMSController();
        // $smsController->sms();
        return redirect("/profile/active-orders/" . Auth::user()->id)->with("success", "Order Placed");
    }


    //get all active order for user
    public function getUserActiveOrder($id) {
        $userOrder = Order::all();
        $activeOrder =  $userOrder->where("user_id", $id);

        return view('active-orders', compact('activeOrder'));
    }

    //show all orders
    public function showAllOrders() {
        $orders = Order::all();
        $orderDetails = OrderDetails::all();
        return view('orders-staff', compact("orders", "orderDetails"));
    }


    public function showUserOrder($id) {
        $order = OrderDetails::where('order_id', $id)->get();
        return response()->json($order);
    }
    public function showUserOrders($id) {
        $orderMain = Order::where("order_number", $id)->first();
        return response()->json($orderMain);
    }

    public function cancelOrder($id) {
        $orderToCancel = Order::where("order_number", $id)->first();
        if (!$orderToCancel) {
            return redirect()->back()->with("failure", "Order not found");
        }
        $orderToCancel->status = "Order Cancelled";
        $orderToCancel->save();
        return redirect()->back()->with("success", "Order Cancelled Successfully");
    }


    public function orderReady($id) {
        $orderReady = Order::where("order_number", $id)->first();
        if (!$orderReady) {
            return redirect()->back()->with("failure", "Order not found");
        }
        $orderReady->status = "Order Ready for Pick-up";
        $orderReady->save();
        return redirect()->back()->with("success", "Order Marked Ready for Pick-up!");
    }


    public function orderDelivering($id) {
        $orderDelivering = Order::where("order_number", $id)->first();
        if (!$orderDelivering) {
            return redirect()->back()->with("failure", "Order Not Found");
        }
        $orderDelivering->status = "Order Being Delivered to You!";
        $orderDelivering->save();
        return redirect()->back()->with("success", "Order Marked Being Delivered");
    }

    public function orderFinished($id) {
        $orderReady = Order::where("order_number", $id)->first();
        if (!$orderReady) {
            return redirect()->back()->with("failure", "Order Not Found");
        }
        $orderReady->status = "Order Completed";
        $orderReady->save();
        return redirect("/orders/past")->with("success", "Order Ready!");
    }

    public function orderFinishedButCancelled($id) {
        $orderReady = Order::where("order_number", $id)->first();
        if (!$orderReady) {
            return redirect()->back()->with("failure", "Order Not Found");
        }
        $orderReady->status = "Order Cancelled!";
        $orderReady->save();
        return redirect("/orders/past")->with("success", "Order Marked as CANCELLED BUT PROCCESSED");
    }


    public function getAllPastOrders() {
        $orders = Order::all();
        return view("past-orders-staff", compact("orders"));
    }

    public function getAllPastOrdersForUser($id) {
        $Order = Order::all();
        $userOrder = $Order->where("user_id", $id);
        return view('past-orders', compact('userOrder'));
    }


    public function createOrderAsGuest(Request $request) {
        $incomingFields = $request->validate([
            "name" => "required",
            "email" => "required",
            "address" => "required",
            "city" => "required",
            "zip" => "required",
            "phone" => "required",
        ]);

        $delMethod = session('delMethod');
        $specialNotes = session('specialNotes');
        $timeToDel = session('timeToDel');

        // Merge the guest details with the session values
        $data = array_merge($incomingFields, [
            "delMethod" => $delMethod,
            "specialNotes" => $specialNotes,
            "timeToDel" => $timeToDel,
        ]);

        $cartItems = Cart::content();
        $orderNumber = Str::random(10);

        $date = date("d/m/Y");
        $carbon = new Carbon();

        // Set the timezone to Malta
        $carbon->setTimezone('Europe/Malta');
        // Get the current time
        $time = $carbon->format('H:i');

        //save order in the DB
        $order = new Order([
            "order_number" => $orderNumber,
            "user_id" => 1,
            "total_including_vat" => Cart::total(),
            "total_excluding_vat" => Cart::subtotal(),
            "only_vat" => Cart::tax(),
            "payment" => "Paid",
            "delivery_method" => $delMethod,
            "order_notes" => $specialNotes,
            "date" => $date,
            "time" => $time,
            "time_to_deliver" => $timeToDel
        ]);


        $order->save();
        //add each item in order as a single item in the db
        foreach ($cartItems as $item) {
            $orderDetails = new OrderDetails();
            $orderDetails->order_id = $orderNumber;
            $orderDetails->product_name = $item->name;
            $orderDetails->quantity = $item->qty;
            $orderDetails->price = $item->price;
            $orderDetails->save();
        }
        //destroy the cart and after order is sent 
        Cart::destroy();
        $userEmail = $incomingFields["email"];
        //email user and staff the order
        Mail::to($userEmail)->send(new OrderReceivedUser($order));
        Mail::to('neil.mallia1@gmail.com')->send(new OrderReceived($order));
        return redirect("cart")->with("success", "Order Recieved Staff will be contacting you when order is ready");
    }
}
