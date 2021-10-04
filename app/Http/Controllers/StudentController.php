<?php

namespace App\Http\Controllers;

use App\Student;
use App\Student_parent;
use App\Plugin\Addon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Exception;

class StudentController extends Controller
{
    public $perPage = 10000;
    public $table = 'students';

    public function index($status=null,$category_id=null){

        if(!is_null($category_id)){

            $condition = array(['student_category_id',$category_id]);

            if(!is_null($status))
                $condition[] = ['status',$status];

            $students = Student::join('parents','parents.id','=','students.parent_id')
                            ->join('student_spies','student_spies.student_id','=','students.id')
                            ->where($condition)
                            ->select('students.id','students.admission_no','students.surname','students.othernames','students.student_category_id','parents.name as parent','parents.phone1 as phone1','parents.phone2 as phone 2','student_spies.current_class','student_spies.arm','students.status','students.switched_id')
                            ->orderBy('surname','ASC')
                            ->paginate($this->perPage);
        }

        else{
        if(is_null($status))
            $students = Student::join('parents','parents.id','=','students.parent_id')
                            ->join('student_spies','student_spies.student_id','=','students.id')
                            ->select('students.id','students.admission_no','students.surname','students.othernames','students.student_category_id','parents.name as parent','parents.phone1 as phone1','parents.phone2 as phone2','student_spies.current_class','student_spies.arm','students.status','students.switched_id')
                            ->orderBy('surname','ASC')
                            ->paginate($this->perPage);

        /*Collect active students including graduated jss 3 student now in sss classes*/
        else if($status == 1)
            $students = Student::join('parents','parents.id','=','students.parent_id')
                            ->join('student_spies','student_spies.student_id','=','students.id')
                            ->where([['status',$status],['status',4]])
                            ->select('students.id','students.admission_no','students.surname','students.othernames','students.student_category_id','parents.name as parent','parents.phone1 as phone1','parents.phone2 as phone2','student_spies.current_class','student_spies.arm','students.status','students.switched_id')
                            ->orderBy('surname','ASC')
                            ->paginate($this->perPage);

        else
            $students = Student::join('parents','parents.id','=','students.parent_id')
                            ->join('student_spies','student_spies.student_id','=','students.id')
                            ->where('status',$status)
                            ->select('students.id','students.admission_no','students.surname','students.othernames','students.student_category_id','parents.name as parent','parents.phone1 as phone1','parents.phone2 as phone2','student_spies.current_class','student_spies.arm','students.status','students.switched_id')
                            ->orderBy('surname','ASC')
                            ->paginate($this->perPage);
            }
        $status = is_null($status) ? null : $status;


        return view('students.index',compact('students','status','category_id'));
    }

    


    /*Filter student display*/
    public function filter(Request $request){
        $group_class_id = (int) $request->group_class_id;
        $aagc_id = (int) $request->aagc_id;
        $session_id = (int) $request->session_id;
        $category_id = (int) $request->category_id;
        $club_id = (int) $request->club_id;

        $fiddle = [];
        $fiddle[0] = ['group_classes.id',$group_class_id];
        
        if($aagc_id > 0)
            $fiddle[1] = ['aagc_session_student.aagc_id',$aagc_id];

        if($session_id > 0)
            $fiddle[2] = ['aagc_session_student.session_id',$session_id];
        
        if($category_id > 0)
            $fiddle[3] = ['students.student_category_id',$category_id];

        if($club_id > 0)
            $fiddle[4] = ['students.club_id',$club_id];

        // dd($fiddle);
        $students  = DB::table($this->table)
                            /*Join student to session*/
                            ->leftJoin('aagc_session_student','aagc_session_student.student_id','=','students.id')

                            /*Join session to class arm*/
                            ->leftJoin('aagc','aagc.id','=','aagc_session_student.aagc_id')

                            /*Join class arm to class*/
                            ->leftJoin('group_classes','group_classes.id','=','aagc.group_class_id')

                            /*Join student to parent*/
                            ->leftJoin('parents','parents.id','=','students.parent_id')

                            /*Join student to student spy*/
                            ->leftJoin('student_spies','student_spies.student_id','=','students.id')
                            
                            ->where($fiddle)
                            ->select('students.id','students.admission_no','students.surname','students.othernames','parents.name as parent','student_spies.current_class','student_spies.arm','students.status')
                            ->orderBy('surname','ASC')
                            ->paginate($this->perPage);

        $status = null;   
        $category_id = $category_id > 0 ? $category_id : null;             
        return view('students.index',compact('students','status','category_id'));
    }




