<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Plugin\Addon;
use App\Aagc;

class Assessment extends Model
{
    protected $fillable = ['test1','test2','test3','micro_exam','practical','exam','student_id','aagc_id','session_id','student_category_id','term_id','subject_id'];


    private function domainGrader($dbTable,$aagc_id,$session_id,$term_id,$student_id){
        $condition = array(
            ['aagc_id',$aagc_id],
            ['session_id',$session_id],
            ['term_id',$term_id],
            ['student_id',$student_id]
        );

        $results = DB::table($dbTable)
                        ->where($condition)->get();
        $early = 0;
        $late = 0;

        foreach($results as $result){
            if($result->status == 1)
                $early++;
            else
                $late++;
        }

        $total = ($early + $late) == 0 ? 1 : ($early + $late);
        return ceil($early / $total) * 100;
    }



    /*Classroom punctuality*/
    public static function cPunctuality($aagc_id,$session_id,$term_id,$student_id){
        return (new self)->domainGrader('punctuality_classrooms',$aagc_id,$session_id,$term_id,$student_id);
    }

    /*Classroom punctuality*/
    public static function attendanceCount($aagc_id,$session_id,$term_id,$student_id){      
        $condition = array(
            ['aagc_id',$aagc_id],
            ['session_id',$session_id],
            ['term_id',$term_id],
            ['student_id',$student_id]
        );

        $results = DB::table('attendances')
                        ->where($condition)->get();
        
        return count($results);
    }
/*Exeat Count*/
    public static function clinicCount($aagc_id,$session_id,$term_id,$student_id){      
        $condition = array(
            ['aagc_id',$aagc_id],
            ['session_id',$session_id],
            ['term_id',$term_id],
            ['status',1],
            ['student_id',$student_id]
        );

        $results = DB::table('clinics')
                        ->where($condition)->get();
        
        return count($results);
    }

/*Exeat Count*/
    public static function exeatCount($aagc_id,$session_id,$term_id,$student_id){      
        $condition = array(
            ['aagc_id',$aagc_id],
            ['session_id',$session_id],
            ['term_id',$term_id],
            ['student_id',$student_id]
        );

        $results = DB::table('exeats')
                        ->where($condition)->get();
        
        return count($results);
    }

    

    /*Classroom attendance*/
    public static function cAttendance($aagc_id,$session_id,$term_id,$student_id){
        return (new self)->domainGrader('attendances',$aagc_id,$session_id,$term_id,$student_id);
    }

    /*Subject assignment*/
    public static function sAssigment($aagc_id,$session_id,$term_id,$student_id){
        return (new self)->domainGrader('assignment_subjects',$aagc_id,$session_id,$term_id,$student_id);
    }

    /*Subject assignment*/
    public static function hAssigment($aagc_id,$session_id,$term_id,$student_id){
        return (new self)->domainGrader('assignment_hostels',$aagc_id,$session_id,$term_id,$student_id);
    }


    /*Subject assignment*/
    public static function neatness($aagc_id,$session_id,$term_id,$student_id){
        return (new self)->domainGrader('neatnesses',$aagc_id,$session_id,$term_id,$student_id);
    }

    /*Subject assignment*/
    public static function clinic($aagc_id,$session_id,$term_id,$student_id){
        return (new self)->domainGrader('clinics',$aagc_id,$session_id,$term_id,$student_id);
    }

    /*Subject assignment*/
    public static function exeat($aagc_id,$session_id,$term_id,$student_id){
        return (new self)->domainGrader('exeats',$aagc_id,$session_id,$term_id,$student_id);
    }


    public static function psychomotor($aagc_id,$session_id,$term_id,$student_id){
        $condition = array(
            ['aagc_id',$aagc_id],
            ['session_id',$session_id],
            ['term_id',$term_id],
            ['student_id',$student_id]
        );
        $result = DB::table('psychomotors')
                        ->where($condition)->first();

        $result = Addon::isEmpty($result);

        return $result;
    }

    public static function performance($aagc_id,$session_id,$term_id,$student_id){
        $condition = array(
            ['aagc_id',$aagc_id],
            ['session_id',$session_id],
            ['term_id',$term_id],
            ['student_id',$student_id]
        );
        $result = DB::table('club_report')
                        ->where($condition)->first();

        $result = Addon::isEmpty($result);

        return $result;
    }
    public static function club_remark($aagc_id,$session_id,$term_id,$student_id){
        $condition = array(
            ['aagc_id',$aagc_id],
            ['session_id',$session_id],
            ['term_id',$term_id],
            ['student_id',$student_id]
        );
        $result = DB::table('club_remarks')
                        ->where($condition)->first();

        $result = Addon::isEmpty($result);

        return $result;
    }
    public static function ntb($session_id,$term_id,$student_category_id) {
        $condition = array(
            ['session_id', $session_id],
            ['student_category_id', $student_category_id],
            ['term_id', $term_id]
        );
        $result = DB::table('next_term_begins')
                ->where($condition)->first();

                return $result;
    }
    public static function comments($aagc_id,$session_id,$term_id,$student_id,$student_category_id) {
        $condition = array(
            ['session_id', $session_id],
            ['student_id', $student_id],
            ['aagc_id', $aagc_id],
            ['student_category_id', $student_category_id],
            ['term_id', $term_id]
        );
        $result = DB::table('comments')
                ->where($condition)->first();

                return $result;
    }
    
    public static function classCount2($aagc_id,$session_id,$student_category_id,$term_id) {

        $students_no  =  DB::select('SELECT * FROM aagc_session_student WHERE aagc_id='.$aagc_id.' AND session_id='.$session_id.' AND student_category_id2 = '.$student_category_id.' AND student_id NOT IN (SELECT id FROM students WHERE status=0) AND student_id IN (SELECT student_id FROM assessments WHERE session_id='.$session_id.' AND term_id='.$term_id.')');
        

        // $condition = array(
        //     ['aagc_id',$aagc_id],
        //     ['session_id', $session_id],
        //     ['student_category_id2', $student_category_id]
        // );
        // $result = DB::table('aagc_session_student')
        //         ->where($condition)->get();

                return count($students_no);
    }
    public static function classCount($aagc_id,$session_id,$student_category_id,$term_id,$subject_id) {
        $group_class_id = Aagc::find($aagc_id)->group_class_id;
        if ($group_class_id == 1) {

        $students_no  =  DB::select('SELECT * FROM aagc_session_student WHERE aagc_id='.$aagc_id.' AND session_id='.$session_id.' AND student_category_id2 = '.$student_category_id.' AND student_id NOT IN (SELECT id FROM students WHERE status=0)');
        }
        else 
        {

        $students_no  =  DB::select('SELECT DISTINCT student_id FROM assessments WHERE aagc_id='.$aagc_id.' AND session_id='.$session_id.' AND student_category_id = '.$student_category_id.' AND subject_id= '.$subject_id.' AND term_id= '.$term_id.' AND student_id NOT IN (SELECT id FROM students WHERE status=0)');
        //var_dump($students_no);
        }

        // $condition = array(
        //     ['aagc_id',$aagc_id],
        //     ['session_id', $session_id],
        //     ['student_category_id2', $student_category_id]
        // );
        // $result = DB::table('aagc_session_student')
        //         ->where($condition)->get();

                return count($students_no);
    }
    public static function classCount3($aagc_id,$session_id,$student_category_id,$term_id,$subject_id) {
        
        $students_no  =  DB::select('SELECT DISTINCT student_id FROM assessments WHERE aagc_id='.$aagc_id.' AND session_id='.$session_id.' AND student_category_id = '.$student_category_id.' AND subject_id= '.$subject_id.' AND term_id= '.$term_id.' AND student_id NOT IN (SELECT id FROM students WHERE status=0)');
        
                return count($students_no);
    }

