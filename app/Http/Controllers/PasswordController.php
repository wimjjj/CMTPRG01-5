<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;

class PasswordController extends Controller
{
    public function index(){
    	return view('auth.passwords.chance');
    }

    public function update(Request $request){
    	$this->validate($request, [
    		'password' => 'required',
    		'new_password' => 'required|min:6|confirmed'
    		]);

    	$user = Auth::user();

    	if (!Hash::check($request->input('password'), $user->password)){
    		return back()->withInput()->withErrors(['password' => "Your password doesn't match"]);
    	}

    	$password = Hash::make($request->input('new_password'));

    	$user->password = $password;

    	$user->save();

    	return view('auth.passwords.updated');
    }
}
