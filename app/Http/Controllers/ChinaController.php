<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\China;
use App\Http\Requests;
use Session;
class ChinaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $backups = China::all();
        $test = 'from the server';
    	return view('reports.china' )->with('backups' , $backups);
    }
    // Handle post request to create oracle report
 	public function create(Request $request)
    {
          // Validate
       $this->validate($request, [
        'date' => 'required',
        'session' => 'required',
        'specification' => 'required',
        'host' => 'required',
        'type' => 'required',
        'retried' => 'required',
      
        
      ]);
    	$user = China::create($request->all());
    	$records =  China::find($user->id);
		/*return response()->json(
		array(
				"Result"			=>		"OK",
				"Record"			=>		$records
			)
		);*/
        Session::flash('creado' , 'Creado correctamente...');
        return redirect()->back();
    }

    // Udpate record
    public function update(Request $request)
    {
    	
    	$id = $request->input('report_id');
    	$report = China::find($request->input('id'));
    	$report->date = $request->input('date');
    	$report->session = $request->input('session');
    	$report->host = $request->input('host');
    	$report->type = $request->input('type');
    	$report->specification = $request->input('specification');
    	$report->new_session = $request->input('new_session');
    	$report->retried = $request->input('retried');
    	$report->end_ok = $request->input('end_ok');
    	$report->observations = $request->input('observations');
    	$report->incident = $request->input('incident');
    	$report->link = $request->input('link');
    	$report->save();
        Session::flash('modificado' , 'Modificado correctamente...');
        return redirect('/china');


    }
    public function edit($id)
    {
        $bk = China::find($id);
        return $bk;
    }
    public function delete($id)
    {
    	
    	if(China::destroy($id))
        {
            return redirect()->back();
        }
        else{
            return $id;
        }
    }
    // Return all reports
    public function getReports()
    {
        return China::all();
    }
}