    public static function ninetyCount($aagc_id,$session_id,$student_category_id,$term_id,$subject_id) {
        $condition = array(
            ['aagc_id',$aagc_id],
            ['session_id', $session_id],
            ['student_category_id', $student_category_id],
            ['term_id', $term_id]
        );

            if(Aagc::isCatTerm(Aagc::find($aagc_id)->group_class_id,$term_id))
            {
        $result = DB::select('SELECT student_id, SUM( (IFNULL(test1,0)/2) + (IFNULL(test2,0)/2) + (IFNULL(micro_exam,0)/2) + IFNULL(exam,0) ) as score  FROM assessments WHERE aagc_id='.$aagc_id.' AND session_id='.$session_id.' AND student_category_id='.$student_category_id.' AND term_id='.$term_id.' AND subject_id='.$subject_id.' GROUP BY student_id HAVING score >= 90  ');

            }
            else {
        $result = DB::select('SELECT student_id, SUM( IFNULL(test1,0) + IFNULL(test2,0) + IFNULL(test3,0) + IFNULL(micro_exam,0) + IFNULL(exam,0) ) as score  FROM assessments WHERE aagc_id='.$aagc_id.' AND session_id='.$session_id.' AND student_category_id='.$student_category_id.' AND term_id='.$term_id.' AND subject_id='.$subject_id.' GROUP BY student_id HAVING score >= 90  ');
            }

                return count($result);
    }
 public static function classTotalScores($aagc_id,$session_id,$student_category_id,$term_id,$subject_id) {
    if(Aagc::isCatTerm(Aagc::find($aagc_id)->group_class_id,$term_id))
            {
      
        $result = DB::select('SELECT  SUM( (IFNULL(test1,0)/2) + (IFNULL(test2,0)/2) + (IFNULL(micro_exam,0)/2) + IFNULL(exam,0) ) as score  FROM assessments WHERE aagc_id='.$aagc_id.' AND session_id='.$session_id.' AND student_category_id='.$student_category_id.' AND term_id='.$term_id.' AND subject_id='.$subject_id.'');
            }
            else {
        $result = DB::select('SELECT SUM( IFNULL(test1,0) + IFNULL(test2,0) + IFNULL(test3,0) + IFNULL(micro_exam,0) + IFNULL(exam,0) ) as score  FROM assessments WHERE aagc_id='.$aagc_id.' AND session_id='.$session_id.' AND student_category_id='.$student_category_id.' AND term_id='.$term_id.' AND subject_id='.$subject_id.'');
            }

                return ($result[0]);
    }

    public static function eightyCount($aagc_id,$session_id,$student_category_id,$term_id,$subject_id) {
        $condition = array(
            ['aagc_id',$aagc_id],
            ['session_id', $session_id],
            ['student_category_id', $student_category_id],
            ['term_id', $term_id]
        );
        $result = DB::select('SELECT student_id, SUM( IFNULL(test1,0) + IFNULL(test2,0) + IFNULL(test3,0) + IFNULL(micro_exam,0) + IFNULL(exam,0) ) as score  FROM assessments WHERE aagc_id='.$aagc_id.' AND session_id='.$session_id.' AND student_category_id='.$student_category_id.' AND term_id='.$term_id.' AND subject_id='.$subject_id.' GROUP BY student_id HAVING score >= 80 AND score <=89  ');
                return count($result);
    }

    public static function seventyCount($aagc_id,$session_id,$student_category_id,$term_id,$subject_id) {
        $condition = array(
            ['aagc_id',$aagc_id],
            ['session_id', $session_id],
            ['student_category_id', $student_category_id],
            ['term_id', $term_id]
        );
            if(Aagc::isCatTerm(Aagc::find($aagc_id)->group_class_id,$term_id))
            {
        $result = DB::select('SELECT student_id, SUM( (IFNULL(test1,0)/2) + (IFNULL(test2,0)/2) + (IFNULL(micro_exam,0)/2) + IFNULL(exam,0) ) as score  FROM assessments WHERE aagc_id='.$aagc_id.' AND session_id='.$session_id.' AND student_category_id='.$student_category_id.' AND term_id='.$term_id.' AND subject_id='.$subject_id.' GROUP BY student_id HAVING score >= 70 AND score <=79 ');

            }
            else {

        $result = DB::select('SELECT student_id, SUM( IFNULL(test1,0) + IFNULL(test2,0) + IFNULL(test3,0) + IFNULL(micro_exam,0) + IFNULL(exam,0) ) as score  FROM assessments WHERE aagc_id='.$aagc_id.' AND session_id='.$session_id.' AND student_category_id='.$student_category_id.' AND term_id='.$term_id.' AND subject_id='.$subject_id.' GROUP BY student_id HAVING score >= 70 AND score <=79  ');
            }
                return count($result);
    }

    public static function sixtyCount($aagc_id,$session_id,$student_category_id,$term_id,$subject_id) {
        $condition = array(
            ['aagc_id',$aagc_id],
            ['session_id', $session_id],
            ['student_category_id', $student_category_id],
            ['term_id', $term_id]
        );

            if(Aagc::isCatTerm(Aagc::find($aagc_id)->group_class_id,$term_id))
            {
        $result = DB::select('SELECT student_id, SUM( (IFNULL(test1,0)/2) + (IFNULL(test2,0)/2) + (IFNULL(micro_exam,0)/2) + IFNULL(exam,0) ) as score  FROM assessments WHERE aagc_id='.$aagc_id.' AND session_id='.$session_id.' AND student_category_id='.$student_category_id.' AND term_id='.$term_id.' AND subject_id='.$subject_id.' GROUP BY student_id HAVING score >= 60 AND score <=69  ');

            }
            else {
        $result = DB::select('SELECT student_id, SUM( IFNULL(test1,0) + IFNULL(test2,0) + IFNULL(test3,0) + IFNULL(micro_exam,0) + IFNULL(exam,0) ) as score  FROM assessments WHERE aagc_id='.$aagc_id.' AND session_id='.$session_id.' AND student_category_id='.$student_category_id.' AND term_id='.$term_id.' AND subject_id='.$subject_id.' GROUP BY student_id HAVING score >= 60 AND score <=69  ');

            }
                return count($result);
    }

