<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Subject extends Model
{
    protected $fillable = ['name','subject_school_id'];


    public static function name($id){
    	return self::find($id)->name;
    }

    public function subject_category(){
    	return $this->belongsToMany('App\Subject_category');
    }


    public static function categoryId($id){
        return DB::table('subject_subject_category')
                    ->where([['subject_id',$id],['subject_school_id',2]])
                    ->first();
    }

    /*Collect subject of a given class e.g All JSS1 Subject*/
    public static function groupClassSubject($group_class_id,$session_id,$arm_id=false,$alias_id=false){

    	$condition = 'group_class_id = '.$group_class_id.' ';
    	

    	if($arm_id){
    		$condition.=' AND arm_id = '.$arm.' ';
    	}

    	if($alias_id){
    		$condition.=' AND alias_id = '.$alias.' ';
    	}

    	$query = 'id IN (SELECT DISTINCT subject_id FROM aagc_subject_student WHERE session_id = '.$session_id.' AND aagc_id IN (SELECT id FROM aagc WHERE '.$condition.' ))';

    	$subjects = self::whereRaw($query)->get(['id','name']);

    	return $subjects;
    }


   
}
