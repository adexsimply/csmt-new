<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lga extends Model
{
	protected $fillable = ['id','name','state_id'];
	protected $table = 'lgas';

    public function state(){
    	return $this->belongsTo('App\State');
    }
}
