<?php

namespace App\Http\Controllers;

use App\Mail\MailHandler;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use App\Party;
use App\User;
use Validator;
use Illuminate\Pagination\Paginator;

class PartyController extends Controller
{
    /**
     * shows a list with all the parties you organised
     * @return \Illuminate\Http\Response
     */
    public function owned(){
        $parties = Auth::user()
                        ->ownParties()
                        ->orderBy('created_at', 'desc')
                        ->paginate(10);

        return view('parties.owned', compact('parties'));
    }

    public function attended(){
        $parties = Auth::user()
                        ->attendedParties()
                        ->orderBy('created_at', 'desc')
                        ->paginate(10);

        return view('parties.attended', compact('parties'));
    }

    /**
     * shows the form for creating a new party
     * @return \Illuminate\Http\Response
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
    	$party = Party::with('owner')->findOrFail($id);

        $this->authorize('view', $party);

    	return view('parties.details', compact('party'));
    }

    public function attendees(Request $request, $id){
        $party = Party::with([
            'owner' => function($query) use ($id) {
                $query->withCount(['tasks' => function ($query) use ($id){
                            $query->where('party_id', $id);        
                        }
                    ]);
                }, 
            'attendees' => function($query) use ($id) {
                $query->withCount(['tasks' => function ($query) use ($id){
                            $query->where('party_id', $id);        
                        }
                    ]);
                }
            ])
        ->findOrFail($id);

        $users = $party->attendees->push($party->owner);

        return view('parties.attendees', compact('party', 'users'));
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
        $party = Party::with('attendees', 'owner')->findOrFail($id);

        $this->authorize('isOwner', $party);

        $this->validate($request, ['keyword' => 'required|max:255']);

        $keyword = $request->input('keyword');

        $ofset = 0;

        $attendeedIds = [];

        foreach($party->attendees as $user){
            $attendeedIds[] = $user->id;
        }

        $users = User::whereNotIn('id', $attendeedIds)
            ->where('id', '!=', $party->owner->id)
            ->where(function($query) use ($keyword) {
                $query->orWhere('name', 'LIKE', "%$keyword%")
                      ->orWhere('email', 'LIKE', "%$keyword%");
            })
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
        $party = Party::with('owner')->findOrFail($id);

        $this->authorize('isOwner', $party);

        return view('parties.addusers', compact('party'));
    }

    /**
     * sends the invite to an user
     * @param  int $partyid         id of the party
     * @param  int $userid          id of the user
     * @return \Illuminate\Http\Response
     */
    public function invite(MailHandler $mailHandler, $partyid, $userid){
        $user = User::findOrFail($userid);
        $party = Party::with('owner')->findOrFail($partyid);

        $this->authorize('isOwner', $party);

        //you cant invite yourself
        if($userid == Auth::id()) return back();

        //don't invite an user twice!
        if($user->attendedParties->contains($party)) return back();

        $user->attendedParties()->attach($party);

        $mailHandler->sendInviteMail($party, $user);

        return redirect(Route('party.invite', ['id' => $party->id]));
    }
}   
