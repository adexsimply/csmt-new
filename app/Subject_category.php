<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject_category extends Model
{
    protected $fillable = ['name','subject_school_id'];


    public static function name($id){
    	return self::find($id)->name;
    }

    public function subjects(){
    	return $this->belongsToMany('App\Subject');
    }
}
