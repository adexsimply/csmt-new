<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public function classes(){
    	return $this->hasMany('App\Class');
    }

    public static function name($id){
    	return self::find($id)->name;
    }
}
