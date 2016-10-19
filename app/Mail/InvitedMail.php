<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;
use App\Party;

class InvitedMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * the party the user is invited to
     * @var Party
     */
    private $party;

    /**
     * the user who is invited to the party
     * @var User
     */
    private $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Party $party, User $user)
    {
        $this->party = $party;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.invited')
                    ->with([
                        'user' => $this->user,
                        'party' => $this->party
                    ]);
    }
}
