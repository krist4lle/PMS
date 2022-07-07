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

    public $token;

    public function __construct($password, $email, $token)
    {
        $this->password = $password;
        $this->email = $email;
        $this->token = $token;
    }

    public function build()
    {
        return $this->markdown('mail.user.credentials');
    }
}
