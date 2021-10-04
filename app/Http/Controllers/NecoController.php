<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Neco;
use App\Session;
use App\Subject;
use App\Student;
use Illuminate\Support\Facades\DB;

class NecoController extends Controller
{

    public function index($session_id){

    	/*Collect all SSS3 student list*/
    	$students = Student::groupClassStudent(6,$session_id)->with('neco_details')
    						->get(['id','surname','othernames','admission_no']);

    	/*Collect all SSS3 subjects*/
    	$subjects = Subject::groupClassSubject(6,$session_id);

    	$session = Session::find($session_id);

    	$x = 1;

    	return view('subjects.neco',compact('students','subjects','session','x'));
    }



    /*Collect academic session to display neco taken */
    public function session(){
    	$sessions = Session::orderBy('name','DESC')->get();
    	$exam = 'neco';
    	
    	return view('subjects.ajax.external-exam-session',compact('sessions','exam'))->render();
    }




    public function edit($student_id,$session_id){

    	/*Collect all subjects offered by student in JJS 3*/
    	$subjects = Student::subjects($student_id,6);

    	$student = Student::where('id',$student_id)->first(['id','surname','admission_no','othernames']);

    	if(is_null($student->neco_details)):
    		$examination_no = '';
    		$remark = '';

    	else:

    		$examination_no = $student->neco_details->examination_no;
    		$remark = $student->neco_details->remark;

    	endif;


    	return view('subjects.ajax.edit-neco',compact('subjects','student','session_id','examination_no','remark'))->render();

	}






	public function update(Request $request){
		

		try{

			DB::transaction(function() use($request){
				extract($request->all());

				$necoDetails = [
							'student_id' => $student_id,
							'remark' => $remark,
							'examination_no' => $examination_no
						];

				$necoScores = [];

				for($x=0; $x < count($subject_id); $x++):

					$necoScores[count($necoScores)] = [
								'student_id' => $student_id,
								'subject_id' => $subject_id[$x],
								'session_id' => $session_id,
								'score' => $score[$x]
							];
				endfor;



				/*Check if neco details already exist*/
				if(DB::table('neco_details')->where('student_id',$student_id)->exists())

					DB::table('neco_details')->where('student_id',$student_id)->update($necoDetails);

				else
					DB::table('neco_details')->insert($necoDetails);

				
				/*Check if score already exists*/
				if(DB::table('necos')->where('student_id',$student_id)->exists())

					/*Delete all student's neco scores because laravel doesn't allow multiple column update*/
					DB::table('necos')->where('student_id',$student_id)->delete();

				
				DB::table('necos')->insert($necoScores);

				

			});
		}
		catch(Exception $e){
			return response(['status'=>0,'message'=>$e->getMessage()]);
		}

		return response(['status'=>1, 'message'=>'Neco details stored successfully!','retain'=>301]);
	}




	public function show($student_id){

		$subjects = Student::subjects($student_id,6);
		$student = Student::find($student_id);

		/*Collect exam academic session*/
		$session = DB::table('sessions')->whereRaw('id = (SELECT session_id FROM necos WHERE student_id= '.$student_id.' LIMIT 1 )')->first();

		if($session)
			
			$session = explode(' ', $session->name)[0];

		else
			return redirect(url('empty'));

		return view('subjects.neco-statement',compact('subjects','student','session'));
	}



}
