<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProfileEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $email;
    protected $name;
    protected $phone;
    protected $file;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $email, $phone, $file)
    {
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->file = $file;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('admin.messages.send-profile')
            ->with(
                ['name' => $this->name,
                    'email' => $this->email,
                    'phone' => $this->phone,
                    'file' => $this->file,
                ])
            ->subject('Отклик на вакансию');
    }
}
