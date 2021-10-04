<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Waec;
use App\Session;
use App\Subject;
use App\Student;
use Illuminate\Support\Facades\DB;

class WaecController extends Controller
{

    public function index($session_id){

    	/*Collect all SSS3 student list*/
    	$students = Student::groupClassStudent(6,$session_id)->with('waec_details')
    						->get(['id','surname','othernames','admission_no']);

    	/*Collect all SSS3 subjects*/
    	$subjects = Subject::groupClassSubject(6,$session_id);

    	$session = Session::find($session_id);

    	$x = 1;

    	return view('subjects.waec',compact('students','subjects','session','x'));
    }



    /*Collect academic session to display waec taken */
    public function session(){
    	$sessions = Session::orderBy('name','DESC')->get();
    	$exam = 'waec';
    	
    	return view('subjects.ajax.external-exam-session',compact('sessions','exam'))->render();
    }




    public function edit($student_id,$session_id){

    	/*Collect all subjects offered by student in JJS 3*/
    	$subjects = Student::subjects($student_id,6);

    	$student = Student::where('id',$student_id)->first(['id','surname','admission_no','othernames']);

    	if(is_null($student->waec_details)):
    		$examination_no = '';
    		$remark = '';

    	else:

    		$examination_no = $student->waec_details->examination_no;
    		$remark = $student->waec_details->remark;

    	endif;


    	return view('subjects.ajax.edit-waec',compact('subjects','student','session_id','examination_no','remark'))->render();

	}






	public function update(Request $request){
		

		try{

			DB::transaction(function() use($request){
				extract($request->all());

				$waecDetails = [
							'student_id' => $student_id,
							'remark' => $remark,
							'examination_no' => $examination_no
						];

				$waecScores = [];

				for($x=0; $x < count($subject_id); $x++):

					$waecScores[count($waecScores)] = [
								'student_id' => $student_id,
								'subject_id' => $subject_id[$x],
								'session_id' => $session_id,
								'score' => $score[$x]
							];
				endfor;



				/*Check if waec details already exist*/
				if(DB::table('waec_details')->where('student_id',$student_id)->exists())

					DB::table('waec_details')->where('student_id',$student_id)->update($waecDetails);

				else
					DB::table('waec_details')->insert($waecDetails);

				
				/*Check if score already exists*/
				if(DB::table('waecs')->where('student_id',$student_id)->exists())

					/*Delete all student's waec scores because laravel doesn't allow multiple column update*/
					DB::table('waecs')->where('student_id',$student_id)->delete();

				
				DB::table('waecs')->insert($waecScores);

				

			});
		}
		catch(Exception $e){
			return response(['status'=>0,'message'=>$e->getMessage()]);
		}

		return response(['status'=>1, 'message'=>'Waec details stored successfully!','retain'=>301]);
	}




	public function show($student_id){

		$subjects = Student::subjects($student_id,6);
		$student = Student::find($student_id);

		/*Collect exam academic session*/
		$session = DB::table('sessions')->whereRaw('id = (SELECT session_id FROM waecs WHERE student_id= '.$student_id.' LIMIT 1 )')->first();

		if($session)
			
			$session = explode(' ', $session->name)[0];

		else
			return redirect(url('empty'));

		return view('subjects.waec-statement',compact('subjects','student','session'));
	}



}