    public function create($aagc_id,$session_id){
        return view('students.ajax.student-registration',compact('aagc_id','session_id'))->render();
    }

// whereRaw('id IN (SELECT student_id FROM student_spies WHERE current_class = "JSS3")')

    public function createFull(){
        return view('students.ajax.full-student-registration')->render();
    }



    /*Collect jss 3 student for graduation*/
    public function createJss3(){
        $students = Student::join('student_spies','student_spies.student_id','=','students.id')
                            ->where([['current_class','JSS3'],['students.status','<>',2]])->get(['students.id','students.admission_no','students.surname','students.othernames','student_spies.current_class','student_spies.arm','students.status']);

        $students = Addon::isEmpty($students);
        $status = 2;
        return view('students.ajax.create-graduate',compact('students','status'))->render();
    }



    /*Collect sss 3 student for graduation*/
    public function createSss3(){
        $students = Student::join('student_spies','student_spies.student_id','=','students.id')
                            ->where([['current_class','SSS3'],['students.status','<>',3]])->get(['students.id','students.admission_no','students.surname','students.othernames','student_spies.current_class','student_spies.arm','students.status']);

        $students = Addon::isEmpty($students);
        $status = 3;
        return view('students.ajax.create-graduate',compact('students','status'))->render();
    }



    public function store(Request $request){

        try{
        
            $transaction = DB::transaction(function() use($request){

                /*Collect all array data and make them variables*/
                extract($request->all());

                /*Check if parent already exist*/
                $parentDetails = DB::table('parents')
                        ->whereRaw(sprintf('phone1 IS NOT NULL AND phone2 IS NOT NULL AND (phone1="%s" OR phone1="%s" OR phone2="%1$s" OR phone2="%1$s")',$phone1,$phone2))->first(['id']);

                if(count($parentDetails) > 0){
                    $parent_id = $parentDetails->id;
                }
                else{

                    $parent_id = DB::table('parents')->insertGetId([
                        'name' => $parent_name,
                        'phone1' => $phone1,
                        'phone2' => $phone2,
                        'email' => $email,
                        'address' => $parent_address
                    ]);
                }



                $student = new Student;

                /*Check if admission no already exists*/
                if(Student::where('admission_no',$admission_no)->exists())
                    throw new Exception("Student ID already taken");           

                $student->surname = trim($surname);
                $student->othernames = trim($othernames);
                $student->dob = trim($dob);
                $student->admission_no = trim($admission_no);
                $student->gender = trim($gender);
                $student->blood_group = trim($blood_group);
                $student->genotype = trim($genotype);
                $student->health_challenges = trim($health_challenges);
                $student->emergency_treatment = trim($emergency_treatment);
                $student->immunization = trim($immunization);
                $student->lab_test = trim($lab_test);
                $student->admitted_session_id = trim($admitted_session_id);
                $student->parent_id = trim($parent_id);
                $student->state_id = trim($state_id);
                $student->lga_id = trim($lga_id);
                $student->parent_relationship = trim($parent_relationship);
                $student->club_id = trim($club_id);
                $student->house_id = trim($house_id);
                $student->student_category_id = trim($student_category_id);
                $student->status = 1;

                $student->save();


                /*Add student to class*/
                DB::table('aagc_session_student')->insert([
                    'aagc_id' => $aagc_id,
                    'session_id' => $admitted_session_id,
                    'student_category_id2' => $student_category_id,
                    'student_id' => $student->id
                ]);



                /*Update student details in student spy table for easy access of class detaiils*/
                Student::newCLass($student->id,$aagc_id);



                /*Register student to all class subjects*/
                $aagc_subjects = DB::table('aagc_subject')->where('aagc_id',$aagc_id)->get(['subject_id']);
                

                $insert = array();
                foreach($aagc_subjects as $aagc_subject){
                    $insert[count($insert)] = [
                        'aagc_id' => $aagc_id,
                        'session_id' => $admitted_session_id,
                        'student_id' => $student->id,
                        'subject_id' => $aagc_subject->subject_id
                    ];

                }


                DB::table('aagc_subject_student')->insert($insert);

            });

        } catch(Exception $e){
            
            return response(['status'=>0,'message'=>$e->getMessage()]);
        }

        
        return response(['status'=>1,'message'=>$request->surname.' '.$request->othernames.' registered successfully!', 'retain'=>301]);
        

    }


