<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EventRegistrationOtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public $otp;
    public $name;
    public $eventId;

    public function __construct($otp, $name, $eventId)
    {
        $this->otp = $otp;
        $this->name = $name;
        $this->eventId = $eventId;
    }

    public function envelope()
    {
        return new Envelope(
            subject: 'Your Event Registration OTP'
        );
    }

    public function content()
    {
        return new Content(
            view: 'emails.event_otp'
        );
    }
}