    public static function fiftyCount($aagc_id,$session_id,$student_category_id,$term_id,$subject_id) {
        $condition = array(
            ['aagc_id',$aagc_id],
            ['session_id', $session_id],
            ['student_category_id', $student_category_id],
            ['term_id', $term_id]
        );
            if(Aagc::isCatTerm(Aagc::find($aagc_id)->group_class_id,$term_id))
            {
        $result = DB::select('SELECT student_id, SUM( (IFNULL(test1,0)/2) + (IFNULL(test2,0)/2) + (IFNULL(micro_exam,0)/2) + IFNULL(exam,0) ) as score  FROM assessments WHERE aagc_id='.$aagc_id.' AND session_id='.$session_id.' AND student_category_id='.$student_category_id.' AND term_id='.$term_id.' AND subject_id='.$subject_id.' GROUP BY student_id HAVING score >= 50 AND score <=59  ');

            }
            else {
        $result = DB::select('SELECT student_id, SUM( IFNULL(test1,0) + IFNULL(test2,0) + IFNULL(test3,0) + IFNULL(micro_exam,0) + IFNULL(exam,0) ) as score  FROM assessments WHERE aagc_id='.$aagc_id.' AND session_id='.$session_id.' AND student_category_id='.$student_category_id.' AND term_id='.$term_id.' AND subject_id='.$subject_id.' GROUP BY student_id HAVING score >= 50 AND score <=59  ');
            }
                return count($result);
    }

    public static function fortyCount($aagc_id,$session_id,$student_category_id,$term_id,$subject_id) {
        $condition = array(
            ['aagc_id',$aagc_id],
            ['session_id', $session_id],
            ['student_category_id', $student_category_id],
            ['term_id', $term_id]
        );

            if(Aagc::isCatTerm(Aagc::find($aagc_id)->group_class_id,$term_id))
            {
        $result = DB::select('SELECT student_id, SUM( (IFNULL(test1,0)/2) + (IFNULL(test2,0)/2) + (IFNULL(micro_exam,0)/2) + IFNULL(exam,0) ) as score  FROM assessments WHERE aagc_id='.$aagc_id.' AND session_id='.$session_id.' AND student_category_id='.$student_category_id.' AND term_id='.$term_id.' AND subject_id='.$subject_id.' GROUP BY student_id HAVING score >= 40 AND score <=49  ');

            }
            else {
        $result = DB::select('SELECT student_id, SUM( IFNULL(test1,0) + IFNULL(test2,0) + IFNULL(test3,0) + IFNULL(micro_exam,0) + IFNULL(exam,0) ) as score  FROM assessments WHERE aagc_id='.$aagc_id.' AND session_id='.$session_id.' AND student_category_id='.$student_category_id.' AND term_id='.$term_id.' AND subject_id='.$subject_id.' GROUP BY student_id HAVING score >= 40 AND score <=49  ');
            }
                return count($result);
    }

    public static function thirtyCount($aagc_id,$session_id,$student_category_id,$term_id,$subject_id) {
        $condition = array(
            ['aagc_id',$aagc_id],
            ['session_id', $session_id],
            ['student_category_id', $student_category_id],
            ['term_id', $term_id]
        );

            if(Aagc::isCatTerm(Aagc::find($aagc_id)->group_class_id,$term_id))
            {
        $result = DB::select('SELECT student_id, SUM( (IFNULL(test1,0)/2) + (IFNULL(test2,0)/2) + (IFNULL(micro_exam,0)/2) + IFNULL(exam,0) ) as score  FROM assessments WHERE aagc_id='.$aagc_id.' AND session_id='.$session_id.' AND student_category_id='.$student_category_id.' AND term_id='.$term_id.' AND subject_id='.$subject_id.' GROUP BY student_id HAVING score >= 30 AND score <=39  ');

            }
            else {

        $result = DB::select('SELECT student_id, SUM( IFNULL(test1,0) + IFNULL(test2,0) + IFNULL(test3,0) + IFNULL(micro_exam,0) + IFNULL(exam,0) ) as score  FROM assessments WHERE aagc_id='.$aagc_id.' AND session_id='.$session_id.' AND student_category_id='.$student_category_id.' AND term_id='.$term_id.' AND subject_id='.$subject_id.' GROUP BY student_id HAVING score >= 30 AND score <=39  ');
            }
                return count($result);
    }

    public static function twentyCount($aagc_id,$session_id,$student_category_id,$term_id,$subject_id) {
        $condition = array(
            ['aagc_id',$aagc_id],
            ['session_id', $session_id],
            ['student_category_id', $student_category_id],
            ['term_id', $term_id]
        );

            if(Aagc::isCatTerm(Aagc::find($aagc_id)->group_class_id,$term_id))
            {
        $result = DB::select('SELECT student_id, SUM( (IFNULL(test1,0)/2) + (IFNULL(test2,0)/2) + (IFNULL(micro_exam,0)/2) + IFNULL(exam,0) ) as score  FROM assessments WHERE aagc_id='.$aagc_id.' AND session_id='.$session_id.' AND student_category_id='.$student_category_id.' AND term_id='.$term_id.' AND subject_id='.$subject_id.' GROUP BY student_id HAVING score >= 20 AND score <=29  ');

            }
            else {
        $result = DB::select('SELECT student_id, SUM( IFNULL(test1,0) + IFNULL(test2,0) + IFNULL(test3,0) + IFNULL(micro_exam,0) + IFNULL(exam,0) ) as score  FROM assessments WHERE aagc_id='.$aagc_id.' AND session_id='.$session_id.' AND student_category_id='.$student_category_id.' AND term_id='.$term_id.' AND subject_id='.$subject_id.' GROUP BY student_id HAVING score >= 20 AND score <=29  ');
            }
                return count($result);
    }

    public static function tenCount($aagc_id,$session_id,$student_category_id,$term_id,$subject_id) {
        $condition = array(
            ['aagc_id',$aagc_id],
            ['session_id', $session_id],
            ['student_category_id', $student_category_id],
            ['term_id', $term_id]
        );

            if(Aagc::isCatTerm(Aagc::find($aagc_id)->group_class_id,$term_id))
            {
        $result = DB::select('SELECT student_id, SUM( (IFNULL(test1,0)/2) + (IFNULL(test2,0)/2) + (IFNULL(micro_exam,0)/2) + IFNULL(exam,0) ) as score  FROM assessments WHERE aagc_id='.$aagc_id.' AND session_id='.$session_id.' AND student_category_id='.$student_category_id.' AND term_id='.$term_id.' AND subject_id='.$subject_id.' GROUP BY student_id HAVING score >= 10 AND score <=19  ');

            }
            else {

        $result = DB::select('SELECT student_id, SUM( IFNULL(test1,0) + IFNULL(test2,0) + IFNULL(test3,0) + IFNULL(micro_exam,0) + IFNULL(exam,0) ) as score  FROM assessments WHERE aagc_id='.$aagc_id.' AND session_id='.$session_id.' AND student_category_id='.$student_category_id.' AND term_id='.$term_id.' AND subject_id='.$subject_id.' GROUP BY student_id HAVING score >= 10 AND score <=19  ');
            }
                return count($result);
    }

