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
     * creates a new Party
     * @param  Request $request
     * @return rediricts to prev page
     */
    public function create(Request $request){
    	$this->validate($request, ['name' => 'required|max:50',
    							   'description' => 'required|max:255']);

    	$party = new Party($request->all());
    	$party->user_id = Auth::id();

    	$party->save();

    	return Back();
    }

    /**
     * shows a single party
     * @param  id $id [description]
     * @return [type]     [description]
     */
    public function show($id){
    	$party = Party::findOrFail($id);

    	$party->with('owner', 'attendees')->get();

    	return view('parties.details', compact('party'));
    }

    /**
     * binds an user to a party
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function attend($id){
    	$party = Party::findOrFail($id);
    	$user = Auth::user();

    	if(!$user->attendedParties->contains($party))
    		$user->attendedParties()->attach($party);

    	return Back();
    }

    /**
     * detachs an user from a party
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function dontAttend($id){
    	Auth::user()->attendedParties()->detach($id);

    	return back();
    }

    /**
     * lets te owner of a party searchs for users and invite them
     * @param  Request $request [description]
     * @param  [type]  $id      id of the party
     * @return [type]           [description]
     */
    public function inviteUsers(Request $request, $id){
        $party = Party::findOrFail($id);

        if($party->owner->id != Auth::id()) return redirect('/');

        $this->validate($request, ['keyword' => 'required|max:255']);

        $keyword = $request->input('keyword');

        $users = User::where('name', 'LIKE', "%$keyword%")
            ->orWhere('email', 'LIKE', "%$keyword%")
            ->take(10)
            ->get();
        
        return view('parties.addusers', compact('party', 'users'));
    }

    /**
     * shows the screen where the users can search for people
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function showInvite($id){
        $party = Party::findOrFail($id);

        if($party->owner->id != Auth::id()) return redirect('/');

        return view('parties.addusers', compact('party'));
    }

    /**
     * sends the invite to an user
     * @param  [type] $partyid id of the party
     * @param  [type] $userid  id of the user
     * @return [type]          [description]
     */
    public function invite($partyid, $userid){
        $user::findOrFail($userid);
        $party::findOrFail($partyid);


    }
}   
