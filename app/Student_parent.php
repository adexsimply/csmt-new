<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student_parent extends Model
{
    protected $fillable = ['name','address','phone1','phone2','email'];
    protected $table = 'parents';

    public function students(){
    	return $this->hasMany('App\Student');
    }

    
}