    public static function unitCount($aagc_id,$session_id,$student_category_id,$term_id,$subject_id) {
        $condition = array(
            ['aagc_id',$aagc_id],
            ['session_id', $session_id],
            ['student_category_id', $student_category_id],
            ['term_id', $term_id]
        );

            if(Aagc::isCatTerm(Aagc::find($aagc_id)->group_class_id,$term_id))
            {
        $result = DB::select('SELECT student_id, SUM( (IFNULL(test1,0)/2) + (IFNULL(test2,0)/2) + (IFNULL(micro_exam,0)/2) + IFNULL(exam,0) ) as score  FROM assessments WHERE aagc_id='.$aagc_id.' AND session_id='.$session_id.' AND student_category_id='.$student_category_id.' AND term_id='.$term_id.' AND subject_id='.$subject_id.' GROUP BY student_id HAVING score <10  ');

            }
            else {
        $result = DB::select('SELECT student_id, SUM( IFNULL(test1,0) + IFNULL(test2,0) + IFNULL(test3,0) + IFNULL(micro_exam,0) + IFNULL(exam,0) ) as score  FROM assessments WHERE aagc_id='.$aagc_id.' AND session_id='.$session_id.' AND student_category_id='.$student_category_id.' AND term_id='.$term_id.' AND subject_id='.$subject_id.' GROUP BY student_id HAVING score < 10  ');
            }
                return count($result);
    }

    public static function failedCount($aagc_id,$session_id,$student_category_id,$term_id,$subject_id) {
        $condition = array(
            ['aagc_id',$aagc_id],
            ['session_id', $session_id],
            ['student_category_id', $student_category_id],
            ['term_id', $term_id]
        );
            if(Aagc::isCatTerm(Aagc::find($aagc_id)->group_class_id,$term_id))
            {
        $result = DB::select('SELECT student_id, SUM( (IFNULL(test1,0)/2) + (IFNULL(test2,0)/2) + (IFNULL(micro_exam,0)/2) + IFNULL(practical,0) + IFNULL(exam,0) ) as score  FROM assessments WHERE aagc_id='.$aagc_id.' AND session_id='.$session_id.' AND student_category_id='.$student_category_id.' AND term_id='.$term_id.' AND subject_id='.$subject_id.' GROUP BY student_id HAVING score <60  ');

            }
            else {
        $result = DB::select('SELECT student_id, SUM( IFNULL(test1,0) + IFNULL(test2,0) + IFNULL(test3,0) + IFNULL(micro_exam,0) + IFNULL(practical,0) + IFNULL(exam,0) ) as score  FROM assessments WHERE aagc_id='.$aagc_id.' AND session_id='.$session_id.' AND student_category_id='.$student_category_id.' AND term_id='.$term_id.' AND subject_id='.$subject_id.' GROUP BY student_id HAVING score < 60  ');
            }
                return count($result);
    }

    public static function passedCount($aagc_id,$session_id,$student_category_id,$term_id,$subject_id) {
        $condition = array(
            ['aagc_id',$aagc_id],
            ['session_id', $session_id],
            ['student_category_id', $student_category_id],
            ['term_id', $term_id]
        );

            if(Aagc::isCatTerm(Aagc::find($aagc_id)->group_class_id,$term_id))
            {
        $result = DB::select('SELECT student_id, SUM( (IFNULL(test1,0)/2) + (IFNULL(test2,0)/2) + (IFNULL(micro_exam,0)/2) + IFNULL(practical,0) + IFNULL(exam,0) ) as score  FROM assessments WHERE aagc_id='.$aagc_id.' AND session_id='.$session_id.' AND student_category_id='.$student_category_id.' AND term_id='.$term_id.' AND subject_id='.$subject_id.' GROUP BY student_id HAVING score >= 60  ');

            }
            else {
        $result = DB::select('SELECT student_id, SUM( IFNULL(test1,0) + IFNULL(test2,0) + IFNULL(test3,0) + IFNULL(micro_exam,0) + IFNULL(practical,0) + IFNULL(exam,0) ) as score  FROM assessments WHERE aagc_id='.$aagc_id.' AND session_id='.$session_id.' AND student_category_id='.$student_category_id.' AND term_id='.$term_id.' AND subject_id='.$subject_id.' GROUP BY student_id HAVING score >= 60  ');
            }
                return count($result);
    }

    public static function vpoorCount($aagc_id,$session_id,$student_category_id,$term_id,$subject_id) {
        $condition = array(
            ['aagc_id',$aagc_id],
            ['session_id', $session_id],
            ['student_category_id', $student_category_id],
            ['term_id', $term_id]
        );

            if(Aagc::isCatTerm(Aagc::find($aagc_id)->group_class_id,$term_id))
            {
        $result = DB::select('SELECT student_id, SUM( (IFNULL(test1,0)/2) + (IFNULL(test2,0)/2) + (IFNULL(micro_exam,0)/2) + IFNULL(exam,0) ) as score  FROM assessments WHERE aagc_id='.$aagc_id.' AND session_id='.$session_id.' AND student_category_id='.$student_category_id.' AND term_id='.$term_id.' AND subject_id='.$subject_id.' GROUP BY student_id HAVING score <40  ');

            }
            else {
        $result = DB::select('SELECT student_id, SUM( IFNULL(test1,0) + IFNULL(test2,0) + IFNULL(test3,0) + IFNULL(micro_exam,0) + IFNULL(exam,0) ) as score  FROM assessments WHERE aagc_id='.$aagc_id.' AND session_id='.$session_id.' AND student_category_id='.$student_category_id.' AND term_id='.$term_id.' AND subject_id='.$subject_id.' GROUP BY student_id HAVING score < 40  ');
            }
                return count($result);
    }

    public static function fairCount($aagc_id,$session_id,$student_category_id,$term_id,$subject_id) {
        $condition = array(
            ['aagc_id',$aagc_id],
            ['session_id', $session_id],
            ['student_category_id', $student_category_id],
            ['term_id', $term_id]
        );

            if(Aagc::isCatTerm(Aagc::find($aagc_id)->group_class_id,$term_id))
            {
        $result = DB::select('SELECT student_id, SUM( (IFNULL(test1,0)/2) + (IFNULL(test2,0)/2) + (IFNULL(micro_exam,0)/2) + IFNULL(exam,0) ) as score  FROM assessments WHERE aagc_id='.$aagc_id.' AND session_id='.$session_id.' AND student_category_id='.$student_category_id.' AND term_id='.$term_id.' AND subject_id='.$subject_id.' GROUP BY student_id HAVING score >= 40 AND score <=45  ');

            }
            else {
        $result = DB::select('SELECT student_id, SUM( IFNULL(test1,0) + IFNULL(test2,0) + IFNULL(test3,0) + IFNULL(micro_exam,0) + IFNULL(exam,0) ) as score  FROM assessments WHERE aagc_id='.$aagc_id.' AND session_id='.$session_id.' AND student_category_id='.$student_category_id.' AND term_id='.$term_id.' AND subject_id='.$subject_id.' GROUP BY student_id HAVING score >= 40 AND score <45 ');
            }
                return count($result);
    }

