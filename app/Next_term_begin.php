<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Next_term_begin extends Model
{
    protected $fillable = ['session_id','term_id','begins','student_category_id'];


    public function term(){
    	return $this->belongsTo('App\Term');
    }

    public function session(){
    	return $this->belongsTo('App\Session');
    }


}