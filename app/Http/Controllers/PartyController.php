<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use App\Party;
use App\User;

class PartyController extends Controller
{
    /**
     * shows the form for creating a new party
     * @return [type] [description]
     */
    public function create(){
        return view('parties.new');
    }

    /**
     * creates a new Party
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
    	$this->validate($request, ['name' => 'required|max:50',
    							   'description' => 'required|max:255']);

    	$party = new Party($request->all());
    	$party->user_id = Auth::id();

    	$party->save();

    	return redirect(Route('party.show', ['id' => $party->id]));
    }

    /**
     * shows a single party
     * @param  id $id       id of the party
     * @return \Illuminate\Http\Response
     */
    public function show($id){
    	$party = Party::findOrFail($id);

    	$party->load(['owner', 'attendees' => function($query){
            $query->orderBy('attendees.created_at', 'desc')->take(3);
        }])->get();

        $this->authorize('view', $party);

    	return view('parties.details', compact('party'));
    }

    /**
     * detachs an user from a party
     * @param  int $id      id of the party
     * @return \Illuminate\Http\Response
     */
    public function dontAttend($id){
    	Auth::user()->attendedParties()->detach($id);

    	return back();
    }

    /**
     * lets te owner of a party searchs for users and invite them
     * @param  Request $request [description]
     * @param  [type]  $id      id of the party
     * @return \Illuminate\Http\Response
     */
    public function inviteUsers(Request $request, $id){
        $party = Party::findOrFail($id);

        $this->authorize('isOwner', $party);

        $this->validate($request, ['keyword' => 'required|max:255']);

        $keyword = $request->input('keyword');

        $users = User::where('name', 'LIKE', "%$keyword%")
            ->orWhere('email', 'LIKE', "%$keyword%")
            ->take(10)
            ->get();
        
        return view('parties.addusers', compact('party', 'users', 'keyword'));
    }

    /**
     * shows the screen where the users can search for people
     * @param  int $id      id of the party
     * @return \Illuminate\Http\Response
     */
    public function showInvite($id){
        $party = Party::findOrFail($id);

        $this->authorize('isOwner', $party);

        return view('parties.addusers', compact('party'));
    }

    /**
     * sends the invite to an user
     * @param  int $partyid         id of the party
     * @param  int $userid          id of the user
     * @return \Illuminate\Http\Response
     */
    public function invite($partyid, $userid){
        $user = User::findOrFail($userid);
        $party = Party::findOrFail($partyid);

        $this->authorize('isOwner', $party);

        //you cant invite yourself
        if($userid == Auth::id()) return back();

        //don't invite an user twice!
        if(!$user->attendedParties->contains($party))
            $user->attendedParties()->attach($party);

        return redirect(Route('party.invite', ['id' => $party->id]));
    }
}   
