<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Aagc extends Model
{
    protected $fillable = ['group_class_id','arm_id','alias_id'];

    protected $table = 'aagc';


    /*Check sss 2 third term*/
    public static function isCatTerm($group_class_id,$term_id){
        if($group_class_id == 5 && $term_id == 3)
            return true;
        return false;
    }

    public static function active(){
        $active = DB::table('session_term')->where('status',1)->first(['session_id','term_id']);

        return $active;
    }


    public static function active_session_term(){
        $active_st = DB::table('session_term')
            ->leftJoin('sessions', 'sessions.id', '=', 'session_term.session_id')
            ->leftJoin('terms', 'terms.id', '=', 'session_term.term_id')
            ->addSelect('terms.name as term_name', 'sessions.name as session_name')
            ->where('session_term.status',1)
            ->first(['session_id','term_id']);

        return $active_st;
    }

    /*Collect sessions in a selected class arm*/
    public function sessions(){
    	return $this->belongsToMany('App\Session')->withPivot('id')->orderBy('sessions.id','desc');
    }

    /*Collecting class*/
    public function group_class(){
    	return $this->belongsTo('App\Group_class');
    }
 
     /*Collecting class arm*/
    public function arm(){
    	return $this->belongsTo('App\Arm');
    }

     /*Collecting class arm alias*/
    public function alias(){
    	return $this->belongsTo('App\Alias');
    }

    public function students(){
    	return $this->belongsToMany('App\Student','aagc_session_student')->withPivot('id','principal_comment','teacher_comment','hostel_comment','promotion_status');
    }


    public function subjects(){
    	return $this->belongsToMany('App\Subject','aagc_subject')->withPivot('id');
    }


    public function subjectStudents(){
        return $this->belongsToMany('App\Student','aagc_subject_student')->withPivot('id');
    }


    public static function name($id){
        $name = DB::table('aagc_view')->where('id',$id)->first();
        return $name->class.' &nbsp'.$name->arm;
    }



}
