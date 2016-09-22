<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;

class ProfileController extends Controller
{
    public function index(){
    	$user = Auth::user();

    	return view("users.profile", compact('user'));
    }

    public function edit(){
    	$user = Auth::user();

    	return view('users.form', compact('user'));
    }

    public function update(Request $request){
    	$this->validate($request, [
			'name' => 'required|max:255',
            'email' => 'required|email|max:255']);

    	$user = Auth::user();

    	$user->name = $request->input('name');
    	$user->email = $request->input('email');

    	$user->save();

    	return back();
    }
}