    public function storeSwitch(Request $request){

        try{
        
            $transaction = DB::transaction(function() use($request){

                /*Collect all array data and make them variables*/
                extract($request->all());

                /*Check if parent already exist*/
                $parentDetails = DB::table('parents')
                        ->whereRaw(sprintf('phone1 IS NOT NULL AND phone2 IS NOT NULL AND (phone1="%s" OR phone1="%s" OR phone2="%1$s" OR phone2="%1$s")',$phone1,$phone2))->first(['id']);

                if(count($parentDetails) > 0){
                    $parent_id = $parentDetails->id;
                }
                else{

                    $parent_id = DB::table('parents')->insertGetId([
                        'name' => $parent_name,
                        'phone1' => $phone1,
                        'phone2' => $phone2,
                        'email' => $email,
                        'address' => $parent_address
                    ]);
                }



                $student = new Student;

                /*Check if admission no already exists*/
                if(Student::where('admission_no',$admission_no)->exists())
                    throw new Exception("Student ID already taken"); 



                $student1 = Student::find($id);
                $student1->status = 5;
                $student1 -> save();        

                $student->surname = trim($surname);
                $student->othernames = trim($othernames);
                $student->dob = trim($dob);
                $student->admission_no = trim($admission_no);
                $student->gender = trim($gender);
                $student->blood_group = trim($blood_group);
                $student->genotype = trim($genotype);
                $student->health_challenges = trim($health_challenges);
                $student->emergency_treatment = trim($emergency_treatment);
                $student->immunization = trim($immunization);
                $student->lab_test = trim($lab_test);
                $student->admitted_session_id = trim($admitted_session_id);
                $student->parent_id = trim($parent_id);
                $student->state_id = trim($state_id);
                $student->lga_id = trim($lga_id);
                $student->parent_relationship = trim($parent_relationship);
                $student->club_id = trim($club_id);
                $student->house_id = trim($house_id);
                $student->student_category_id = trim($student_category_id);
                $student->switched_id = trim($id);
                $student->status = 1;

                $student->save();


                /*Add student to class*/
                DB::table('aagc_session_student')->insert([
                    'aagc_id' => $aagc_id,
                    'session_id' => $admitted_session_id,
                    'student_category_id2' => $student_category_id,
                    'student_id' => $student->id
                ]);



                /*Update student details in student spy table for easy access of class detaiils*/
                Student::newCLass($student->id,$aagc_id);



                /*Register student to all class subjects*/
                $aagc_subjects = DB::table('aagc_subject')->where('aagc_id',$aagc_id)->get(['subject_id']);
                

                $insert = array();
                foreach($aagc_subjects as $aagc_subject){
                    $insert[count($insert)] = [
                        'aagc_id' => $aagc_id,
                        'session_id' => $admitted_session_id,
                        'student_id' => $student->id,
                        'subject_id' => $aagc_subject->subject_id
                    ];

                }


                DB::table('aagc_subject_student')->insert($insert);

            });

        } catch(Exception $e){
            
            return response(['status'=>0,'message'=>$e->getMessage()]);
        }

        
        return response(['status'=>1,'message'=>$request->surname.' '.$request->othernames.' registered successfully!', 'retain'=>301]);
        

    }


