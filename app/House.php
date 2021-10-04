<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    protected $fillable = ['colour'];

    public function students(){
    	return $this->hasMany('App\Student');
    }
}
