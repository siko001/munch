<?php

namespace App\Mail;

use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderReceivedUser extends Mailable implements ShouldQueue {
    use Queueable, SerializesModels;

    public $order;
    public $orderDetails;

    /**
     * Create a new message instance.
     */
    public function __construct(Order $order) {
        $this->order = $order;
        $this->orderDetails = orderDetails::where('order_id', $order->order_number)->get();
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {

        return $this->subject('Order Sent to Munch Munch')
            ->view('emails.order-received-user')
            ->with([
                'order' => $this->order,
                "orderDetails" => $this->orderDetails
            ]);
    }
}
