<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMailable extends Mailable
{
    use Queueable, SerializesModels;
     public $name;
     public $student_id;
     public $pin;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name,$student_id,$pin)
    {
        //
         $this->name = $name;
         $this->student_id = $student_id;
         $this->pin = $pin;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('csmtschools@gmail.com')
                ->subject('CSMT SCHOOLS RESULT')
                ->view('email.name');

        $this->withSwiftMessage(function ($message) {
            $message->getHeaders()
                    ->addTextHeader('Custom-Header', 'CSMT SCHOOLS');
        });
    }
}
