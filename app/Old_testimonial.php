<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Old_testimonial extends Model
{
   protected $fillable = ['name','admission_no','areas_good_at','image','session_admitted','session_graduated','post_held','abilities','conduct'];

    const imageUploadPath = 'public/passports';
    const imageViewPath = 'storage/passports/';
}
