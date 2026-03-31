<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LeadSubmittedMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    public function __construct(public array $lead)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Новая заявка с сайта Татьяны Щипициной'
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.lead-submitted'
        );
    }
}
