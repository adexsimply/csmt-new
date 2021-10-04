<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Aagc;
use App\Student;
use Illuminate\Support\Facades\DB;
use Exception;

class AagcController extends Controller{

	public function index($group_id,$id,$name=null){
		$aagc = Aagc::find($id);

		return view('classes.arm-session',compact('aagc','group_id')); 
	}


     public static function active(){
        $active = DB::table('session_term')->where('status',1)->first(['session_id','term_id']);

        return $active;
    }



    


    /*Create new class arm */
    public function store(Request $request){
    	$request->validate([
    		'group_class_id'=>'numeric|required',
    		'arm_id'=>'numeric|required',
    		'alias_id'=>'numeric|required',
    	]);


    	/*Check if arm already created*/
    	if (DB::table('aagc')->where([
    		['group_class_id',$request->group_class_id],
    		['arm_id',$request->arm_id],
    		['alias_id',$request->alias_id],
    		])->exists()) {

                return response(['status'=>0,'message'=>'Class arm already exists']);
    		}


    		/*Create class arm*/
    		if(DB::table('aagc')->insertGetId($request->except(['_token'])))

                return response(['status'=>1,'message'=>'Class arm created successfully!','retain'=>301]);

            return response(['status'=>0,'message'=>'Connection error']);

    }




    /*Collect sessions that are not in class*/
    public function sessionList($aagc_id){
        $sessions = DB::table('sessions')->whereRaw('id NOT IN (SELECT session_id FROM aagc_session WHERE aagc_id = '.$aagc_id.' )')->get(['name','id']);

        return response(compact('sessions'));
    }



    /*Add sigle session to class*/
    public function addSingleSessionToClass(Request $request){
        
        extract($request->all());

        /*Check if session already exist in class*/
        if(DB::table('aagc_session')->where([['aagc_id',$aagc_id],['session_id',$session_id]])->exists())

            return response(['status'=>0,'message'=>'Session already in class']);


        if(DB::table('aagc_session')->insert([
            'aagc_id' => $aagc_id,
            'session_id' => $session_id
        ]))

            return response(['status'=>1,'message'=>'Session added successfully!','retain'=>301]);

        /*If an error occured*/
        return response(['status'=>0,'message'=>'Connection error']);

    }





    /*Class arm session detail (Session students, session subject etc..)*/
    public function sessionDetails(Request $request){
        // $group_id,$group_class_id,$aagc_id,$session_id
        $aagc_id = (int)$request->aagc_id;
        $group_id = (int)$request->group_id;
        $group_class_id = (int)$request->group_class_id;
        $session_id = (int)$request->session_id;
        $category_id = (int)$request->category_id;

    	$aagc = Aagc::find($aagc_id);

    	$name = $aagc->group_class->name.' '.$aagc->arm->name.'('.$aagc->alias->name.')'; 

    	/* Students in selected class arm*/
  		$students = $aagc->students()->join('parents','parents.id','students.parent_id')
  					->where([
                        ['session_id',$session_id],
                        ['status',1],
                        ['student_category_id',$category_id]
                    ])
                    ->orderBy('students.surname')
                    ->get(['students.id','students.surname','students.gender','students.othernames','students.admission_no','parents.name as parent_name','parents.phone1','parents.phone2']);

               
        
         /*Subjects offer by students in selected arm class*/
         $subjects = $aagc->Subjects;

         $term_id = self::active()->term_id;
         $categoryAlt = $category_id == 1 ? 2 : 1;

    	return view('classes.session-details',compact('aagc','subjects','students','session_id','name','group_id','group_class_id','aagc_id','category_id','session_id','term_id','categoryAlt'));
    }






