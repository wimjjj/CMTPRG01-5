<?php

namespace App\Http\Controllers;

use App\User;
use App\Party;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\Mail\MailHandler;

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
    	$users = User::where('id', '!=', Auth::id())
            ->withCount('ownParties', 'attendedParties')
            ->paginate(10);

    	return view('admin.users', compact('users'));
    }

    /**
     * lets the admin search for users
     * @param  Request $request [description]
     * @return \Illuminate\Http\Response
     */
    public function searchUsers(Request $request){
        $keyword = $request->get('keyword');
        $status = $request->get('status');

        $users = User::where('id', '!=', Auth::id())
            ->where(function($query) use ($status){
                if($status == 'banned') $query->where('access', -1);

                if($status == 'access') $query->where('access', '>=', 0);

                if($status == 'admin') $query->where('access', 1);
            })
            ->where(function($query) use ($keyword) {                       
                $query->orWhere('name', 'LIKE', "%$keyword%")
                      ->orWhere('email', 'LIKE', "%$keyword%");
            })
            ->withCount('ownParties', 'attendedParties')
            ->paginate(10);

        return view('admin.users', compact('users', 'keyword', 'status'));
    }

    /**
     * ban an user
     * @param  MailHandler $mailHandler [description]
     * @param  Request     $request     [description]
     * @return \Illuminate\Http\Response
     */
    public function ban(MailHandler $mailHandler, Request $request){
    	$user = User::findOrFail($request->input('user'));

        if(!$user->isBanned())
            $user->ban();
        else
            $user->grandAcces();

        $mailHandler->sendBannedMail($user, Auth::user());

    	return back();
    }

    /**
     * make an user admin
     * @param  Request $request [description]
     * @return \Illuminate\Http\Response
     */
    public function admin(Request $request){
        $user = User::findOrFail($request->input('user'));

        if($user->isAdmin())
            $user->grandAcces();
        else
            $user->makeAdmin();

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
    	$parties = Party::orderBy('created_at', 'desc')
            ->with('owner')
            ->withCount('reports')
            ->paginate(10);

    	return view('admin.parties', compact('parties'));
    }

    /**
     * deletes a party
     * @param  Request $request [description]
     * @return \Illuminate\Http\Response
     */
    public function deleteParty(MailHandler $mailHandler, Request $request){
    	$party = Party::findOrFail($request->input('party'));

        $mailHandler->sendDeletedPartyMail($party);

        $party->delete();

    	return back();
    }

    /**
     * shows the reports for a party
     * @param  int $partid      id of the party
     * @return \Illuminate\Http\Response
     */
    public function reports($partyid){
        $party = Party::with('reports.user')->findOrFail($partyid);

        $reports = $party->reports;

        return view('admin.reports', compact('party', 'reports'));
    }
}