    public static function fgoodCount($aagc_id,$session_id,$student_category_id,$term_id,$subject_id) {
        $condition = array(
            ['aagc_id',$aagc_id],
            ['session_id', $session_id],
            ['student_category_id', $student_category_id],
            ['term_id', $term_id]
        );

            if(Aagc::isCatTerm(Aagc::find($aagc_id)->group_class_id,$term_id))
            {
        $result = DB::select('SELECT student_id, SUM( (IFNULL(test1,0)/2) + (IFNULL(test2,0)/2) + (IFNULL(micro_exam,0)/2) + IFNULL(exam,0) ) as score  FROM assessments WHERE aagc_id='.$aagc_id.' AND session_id='.$session_id.' AND student_category_id='.$student_category_id.' AND term_id='.$term_id.' AND subject_id='.$subject_id.' GROUP BY student_id HAVING score >= 45 AND score <=49  ');

            }
            else {
        $result = DB::select('SELECT student_id, SUM( IFNULL(test1,0) + IFNULL(test2,0) + IFNULL(test3,0) + IFNULL(micro_exam,0) + IFNULL(exam,0) ) as score  FROM assessments WHERE aagc_id='.$aagc_id.' AND session_id='.$session_id.' AND student_category_id='.$student_category_id.' AND term_id='.$term_id.' AND subject_id='.$subject_id.' GROUP BY student_id HAVING score >= 45 AND score <=49 ');
            }

                return count($result);
    }
    public static function subject_name($subject_id) {
        $condition = array(
            ['id', $subject_id]
        );
        $result = DB::table('subjects')
                ->where($condition)->first();

                return $result;
    }

    public static function aagc_info($session_id,$student_id,$aagc_id) {
        $condition = array(
            ['session_id', $session_id],
            ['student_id', $student_id],
            ['aagc_id', $aagc_id]
        );
        $result = DB::table('aagc_session_student')
                ->where($condition)->first();

                return $result;
    }

    /*Punctuality resumption*/
    public static function rPunctuality($aagc_id,$session_id,$term_id,$student_id){
        $condition = array(
            ['aagc_id',$aagc_id],
            ['session_id',$session_id],
            ['term_id',$term_id],
            ['student_id',$student_id]
        );

        $result = DB::table('punctuality_resumptions')
                        ->where($condition)->first();

        $result = Addon::isEmpty($result);

        if($result)
         return $result->status == 0 ? 'Late' : 'Early';

        return '-';

    }

    /*SUbject Countn*/
    public static function subject_count($aagc_id,$session_id,$term_id,$student_id){
        // $condition = array(
        //     ['aagc_id',$aagc_id],
        //     ['session_id',$session_id],
        //     ['term_id',$term_id],
        //     ['student_id',$student_id]
        // );

        // $result = DB::table('assessments')
        //                 ->where($condition)->get();

                   $result = DB::select('SELECT DISTINCT subject_id FROM assessments WHERE aagc_id='.$aagc_id.' AND session_id='.$session_id.' AND term_id='.$term_id.' AND student_id='.$student_id.' ');

        return $result;

    }




    /*Print specified subject assessment for a given class*/
    public static function printer($fiddle){
        $aagc_id = $fiddle[0][1];
        $term_id = $fiddle[3][1];

        // if(Aagc::isCatTerm(Aagc::find($aagc_id)->group_class_id,$term_id))
        //    $assessments = Assessment::where($fiddle)
        //         ->join('students','students.id','=','assessments.student_id')
        //         ->select('students.id as student_id','students.surname','students.othernames','students.admission_no','assessments.id','test1','test2','test3','micro_exam','exam',
        //             DB::raw('(((IFNULL(test1,0)+IFNULL(test2,0)+IFNULL(micro_exam,0))/2)+IFNULL(exam,0)) as gp'),
        //             DB::raw('grade(((test1+test2+micro_exam)/2)+exam) as grade'),
        //             DB::raw('remark(((test1+test2+micro_exam)/2)+exam) as remark')
        //             )
        //         ->orderBy('gp','DESC')
        //         ->get();

        // else
    	    $assessments = Assessment::where($fiddle)
    			->join('students','students.id','=','assessments.student_id')
    			->select('students.id as student_id','students.surname','students.othernames','students.admission_no','assessments.id','test1','test2','test3','micro_exam','practical','exam',
    				DB::raw('(IFNULL(test1,0)+IFNULL(test2,0)+IFNULL(test3,0)+IFNULL(micro_exam,0)+IFNULL(practical,0)+IFNULL(exam,0)) as gp'),
    				DB::raw('grade((IFNULL(test1,0)+IFNULL(test2,0)+IFNULL(test3,0)+IFNULL(micro_exam,0)+IFNULL(practical,0)+IFNULL(exam,0))) as grade'),
    				DB::raw('remark((IFNULL(test1,0)+IFNULL(test2,0)+IFNULL(test3,0)+IFNULL(micro_exam,0)+IFNULL(practical,0)+IFNULL(exam,0))) as remark')
    				)
    			->orderBy('gp','DESC')
				->get();


        return Addon::isEmpty($assessments);
    }




    /*Print all class students' grades for all subjects*/
    public static function classAssessment($fiddle){
    	$assessments = Assessment::where($fiddle)
    			->join('students','students.id','=','assessments.student_id')
    			->join('subjects','subjects.id','=','assessments.subject_id')
				->select('students.id as student_id','students.surname','students.othernames','students.admission_no','subjects.name as subject_name',
    				DB::raw('(assessments.test1 + assessments.test2 + assessments.test3 + assessments.micro_exam + assessments.exam) as gp')
    				)              
				// ->simplePaginate(100);
                ->get();

		return Addon::isEmpty($assessments);
    }





    /* Can't imagine myself writing this function. However, it lazy loads student grade in a subject loop  */
    public static function stupidLoading($subject_id,$student_id,$aagc_id,$session_id,$term_id=false,$cummulative=false,$summed=true){

        
        /*Calculate the cummulative (Add all terms score) of a specified subject and student*/
        if($cummulative){
            $score = self::where([
                ['subject_id',$subject_id],
                ['student_id',$student_id],
                ['aagc_id',$aagc_id],
                ['session_id',$session_id]

            ])

            ->select(
                        DB::raw('(IFNULL(sum(test1),0) AS test1'), 
                        DB::raw('(IFNULL(sum(test2),0) AS test2'), 
                        DB::raw('(IFNULL(sum(test3),0) AS test3'), 
                        DB::raw('(IFNULL(sum(micro_exam),0) AS micro_exam'), 
                        DB::raw('(IFNULL(sum(practical),0) AS practical'), 
                        DB::raw('(IFNULL(sum(exam),0) AS exam') 
                    )
            ->first();
        }


        /*Collect student grade for a given term*/
        else
            $score = self::where([
                ['subject_id',$subject_id],
                ['student_id',$student_id],
                ['aagc_id',$aagc_id],
                ['session_id',$session_id],
                ['term_id',$term_id]

            ])->first(['test1','test2','test3','micro_exam','practical','exam']);


        //$score = Addon::isEmpty($score);
        if($score){
            if($summed)
               return round(self::gradePoint($score->test1,$score->test2,$score->test3,$score->micro_exam,$score->practical,$score->exam));
            else
                return $score;
        }

        else
            return self::gradePoint(0,0,0,0,0,0);
    }


