<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ActivateAccount extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user_id = $this->user->id;
        $token = md5($this->user->email);
        $activationLink = env('APP_URL') . '/user/accountActivate/' . $user_id . '/' . $token;

//	    $activationLink = route('front.activation', [
//		    'id' => $this->user->id,
//		    'token' => md5($this->user->email)
//	    ]);

	    return $this->subject(__('page.confirm_your_account'))
		    ->view('emails.activate')->with([
			    'link' => $activationLink
		    ]);
    }
}
