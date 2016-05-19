<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Oracle;
use App\People;
class OracleController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
    	//return view('reports.oracle' )->with('backups' , $backups);
        return view('reports.oracle' );
    }
    // Get reports
    public function getReports()
    {
        return Oracle::all();
    }
    // Handle post request to create oracle report
 	public function create(Request $request)
    {
    	$user = Oracle::create($request->all());
    	$records =  Oracle::find($user->id);
		/*return response()->json(
		array(
				"Result"			=>		"OK",
				"Record"			=>		$records
			)
		);*/
        return redirect()->back();
    }
    // Handle get request to list reports
    public function show(Request $request)
    {
    	$num_rows = Oracle::all()->count();
		//$records =  Oracle::all();
		/*return response()->json(
		array(
				"Result"			=>		"OK",
				"TotalRecordCount"	=>		$num_rows,
				"Records"			=>		$records
			)
		);*/
		$records = \DB::table('oraclereports')
			   ->skip($request->input("jtStartIndex"))
               ->take($request->input("jtPageSize"))
               ->get();
		return response()->json(
		array(
				"Result"			=>		"OK",
				"TotalRecordCount"	=>		$num_rows,
				"Records"			=>		$records
			)
		);
		
    }
    // Udpate record
    public function update(Request $request)
    {
    	$id = $request->input('report_id');
    	$report = Oracle::find($request->input('id'));
    	$report->date = $request->input('date');
    	$report->db = $request->input('db');
    	$report->host = $request->input('host');
    	$report->type = $request->input('type');
    	$report->last_bk = $request->input('last_bk');
    	$report->num_failed_bk = $request->input('num_failed_bk');
    	$report->retried = $request->input('retried');
    	$report->status = $request->input('status');
    	$report->observation = $request->input('observation');
    	$report->save();
        return redirect('/oracle');
        /*
    	$records =  Oracle::all();
		return response()->json(
		array(
				"Result"			=>		"OK",
				"Records"			=>		$records
			)
		);*/
    }
    public function edit($id)
    {
        $bk = Oracle::find($id);
        //return view('partials.oracle-edit-form' , compact('bk'));
        return $bk;
    }
    public function delete($id)
    {
    	//$report = Oracle::find($id);
    	if(Oracle::destroy($id))
        {
            return redirect()->back();
        }
        else{
            return $id;
        }
        //return redirect('/oracle');
    	/*$records =  Oracle::all();
		return response()->json(
		array(
				"Result"			=>		"OK",
				"Records"			=>		$records
			)
		);*/
    }

}
