<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;

class PasswordController extends Controller
{
    /**
     * shows the form for chancing your password
     * @return \Illuminate\Http\Response
     */
    public function index(){
    	return view('auth.passwords.chance');
    }

    /**
     * updates the password
     * @param  Request $request [description]
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request){
    	$this->validate($request, [
    		'password' => 'required',
    		'new_password' => 'required|min:6|confirmed'
    		]);

    	$user = Auth::user();

        // if the users has not entered his old password correctly, we send him back with an error
    	if (!Hash::check($request->input('password'), $user->password)){
    		return back()->withInput()->withErrors(['password' => "Your password doesn't match"]);
    	}

    	$password = Hash::make($request->input('new_password'));

    	$user->password = $password;

    	$user->save();

    	return view('auth.passwords.updated');
    }
}
