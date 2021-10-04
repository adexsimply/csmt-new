<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class psychomotor extends Model
{
    protected $fillable = ['student_id','aagc_id','session_id','term_id','craft_skill','pet_project','sport','remark'];
}
