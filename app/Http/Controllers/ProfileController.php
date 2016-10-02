<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\User;

class ProfileController extends Controller
{
    /**
     * shows the profile page
     * @return \Illuminate\Http\Response
     */
    public function index(){
    	$user = Auth::user();

    	return view("users.profile", compact('user'));
    }

    /**
     * shows the edit form for your profile
     * @return \Illuminate\Http\Response
     */
    public function edit(){
    	$user = Auth::user();

    	return view('users.form', compact('user'));
    }

    /**
     * updates the profile of the logged in user
     * @param  Request $request [description]
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request){
    	$this->validate($request, [
			'name' => 'required|max:255']);

    	$user = Auth::user();

    	$user->name = $request->input('name');

    	$user->save();

    	return back();
    }

    /**
     * shows the profile of a given user
     * @param  int  $id   id of the user you want to show
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $user = User::findOrFail($id);

        return view('users.profile', compact('user'));
    }

    
}
