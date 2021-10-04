<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Bece extends Model
{
    protected $fillable = ['student_id','subject_id','session_id','score'];


    public static function score($student_id,$subject_id){
    	$score = self::where([
    				['student_id',$student_id],
    				['subject_id',$subject_id]
    			])->first([

    					DB::raw('IFNULL(score,0) as score')
    				]);

    	return $score;
    }


    public static function grade($gp){

        if($gp >= 90 and $gp <= 100)
            $grade = 'A+';

        else if($gp >= 80 and $gp < 90)
            $grade = 'A';

        else if($gp >= 70 and $gp < 80)
            $grade = 'B+';

        else if($gp >= 60 and $gp < 70)
            $grade = 'B';

        else if($gp >= 50 and $gp < 60)
            $grade = 'C';

        else if($gp >= 40 and $gp < 50)
            $grade = 'D';

        else if($gp < 40 )
            $grade = 'F';

        else 
            /*Not Valid*/
            $grade = 'NI';

        return $grade;

    }



    public static function remark($gp){
        
        if($gp >= 90 and $gp <= 100)
            $remark = 'EXCELLENT';

        else if($gp >= 80 and $gp < 90)
            $remark = 'VERY GOOD';

        else if($gp >= 70 and $gp < 80)
            $remark = 'GOOD';

        else if($gp >= 60 and $gp < 70)
            $remark = 'FAIRLY GOOD';

        else if($gp >= 50 and $gp < 60)
            $remark = 'FAIR';

        else if($gp >= 40 and $gp < 50)
            $remark = 'POOR';

        else if($gp < 40 )
            $remark = 'VERY POOR';

        else 
            /*Not Valid*/
            $remark = 'NI';

        return $remark;

    }






}
