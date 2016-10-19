<?php

namespace App\Mail;

use Illuminate\Support\Facades\Mail;
use App\Mail\InvitedMail;
use App\Mail\BannedMail;
use App\Mail\DeletedPartyMail;
use App\User;
use App\Party;

/**
 * This class is injected in the controllers that need to send an email
 */
class MailHandler {

	/**
	 * sends a mail to an user to inform him about his new invitation
	 * @param  Party $party   	the party where the user is invited to
	 * @param  User $user  		the user who is invited
	 * @return void
	 */
	public function sendInviteMail($party, $user){
		Mail::to($user)->send(new InvitedMail($party, $user));
	}

	/**
	 * send a mail to an user to inform him about his ban
	 * @param  User $user    	the banned user
	 * @param  User $admin   	the admin that banned the user
	 * @return void
	 */
	public function sendBannedMail($user, $admin){
		Mail::to($user)->send(new BannedMail($user, $admin));
	}

	/**
	 * sends an mail to an user to let him now that his party is deleted
	 * @param  Party $party   	the deleted party
	 * @return void        
	 */
	public function sendDeletedPartyMail($party){
		Mail::to($party->owner)->send(new DeletedPartyMail($party));
	}
}