    /* Can't imagine myself writing this function. However, it lazy loads student grade in a subject loop  */
    public static function checkDuplicateScores($subject_id,$student_id,$aagc_id,$session_id,$term_id=false){

        $scores = DB::table('assessments')->where([

                ['subject_id',$subject_id],
                ['student_id',$student_id],
                ['aagc_id',$aagc_id],
                ['session_id',$session_id],
                ['term_id',$term_id]

                ])->get();

        return $scores;

        
        
    }



    /* Can't imagine myself writing this function. However, it lazy loads student grade in a subject loop  */
    public static function stupidLoading2($subject_id,$student_id,$aagc_id,$session_id,$term_id=false,$cummulative=false,$summed=true){

        
        /*Calculate the cummulative (Add all terms score) of a specified subject and student*/
        if($cummulative){
            $score = self::where([
                ['subject_id',$subject_id],
                ['student_id',$student_id],
                ['aagc_id',$aagc_id],
                ['session_id',$session_id]

            ])

            ->select(
                        DB::raw('(IFNULL(sum(test1),0) / '.$cummulative.') AS test1'), 
                        DB::raw('(IFNULL(sum(test2),0) / '.$cummulative.') AS test2'), 
                        DB::raw('(IFNULL(sum(test3),0) / '.$cummulative.') AS test3'), 
                        DB::raw('(IFNULL(sum(micro_exam),0) / '.$cummulative.') AS micro_exam'), 
                        DB::raw('(IFNULL(sum(exam),0) / '.$cummulative.') AS exam') 
                    )
            ->first();
        }


        /*Collect student grade for a given term*/
        else
            $score = self::where([
                ['subject_id',$subject_id],
                ['student_id',$student_id],
                ['aagc_id',$aagc_id],
                ['session_id',$session_id],
                ['term_id',$term_id]

            ])->first(['test1','test2','test3','micro_exam','exam']);


        //$score = Addon::isEmpty($score);
        if($score){
            if($summed)
               return round(self::gradePoint2($score->test1,$score->test2,$score->test3,$score->micro_exam,$score->exam));
            else
                return $score;
        }

        else
            return self::gradePoint2(0,0,0,0,0);
    }


    /*Promote student to another class*/
    public static function getPromotionStatus($aagc_id,$session_id,$student_id){

        $condition = array(
            ['aagc_id',$aagc_id],
            ['session_id',$session_id],
            ['student_id',$student_id]
        );

        $result = DB::table('aagc_session_student')
                        ->where($condition)->first();


        return $result;


    }



    public static function cumCatStupidLoading($subject_id,$student_id,$aagc_id,$session_id,$term_id=false,$cummulative=false,$summed=true){

    	
    	/*Calculate the cummulative (Add all terms score) of a specified subject and student*/
    	if($cummulative){

            /*Check for sss2 third term result*/
            if(Aagc::isCatTerm(Aagc::find($aagc_id)->group_class_id,$term_id))
        		$score = self::where([
    	    		['subject_id',$subject_id],
    	    		['student_id',$student_id],
    	    		['aagc_id',$aagc_id],
    	    		['session_id',$session_id]

    	    	])

        		->select(
        					DB::raw('(IFNULL(sum(test1),0) / '.$cummulative.') AS test1'), 
        					DB::raw('(IFNULL(sum(test2),0) / '.$cummulative.') AS test2'), 
                            DB::raw('(IFNULL(sum(test3),0) / '.$cummulative.') AS test3'), 
        					DB::raw('(IFNULL(sum(micro_exam),0) / '.$cummulative.') AS micro_exam'), 
        					DB::raw('(IFNULL(sum(exam),0) / '.$cummulative.') AS exam') 
        				)

    	    	->first();

            
        else
            $score = self::where([
                ['subject_id',$subject_id],
                ['student_id',$student_id],
                ['aagc_id',$aagc_id],
                ['session_id',$session_id],
                ['term_id',$term_id]

            ])->first(['test1','test2','test3','micro_exam','practical','exam']);

    	}


    	/*Collect student grade for a given term*/
    
        else
            $score = self::where([
                ['subject_id',$subject_id],
                ['student_id',$student_id],
                ['aagc_id',$aagc_id],
                ['session_id',$session_id],
                ['term_id',$term_id]

            ])->first(['test1','test2','test3','micro_exam','practical','exam']);


        $score = Addon::isEmpty($score);
        if($score){
            if($summed)
    	       return round(self::gradePoint2($score->test1,$score->test2,$score->test3,$score->micro_exam,$score->practical,$score->exam));
            else
                return $score;
        }

        else
            return self::gradePoint2(0,0,0,0,0,0);
    }





    /*Collect all class student that have been assessed*/
    public static function classStudent($aagc_id,$category_id,$session_id,$term_id=false){

        /*Collect students in a given term*/
        if(Aagc::isCatTerm(Aagc::find($aagc_id)->group_class_id,$term_id)) {
        if($term_id)
            $students = DB::select('SELECT DISTINCT std.id, std.admission_no,std.othernames,std.surname, ass.gp FROM (SELECT student_id,  SUM((IFNULL(test1,0)/2 + IFNULL(test2,0)/2 + IFNULL(micro_exam,0)/2 + IFNULL(practical,0) + IFNULL(exam,0))) gp FROM assessments WHERE aagc_id='.$aagc_id.' AND session_id='.$session_id.' AND term_id='.$term_id.' GROUP BY student_id) ass inner join (SELECT id,admission_no,othernames,surname FROM students WHERE student_category_id = '.$category_id.' AND status=1) std on ass.student_id = std.id ORDER BY ass.gp DESC');

        /*Collect student in a given session*/
        else
            $students = DB::select('SELECT DISTINCT std.id, std.admission_no,std.othernames,std.surname FROM (SELECT student_id FROM assessments WHERE aagc_id='.$aagc_id.' AND session_id='.$session_id.') ass inner join (SELECT id,admission_no,othernames,surname FROM students WHERE student_category_id = '.$category_id.') std on ass.student_id = std.id ORDER BY std.surname ASC');

        }
        else {
        if($term_id)
            $students = DB::select('SELECT DISTINCT std.id, std.admission_no,std.othernames,std.surname, ass.gp FROM (SELECT student_id,  SUM((IFNULL(test1,0) + IFNULL(test2,0)+ IFNULL(test3,0) + IFNULL(micro_exam,0) + IFNULL(practical,0) + IFNULL(exam,0))) gp FROM assessments WHERE aagc_id='.$aagc_id.' AND session_id='.$session_id.' AND term_id='.$term_id.' GROUP BY student_id) ass inner join (SELECT id,admission_no,othernames,surname FROM students WHERE student_category_id = '.$category_id.' AND status=1) std on ass.student_id = std.id ORDER BY ass.gp DESC');

        /*Collect student in a given session*/
        else
            $students = DB::select('SELECT DISTINCT std.id, std.admission_no,std.othernames,std.surname FROM (SELECT student_id FROM assessments WHERE aagc_id='.$aagc_id.' AND session_id='.$session_id.') ass inner join (SELECT id,admission_no,othernames,surname FROM students WHERE student_category_id = '.$category_id.') std on ass.student_id = std.id ORDER BY std.surname ASC');
            
        }


        return Addon::isEmpty($students);
    }


