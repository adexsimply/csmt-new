<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Neatness extends Model
{
    protected $fillable = ['student_id','status','date','aagc_id','session_id','term_id'];
}
