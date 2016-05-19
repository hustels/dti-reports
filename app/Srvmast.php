<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Srvmast extends Model
{
    protected $fillable = [
    	'date' , 'session', 'specification' , 'host', 'type' , 'retried' , 'new_session' , 'incident',
    	'link' , 'end_ok' , 'observations'
    ];
    public $timestamps = true;
}
