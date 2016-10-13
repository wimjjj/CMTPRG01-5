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
        $ownedParties = Auth::user()->ownParties()
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        $attendedParties = Auth::user()->attendedParties()
            ->orderBy('attendees.created_at', 'desc')
            ->take(3)
            ->get();

        return view('home', compact('ownedParties', 'attendedParties'));
    }

    public function banned(){
        return view('auth.banned');
    }
}