    /*Add bulk subjects to class, first time subject setup*/
    public function subjectSetup(Request $request){
    	
    		extract($request->all());

    		/*Empty arrays to collect student and subject data for insertion*/
    		$insertSubject = [];
    		$insertStudent = [];

    		/*Fetch individual subject from subject id array passed from html page*/
    		foreach($subject_ids as $subject_id)

    			$insertSubject[count($insertSubject)] = [
    				'aagc_id'=>$aagc_id, 
    				'subject_id'=>$subject_id,
    				'created_at' => date('Y-m-d H:m:s')
    			];


    		if(!empty($insertSubject)){

    			/*Collect all students in class*/
    			$students = DB::table('aagc_session_student')
    							->where([['aagc_id',$aagc_id],['session_id',$session_id]])
    							->get(['student_id']);

    			/*Check if there are students in class*/				
    			if(count($students) > 0){
    				
    				foreach($students as $student){

    					/*Assign students to subject*/
    					foreach($subject_ids as $subject_id){

    						$insertStudent[count($insertStudent)] = [
    							'student_id' => $student->student_id,
    							'subject_id' => $subject_id,
    							'aagc_id' => $aagc_id,
    							'session_id' => $session_id,
    							'created_at' => date('Y-m-d H:m:s')
    						];
    					}
    				}
    					
    			}

    		}

    	
    	try {

    		DB::transaction(function() use($insertSubject,$insertStudent){
    			DB::table('aagc_subject')->insert($insertSubject);
    			DB::table('aagc_subject_student')->insert($insertStudent);
    		});
    		
    	} catch (Exception $e) {
    		
    		return response(['status'=>0,'message'=>'Connection error : '.$e->getMessage()]);
    	}

    	/*All insertion were successfully, refresh the page to display latest data*/
        return response(['status'=>301,'message'=>'Subject configuration saved!']);

    }






    /*Remove subject from class*/
    public function deleteSubject(Request $request){

        
        try{
            DB::transaction(function()use($request){

                /*Collect subject relationship details*/
                $aagc_subject = DB::table('aagc_subject')->where('id',$request->id)->first(['subject_id','aagc_id']);
                
                /*Unlink students from subject*/
                DB::table('aagc_subject_student')->where([
                    ['aagc_id',$aagc_subject->aagc_id],
                    ['subject_id',$aagc_subject->subject_id]
                ])->delete();

                /*Delete subject from class*/
                DB::table('aagc_subject')->where('id',$request->id)->delete();

            });
         }

         catch(Exception $e){
            return response(['status'=>0,'message'=>'Connection error ']);
         }


        
        return response(['status'=>1,'message'=>'Subject removed!','retain'=>301]);
    	
    	
    }







    /*Add new subject to class*/
    public function newSingleSubject(Request $request){

        extract($request->all());
        
        /*Check if subject already added to class*/
        if(DB::table('aagc_subject')->where([
            ['subject_id',$subject_id],
            ['aagc_id',$aagc_id]])
            ->exists()
                )

            return response(['status'=>0,'message'=>'Subject already exists!']);

        DB::beginTransaction();

            /*Insert subject to class*/
            if(!DB::table('aagc_subject')->insert([
                'aagc_id' => $aagc_id,
                'subject_id' => $subject_id
            ])) {
                DB::rollback();
                return response(['status'=>0,'message'=>'Unable to record subject']);
            }



            /*Collect class student list to automatically assign to subject*/
            $subjects = DB::table('aagc_session_student')->where([['session_id',$session_id],['aagc_id',$aagc_id]])->get(['student_id']);

            $insert = [];

            foreach($subjects as $subject) 
                $insert[count($insert)] = [
                    'aagc_id' => $aagc_id,
                    'session_id' => $session_id,
                    'subject_id' => $subject_id,
                    'student_id' => $subject->student_id
                ]; 
            

            if(DB::table('aagc_subject_student')->insert($insert)) {
                DB::commit();
                return response(['status'=>1,'message'=>'Subject added!','retain'=>301]);
            }
            
            DB::rollback();
            /*An error occured during insertion*/
            return response(['status'=>0,'message'=>'Connection error']);
    		
    }






