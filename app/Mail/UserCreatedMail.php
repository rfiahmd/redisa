<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $password;

    public function __construct(User $user, $password)
    {
        $this->user = $user;
        $this->password = $password;
    }

    public function build()
    {
        return $this->subject('Akun Anda Telah Dibuat')
            ->view('emails.template_email')
            ->with([
                'nama_lengkap' => $this->user->nama_lengkap,
                'username' => $this->user->username,
                'email' => $this->user->email,
                'password' => $this->password,
                'login_url' => url('/login'),
            ]);
    }
}
