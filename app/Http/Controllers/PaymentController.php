<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;


class PaymentController extends Controller {
    public function proceedToPayment(Request $request) {
        if (Auth::user()) {
            return app(OrderController::class)->createOrder($request);
        } else {
            session(['delMethod' => $request->delMethod]);
            session(['specialNotes' => $request->specialNotes]);
            session(['timeToDel' => $request->timeToDel]);
            return view("choice-for-payment");
        }
    }
}
