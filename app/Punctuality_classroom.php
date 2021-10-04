<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Punctuality_classroom extends Model
{
    protected $fillable = ['student_id','status','date','aagc_id','session_id','term_id'];

    public function student(){
    	return $this->belongsTo('App\Student');
    }

}
