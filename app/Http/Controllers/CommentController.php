<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Comment;
use App\Subject;
use App\Student;
use App\Aagc;
use Illuminate\Support\Facades\DB;
use Exception;

class CommentController extends Controller {
    
    public static function active(){
        $active = DB::table('session_term')->where('status',1)->first(['session_id','term_id']);

        return $active;
    }


	/*Collecting assessement details for upload */
    public function create($aagc_id,$category_id,$session_id,$term_id=false){

        $term_id = $term_id ? $term_id : self::active()->term_id;

        // $students = DB::select('SELECT DISTINCT std.id, std.admission_no,std.othernames,std.surname, ass.gp FROM (SELECT student_id,  SUM((IFNULL(test1,0) + IFNULL(test2,0)+ IFNULL(test3,0) + IFNULL(micro_exam,0) + IFNULL(exam,0))) gp FROM assessments WHERE aagc_id='.$aagc_id.' AND session_id='.$session_id.' AND term_id='.$term_id.' GROUP BY student_id) ass inner join (SELECT id,admission_no,othernames,surname FROM students WHERE student_category_id = '.$category_id.' AND status=1) std on ass.student_id = std.id ORDER BY ass.gp DESC');


        $students = DB::table('students')->whereRaw('

                student_category_id = '.$category_id.' AND status=1 AND id IN (SELECT student_id FROM aagc_session_student WHERE aagc_id='.$aagc_id.' AND session_id='.$session_id.' AND student_category_id2 = '.$category_id.')
                AND id NOT IN (SELECT student_id FROM comments WHERE aagc_id='.$aagc_id.' AND session_id='.$session_id.' AND term_id='.$term_id.' AND student_category_id = '.$category_id.')')->orderBy('students.surname')->get(['id','admission_no','surname','othernames']);

        if(count($students) > 0){

                
            return view('classes.ajax.comment-new',compact('students','aagc_id','session_id','term_id','category_id'))->render();

        } else{

            $condition = array(['aagc_id',$aagc_id],['session_id',$session_id],['term_id',$term_id],['comments.student_category_id',$category_id]);

        /*Collect assessments for editing*/
            $students = DB::table('comments')->join('students','students.id','comments.student_id')
                            ->where($condition)
                            ->orderBy('students.surname')
                            ->get(['comments.*','admission_no','surname','othernames']);

            // dd($students);

            return view('classes.ajax.comment',compact('students','aagc_id','session_id','term_id','category_id'))->render();

        }


        /*Check if assessment already exits*/
        // if(DB::table('assessments')->join('students','students.id','assessments.student_id')->where($condition)->exists()){
 
        //     /*Add student category constraint*/
        //     // $condition[] = ['students.student_category_id',$category_id];

        //     /*Collect assessments for editing*/
        //     $students = DB::table('assessments')->join('students','students.id','assessments.student_id')
        //                     ->where($condition)
        //                     ->orderBy('students.surname')
        //                     ->get(['assessments.*','admission_no','surname','othernames']);

        //     // dd($students);

        //     $page = 'assessments.ajax.subject-assessment';
        //     if(Aagc::isCatTerm(Aagc::find($aagc_id)->group_class_id,$term_id))
        //         $page = 'assessments.ajax.edit-cat';

        //     return view($page,compact('students','aagc_id','session_id','subject_id','term_id'))->render();

        // }

        // else{

        // 	$students = DB::table('students')->whereRaw('

        //         student_category_id = '.$category_id.' AND id IN (SELECT student_id FROM aagc_subject_student WHERE aagc_id='.$aagc_id.' AND session_id='.$session_id.' AND subject_id='.$subject_id.') 

        //         AND id NOT IN (SELECT student_id FROM assessments WHERE aagc_id='.$aagc_id.' AND session_id='.$session_id.' AND subject_id='.$subject_id.' AND term_id='.$term_id.')')->get(['id','admission_no','surname','othernames']);


        // 	$page = 'assessments.ajax.upload';
        //     if(Aagc::isCatTerm(Aagc::find($aagc_id)->group_class_id,$term_id))
        //         $page = 'assessments.ajax.upload-cat';

        // 	return view($page,compact('students','aagc_id','session_id','subject_id','term_id'))->render();
        // }
    }



    /*Collecting assessement details for upload */
    public function createClub($club_id,$session_id,$term_id=false){

      //  $term_id = $term_id ? $term_id : self::active()->term_id;


        $session_id = Aagc::active()->session_id;
        $term_id = Aagc::active()->term_id;



        $students = DB::table('students')->whereRaw('status=1 AND club_id= '.$club_id.' AND students.id IN (SELECT student_id FROM aagc_session_student WHERE session_id='.$session_id.')
                AND students.id NOT IN (SELECT student_id FROM club_remarks WHERE session_id='.$session_id.' AND term_id='.$term_id.')')
                        ->join('aagc_session_student','students.id','aagc_session_student.student_id')
                        ->where('aagc_session_student.session_id',$session_id)->orderBy('students.surname')->get(['students.id','students.admission_no','students.surname','othernames','students.student_category_id','aagc_session_student.aagc_id']);

        if(count($students) > 0){

                
            return view('classes.ajax.comment-new-club',compact('students','session_id','term_id','club_id'))->render();

        } else{

            $condition = array(['session_id',$session_id],['term_id',$term_id],['club_remarks.club_id',$club_id]);

        /*Collect assessments for editing*/
            $students = DB::table('club_remarks')->join('students','students.id','club_remarks.student_id')
                            ->where($condition)
                            ->orderBy('students.surname')
                            ->get(['club_remarks.*','admission_no','surname','othernames']);

            // dd($students);

            return view('classes.ajax.comment-club',compact('students','session_id','term_id','club_id'))->render();

        }

    }



    /*Upload assessment*/
    public function store(Request $request){


    	try {

    		DB::transaction(function() use($request){

    			extract($request->all());

    			$scores = [];

    			/*Formatting assessment data*/
    			for( $x=0; $x < count($student_id); $x++){
                    $admission_no = Student::find($student_id[$x])->admission_no;
    				/*Prepare student exam details for insertion*/
    				$scores[$x] = [
                        'teacher_comment' => $teacher_comment[$x],

                        'principal_comment' => $principal_comment[$x],

                        'hostel_comment' => $hostel_comment[$x],


    					'student_id' => $student_id[$x],
    					'aagc_id' => $aagc_id,
    					'session_id' => $session_id,
    					'term_id' => $term_id,
    					'student_category_id' => $category_id,
                        'created_at' => date('Y-m-d H:i:s',time())
    				];


    			}


    			/*Upload assessment to database*/
    			DB::table('comments')->insert($scores);



    		});
    		
    	} catch (Exception $e) {
    		return response(['status'=>0,'message'=>$e->getMessage()]);
    	}


    	return response(['status'=>1,'message'=>'Comment Uploaded','retain'=>301]);

    }



    /*Upload assessment*/
    public function storeClub(Request $request){


        try {

            DB::transaction(function() use($request){

                extract($request->all());

                $scores = [];

                /*Formatting assessment data*/
                for( $x=0; $x < count($student_id); $x++){
                    $admission_no = Student::find($student_id[$x])->admission_no;
                    /*Prepare student exam details for insertion*/
                    $scores[$x] = [
                        'remark' => $remark[$x],


                        'student_id' => $student_id[$x],
                        'aagc_id' => $aagc_id[$x],
                        'session_id' => $session_id,
                        'term_id' => $term_id,
                        'club_id' => $club_id,
                        'student_category_id' => $category_id[$x],
                        'created_at' => date('Y-m-d H:i:s',time())
                    ];


                }


                /*Upload assessment to database*/
                DB::table('club_remarks')->insert($scores);



            });
            
        } catch (Exception $e) {
            return response(['status'=>0,'message'=>$e->getMessage()]);
        }


        return response(['status'=>1,'message'=>'Remark Uploaded','retain'=>301]);

    }





    /*Update entire subject assessment*/
    public function updateMany(Request $request){


        try {

            DB::transaction(function() use($request){

                // extract($request->all());
                $student_id=$request->student_id;
                $admission_no=$request->admission_no;
                $aagc_id=$request->aagc_id;
                $session_id=$request->session_id;
                $term_id=$request->term_id;
                $category_id=$request->category_id;
                $principal_comment = $request->principal_comment;
                $teacher_comment = $request->teacher_comment;
                $hostel_comment = $request->hostel_comment;



                $scores = [];

                /*Formatting assessment data*/
                for( $x=0; $x < count($student_id); $x++){
                    // $admission_no = $admission_no[$x];
                    /*Prepare student exam details for insertion*/
                    $scores[$x] = [
                        'teacher_comment' => $teacher_comment[$x],

                        'principal_comment' => $principal_comment[$x],

                        'hostel_comment' => $hostel_comment[$x],


                        'student_id' => $student_id[$x],
                        'aagc_id' => $aagc_id,
                        'session_id' => $session_id,
                        'term_id' => $term_id,
                        'student_category_id' => $category_id,
                        'created_at' => date('Y-m-d H:i:s',time())
                    ];
                }

                /*Remove previous assessment*/
                DB::table('comments')->where([['aagc_id',$aagc_id],['student_category_id',$category_id],['session_id',$session_id],['term_id',$term_id]])->delete();

                /*Upload assessment to database*/
                DB::table('comments')->insert($scores);

            });
            
        } catch (Exception $e) {
            return response(['status'=>0,'message'=>$e->getMessage()]);
        }


        return response(['status'=>1,'message'=>'Comments updated','retain'=>1]);

    }


    /*Update entire subject assessment*/
    public function updateManyClub(Request $request){


        try {

            DB::transaction(function() use($request){

                // extract($request->all());
                $student_id=$request->student_id;
                $admission_no=$request->admission_no;
                $aagc_id=$request->aagc_id;
                $club_id=$request->club_id;
                $session_id=$request->session_id;
                $term_id=$request->term_id;
                $category_id=$request->category_id;
                $remark = $request->remark;



                $scores = [];

                /*Formatting assessment data*/
                for( $x=0; $x < count($student_id); $x++){
                    // $admission_no = $admission_no[$x];
                    /*Prepare student exam details for insertion*/
                    $scores[$x] = [
                        'remark' => $remark[$x],



                        'student_id' => $student_id[$x],
                        'aagc_id' => $aagc_id[$x],
                        'club_id' => $club_id,
                        'session_id' => $session_id,
                        'term_id' => $term_id,
                        'student_category_id' => $category_id[$x],
                        'created_at' => date('Y-m-d H:i:s',time())
                    ];
                }

                /*Remove previous assessment*/
                DB::table('club_remarks')->where([['club_id',$club_id],['session_id',$session_id],['term_id',$term_id]])->delete();

                /*Upload assessment to database*/
                DB::table('club_remarks')->insert($scores);

            });
            
        } catch (Exception $e) {
            return response(['status'=>0,'message'=>$e->getMessage()]);
        }


        return response(['status'=>1,'message'=>'Remarks updated','retain'=>1]);

    }



    /*===========================Graph========================*/




}
