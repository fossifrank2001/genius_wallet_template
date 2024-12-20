<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DepositMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $messageBody;

    /**
     * Create a new message instance.
     *
     * @param array $data
     * @param string $messageBody
     */
    public function __construct($data, $messageBody, public $gs)
    {
        $this->data = $data;
        $this->messageBody = $messageBody;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject($this->data['email_subject'])
            ->from($this->gs->from_email, $this->gs->from_name)
            ->view('templates.dynamic')
            ->with([
                'content' => $this->messageBody,
                'data' => $this->data,
            ]);
    }
}
