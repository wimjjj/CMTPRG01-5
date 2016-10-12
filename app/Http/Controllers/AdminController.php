<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
use Illuminate\Http\Request;

=======
use App\User;
use App\Party;
use Illuminate\Http\Request;
>>>>>>> dev
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

<<<<<<< HEAD
    /**
     * ban an user
     * @param  User   $user  	the banned users
     * @return \Illuminate\Http\Response
     */
    public function banUser(User $user){
    	$user->ban();
=======
    public function ban(Request $request){
    	$user = User::findOrFail($request->input('user'));

        if(!$user->isBanned())
            $user->ban();
        else
            $user->grandAcces();

    	return back();
>>>>>>> dev
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
<<<<<<< HEAD
     * delete a party
     * @param  Party  $party 	the party you want to delete
     * @return \Illuminate\Http\Response
     */
    public function deleteParty(Party $party){
    	$party->delete();
=======
     * deletes an party
     * @param  Request $request [description]
     * @return \Illuminate\Http\Response
     */
    public function deleteParty(Request $request){
    	$party = Party::findOrFail($request->input('party'));

        $party->delete();
>>>>>>> dev

    	return back();
    }
}
