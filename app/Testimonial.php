<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = ['areas_good_at','image','session_admitted','session_graduated','post_held','abilities','student_id','conduct'];

    const imageUploadPath = 'public/passports';
    const imageViewPath = 'storage/passports/';


    public function student(){
    	return $this->belongsTo('App\Student');
    }
}
