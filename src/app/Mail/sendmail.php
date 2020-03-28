<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $emailSubject = isset($this->data['email_subject']) ? $this->data['email_subject'] : "NGO Enquiry";
        $emailFrom = isset($this->data['email_from']) ? $this->data['email_from'] : "info@oneinr.com";
        return $this->from($emailFrom)
                    ->subject($emailSubject)
                    ->view('emails.'.$this->data['view']);
    }
}
