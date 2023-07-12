<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\User;


class EmailVerificationMail extends Mailable {
    use Queueable, SerializesModels;
    public $user;
    /**
     * Create a new message instance.
     */
    public function __construct($user) {
        $this->user = $user;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        return $this->markdown("emails.auth.email-verification-mail")->with(["user" => $this->user]);
    }
}
