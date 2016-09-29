<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use App\Party;

class PartyController extends Controller
{
    public function create(Request $request){
    	$this->validate($request, ['name' => 'required|max:50',
    							   'description' => 'required|max:255']);

    	$party = new Party($request->all());
    	$party->user_id = Auth::id();

    	$party->save();

    	return Back();
    }

    public function show($id){
    	$party = Party::findOrFail($id);

    	$party->with('owner', 'attendees')->get();

    	return view('parties.details', compact('party'));
    }

    public function attend($id){
    	$party = Party::findOrFail($id);
    	$user = Auth::user();

    	if(!$user->attendedParties->contains($party))
    		$user->attendedParties()->attach($party);

    	return Back();
    }
}