    /*Collect all class student that have been assessed*/
    public static function classStudentCat($aagc_id,$category_id,$session_id,$term_id=false){

        /*Collect students in a given term*/
        if($term_id)
            $students = DB::select('SELECT DISTINCT std.id, std.admission_no,std.othernames,std.surname, ass.gp FROM (SELECT student_id,  SUM((IFNULL(test1,0)/2 + IFNULL(test2,0)/2 + IFNULL(micro_exam,0)/2 + IFNULL(exam,0))) gp FROM assessments WHERE aagc_id='.$aagc_id.' AND session_id='.$session_id.' AND term_id='.$term_id.' GROUP BY student_id) ass inner join (SELECT id,admission_no,othernames,surname FROM students WHERE student_category_id = '.$category_id.' AND status=1) std on ass.student_id = std.id ORDER BY ass.gp DESC');

        /*Collect student in a given session*/
        else
            $students = DB::select('SELECT DISTINCT std.id, std.admission_no,std.othernames,std.surname FROM (SELECT student_id FROM assessments WHERE aagc_id='.$aagc_id.' AND session_id='.$session_id.') ass inner join (SELECT id,admission_no,othernames,surname FROM students WHERE student_category_id = '.$category_id.') std on ass.student_id = std.id ORDER BY std.surname ASC');


        return Addon::isEmpty($students);
    }
    /*Collect all class student that have been assessed*/
    public static function classStudent2($aagc_id,$category_id,$session_id,$term_id=false){

    	/*Collect students in a given term*/
    	if($term_id)
    		$students = DB::select('SELECT DISTINCT std.id, std.admission_no,std.othernames,std.surname, ass.score FROM (SELECT student_id, score FROM cummulative_assessements2 WHERE aagc_id='.$aagc_id.' AND session_id='.$session_id.' AND term_id='.$term_id.') ass inner join (SELECT id,admission_no,othernames,surname FROM students WHERE student_category_id = '.$category_id.') std on ass.student_id = std.id ORDER BY score*1 DESC');

    	/*Collect student in a given session*/
    	else
    		$students = DB::select('SELECT DISTINCT std.id, std.admission_no,std.othernames,std.surname FROM (SELECT student_id FROM assessments WHERE aagc_id='.$aagc_id.' AND session_id='.$session_id.') ass inner join (SELECT id,admission_no,othernames,surname FROM students WHERE student_category_id = '.$category_id.') std on ass.student_id = std.id ORDER BY std.surname ASC');


    	return Addon::isEmpty($students);
    }