    public function storeRemark(Request $request){


        // try {

        //     DB::transaction(function() use($request){

        //         extract($request->all());

        //         $scores = [];

        //         /*Formatting assessment data*/
        //         for( $x=0; $x < count($student_id); $x++){
        //           //  $admission_no = Student::find($student_id[$x])->admission_no;
        //             /*Prepare student exam details for insertion*/
        //             $scores[$x] = [
        //                 'performance' => $performance[$x],


        //                 'student_id' => $student_id[$x],
        //                 'aagc_id' => $aagc_id[$x],
        //                 'session_id' => $session_id,
        //                 'term_id' => $term_id,
        //                 'club_id' => $club_id,
        //                 'student_category_id' => $category_id[$x],
        //                 'created_at' => date('Y-m-d H:i:s',time())
        //             ];


        //         }


        //         /*Upload assessment to database*/
        //         DB::table('club_report')->insert($scores);



        //     });
            
        // }

        try{
        
            $transaction = DB::transaction(function() use($request){

                /*Collect all array data and make them variables*/
                extract($request->all());


                    $insert = [
                        'student_id' => $id,
                        'remark_title' => $remark_title,
                        'remark_date' => $remark_date,
                        'remark_description' => $remark_description
                    ];

                DB::table('remarks')->insert($insert);


            });

        } catch(Exception $e){
            
            return response(['status'=>0,'message'=>$e->getMessage()]);
        }

        
        return response(['status'=>1,'message'=>$request->surname.' '.$request->othernames.' Remark Added!', 'retain'=>301]);
        

    }



    /*Store jss3 graduate*/
    public function storeGraduate(Request $request){
        extract($request->all());


        try {

            DB::transaction(function() use($student_ids,$status){

                /*Check if student ids exist*/
                if(Addon::isEmpty($student_ids)){
                    
                    foreach($student_ids as $student_id){
                        DB::table('students')->where('id',$student_id)->update(['status'=>$status]);
                    }
                }

                else
                    throw new Exception("No student found");
            });
            
        } catch(Exception $e){
            
            return response(['status'=>0,'message'=>$e->getMessage()]);
        }

        
        return response(['status'=>301,'message'=>'Operation successful!']);

    }
  

    


    public function edit($student_id){

        $student = Student::where('students.id',$student_id)
                            ->join('student_spies','student_spies.student_id','=','students.id')
                            ->join('parents','parents.id','=','students.parent_id')
                            ->join('aagc','aagc.id','=','student_spies.aagc_id')
                            ->select('students.*','students.id as student_id','aagc.id as aagc_id','aagc.group_class_id','parents.*')->first();
            // dd($student);
        
        return view('students.ajax.edit',compact('student'));
    }

   
    public function newRemark($student_id){

        // $student = Student::where('students.id',$student_id)
        //                     ->join('student_spies','student_spies.student_id','=','students.id')
        //                     ->join('parents','parents.id','=','students.parent_id')
        //                     ->join('aagc','aagc.id','=','student_spies.aagc_id')
        //                     ->select('students.*','students.id as student_id','aagc.id as aagc_id','aagc.group_class_id','parents.*')->first();
            // dd($student);
        
        return view('students.ajax.add-remark',compact('student_id'));
    }

   

    public function edit2($student_id){

        $student = Student::where('students.id',$student_id)
                            ->join('student_spies','student_spies.student_id','=','students.id')
                            ->join('parents','parents.id','=','students.parent_id')
                            ->join('aagc','aagc.id','=','student_spies.aagc_id')
                            ->select('students.*','students.id as student_id','aagc.id as aagc_id','aagc.group_class_id','parents.*')->first();


       
        
        $parents = DB::table('parents')->get();
            // dd($student);
        
        return view('students.ajax.edit2',compact('parents','student'));
    }
   

