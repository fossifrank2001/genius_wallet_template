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
    public $pdfPath;

    /**
     * Create a new message instance.
     *
     * @param array $data
     * @param string $messageBody
     * @param mixed $gs
     * @param string $pdfPath // Chemin du fichier PDF
     */
    public function __construct($data, $messageBody, public $gs, $pdfPath)
    {
        $this->data = $data;
        $this->messageBody = $messageBody;
        $this->pdfPath = $pdfPath;
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
            ])
            ->attach($this->pdfPath, [
                'as' => 'transaction_receipt.pdf',
                'mime' => 'application/pdf',
            ]);
    }
}