    /*Collect subjects that has assessment stored in the assessment table*/
    public static function classSubject($aagc_id,$session_id,$term_id=false){
    	
    	/*Collect subject in a given term*/
    	if($term_id)
    		$subjects = DB::select('SELECT DISTINCT sub.id, sub.name FROM (SELECT subject_id FROM assessments WHERE aagc_id='.$aagc_id.' AND session_id='.$session_id.' AND term_id='.$term_id.') ass INNER JOIN subjects sub ON ass.subject_id = sub.id 

                ORDER BY sub.name ASC');


    	/*Collect subject in a given session*/
    	else
    		$subjects = DB::select('SELECT DISTINCT sub.id, sub.name FROM (SELECT subject_id FROM assessments WHERE aagc_id='.$aagc_id.' AND session_id='.$session_id.') ass INNER JOIN subjects sub ON ass.subject_id = sub.id ORDER BY sub.name ASC');


    	return Addon::isEmpty($subjects);
    }

    /*Collect subjects that has assessment stored in the assessment table*/
    public static function classSubjectStudent($aagc_id,$session_id,$term_id=false,$student_id){
        
        /*Collect subject in a given term*/
   if($session_id > 4)
        {
        if($term_id)

            $subjects = DB::select('SELECT DISTINCT sub.id, sub.name FROM (SELECT subject_id FROM assessments WHERE aagc_id='.$aagc_id.' AND session_id='.$session_id.' AND term_id='.$term_id.' AND student_id='.$student_id.') ass INNER JOIN subjects sub ON ass.subject_id = sub.id 

                ORDER BY sub.name ASC');


        /*Collect subject in a given session*/
        else
            $subjects = DB::select('SELECT DISTINCT sub.id, sub.name FROM (SELECT subject_id FROM assessments WHERE aagc_id='.$aagc_id.' AND session_id='.$session_id.' AND student_id='.$student_id.' AND subject_id !=49) ass INNER JOIN subjects sub ON ass.subject_id = sub.id ORDER BY sub.name ASC');

        }
        else {
        if($term_id)

            $subjects = DB::select('SELECT DISTINCT sub.id, sub.name FROM (SELECT subject_id FROM assessments WHERE aagc_id='.$aagc_id.' AND session_id='.$session_id.' AND term_id='.$term_id.' AND student_id='.$student_id.') ass INNER JOIN subjects sub ON ass.subject_id = sub.id 

                ORDER BY sub.name ASC');


        /*Collect subject in a given session*/
        else
            $subjects = DB::select('SELECT DISTINCT sub.id, sub.name FROM (SELECT subject_id FROM assessments WHERE aagc_id='.$aagc_id.' AND session_id='.$session_id.' AND student_id='.$student_id.') ass INNER JOIN subjects sub ON ass.subject_id = sub.id ORDER BY sub.name ASC');

        }


        return Addon::isEmpty($subjects);
    }



    public static function studentClassSubject($student_id,$aagc_id,$session_id){
        $subjects = DB::select(sprintf('SELECT DISTINCT sub.id, sub.name FROM (SELECT subject_id FROM assessments WHERE aagc_id=%d AND session_id=%d AND student_id=%d) ass INNER JOIN subjects sub ON ass.subject_id = sub.id ORDER BY sub.name ASC',$aagc_id,$session_id,$student_id));

        return Addon::isEmpty($subjects);
    }







    /*Url to statement of result print page*/
    public static function printUrl($student_id,$aagc_id,$session_id,$position,$group_class_id,$term_id=false,$cummulative=false){

    	$url = null;

    	/*Print a student's statement of result for a given term*/
    	if($term_id)
    		$url = url('assessments/print-term-statement/'.$student_id.'/'.$aagc_id.'/'.$session_id.'/'.$position.'/'.$group_class_id.'/'.$term_id);


    	/*Print a student's cummulative (All done terms') statement of result */
    	else if($cummulative)
    		$url = url('assessments/print-cummulative-statement/'.$student_id.'/'.$aagc_id.'/'.$session_id.'/'.$cummulative);
    	else
    		$url = "#";


    	return $url;
    }



    /*Cummulative cat*/
    public static function cumCat($test1,$test2,$test3){
        //$test1 /=2;
       // $test2 /=2;
        //$test3 /=2;
        //$micro_exam /=2;

        // if ($test1==-1) {
        //     $test1 = 0;
        // }
        // if ($test2==-1) {
        //     $test2 = 0;
        // }
        // if ($test3==-1) {
        //     $test3=0;
        // }
        // if ($micro_exam==-1) {
        //     $micro_exam = 0;
        // }
        return round(($test1 + $test2 + $test3)/2);
    }



    /*Print single student score in a given subject*/
    public static function termStudentScore($student_id,$subject_id,$aagc_id,$session_id,$term_id)
    {
    	
	    $score = self::where([
			    		['student_id',$student_id],
			    		['subject_id',$subject_id],
			    		['aagc_id',$aagc_id],
			    		['session_id',$session_id],
			    		['term_id',$term_id]
			    	])->first(['test1','test2','test3','micro_exam','practical','exam']);


        $score = Addon::isEmpty($score);
	   	    
        if($score)
	   	   return  self::gradeHelper($score->test1,$score->test2,$score->test3,$score->micro_exam,$score->practical,$score->exam);

        else
	       return self::gradePoint(0,0,0,0,0,0);
    }


    /*Print single student score in a given subject*/
    public static function termStudentScoreCat($student_id,$subject_id,$aagc_id,$session_id,$term_id)
    {
        
        $score = self::where([
                        ['student_id',$student_id],
                        ['subject_id',$subject_id],
                        ['aagc_id',$aagc_id],
                        ['session_id',$session_id],
                        ['term_id',$term_id]
                    ])->first(['test1','test2','test3','micro_exam','practical','exam']);


        $score = Addon::isEmpty($score);
            
        if($score)
           return  self::gradeHelperCat($score->test1,$score->test2,$score->test3,$score->micro_exam,$score->practical,$score->exam);

        else
           return self::gradePoint(0,0,0,0,0,0);
    }




    
    /*Print single student score in a given subject*/
    public static function cummulativeStudentScore($student_id,$subject_id,$aagc_id,$session_id,$cummulative)
    {
    	
	    	$scores = self::where([
			    		['student_id',$student_id],
			    		['subject_id',$subject_id],
			    		['aagc_id',$aagc_id],
			    		['session_id',$session_id]
			    	])
	    			->groupBy('term_id')

	    			->get([

			    		   DB::raw('SUM( test1 + test2 + test3 + micro_exam + exam ) as score')
			    		]);


	    return Addon::isEmpty($scores);

    }








    public static function gradePoint($test1,$test2,$test3,$micro_exam,$practical,$exam){
    	/*$test = ($test1 + $test2 + $test3) * 0.1 ;
        $gp = $test + ($exam * 0.7);*/

        return $test1 + $test2 + $test3 + $micro_exam + $practical + $exam;
    }

    public static function gradePoint2($test1,$test2,$test3,$micro_exam,$practical,$exam){
        /*$test = ($test1 + $test2 + $test3) * 0.1 ;
        $gp = $test + ($exam * 0.7);*/

        return (($test1 + $test2 +$test3)/2) + $practical + $micro_exam + $exam;
    }



    public static function grade($gp){

    	if($gp >= 70 and $gp <= 100)
    		$grade = 'A';

    	else if($gp >= 60 and $gp < 70)
    		$grade = 'B';

    	else if($gp >= 50 and $gp < 60)
    		$grade = 'C';

        else if($gp >= 45 and $gp < 50)
            $grade = 'D';

    	else if($gp >= 40 and $gp < 45)
    		$grade = 'E';

    	else if($gp < 40 )
    		$grade = 'F';

    	else 
    		/*Not Valid*/
    		$grade = 'NI';

    	return $grade;

    }



    public static function remark($gp){
        
        if($gp >= 70 and $gp <= 100)
            $remark = 'EXCELLENT';

        else if($gp >= 60 and $gp < 70)
            $remark = 'VERY GOOD';

        else if($gp >= 50 and $gp < 60)
            $remark = 'GOOD';

        else if($gp >= 45 and $gp < 50)
            $remark = 'FAIRLY GOOD';

        else if($gp >= 40 and $gp < 45)
            $remark = 'FAIR';

        else if($gp < 40 )
            $remark = 'VERY POOR';

        else 
            /*Not Valid*/
            $remark = 'NI';

        return $remark;

    }



    public static function remark2($gp){
    	
    	if($gp >= 20 and $gp <= 100)
    		$remark = 'REGULAR';

    	else if($gp >= 0 and $gp < 20)
    		$remark = 'NOT REGULAR';

    	else 
    		/*Not Valid*/
    		$remark = 'NI';

    	return $remark;

    }


    public static function gradeHelper($test1,$test2,$test3,$micro_exam,$practical,$exam){

        // if ($test1==-1) {
        //     $test11 = 0;
        // }
        // else {
        //     $test11 = $test1;
        // }
        // if ($test2==-1) {
        //     $test21 = 0;
        // }
        // else {
        //     $test21 = $test2;
        // }
        // if ($test3==-1) {
        //     $test31=0;
        // }
        // else {
        //     $test31 = $test3;
        // }
        // if ($micro_exam==-1) {
        //     $micro_exam1 = 0;
        // }
        // else {
        //     $micro_exam1 = $micro_exam;
        // }
        // if ($exam==NULL) {
        //     $exam1 = 0;
        // }
        // else {
        //     $exam1 = $exam;
        // }
    	$gp = $test1 + $test2 + $test3 + $micro_exam + $practical + $exam;
    	$grade = self::grade($gp);
    	$remark = self::remark($gp);

    	return [
    		'gp'=>$gp,
    		'grade'=>$grade,
    		'remark'=>$remark,
    		'scores' => array('test1'=>$test1, 'test2'=>$test2, 'test3'=> $test3,  'micro_exam'=> $micro_exam, 'practical'=> $practical, 'exam'=>$exam)
    	];
    }

    public static function gradeHelperCat($test1,$test2,$test3,$micro_exam,$practical,$exam){

        if ($test1==NULL) {
            $test11 = 0;
        }
        if ($test2==NULL) {
            $test2 = 0;
        }
        if ($test3==NULL) {
            $test3 = 0;
        }
        if ($micro_exam==NULL) {
            $micro_exam = 0;
        }
        // else {
        //     $test11 = $test1;
        // }
        // if ($test2==-1) {
        //     $test21 = 0;
        // }
        // else {
        //     $test21 = $test2;
        // }
        // if ($test3==-1) {
        //     $test31=0;
        // }
        // else {
        //     $test31 = $test3;
        // }
        // if ($micro_exam==-1) {
        //     $micro_exam1 = 0;
        // }
        // else {
        //     $micro_exam1 = $micro_exam;
        // }
        // if ($exam==NULL) {
        //     $exam1 = 0;
        // }
        // else {
        //     $exam1 = $exam;
        // }
        $gp = (($test1 + $test2 + $test3)/2) + ($micro_exam + $exam);
        $grade = self::grade($gp);
        $remark = self::remark($gp);

        return [
            'gp'=>$gp,
            'grade'=>$grade,
            'remark'=>$remark,
            'scores' => array('test1'=>$test1, 'test2'=>$test2, 'test3'=>$test3, 'micro_exam'=> $micro_exam,'practical'=> $practical, 'exam'=>$exam)
        ];
    }





}
