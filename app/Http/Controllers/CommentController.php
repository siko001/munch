<?php

namespace App\Http\Controllers;

use PO;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller {

    public function render($id) {

        $order = Order::where("order_number", $id)->first();
        $orderDetails = $order->items;

        return view("add-comment", compact("order", "orderDetails"));
    }


    public function submitComment(Request $request, $id) {
        $userID = Auth::user()->id;
        $order = Order::where("order_number", $id)->first();

        $incomingFields = $request->validate([
            "name" => "required|max:20",
            "rating" => "required",
            "description" => "required"
        ]);

        $comment = new Comment($incomingFields);
        $comment->userId = $userID;
        $comment->date = Carbon::now()->format('d/m/Y');;
        $order->rated = true;
        $comment->save();
        $order->update();
        return redirect("/profile/past-orders/" . $userID)->with("success", "Review Left, Thanks you");
    }
}
