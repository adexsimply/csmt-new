<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Aagc;
use App\Session;
use App\Plugin\Addon;

class Student extends Model
{
    protected $fillable = ['admission_no','surname','othernames','gender','dob','address','blood_group','genotype','health_challenges','emergency_treatment','school_immunization','lab_test','admitted_session_id','graduated_session_id','parent_id','state_id','lga_id','parent_relationship','club_id','house_id','student_category_id','status'];



    public static function birthday($count=false){

        if($count)
            return self::whereRaw("date_format(dob,'%m %d') = date_format(curdate(),'%m %d') AND status=1")->count('id');

        else
            $student = self::join('parents','parents.id','=','students.parent_id')
                            ->join('student_spies','student_spies.student_id','=','students.id')
                            ->whereRaw("date_format(dob,'%m %d') = date_format(curdate(),'%m %d') AND status=1")
                            ->select('students.id','students.dob','students.admission_no','students.surname','students.othernames','parents.name as parent','parents.phone1','parents.phone2','parents.email','student_spies.current_class','student_spies.arm','students.status')
                            ->get();

        return Addon::isEmpty($student);
    }

    /*
        1 = Active in junior classes
        2 = Graduated from Jss3
        3 = Graduated from SSS3
        4 = Graduated from JSS3 but now in SSS Classes
        0 = Withdrawn
    */
    public static function status($status){
        if($status == 1)
            return '<span class="badge badge-success">Active</span>';
        elseif($status == 4)
            return '<span class="badge badge-warning">Expelled</span>';
        elseif($status == 3)
            return '<span class="badge badge-info">Graduated</span>';
        elseif($status == 5)
            return '<span class="badge badge-secondary">Switched</span>';
        else
            return '<span class="badge badge-danger">Withdrawn</span>';
    }


    public static function categoryName($category_id){
        if($category_id == 1)
            return 'Boarding Students';

        elseif ($category_id == 2) 
            return 'Day students';

        return 'Invalid';
    }



    /*Update student spy */
    public static function newClass($student_id,$aagc_id){
        $aagc_helper = DB::table('aagc_view')->where('id',$aagc_id)->first();

        DB::table('student_spies')->insert([
                    'student_id' => $student_id,
                    'aagc_id' => $aagc_id,
                    'current_class' => $aagc_helper->class,
                    'arm' => $aagc_helper->arm
                ]);
            
    }



    public function spy(){
    	return $this->hasOne('App\Student_spy');
    }

    public function state(){
        return $this->belongsTo('App\State');
    }


    public function lga(){
        return $this->belongsTo('App\Lga');
    }


    public function category(){
        return $this->belongsTo('App\Student_category','student_category_id');
    }

    public function admitted_session(){
        return $this->belongsTo('App\Session','admitted_session_id');
    }

    public function graduated_session(){
        return $this->belongsTo('App\Session','graduated_session_id');
    }


    public function parent(){
    	return $this->belongsTo('App\Student_parent');
    }

    public function club(){
    	return $this->belongsTo('App\Club');
    }

    public function house(){
        return $this->belongsTo('App\House');
    }

    public function bece(){
        return $this->hasMany('App\Bece');
    }


    public function bece_details(){
        return $this->hasOne('App\Bece_details');
    }


    public function junior_mock(){
        return $this->hasMany('App\Junior_mock');
    }


    public function junior_mock_details(){
        return $this->hasOne('App\Junior_mock_details');
    }



     public function senior_mock(){
    	return $this->hasMany('App\Senior_mock');
    }


    public function senior_mock_details(){
        return $this->hasOne('App\Senior_mock_details');
    }



    public function waec(){
        return $this->hasMany('App\Waec');
    }


    public function waec_details(){
        return $this->hasOne('App\Waec_details');
    }



    public function neco(){
        return $this->hasMany('App\Neco');
    }


    public function neco_details(){
        return $this->hasOne('App\Neco_details');
    }





    public static function subjects($student_id,$group_class_id=false){
        $condition='';

        if ($group_class_id) 
            $condition = 'AND aagc_id IN (SELECT id FROM aagc WHERE group_class_id = '.$group_class_id.' )';
        

        $subjects = DB::table('subjects')->whereRaw('id IN (SELECT subject_id FROM aagc_subject_student WHERE student_id = '.$student_id.' '.$condition.' )')->get();

        return $subjects;
    }




    /*Collect student of a given class e.g All JSS1 Student*/
    public static function groupClassStudent($group_class_id,$session_id,$arm_id=false,$alias_id=false){

        $condition = 'group_class_id = '.$group_class_id.' ';
        

        if($arm_id){
            $condition.=' AND arm_id = '.$arm.' ';
        }

        if($alias_id){
            $condition.=' AND alias_id = '.$alias.' ';
        }

        $query = 'id IN (SELECT DISTINCT student_id FROM aagc_subject_student WHERE session_id = '.$session_id.' AND aagc_id IN (SELECT id FROM aagc WHERE '.$condition.' ))';

        $students = self::whereRaw($query);

        return $students;
    }


    /*Select all classes a student had been*/
    public static function studentClasses($student_id){

        $query = sprintf('id IN (SELECT group_class_id FROM aagc WHERE aagc.id IN (SELECT aagc_id FROM aagc_session_student WHERE student_id = %d))',$student_id);

        return DB::table('group_classes')->whereRaw($query)->get(['id','name']);
    }



    public static function seeder(){
             $students = DB::table('students')->whereRaw('id NOT IN (SELECT student_id FROM student_spies)')->get();

                
                    $aagc_id = Aagc::all()->random()->id;

                    foreach ($students as $student) {

                        DB::table('aagc_session_student')->insert([
                            'aagc_id' => $aagc_id,
                            'session_id' => 12,
                            'student_id' => $student->id
                        ]);


                        $aagc_helper = DB::table('aagc_view')->where('id',$aagc_id)->first();

                        DB::table('student_spies')->insert([
                            'student_id' => $student->id,
                            'aagc_id' => $aagc_id,
                            'current_class' => $aagc_helper->class,
                            'arm' => $aagc_helper->arm
                        ]);


                    }

        }


}
