<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Report;
use App\Http\Requests;
use App\Party;
use Auth;
class ReportController extends Controller
{	
	/**
	 * shows the form for creating a new report
	 * @param  int $partyid     	id of the reported party
	 * @return \Illuminate\Http\Response
	 */
    public function create($partyid){
        $party = Party::with('invited')->findOrFail($partyid);

        $this->authorize('report', $party);

    	return view('reports.new', compact('party'));
    }

    /**
     * stores the new report
     * @param  Request $request [description]
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
    	$this->validate($request, [
    		'party_id' => 'required|integer',
    		'message' => 'required']);

        $party = Party::with('invited')->findOrFail($request->input('party_id'));

        $this->authorize('report', $party);

    	$report = new Report($request->all());
    	$report->user_id = Auth::id();
    	$report->save();

    	return redirect(Route('home'));
    }

    /**
     * deletes a report
     * @param  Request $request [description]
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request){
    	$this->validate($request, ['reportid' => 'required|integer']);

    	$report = Report::findOrFail($request->input('reportid'));

    	$report->delete();
    	
    	return back();
    }
}
