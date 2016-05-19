<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/', function () {
    return redirect('/home');
});
Route::group(['middleware' => ['web']], function () {
    //
});

Route::group(['middlewareGroups' => 'web'], function () {
   Route::auth();
   
   Route::get('/home', 'HomeController@index');

    //Oracle reports routes
   Route::get('/oracle', 'OracleController@index');
   Route::get('/oracle/reports', 'OracleController@getReports');
   Route::get('/oracle/edit/{id}', 'OracleController@edit');
   Route::get('/oracle/delete/{id}', 'OracleController@delete');
   Route::post('/oracle/list', 'OracleController@show');
   Route::post('/oracle/create', 'OracleController@create');
   Route::post('/oracle/update', 'OracleController@update');

    //Srmvmast reports routes
   Route::get('/srvmast', 'SrvmastController@index');
   Route::get('/srvmast/reports', 'SrvmastController@getReports');
   Route::get('/srvmast/edit/{id}', 'SrvmastController@edit');
   Route::get('/srvmast/delete/{id}', 'SrvmastController@delete');
   Route::post('/srvmast/list', 'SrvmastController@show');
   Route::post('/srvmast/create', 'SrvmastController@create');
   Route::post('/srvmast/update', 'SrvmastController@update');

  //China reports routes
   Route::get('/china', 'ChinaController@index');
   Route::get('/china/reports', 'ChinaController@getReports');
   Route::get('/china/edit/{id}', 'ChinaController@edit');
   Route::get('/china/delete/{id}', 'ChinaController@delete');
   Route::post('/china/list', 'ChinaController@show');
   Route::post('/china/create', 'ChinaController@create');
   Route::post('/china/update', 'ChinaController@update');
  //Australia reports routes
   Route::get('/australia', 'AustraliaController@index');
   Route::get('/australia/reports', 'AustraliaController@getReports');
   Route::get('/australia/edit/{id}', 'AustraliaController@edit');
   Route::get('/australia/delete/{id}', 'AustraliaController@delete');
   Route::post('/australia/list', 'AustraliaController@show');
   Route::post('/australia/create', 'AustraliaController@create');
   Route::post('/australia/update', 'AustraliaController@update');

  //Francia reports routes
   Route::get('/francia', 'FranciaController@index');
   Route::get('/francia/reports', 'FranciaController@getReports');
   Route::get('/francia/edit/{id}', 'FranciaController@edit');
   Route::get('/francia/delete/{id}', 'FranciaController@delete');
   Route::post('/francia/list', 'FranciaController@show');
   Route::post('/francia/create', 'FranciaController@create');
   Route::post('/francia/update', 'FranciaController@update');

  //Vicalvaro reports routes
   Route::get('/vicalvaro', 'VicalvaroController@index');
   Route::get('/vicalvaro/reports', 'VicalvaroController@getReports');
   Route::get('/vicalvaro/edit/{id}', 'VicalvaroController@edit');
   Route::get('/vicalvaro/delete/{id}', 'VicalvaroController@delete');
   Route::post('/vicalvaro/list', 'VicalvaroController@show');
   Route::post('/vicalvaro/create', 'VicalvaroController@create');
   Route::post('/vicalvaro/update', 'VicalvaroController@update');


   // Add errors
   Route::post('/errors', 'ErrorController@add');

   // get errors
    Route::post('/getErrors', 'ErrorController@getErrors');
   


});
