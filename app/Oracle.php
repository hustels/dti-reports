<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Oracle extends Model
{
    protected $table = 'oraclereports';
    protected $fillable = ['date' , 'db' , 'host' , 
    'observation' , 'type' , 'last_bk' , 'traces' , 'retried' , 'status',
    'num_failed_bk'
    ];
    public $timestamps = true;
    // a backup has many errors
    /*
    public function errors()
    {
    	return $this->hasMany('App\OracleErrors');
    }*/
    //oracle->errors
    
}
