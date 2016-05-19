<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Australia;
use App\OracleErrors;
use App\Http\Requests;
use  Session;
class AustraliaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $backups = Australia::all();
        $test = 'from the server';
    	return view('reports.australia' )->with('backups' , $backups);
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
        /*$file = $request->file('file');
        $name = time() . $file->getClientOriginalName();
        $file->move('reports_errors' , $name);
        OracleErrors::create(['report_id' => 2,'path' => 'reports_errors/'.$name ] );
        return 'Done';*/
      
    	Australia::create($request->all());
    	/*$records =  Australia::find($user->id);*/
        Session::flash('creado' , 'Creado correctamente...');
        return redirect()->back();
       

        //$error_id  = Australia::orderBy('created_at', 'desc')->first()->id;
       
    }

    // Udpate record
    public function update(Request $request)
    {
    	
    	$id = $request->input('report_id');
    	$report = Australia::find($request->input('id'));
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
        return redirect('/australia');


    }
    public function edit($id)
    {
        $bk = Australia::find($id);
        return $bk;
    }
    public function delete($id)
    {
    	
    	if(Australia::destroy($id))
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
        return Australia::all();
    }
}
