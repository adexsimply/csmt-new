<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    public function sessions(){
    	return $this->BelongsToMany('App\Session')->withPivot('id','status');
    }

}
