<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Error extends Model
{
    public $timestamps = true;
    protected $table = 'errors';
    protected $fillable = ['oracle_id' , 'path' , 'chinas_id' , 'australias_id' , 'francias_id' , 'srvmasts_id' , 'vicalvaros_id'];
    /*
    public function report()
    {
    	return $this->belongsTo('App\Oracle');
    }*/
}