    public function switch($student_id){

        $student = Student::where('students.id',$student_id)
                            ->join('student_spies','student_spies.student_id','=','students.id')
                            ->join('parents','parents.id','=','students.parent_id')
                            ->join('aagc','aagc.id','=','student_spies.aagc_id')
                            ->select('students.*','students.id as student_id','aagc.id as aagc_id','aagc.group_class_id','parents.*')->first();


       
        
        //$parents = DB::table('parents')->get();
            // dd($student);
        
        return view('students.ajax.switch',compact('student'));
    }


    public function edit_parent($parent_id,$student_id){

        
                    /*Update class session student*/
                    DB::table('students')->where('id',$student_id)->update([
                        'parent_id' => $parent_id
                    ]);

       return response(['status'=>1,'message'=>'Student updated successfully','retain'=>301]);
    }

   


    public function update(Request $request){

        try {

            DB::transaction(function() use($request){

                extract($request->all());

                $student = Student::find($id);
                $student->surname = $surname;
                $student->othernames = $othernames;
                $student->dob = $dob;

                /*Check if admission no already exists*/
                if(Student::where([['admission_no',$admission_no],['id','<>',$id]])->exists())
                    throw new Exception("Student ID already taken");
                    
                $student->admission_no = $admission_no;
                $student->gender = $gender;
                $student->blood_group = $blood_group;
                $student->genotype = $genotype;
                $student->health_challenges = $health_challenges;
                $student->emergency_treatment = $emergency_treatment;
                $student->immunization = $immunization;
                $student->lab_test = $lab_test;
                $student->admitted_session_id = $admitted_session_id;
                $student->state_id = $state_id;
                $student->lga_id = $lga_id;
                $student->parent_relationship = $parent_relationship;
                $student->club_id = $club_id;
                $student->house_id = $house_id;
                $student->student_category_id = $student_category_id;
                $student->parent_relationship = $parent_relationship;
                $student->status = $status;
                $student->save();


                /*Update parent details*/
                $parent = Student_parent::find($parent_id);
                $parent->name = $parent_name;
                $parent->address = $parent_address;
                $parent->phone1 = $phone1;
                $parent->phone2 = $phone2;
                $parent->email = $email;
                $parent->save();


                /*===========Updating student class===========*/
                /*Collect current class details*/

                    /*Collect activated session*/
                    $active_session_id = DB::table('session_term')->where('status',1)->first();

                    if($active_session_id)
                        $active_session_id = $active_session_id->session_id;

                $current_aagc_id = DB::table('student_spies')->where('student_id',$id)->first()->aagc_id;

                ///Change student category-Day/Boarding
                DB::table('aagc_session_student')->where([['student_id',$id],['session_id',$active_session_id]])->update([
                        'student_category_id2' => $student_category_id

                    ]);

                /*Check if changes are made to student class*/
                if($aagc_id != $current_aagc_id){

                    /*Update student spies details*/
                    $aagc_details = DB::table('aagc_view')->where('id',$aagc_id)->first();

                    DB::table('student_spies')->where('student_id',$id)->update([
                        'aagc_id' => $aagc_id,
                        'current_class' => $aagc_details->class,
                        'arm' => $aagc_details->arm
                    ]);


                    /*Collect activated session*/
                    $active_session_id = DB::table('session_term')->where('status',1)->first();

                    if($active_session_id)
                        $active_session_id = $active_session_id->session_id;

                    else

                        throw new Exception ("No active session found, please activate a session to proceed");


                    /*Update class session student*/
                    /*Included Term on 13th May 2021*/
                    DB::table('aagc_session_student')->where([['student_id',$id],['session_id',$active_session_id]])->update([
                        'aagc_id' => $aagc_id

                    ]);


                    /*Remove student from previously assigned subjects*/
                    DB::table('aagc_subject_student')->where([['aagc_id',$current_aagc_id],['student_id',$id]])->delete();


                    /*Collect subject in newly assigned class*/
                    $aagc_subjects = DB::table('aagc_subject')->where('aagc_id',$aagc_id)->get(['subject_id']);


                        

                    /*Array to collect subject student insertion data*/
                    $insert = [];

                    foreach ($aagc_subjects as $aagc_subject) {
                        $insert[count($insert)] = [
                            'session_id' => $active_session_id,
                            'aagc_id' => $aagc_id,
                            'subject_id' => $aagc_subject->subject_id,
                            'student_id' => $id
                        ];
                    }

                    /*Assign subject to student*/
                    DB::table('aagc_subject_student')->insert($insert);
                    
                }

            });

            
        } catch (Exception $e) {
             return response(['status'=>0,'message'=>$e->getMessage()]);
        }


        return response(['status'=>1,'message'=>'Student updated successfully','retain'=>301]);

    }



