<?php

namespace App\Jobs;

use App\Mail\User\PasswordMail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class UserCredentialsEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private string $email;

    private string $personalEmail;

    private string $password;

    public function __construct(string $email, string $personalEmail, string $password)
    {
        $this->email = $email;
        $this->personalEmail = $personalEmail;
        $this->password = $password;
    }

    public function handle()
    {
        Mail::to($this->personalEmail)->send(new PasswordMail($this->password, $this->email));
    }
}
