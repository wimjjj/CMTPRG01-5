<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $user = Auth::user()->load([
                'attendedParties' => function($query){
                    $query->orderBy('created_at', 'desc')
                          ->take(3);
                },
                'ownParties' => function($query){
                    $query->orderBy('created_at', 'desc')
                          ->take(3);
                },
                'invitedParties' => function($query){
                    $query->orderBy('created_at', 'desc')
                          ->take(3);
                },
            ]);

        $ownedParties = $user->ownParties;

        $attendedParties = $user->attendedParties;

        $invitedParties = $user->invitedParties;

        return view('home', compact('ownedParties', 'attendedParties', 'invitedParties'));
    }

    public function banned(){
        return view('auth.banned');
    }
}
