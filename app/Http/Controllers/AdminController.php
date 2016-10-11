<?php

namespace App\Http\Controllers;

use App\User;
use App\Party;
use Illuminate\Http\Request;
use App\Http\Requests;

class AdminController extends Controller
{
	/**
	 * shows te admindashboard
	 * @return \Illuminate\Http\Response
	 */
    public function index(){
    	return view('admin.index');
    }

    /**
     * shows a list with users
     * @return \Illuminate\Http\Response
     */
    public function users(){
    	$users = User::paginate(10);

    	return view('admin.users', compact('users'));
    }

    /**
     * ban an user
     * @param  User   $user  	the banned users
     * @return \Illuminate\Http\Response
     */
    public function ban(User $user){
    	$user->ban();

    	return back();
    }

    /**
     * shows a list with parties
     * @return \Illuminate\Http\Response
     */
    public function parties(){
    	$parties = Party::paginate(10);

    	return view('admin.parties', compact('parties'));
    }

    /**
     * delete a party
     * @param  Party  $party 	the party you want to deletegi
     * @return \Illuminate\Http\Response
     */
    public function deleteParty(Party $party){
    	$party->delete();

    	return back();
    }
}
