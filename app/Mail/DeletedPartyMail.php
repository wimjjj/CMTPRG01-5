<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Party;

class DeletedPartyMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * the deleted party
     * @var Party
     */
    private $party;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Party $party){
        $this->party = $party;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.deletedparty')
                    ->with(['party' => $this->party]);
    }
}
