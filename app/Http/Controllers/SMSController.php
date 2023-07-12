<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SMSController extends Controller {
    public function sms() {
        $basic  = new \Vonage\Client\Credentials\Basic("6f7264fe", "Ug4V5D6g7A19MTTL");
        $client = new \Vonage\Client($basic);

        $response = $client->sms()->send(
            new \Vonage\SMS\Message\SMS("35677201093", "Munch Munch", 'New Order')
        );

        $message = $response->current();

        if ($message->getStatus() == 0) {
            echo "The message was sent successfully\n";
        } else {
            echo "The message failed with status: " . $message->getStatus() . "\n";
        }
    }
}
