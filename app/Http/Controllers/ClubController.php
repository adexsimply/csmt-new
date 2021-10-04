<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Club;
use App\Plugin\Addon;
use App\Aagc;
use Illuminate\Support\Facades\DB;

class ClubController extends Controller
{
    public function index(Request $request){
    	$session_id = Aagc::active()->session_id;
        $term_id = Aagc::active()->term_id;
        $club_id = $request->id;
    	$students = DB::table('clubs')
    					->join('students','students.club_id','clubs.id')
                        ->join('student_spies','student_spies.student_id','=','students.id')
    					->join('aagc_session_student','students.id','aagc_session_student.student_id')
    					->where([
    						['clubs.id',$club_id],
                            ['students.status','1'],
    						['aagc_session_student.session_id',$session_id]
    					])
    					->select('clubs.id','students.surname','students.othernames','students.gender','students.admission_no','students.student_category_id','aagc_session_student.aagc_id','clubs.name','student_spies.current_class','student_spies.arm')

                      //  ->limit(1)
    					->get();
    	$students = Addon::isEmpty($students);

    	return view('extra.club-student',compact('students','club_id','session_id','term_id'));
    }



    /*Collecting assessement details for upload */
    public function createClubReport($club_id,$session_id,$term_id=false){

      //  $term_id = $term_id ? $term_id : self::active()->term_id;


        $session_id = Aagc::active()->session_id;
        $term_id = Aagc::active()->term_id;



        $students = DB::table('students')->whereRaw('status=1 AND club_id= '.$club_id.' AND students.id IN (SELECT student_id FROM aagc_session_student WHERE session_id='.$session_id.')
                AND students.id NOT IN (SELECT student_id FROM club_report WHERE session_id='.$session_id.' AND term_id='.$term_id.' AND club_id='.$club_id.')')
                        ->join('aagc_session_student','students.id','aagc_session_student.student_id')
                        ->where('aagc_session_student.session_id',$session_id)->orderBy('students.surname')->get(['students.id','students.admission_no','students.surname','othernames','students.student_category_id','aagc_session_student.aagc_id']);

        if(count($students) > 0){

                
            return view('extra.report-new-club',compact('students','session_id','term_id','club_id'))->render();

        } else{

            $condition = array(['session_id',$session_id],['term_id',$term_id],['club_report.club_id',$club_id]);

        /*Collect assessments for editing*/
            $students = DB::table('club_report')->join('students','students.id','club_report.student_id')
                            ->where($condition)
                            ->orderBy('students.surname')
                            ->get(['club_report.*','admission_no','surname','othernames']);

            // dd($students);

            return view('extra.report-club',compact('students','session_id','term_id','club_id'))->render();

        }

    }


    /*Upload assessment*/
    public function storeClubReport(Request $request){


        try {

            DB::transaction(function() use($request){

                extract($request->all());

                $scores = [];

                /*Formatting assessment data*/
                for( $x=0; $x < count($student_id); $x++){
                  //  $admission_no = Student::find($student_id[$x])->admission_no;
                    /*Prepare student exam details for insertion*/
                    $scores[$x] = [
                        'performance' => $performance[$x],


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
                DB::table('club_report')->insert($scores);



            });
            
        } catch (Exception $e) {
            return response(['status'=>0,'message'=>$e->getMessage()]);
        }


        return response(['status'=>1,'message'=>'Performance Report Uploaded','retain'=>301]);

    }


    /*Update entire subject assessment*/
    public function updateManyClubReport(Request $request){


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
                $performance = $request->performance;



                $scores = [];

                /*Formatting assessment data*/
                for( $x=0; $x < count($student_id); $x++){
                    // $admission_no = $admission_no[$x];
                    /*Prepare student exam details for insertion*/
                    $scores[$x] = [
                        'performance' => $performance[$x],


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
                DB::table('club_report')->where([['club_id',$club_id],['session_id',$session_id],['term_id',$term_id]])->delete();

                /*Upload assessment to database*/
                DB::table('club_report')->insert($scores);

            });
            
        } catch (Exception $e) {
            return response(['status'=>0,'message'=>$e->getMessage()]);
        }


        return response(['status'=>1,'message'=>'performance updated','retain'=>1]);

    }



}
