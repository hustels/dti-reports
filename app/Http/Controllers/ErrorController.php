<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Australia;
use App\Error;
use App\Http\Requests;

class ErrorController extends Controller
{
    public function add(Request $request)
    {
    	$file = $request->file('file');
    	$name = time() . $file->getClientOriginalName();
    	$file->move('reports_errors' , $name);
    	Error::create(['australias_id' => $request->input('australia_id'),
    		'srvmasts_id' => $request->input('srvmasts_id'),
    		'chinas_id' => $request->input('chinas_id'),
    		'francias_id' => $request->input('francias_id'),
    		'vicalvaros_id' => $request->input('vicalvaros_id'),
    		'oracle_id' => $request->input('oracle_id'),
    		'path' => 'reports_errors/'.$name ] );
    	return 'Done';
    }

    public function getErrors(Request  $request)
    {

    	if($request->input('entorno') == 'australia')
    	{
    		return \DB::select('select path from errors where australias_id = ?', [$request->input('id')]);
    	}
    	if($request->input('entorno') == 'oracle')
    	{
    		return \DB::select('select path from errors where oracle_id = ?', [$request->input('id')]);
    	}
    	    	if($request->input('entorno') == 'srvmast')
    	{
    		return \DB::select('select path from errors where srvmasts_id = ?', [$request->input('id')]);
    	}
        if($request->input('entorno') == 'vicalvaro')
        {
            return \DB::select('select path from errors where vicalvaros_id = ?', [$request->input('id')]);
        }
         if($request->input('entorno') == 'francia')
        {
            return \DB::select('select path from errors where francias_id = ?', [$request->input('id')]);
        }
          if($request->input('entorno') == 'china')
        {
            return \DB::select('select path from errors where chinas_id = ?', [$request->input('id')]);
        }

    }
}
