<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Assessment;
use App\Subject;
use App\Student;
use App\Aagc;
use Illuminate\Support\Facades\DB;
use Exception;

class AssessmentController extends Controller {
    
    public static function active(){
        $active = DB::table('session_term')->where('status',1)->first(['session_id','term_id']);

        return $active;
    }


	/*Collecting assessement details for upload */
    public function create($aagc_id,$category_id,$session_id,$subject_id,$term_id=false){

        $term_id = $term_id ? $term_id : self::active()->term_id;



        $students = DB::table('students')->whereRaw('

                student_category_id = '.$category_id.' AND id IN (SELECT student_id FROM aagc_subject_student WHERE aagc_id='.$aagc_id.' AND session_id='.$session_id.' AND subject_id='.$subject_id.') 

                AND id NOT IN (SELECT student_id FROM assessments WHERE aagc_id='.$aagc_id.' AND session_id='.$session_id.' AND subject_id='.$subject_id.' AND term_id='.$term_id.' AND student_category_id = '.$category_id.')')->orderBy('students.surname')->get(['id','admission_no','surname','othernames']);

        if(count($students) > 0){

            $page = 'assessments.ajax.upload';
            if(Aagc::isCatTerm(Aagc::find($aagc_id)->group_class_id,$term_id))
                $page = 'assessments.ajax.upload-cat';
                
            return view($page,compact('students','aagc_id','session_id','subject_id','term_id','category_id'))->render();

        } else{

            $condition = array(['aagc_id',$aagc_id],['session_id',$session_id],['term_id',$term_id],['subject_id',$subject_id],['students.student_category_id',$category_id]);

        /*Collect assessments for editing*/
            $students = DB::table('assessments')->join('students','students.id','assessments.student_id')
                            ->where($condition)
                            ->orderBy('students.surname')
                            ->get(['assessments.*','admission_no','surname','othernames']);

            // dd($students);

            $page = 'assessments.ajax.subject-assessment';
            if(Aagc::isCatTerm(Aagc::find($aagc_id)->group_class_id,$term_id))
                $page = 'assessments.ajax.subject-assessment';

            return view($page,compact('students','aagc_id','session_id','subject_id','term_id','category_id'))->render();

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
    public function createPractical($aagc_id,$category_id,$session_id,$subject_id,$term_id=false){
        


        $term_id = $term_id ? $term_id : self::active()->term_id;



        $students = DB::table('students')->whereRaw('

                student_category_id = '.$category_id.' AND id IN (SELECT student_id FROM aagc_subject_student WHERE aagc_id='.$aagc_id.' AND session_id='.$session_id.' AND subject_id='.$subject_id.') 

                AND id NOT IN (SELECT student_id FROM assessments WHERE aagc_id='.$aagc_id.' AND session_id='.$session_id.' AND subject_id='.$subject_id.' AND term_id='.$term_id.' AND student_category_id = '.$category_id.')')->orderBy('students.surname')->get(['id','admission_no','surname','othernames']);

        if(count($students) > 0){

            $page = 'assessments.ajax.upload-practical';
            if(Aagc::isCatTerm(Aagc::find($aagc_id)->group_class_id,$term_id))
                $page = 'assessments.ajax.upload-practical-cat';
                
            return view($page,compact('students','aagc_id','session_id','subject_id','term_id','category_id'))->render();

        } else{

            $condition = array(['aagc_id',$aagc_id],['session_id',$session_id],['term_id',$term_id],['subject_id',$subject_id],['students.student_category_id',$category_id]);

        /*Collect assessments for editing*/
            $students = DB::table('assessments')->join('students','students.id','assessments.student_id')
                            ->where($condition)
                            ->orderBy('students.surname')
                            ->get(['assessments.*','admission_no','surname','othernames']);

            // dd($students);

            $page = 'assessments.ajax.subject-assessment-practical';
            if(Aagc::isCatTerm(Aagc::find($aagc_id)->group_class_id,$term_id))
                $page = 'assessments.ajax.subject-assessment-practical';

            return view($page,compact('students','aagc_id','session_id','subject_id','term_id','category_id'))->render();

        }

    }



    /*Upload assessment*/
    public function storePractical(Request $request){

        /*Authenticate score*/
        function checkScore($score,$message,$test=true){

            if($test && ($score > 30))
                throw new Exception($message);
            // elseif($test && ($score = -1))
            //     $score = NULL;
                
            if(!$test && ($score > 100))
                throw new Exception($message);
            // elseif(!$test && ($score = -1))
            //     $score = NULL;
            else
                return $score;
        }

    	try {

    		DB::transaction(function() use($request){

    			extract($request->all());

    			$scores = [];

    			/*Formatting assessment data*/
    			for( $x=0; $x < count($student_id); $x++){
                    $admission_no = Student::find($student_id[$x])->admission_no;
    				/*Prepare student exam details for insertion*/
    				$scores[$x] = [
                        'practical' => checkScore($practical[$x],$admission_no." first test score cannot be greater than 10 or less than 0"),

    					'student_id' => $student_id[$x],
    					'aagc_id' => $aagc_id,
    					'session_id' => $session_id,
    					'term_id' => $term_id,
                        'subject_id' => $subject_id,
    					'student_category_id' => $category_id,
                        'created_at' => date('Y-m-d H:i:s',time())
    				];


    			}


    			/*Upload assessment to database*/
    			DB::table('assessments')->insert($scores);



    		});
    		
    	} catch (Exception $e) {
    		return response(['status'=>0,'message'=>$e->getMessage()]);
    	}


    	return response(['status'=>1,'message'=>'Assessment Uploaded','retain'=>301]);

    }

    /*Upload assessment*/
    public function store(Request $request){

        /*Authenticate score*/
        function checkScore($score,$message,$test=true){

            if($test && ($score > 30))
                throw new Exception($message);
            // elseif($test && ($score = -1))
            //     $score = NULL;
                
            if(!$test && ($score > 100))
                throw new Exception($message);
            // elseif(!$test && ($score = -1))
            //     $score = NULL;
            else
                return $score;
        }

        try {

            DB::transaction(function() use($request){

                extract($request->all());

                $scores = [];

                /*Formatting assessment data*/
                for( $x=0; $x < count($student_id); $x++){
                    $admission_no = Student::find($student_id[$x])->admission_no;
                    /*Prepare student exam details for insertion*/
                    $scores[$x] = [
                        'test1' => checkScore($test1[$x],$admission_no." first test score cannot be greater than 10 or less than 0"),

                        'test2' => checkScore($test2[$x],$admission_no." second test score cannot be greater than 10 or less than 0"),

                        'test3' => checkScore($test3[$x],$admission_no." third test score cannot be greater than 10 or less than 0"),

                        'micro_exam' => checkScore($micro_exam[$x],$admission_no." Micro Exam score cannot be greater than 10 or less than 0"),

                        'exam' => checkScore($exam[$x],$admission_no." exam score cannot be greater than 100 or less than 0",false),

                        'student_id' => $student_id[$x],
                        'aagc_id' => $aagc_id,
                        'session_id' => $session_id,
                        'term_id' => $term_id,
                        'subject_id' => $subject_id,
                        'student_category_id' => $category_id,
                        'created_at' => date('Y-m-d H:i:s',time())
                    ];


                }


                /*Upload assessment to database*/
                DB::table('assessments')->insert($scores);



            });
            
        } catch (Exception $e) {
            return response(['status'=>0,'message'=>$e->getMessage()]);
        }


        return response(['status'=>1,'message'=>'Assessment Uploaded','retain'=>301]);

    }





    /*Update entire subject assessment*/
    public function updateMany(Request $request){

        /*Authenticate score*/
        function checkScore($score,$message,$test=true){

            if($test && ($score > 30))
                throw new Exception($message);
            // if($test && ($score = -1))
            // $score = NULL;
                
            if(!$test && ($score > 100))
                throw new Exception($message);
            // elseif(!$test && ($score = -1))
            //     $score = NULL;
            else
                return $score;
        }

        try {

            DB::transaction(function() use($request){

                // extract($request->all());
                $student_id=$request->student_id;
                $admission_no=$request->admission_no;
                $aagc_id=$request->aagc_id;
                $session_id=$request->session_id;
                $term_id=$request->term_id;
                $category_id=$request->category_id;
                $subject_id=$request->subject_id;
                $test1=$request->test1;
                $test2=$request->test2;
                $test3=$request->test3;
                $micro_exam=$request->micro_exam;
                if ($request->practical) {
                $practical=$request->practical;

                }
                $exam=$request->exam;


                $scores = [];

                /*Formatting assessment data*/
                for( $x=0; $x < count($student_id); $x++){
                    // $admission_no = $admission_no[$x];
                    /*Prepare student exam details for insertion*/
                    $scores[$x] = [
                        'test1' => checkScore($test1[$x],$admission_no[$x]." first test score cannot be greater than 10 or less than 0"),

                        'test2' => checkScore($test2[$x],$admission_no[$x]." second test score cannot be greater than 10 or less than 0"),

                        'test3' => checkScore($test3[$x],$admission_no[$x]." third test score cannot be greater than 10 or less than 0"),

                        'micro_exam' => checkScore($micro_exam[$x],$admission_no[$x]." Micro Exam score cannot be greater than 30 or less than 0"),

                        'practical' => checkScore($practical[$x],$admission_no[$x]." Practical score cannot be greater than 30 or less than 0"),

                        'exam' => checkScore($exam[$x],$admission_no[$x]." exam score cannot be greater than 100 or less than 0",false),

                        'student_id' => $student_id[$x],
                        'aagc_id' => $aagc_id,
                        'session_id' => $session_id,
                        'term_id' => $term_id,
                        'subject_id' => $subject_id,
                        'student_category_id' => $category_id,
                        'updated_at' => date('Y-m-d H:i:s',time())
                    ];
                }

                /*Remove previous assessment*/
                DB::table('assessments')->where([['aagc_id',$aagc_id],['student_category_id',$category_id],['session_id',$session_id],['term_id',$term_id],['subject_id',$subject_id]])->delete();

                /*Upload assessment to database*/
                DB::table('assessments')->insert($scores);

            });
            
        } catch (Exception $e) {
            return response(['status'=>0,'message'=>$e->getMessage()]);
        }


        return response(['status'=>1,'message'=>'Assessment updated','retain'=>1]);

    }





    /*Update entire subject assessment*/
    public function updateManyPractical(Request $request){

        /*Authenticate score*/
        function checkScore($score,$message,$test=true){

            if($test && ($score > 30))
                throw new Exception($message);
            // if($test && ($score = -1))
            // $score = NULL;
                
            if(!$test && ($score > 100))
                throw new Exception($message);
            // elseif(!$test && ($score = -1))
            //     $score = NULL;
            else
                return $score;
        }

        try {

            DB::transaction(function() use($request){

                // extract($request->all());
                $student_id=$request->student_id;
                $admission_no=$request->admission_no;
                $aagc_id=$request->aagc_id;
                $session_id=$request->session_id;
                $term_id=$request->term_id;
                $category_id=$request->category_id;
                $subject_id=$request->subject_id;
                $practical=$request->practical;
                if ($request->test1) {
                $test1=$request->test1;
                }
                if ($request->test2) {
                $test2=$request->test2;
                }
                if ($request->test3) {
                $test3=$request->test3;
                }
                if ($request->micro_exam) {
                $micro_exam=$request->micro_exam;
                }
                if ($request->exam) {
                $exam=$request->exam;
                }


                $scores = [];

                /*Formatting assessment data*/
                for( $x=0; $x < count($student_id); $x++){
                    // $admission_no = $admission_no[$x];
                    /*Prepare student exam details for insertion*/
                    $scores[$x] = [
                        'test1' => checkScore($test1[$x],$admission_no[$x]." first test score cannot be greater than 10 or less than 0"),

                        'test2' => checkScore($test2[$x],$admission_no[$x]." second test score cannot be greater than 10 or less than 0"),

                        'test3' => checkScore($test3[$x],$admission_no[$x]." third test score cannot be greater than 10 or less than 0"),

                        'micro_exam' => checkScore($micro_exam[$x],$admission_no[$x]." Micro Exam score cannot be greater than 30 or less than 0"),

                        'practical' => checkScore($practical[$x],$admission_no[$x]." Practical score cannot be greater than 30 or less than 0"),

                        'exam' => checkScore($exam[$x],$admission_no[$x]." exam score cannot be greater than 100 or less than 0",false),

                        'student_id' => $student_id[$x],
                        'aagc_id' => $aagc_id,
                        'session_id' => $session_id,
                        'term_id' => $term_id,
                        'subject_id' => $subject_id,
                        'student_category_id' => $category_id,
                        'updated_at' => date('Y-m-d H:i:s',time())
                    ];
                }

                /*Remove previous assessment*/
                DB::table('assessments')->where([['aagc_id',$aagc_id],['student_category_id',$category_id],['session_id',$session_id],['term_id',$term_id],['subject_id',$subject_id]])->delete();

                /*Upload assessment to database*/
                DB::table('assessments')->insert($scores);

            });
            
        } catch (Exception $e) {
            return response(['status'=>0,'message'=>$e->getMessage()]);
        }


        return response(['status'=>1,'message'=>'Assessment updated','retain'=>1]);

    }





    /*Collect assessment result*/
    public function printer(Request $request){
        $aagc_id = (int)$request->aagc_id;
        $subject_id = (int)$request->subject_id;
        $session_id = (int)$request->session_id;
        $term_id = (int)$request->term_id;
        $category_id = (int)$request->category_id;


        /*Use active session if session is not specified*/
        $session_id = $session_id > 0 ? $session_id : self::active()->session_id;

        /*Use active term if term is not specified*/
        $term_id = $term_id > 0 ? $term_id : self::active()->term_id;
 
        
        $fiddle = [
            ['aagc_id',$aagc_id],
            ['subject_id',$subject_id],
            ['session_id',$session_id],
            ['term_id',$term_id],
            ['students.student_category_id',$category_id],
        ];


        $assessments = Assessment::printer($fiddle);
        $subject = Subject::find($subject_id);

        /*Check if class is sss2 third term*/
        $page = 'assessments.score-sheet';
        if(Aagc::isCatTerm(Aagc::find($aagc_id)->group_class_id,$term_id))
            $page = 'assessments.score-sheet-cat';

        return view($page,compact('assessments','session_id','term_id','category_id','aagc_id','subject','x'));
    }
        /*Collect assessment result*/
    public function subjectAnalysis(Request $request){
        $aagc_id = (int)$request->aagc_id;
        $subject_id = (int)$request->subject_id;
        $session_id = (int)$request->session_id;
        $term_id = (int)$request->term_id;
        $category_id = (int)$request->category_id;


        /*Use active session if session is not specified*/
        $session_id = $session_id > 0 ? $session_id : self::active()->session_id;

        /*Use active term if term is not specified*/
        $term_id = $term_id > 0 ? $term_id : self::active()->term_id;
 
        
        $fiddle = [
            ['aagc_id',$aagc_id],
            ['subject_id',$subject_id],
            ['session_id',$session_id],
            ['term_id',$term_id],
            ['students.student_category_id',$category_id],
        ];


        $assessments = Assessment::printer($fiddle);
        $subject = Subject::find($subject_id);


        $group_class_id = Aagc::find($aagc_id)->group_class_id;

        if($group_class_id == 1)

            return view('assessments.subject-analysis-junior',compact('assessments','session_id','term_id','category_id','aagc_id','subject_id','subject','x'));

        if(Aagc::isCatTerm(Aagc::find($aagc_id)->group_class_id,$term_id)) 
        return view('assessments.subject-analysis-cat',compact('assessments','session_id','term_id','category_id','aagc_id','subject_id','subject','x'));
        return view('assessments.subject-analysis',compact('assessments','session_id','term_id','category_id','aagc_id','subject_id','subject','x'));

        /*Check if class is sss2 third term*/
        $page = 'assessments.subject-analysis';
        if(Aagc::isCatTerm(Aagc::find($aagc_id)->group_class_id,$term_id))
            $page = 'assessments.subject-analysis-cat';

        return view($page,compact('assessments','session_id','term_id','category_id','aagc_id','subject_id','subject','x'));
    }
    /*Collect assessment result*/
    public function printerFine(Request $request){
        $aagc_id = (int)$request->aagc_id;
        $subject_id = (int)$request->subject_id;
        $session_id = (int)$request->session_id;
        $term_id = (int)$request->term_id;
        $category_id = (int)$request->category_id;


        /*Use active session if session is not specified*/
        $session_id = $session_id > 0 ? $session_id : self::active()->session_id;

        /*Use active term if term is not specified*/
        $term_id = $term_id > 0 ? $term_id : self::active()->term_id;
 
        
        $fiddle = [
            ['aagc_id',$aagc_id],
            ['subject_id',$subject_id],
            ['session_id',$session_id],
            ['term_id',$term_id],
            ['students.student_category_id',$category_id],
        ];


        $assessments = Assessment::printer($fiddle);
        $subject = Subject::find($subject_id);

        /*Check if class is sss2 third term*/
        $page = 'assessments.print-continuous-assessment';
        if(Aagc::isCatTerm(Aagc::find($aagc_id)->group_class_id,$term_id))
            $page = 'assessments.print-continuous-assessment-cat';

        return view($page,compact('assessments','session_id','term_id','category_id','aagc_id','subject_id','subject','x'));
    }



    /*Print entire class assessment*/
    public function classAssessment(Request $request){

        $term_id = (int) $request->term_id;
        $session_id = (int) $request->session_id;
        $aagc_id = (int)$request->aagc_id;
        $category_id = (int)$request->category_id;

        $term_id = $term_id > 0 ? $term_id : self::active()->term_id;
        $session_id = $session_id > 0 ? $session_id : self::active()->session_id;


        $subjects = Assessment::classSubject($aagc_id,$session_id,$term_id);


        // if(Aagc::isCatTerm(Aagc::find($aagc_id)->group_class_id,$term_id))
        // {
        //     $students = Assessment::classStudentCat($aagc_id,$category_id,$session_id,$term_id);
        // }

        $students = Assessment::classStudent($aagc_id,$category_id,$session_id,$term_id);


        /*Set cummulative to false in order to use the stupidLoading function in the view*/
        $cummulative = false;

        /*Check if class is sss2 third term*/
        $page = 'assessments.full-score-sheet';
        if(Aagc::isCatTerm(Aagc::find($aagc_id)->group_class_id,$term_id))
           // $students = Assessment::classStudentCat($aagc_id,$category_id,$session_id,$term_id);

            $page = 'assessments.full-score-sheet-cat';

        $group_class_id = Aagc::find($aagc_id)->group_class_id;

        
        return view($page,compact('students','subjects','category_id','session_id','term_id','aagc_id','group_class_id','cummulative'));   

    }



    /*Print entire class assessment*/
    public function classAssessmentPdf(Request $request){

        $term_id = (int) $request->term_id;
        $session_id = (int) $request->session_id;
        $aagc_id = (int)$request->aagc_id;
        $category_id = (int)$request->category_id;

        $term_id = $term_id > 0 ? $term_id : self::active()->term_id;
        $session_id = $session_id > 0 ? $session_id : self::active()->session_id;


        $subjects = Assessment::classSubject($aagc_id,$session_id,$term_id);



        $students = Assessment::classStudent($aagc_id,$category_id,$session_id,$term_id);


        /*Set cummulative to false in order to use the stupidLoading function in the view*/
        $cummulative = false;

        /*Check if class is sss2 third term*/
        $page = 'assessments.pdf';
        if(Aagc::isCatTerm(Aagc::find($aagc_id)->group_class_id,$term_id))
            $page = 'assessments.pdf-cat';

        $group_class_id = Aagc::find($aagc_id)->group_class_id;



        $comments = DB::table('group_classes')->where('id', '=', $group_class_id)->first();

        //if($comments->group_id == 1)

        if ($comments->group_id == 1) {
            $page = 'assessments.junior-pdf';
        }
        else {

        if(Aagc::isCatTerm(Aagc::find($aagc_id)->group_class_id,$term_id))
        {
            $page = 'assessments.senior-pdf-cat';
        }
       else {
            $page = 'assessments.senior-pdf';

        }

        }

        
        return view($page,compact('students','category_id','session_id','term_id','aagc_id','group_class_id','cummulative'));   

    }




    /*Print entire class assessment*/
    public function classResultStanding(Request $request){

        $term_id = (int) $request->term_id;
        $session_id = (int) $request->session_id;
        $aagc_id = (int)$request->aagc_id;
        $category_id = (int)$request->category_id;

        $term_id = $term_id > 0 ? $term_id : self::active()->term_id;
        $session_id = $session_id > 0 ? $session_id : self::active()->session_id;


        $subjects = Assessment::classSubject($aagc_id,$session_id,$term_id);



        $students = Assessment::classStudent($aagc_id,$category_id,$session_id,$term_id);


        /*Set cummulative to false in order to use the stupidLoading function in the view*/
        $cummulative = false;

        /*Check if class is sss2 third term*/
        $page = 'assessments.print-result-standing';
        if(Aagc::isCatTerm(Aagc::find($aagc_id)->group_class_id,$term_id))
            $page = 'assessments.print-result-standing-cat';

        $group_class_id = Aagc::find($aagc_id)->group_class_id;

        
        return view($page,compact('students','subjects','category_id','session_id','term_id','aagc_id','group_class_id','cummulative'));   

    }





    /*Print entire class assessment*/
    public function classMasterSheet(Request $request){

        $term_id = (int) $request->term_id;
        $session_id = (int) $request->session_id;
        $aagc_id = (int)$request->aagc_id;
        $category_id = (int)$request->category_id;

        $term_id = $term_id > 0 ? $term_id : self::active()->term_id;
        $session_id = $session_id > 0 ? $session_id : self::active()->session_id;


        $subjects = Assessment::classSubject($aagc_id,$session_id,$term_id);



        $students = Assessment::classStudent($aagc_id,$category_id,$session_id,$term_id);


        /*Set cummulative to false in order to use the stupidLoading function in the view*/
        $cummulative = false;

        /*Check if class is sss2 third term*/
        $page = 'assessments.print-master-sheet';
        if(Aagc::isCatTerm(Aagc::find($aagc_id)->group_class_id,$term_id))
            $page = 'assessments.print-master-sheet-cat';

        $group_class_id = Aagc::find($aagc_id)->group_class_id;

        
        return view($page,compact('students','subjects','category_id','session_id','term_id','aagc_id','group_class_id','cummulative'));   

    }



    /*Print entire class assessment*/
    public function classAssessmentPrint(Request $request){

        $term_id = (int) $request->term_id;
        $session_id = (int) $request->session_id;
        $aagc_id = (int)$request->aagc_id;
        $category_id = (int)$request->category_id;

        $term_id = $term_id > 0 ? $term_id : self::active()->term_id;
        $session_id = $session_id > 0 ? $session_id : self::active()->session_id;


        $subjects = Assessment::classSubject($aagc_id,$session_id,$term_id);



        $students = Assessment::classStudent($aagc_id,$category_id,$session_id,$term_id);


        /*Set cummulative to false in order to use the stupidLoading function in the view*/
        $cummulative = false;

        /*Check if class is sss2 third term*/
        $page = 'assessments.full-score-sheet';
        if(Aagc::isCatTerm(Aagc::find($aagc_id)->group_class_id,$term_id))
            $page = 'assessments.full-score-sheet-cat';

        $group_class_id = Aagc::find($aagc_id)->group_class_id;

        
        return view($page,compact('students','subjects','category_id','session_id','term_id','aagc_id','group_class_id','cummulative'));   

    }





    /*Print class assessment cummulative*/
    public function cummulative(Request $request){

        $session_id = $request->has('session_id') ? $request->session_id : self::active()->session_id;
        $aagc_id = $request->aagc_id;

        /*Collect total terms*/
        $cummulative = DB::table('assessments')->distinct('term_id')->where([['aagc_id',$aagc_id],['session_id',$session_id]])->count('term_id');

        

        $subjects = Assessment::classSubject($aagc_id,$session_id);



        $students = Assessment::classStudent($aagc_id,$session_id);

        /*Set term id to false in order to use the stupidLoading function in the view*/
        $term_id = false;
       

       /*Check if class is sss2 third term*/
        $page = 'assessments.full-score-sheet';
        if(Aagc::isCatTerm(Aagc::find($aagc_id)->group_class_id,$this->active()->term_id))
            $page = 'assessments.full-score-sheet-cat';

        return view($page,compact('students','subjects','session_id','term_id','aagc_id','cummulative'));
    }




    /*Print a term statement of result*/
    public function printTermStatement(Request $request){
        $student_id = $request->student_id;
        $aagc_id = $request->aagc_id;
        $session_id = $request->session_id;
        $term_id = $request->term_id;
        $position = (int) $request->position;
        $group_class_id = (int) $request->group_class_id;

        $subjects = Assessment::classSubjectStudent($aagc_id,$session_id,$term_id,$student_id);
        $x=1;
        $comments = DB::table('group_classes')->where('id', '=', $group_class_id)->first();

        if($comments->group_id == 1)

            return view('assessments.print-term-statement-junior',compact('subjects','comments','student_id','aagc_id','session_id','term_id','x','position'));

       if(Aagc::isCatTerm(Aagc::find($aagc_id)->group_class_id,$term_id)) 
        return view('assessments.print-term-statement-senior-cat',compact('subjects','comments','student_id','aagc_id','session_id','term_id','x','position'));
        return view('assessments.print-term-statement-senior',compact('subjects','comments','student_id','aagc_id','session_id','term_id','x','position'));
    }



    /*Print cummulative(All terms) statement of result*/
    public function printCummulativeStatement(Request $request){
        $student_id = $request->student_id;
        $aagc_id = $request->aagc_id;
        $session_id = $request->session_id;
        $cummulative = $request->cummulative;


        /*Authenticate cummulative*/
        if($cummulative < 2)
            back()->with('error','Cummulative function is not available for a single term');

        $subjects = Assessment::classSubject($aagc_id,$session_id);
        $x=1;



        return view('assessments.print-cummulative-statement',compact('subjects','student_id','aagc_id','session_id','cummulative','x'));
    }





    public function edit($id){

        $assessment = Assessment::find($id);

        return view('assessments.ajax.edit',compact('assessment'))->render();
    }




    public function update(Request $request){
        $assessment = Assessment::find($request->id);

        if($assessment->update($request->all()))
            return response(['status'=>1,'message'=>'Update successful','retain'=>301]);

        return response(['status'=>0,'message'=>'An error occured']);
    }





    /*Remove am assess,memt*/
    public function destroy(Request $request){

        if(Assessment::destroy($request->id))

             return response(['status'=>1,'message'=>'Assessment deleted','retain'=>301]);

        return response(['status'=>0,'message'=>'Assessment unable to delete']); 

    }





    /*===========================Graph========================*/




}
