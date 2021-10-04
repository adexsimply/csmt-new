<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Group_class extends Model
{
    public function group(){
    	return $this->belongsTo('App\Group');
    }

    public function arms(){
    	// return $this->belongsToMany('App\Aagc');
    }

    public static function armAlias($group_class_id){
    	$armAlias = DB::table('aagc')
    					->join('arms','arms.id','=','aagc.arm_id')
    					->join('aliases','aliases.id','=','aagc.alias_id')
    					->select('aagc.id','aliases.name as alias','arms.name as arm')
    					->where('aagc.group_class_id',$group_class_id)
    					->get();


        return $armAlias;
    }
}
