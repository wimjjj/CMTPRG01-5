<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Task;
use Auth;
use App\user;
use App\Party;

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

        $this->authorize('view', $party);

        return view('tasks.index', compact('tasks', 'party'));
    }

    /**
     * shows a taks
     * @param  int $id      id of the task
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $task = Task::findOrFail($id);

        $this->authorize('show', $task);

        return view('tasks.details', compact('task'));
    }

	/**
	 * shows the form for creating a new task
	 * @param  int $id 		id of the party the task belongs to
	 * @return \Illuminate\Http\Response
	 */
    public function create($id){
    	$party = Party::findOrFail($id);

        $this->authorize('createTasks', $party);

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

    	$this->authorize('createTasks', $party);

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

        $this->authorize('edit', $task);

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

    	$this->authorize('edit', $task);

    	$this->validate($request, ['description' => 'required|max:255']);

    	$task->update($request->all());

    	return back();
    }

    /**
     * bind the logged in user to a task
     * @param  int $id 		id of the task
     * @return \Illuminate\Http\Response
     */	
    public function claim($id){
    	$task = Task::findOrFail($id);

    	$this->authorize('show', $task);

        //check if task if already claimed
        if($task->user) return back();
    	
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

        $this->authorize('delete', $task);
        
        $task->delete();

        return redirect('/party/' . $task->party->id . '/tasks');
    }
}
