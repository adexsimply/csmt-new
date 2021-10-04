<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
	protected $fillable = ['id','name','state_id'];
	protected $table = 'states';

    public function lgas(){
    	return $this->hasMany('App\Lga');
    }
}
