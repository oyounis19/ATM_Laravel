<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewAccountMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $card;
    public $type;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $card, $type)
    {
        $this->user = $user;
        $this->card = $card;
        $this->type = $type;
    }

    public function build()
    {
        return $this->subject('Congratulations on Your New Account!')
                    ->view('emails.new_account')
                    ->with([
                        'user' => $this->user,
                        'card' => $this->card,
                        'type' => $this->type,
                    ]);
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'New Account Mail',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    // public function content()
    // {
    //     return new Content(
    //         view: 'view.name',
    //     );
    // }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
