<?php

namespace App\Policies;

use App\User;
use App\Party;
use Illuminate\Auth\Access\HandlesAuthorization;

class PartyPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * checks if an user is authorized to create a task for a given party
     * @param  User   $user     the current user
     * @param  Party   $task    the given party
     * @return boolean
     */
    public function createTasks(User $user, Party $party){
        return $party->owner->id == $user->id;;
    }

    /**
     * checks if an user is authorized to view a party and the data that belongs to it
     * @param  User   $user     the current user
     * @param  Party  $party    the given party
     * @return bool
     */
    public function view(User $user, Party $party){
        if($party->owner->id == $user->id) return true;

        if($party->attendees->contains($user)) return true;

        return false;
    }

    /**
     * checks if an user is authorized to make chances to a party
     * @param  User    $user    the current user
     * @param  Party   $party   the given party
     * @return boolean 
     */
    public function isOwner(User $user, Party $party){  
        return $party->owner->id == $user->id;
    }

    /**
     * checks if an user is authorized to report a party
     * @param  User    $user    the current user
     * @param  Party   $party   the given party
     * @return boolean
     */
    public function report(User $user, Party $party){
        return $party->invited->contains($user);
    }
}
