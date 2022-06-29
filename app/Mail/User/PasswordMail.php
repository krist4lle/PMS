<?php

namespace App\Mail\User;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $password;

    public $email;

    public function __construct($password, $email)
    {
        $this->password = $password;
        $this->email = $email;
    }

    public function build()
    {
        return $this->markdown('mail.user.credentials');
    }
}
