<?php

namespace App\Policies;

use App\User;
use App\Task;
use App\Party;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
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
     * checks if an user is authorized to edit a given task
     * @param  User   $user     the current user
     * @param  Task   $task     the given task
     * @return boolean
     */
    public function edit(User $user, Task $task){
        return $task->party->owner->id == $user->id;
    }

    /**
     * checks if an user is authorized to view a given tasks 
     * @param  User   $user     the current user
     * @param  Task   $task     the given tasks
     * @return boolean
     */
    public function show(User $user, Task $task){
        if($task->party->owner->id == $user->id) return true;

        if($task->party->attendees->contains($user)) return true;

        return false;
    }

    /**
     * checks if an user is authorized to delete a given task
     * @param  User   $user     the current user
     * @param  Task   $task     the given task
     * @return boolean
     */
    public function delete(User $user, Task $task){
        return $task->party->owner->id == $user->id;
    }
}
