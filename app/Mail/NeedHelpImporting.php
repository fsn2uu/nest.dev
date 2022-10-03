<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Company;
use App\User;

class NeedHelpImporting extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $company;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Company $company, User $user)
    {
        $this->company = $company;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.NeedHelpImporting');
    }
}
