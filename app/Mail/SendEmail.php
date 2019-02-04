<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $answer;
    protected $name;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($answer, $name)
    {
        $this->answer = $answer;
        $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('admin.messages.send-mail')
          ->with(
            ['answer' => $this->answer,
            'name' => $this->name,
            ])
          ->subject('Ответ на ваше сообщение');
    }
}