    public function show($id){
        $student = Student::with('spy')->where('id',$id)->first();
        $remarks = DB::table('remarks')->where('student_id', $id)->get();

        return view('students.ajax.show',compact('student','remarks'))->render();
    }



    public function birthday(){
        $students = Student::birthday();
                    

        return view('students.ajax.birthday',compact('students'))->render();
    }



    /*Print student performance*/
    public function performance(Request $request){

      //  $students = Assessment::classStudent($aagc_id,$category_id,$session_id,$term_id);

        $student_id = $request->student_id;
        $aagcs = DB::table('aagc_session_student')
                        ->join('students','students.id','=','aagc_session_student.student_id')
                        ->where('student_id',$student_id)
                        ->groupBy(['aagc_session_student.aagc_id','aagc_session_student.session_id','students.student_category_id'])
                       // ->select('students.student_category_id')
                        ->get(['aagc_id','session_id','students.student_category_id']);
        $aagcs = Addon::isEmpty($aagcs);

        return view('students.ajax.performance',compact('aagcs','student_id'))->render();
    }


    public function status(Request $request){
        $student_id = $request->student_id;
        $status = $request->status;
        $student = Student::find($student_id);
        $student->status = $status;
        if($student->save())
            return response(['status'=>1,'message'=>'Status changed successfully']);

        return response(['status'=>0,'message'=>'Connection error']);
       
    }



    public function destroy(Request $request)
    {
        if(Student::destroy($request->id))

            return response(['status'=>1,'message'=>'Student deleted successfully','retain'=>301]);

        return response(['status'=>0,'message'=>'Connection error']);
    }








    /*=========================Graphs============================*/
    /*Admission history graph*/
    public function admissionGraph(){
        $data = DB::select('
                SELECT sessions.name, COUNT(students.id) history FROM sessions 
                LEFT JOIN students ON students.admitted_session_id = sessions.id
                GROUP BY sessions.name, sessions.id
                ORDER BY sessions.id ASC 
                LIMIT 6
            ');

        $data = Addon::isEmpty($data);

        return response(compact('data'));
    }




    /*Gender graph*/
    public function classStudentGraph(){
        $data = DB::select('
                SELECT 
                    session_term.session_id, 
                    COUNT(aagc_session_student.student_id) students, 
                    group_classes.name as classes 
                FROM 
                    session_term 
                LEFT JOIN 
                    aagc_session_student 
                ON 
                    aagc_session_student.session_id = session_term.session_id 
                LEFT JOIN 
                    aagc 
                ON 
                    aagc.id = aagc_session_student.aagc_id 
                LEFT JOIN 
                    group_classes 
                ON 
                    group_classes.id = aagc.group_class_id 
                WHERE 
                    session_term.status = 1 
                GROUP BY 
                    group_classes.name, session_term.session_id
            ');

        $data = Addon::isEmpty($data);

        return response(compact('data'));
    }





    
}