    public function viewSubjectStudent(Request $request){

    	$aagc = Aagc::find($request->aagc_id);
        $students = $aagc->subjectStudents()->where([
            ['subject_id',$request->subject_id],
            ['session_id',$request->session_id],
            ['students.student_category_id',$request->category_id]
        ])

            ->get(['students.id','admission_no','surname','othernames','student_category_id']);

        $x=$request->subject_id;
    	return view('classes.ajax.subject-students',compact('students','x'))->render();
    }


    public function removeStudentFromSubject(Request $request){
    	if(DB::table('aagc_subject_student')->where('id',$request->id)->delete()){

    		return response(['status'=>1,'message'=>'Student removed','retain'=>301]);
    	}

    	return response(['status'=>0,'message'=>'Connection error']);

    }







    public function getStudentToSubject(Request $request){
    	$session_id = (int)$request->session_id;
        $category_id = (int) $request->category_id;
        $subject_id = (int)$request->subject_id;
        $aagc_id = (int)$request->aagc_id;

    	$students = DB::table('aagc_session_student')
    					->whereRaw(sprintf('student_category_id = %d AND student_id NOT IN (SELECT student_id FROM aagc_subject_student WHERE subject_id = %d AND session_id=%d ) AND aagc_id=%d',$category_id,$subject_id,$session_id,$aagc_id))
    					->join('students','students.id','=','aagc_session_student.student_id')
    					->get(['students.id','students.surname','students.othernames','students.admission_no']);


    	return view('classes.ajax.add-student-to-subject-list',compact('students','x','session_id','aagc_id','subject_id'))->render();
    }


    public function studentAddup(Request $request){

    	$insert = [];

    	foreach($request->student_id as $student_id){
    		$insert[count($insert)]  = [
    				'aagc_id'=>$request->aagc_id, 
    				'session_id'=>$request->session_id, 
    				'subject_id'=>$request->subject_id,
    				'student_id'=>$student_id
    			];
    	}

    	if(DB::table('aagc_subject_student')->insert($insert))

    		return response(['status'=>1,'message'=>'Subject added successfully!','retain'=>301]);

    	return response(['status'=>0,'message'=>'Connection error']);
    }




    /*Collect students in class arm to add comment*/
    public function commentSessionStudentList($aagc_id,$category_id,$session_id){
        $aagc = Aagc::find($aagc_id);

        /* Students in selected class arm*/
        $students = $aagc->students()
                    ->where([
                        ['session_id',$session_id],
                        ['promotion_status',0],
                        ['student_category_id',$category_id]
                    ])
                    ->get();


        return view('classes.ajax.comment',compact('aagc_id','session_id','category_id','students'))->render();
    }









    /*Comments on students (Principal, Teacher, Hostel parent comment)*/
    public function commentOnStudent(Request $request){

        extract($request->all());

        $insert = [];

        for($x=0; $x < count($id); $x++):

            $insert[$x] = [

                'id' => $id[$x],
                'aagc_id' => $aagc_id,
                'session_id' => $session_id,
                'student_id' => $student_id[$x],
                'principal_comment' => $principal_comment[$x],
                'teacher_comment' => $teacher_comment[$x],
                'hostel_comment' => $hostel_comment[$x],
                'promotion_status' => $promotion_status[$x],
                'updated_at' => date('Y-m-d H:m:s')
            ];

        endfor;


        try {

            DB::transaction(function() use($insert,$aagc_id,$session_id){

                /*Remove all comments*/
                DB::table('aagc_session_student')->where([
                        ['aagc_id',$aagc_id],
                        ['session_id',$session_id],
                    ])->delete();



                /*Add new comments*/
                DB::table('aagc_session_student')->insert($insert);


            });


            
        } catch (Exception $e) {
            return response(['status'=>0, 'message'=> 'Connection error'.$e->getMessage()]);
        }

        return response(['status'=>1,'message'=>'Comments submitted successfully!','retain'=>301]);


    }







