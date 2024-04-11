<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactForm extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $email;
    public $postcode;
    public $subject;
    public $message;

    /**
     * Create a new message instance.
     */
    public function __construct($name, $email, $postcode, $subject, $message)
    {
        $this->name = $name;
        $this->email = $email;
        $this->postcode = $postcode;
        $this->subject = $subject;
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.contact-form',
            ['name' => $this->name, 'email' => $this->email, 'postcode', 'subject' => $this->subject, 'message' => $this->message]
        )->subject(__('New Contact Request!'));
    }
}
