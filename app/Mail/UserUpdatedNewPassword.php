<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;
use App\Company;

class UserUpdatedNewPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $company;
    public $password;

    /**
     * Create a new message instance.
     *
     * @return void
     */
     public function __construct(Company $company, User $user, $password)
     {
         $this->company = $company;
         $this->user = $user;
         $this->password = $password;
     }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.UserUpdatedNewPassword')
            ->subject('Your Nest Password Has Changed');
    }
}
