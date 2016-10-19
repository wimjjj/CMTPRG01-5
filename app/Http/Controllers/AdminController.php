<?php

namespace App\Http\Controllers;

use App\User;
use App\Party;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use Illuminate\Support\Facades\Hash;

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
    	$users = User::where('id', '!=', Auth::id())->paginate(10);

    	return view('admin.users', compact('users'));
    }

    /**
     * ban an user
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function ban(Request $request){
    	$user = User::findOrFail($request->input('user'));

        if(!$user->isBanned())
            $user->ban();
        else
            $user->grandAcces();

    	return back();
    }

    /**
     * resets the password of an user
     * @param  Request $request [description]
     * @return \Illuminate\Http\Response
     */
    public function resetPassword(Request $request){
        $this->validate($request, ['userid' => 'required|integer']);

        $user = User::findOrFail($request->input('userid'));

        $password = Hash::make('password');

        $user->password = $password;
        $user->save();

        return Back();
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
     * deletes a party
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function deleteParty(Request $request){
    	$party = Party::findOrFail($request->input('party'));

        $party->delete();

    	return back();
    }
}
