<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ItemRequestGuidance extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct($name, $email, $postcode, $item, $message)
    {
        $this->name = $name;
        $this->email = $email;
        $this->postcode = $postcode;
        $this->item = $item;
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.item-guidance-request',
            ['name' => $this->name, 'email' => $this->email, 'postcode' => $this->postcode, 'item' => $this->item, 'message' => $this->message]
        )->subject(__('New Item Guidance Request!'));
    }
}