    /*Promote student to another class*/
    public function createPromotion($aagc_id,$session_id,$term_id){

        $students = DB::select('

            SELECT ass.totalScore, ass.totalScore2, ass.totalSubject, ass.student_id, students.surname, students.othernames, students.admission_no, students.student_category_id, students.status 
            FROM (SELECT student_id, SUM( IFNULL(test1,0) + IFNULL(test2,0) + IFNULL(test3,0) + IFNULL(practical,0) + IFNULL(micro_exam,0) + IFNULL(exam,0)) AS totalScore, SUM( (IFNULL(test1,0)/2) + (IFNULL(test2,0)/2) + (IFNULL(test3,0)/2) + IFNULL(micro_exam,0) + IFNULL(exam,0)) AS totalScore2, COUNT(subject_id) as totalSubject FROM assessments WHERE aagc_id='.$aagc_id.' AND session_id='.$session_id.' AND term_id='.$term_id.' GROUP BY student_id ) 

            AS ass INNER JOIN (SELECT id, surname, othernames, admission_no, student_category_id, status FROM students) students ON ass.student_id = students.id 

            INNER JOIN (SELECT student_id FROM aagc_session_student WHERE aagc_id='.$aagc_id.' AND session_id='.$session_id.') aagcSS ON ass.student_id = aagcSS.student_id

            GROUP BY ass.student_id, ass.totalScore, ass.totalSubject ORDER BY totalScore DESC
            ');

        $page = 'classes.ajax.promotion';
        if(Aagc::isCatTerm(Aagc::find($aagc_id)->group_class_id,$term_id))
            $page = 'classes.ajax.promotion-cat';

        return view($page,compact('students','term_id','session_id','aagc_id'))->render();


    }


    /*Processing student promotion*/
    public function promotion(Request $request){
        $request->validate([
            'promotion_status' => 'required',
            'session_id' => 'required|numeric',
            'aagc_id' => 'required',
            'student_id' => 'required',
            'student_category_id' => 'required'
        ]);

        

        try {
            
            DB::transaction(function() use($request){

                /*Collect content in array*/
                extract($request->all());
                
                $insert = [];
                $subjectInsertion = [];
                
                for($x=0; $x < count($student_id); $x++){

                    /*Another stupid code i'm writing to update student's promotion status*/
                    DB::table('aagc_session_student')

                        ->where([
                            
                                ['student_id',$student_id[$x]], 
                                ['aagc_id',$old_aagc_id], 
                                ['session_id',$old_session_id], 

                            ])

                        ->update(['promotion_status'=>$promotion_status[$x]]);

                    /*Collect details for next class*/
                    $insert[$x] = [
                        'student_id' => $student_id[$x],
                        'aagc_id' => $aagc_id[$x],
                        'student_category_id2' => $student_category_id,
                        'session_id' => $session_id
                    ];


                    /*Assign students to subjects in new class*/
                    $subjects = DB::table('aagc_subject')->where('aagc_id',$aagc_id)->get();

                    if($subjects):

                        foreach($subjects as $subject):

                            $subjectInsertion[count($subjectInsertion)] = [
                                'subject_id' => $subject->subject_id,
                                'student_id' => $student_id[$x],
                                'aagc_id' => $aagc_id[$x],
                                'session_id' => $session_id
                            ];

                        endforeach;
                    endif;

                    /*Update student spy class details*/
                    $aagc_helper = DB::table('aagc_view')->where('id',$aagc_id[$x])->first();

                    DB::table('student_spies')->where('student_id',$student_id[$x])->update([
                        'aagc_id' => $aagc_id[$x],
                        'current_class' => $aagc_helper->class,
                        'arm' => $aagc_helper->arm
                    ]);
                            
;
                DB::table('aagc_session_student')->where([['session_id',$session_id],['student_id',$student_id[$x]]])->delete();
                }

                /*Insert students into a new class*/
               DB::table('aagc_session_student')->insert($insert);

                /*Insert subject assignement*/
                DB::table('aagc_subject_student')->insert($subjectInsertion);



            });




        } catch (Exception $e) {
           return response(['status'=>0,'message'=>$e->getMessage()]);
        }



        return response(['status'=>301,'message'=>'Promotion completed successfully!', 'retian'=>301]);

    }

}
