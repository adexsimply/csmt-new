<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $fillable = ['name'];

    public function terms(){
    	return $this->BelongsToMany('App\Term')->withPivot('id','status');
    }


    /*Collect class arms*/
    public function aagc(){
    	return $this->belongsToMany('App\Aagc');
    }

    

}
