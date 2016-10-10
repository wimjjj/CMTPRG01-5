<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Task;
use Auth;
use App\user;
use App\Party;

//TO-DO: refactor the checks on the id's!!!

class TaskController extends Controller
{
    /**
     * shows the tasks that belong to a given party
     * @param  int $id      id of the party 
     * @return \Illuminate\Http\Response
     */
    public function index($id){
        $tasks = Task::where('party_id', $id)
            ->orderBy('user_id', 'asc')
            ->with('user', 'party')
            ->paginate(10);

        if($tasks[0]){
            $party = $tasks[0]->party;
        }
        else {
            $party = Party::findOrFail($id);
        }

        // checks if the user belongs to the party the task is part of
        // an user should only be able to see tasks that belongs to a party where he belongs to
        // if(!($task->party->attendees->contains(Auth::user()) || 
        //    $task->party->owner->id == Auth::id())) return back();

        return view('tasks.index', compact('tasks', 'party'));
    }

    /**
     * shows a taks
     * @param  int $id      id of the task
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $task = Task::findOrFail($id);

        // checks if the user belongs to the party the task is part of
        // an user should only be able to see tasks that belongs to a party where he belongs to
        // if(!($task->party->attendees->contains(Auth::user()) || 
        //    !$task->party->owner->id == Auth::id())) return back();

        return view('tasks.details', compact('task'));
    }

	/**
	 * shows the form for creating a new task
	 * @param  int $id 		id of the party the task belongs to
	 * @return \Illuminate\Http\Response
	 */
    public function create($id){
    	$party = Party::findOrFail($id);

    	if($party->owner->id != Auth::id()) return back();

    	return view('tasks.new', compact('party'));
    }

    /**
     * saves the new task
     * @param  Request $request [description]
     * @param  int $id 		id of the party the task belongs to
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id){
    	$party = Party::findOrFail($id);

    	if($party->owner->id != Auth::id()) return back();

    	$this->validate($request, ['description' => 'required|max:255']);

    	$task = Task::create(['description' => $request->input('description'),
                          'party_id' => $party->id,
                          'user_id' => null]);

    	return redirect('/task/' . $task->id);
    }

    /**
     * shows the form for editing a task
     * @param  int $id 		the id of the task
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
    	$task = Task::findOrFail($id);

    	if($task->party->owner->id != Auth::id()) return back();

    	return view('tasks.edit', compact('task'));
    }

    /**
     * updates a task
     * @param  Request $request [description]
     * @param  int  $id      id of the task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
    	$task = Task::findOrFail($id);

    	if($task->party->owner->id != Auth::id()) return back();

    	$this->validate($request, ['description' => 'required|max:255']);

    	$task->description = $request->input('description');
    	$task->save();

    	return back();
    }

    /**
     * bind the logged in user to a task
     * @param  int $id 		id of the task
     * @return \Illuminate\Http\Response
     */	
    public function claim($id){
    	$task = Task::findOrFail($id);

    	// checks if the user belongs to the party the task is part of
    	// an user should only be able to claim task that belongs to a party where he belongs to
    	// if(!($task->party->attendees->contains(Auth::user()) || 
    	//    !$task->party->owner->id == Auth::id())) return back(); 

    	$task->user_id = Auth::id();
    	$task->save();

    	return back();
    }

    /**
     * deletes a task
     * @param  int $id      id of the task
     * @return \Illuminate\Http\Response
     */
    public function delete($id){
        $task = Task::findOrFail($id);

        $task->delete();

        return redirect('/party/' . $task->party->id . '/tasks');
    }
}
