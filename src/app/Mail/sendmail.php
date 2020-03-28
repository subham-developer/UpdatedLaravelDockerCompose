<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;
 public $data;
 public $attachment;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data,$content,$attachment)
    {
        $this->subject=$data;
        $this->content=$content;
        $this->attachment = $attachment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $email = $this->markdown('dynamic_email_template')
        ->from('info@nimapinfotech.com')
        ->subject($this->subject)
        ->with('content', $this->content);
 foreach ($this->attachment as $item) {
    $email->attach($item);
}
return $email;

       // return $this->from('info@nimapinfotech.com')->subject('Client Details')->view('dynamic_email_template')->with('data',$this->data);
    }
}
