<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;

class BannedMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * the user we just banned or granted access
     * @var Uset
     */
    private $user;

    /**
     * the admin that has banned the user
     * @var User
     */
    private $admin;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, User $admin)
    {
        $this->user = $user;
        $this->admin = $admin;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.banned')
                    ->with([
                        'user' => $this->user,
                        'admin' => $this->admin
                    ]);
    }
}
