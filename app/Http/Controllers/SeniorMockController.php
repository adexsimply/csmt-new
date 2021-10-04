<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Senior_mock as Mock;
use App\Session;
use App\Subject;
use App\Student;
use Illuminate\Support\Facades\DB;

class SeniorMockController extends Controller
{
       public function index($session_id){

    	/*Collect all JSS3 student list*/
    	$students = Student::groupClassStudent(6,$session_id)->with('senior_mock_details')
    						->get(['id','surname','othernames','admission_no']);

    	/*Collect all JSS3 subjects*/
    	$subjects = Subject::groupClassSubject(6,$session_id);

    	$session = Session::find($session_id);

    	$x = 1;

    	return view('subjects.senior-mock',compact('students','subjects','session','x'));
    }



    /*Collect academic session to display senior_mock taken */
    public function session(){
    	$sessions = Session::orderBy('name','DESC')->get();
    	$exam = 'senior-mock';
    	
    	return view('subjects.ajax.external-exam-session',compact('sessions','exam'))->render();
    }




    public function edit($student_id,$session_id){

    	/*Collect all subjects offered by student in JJS 3*/
    	$subjects = Student::subjects($student_id,6);

    	$student = Student::where('id',$student_id)->first(['id','surname','admission_no','othernames']);

    	if(is_null($student->senior_mock_details)):
    		$examination_no = '';
    		$remark = '';

    	else:

    		$examination_no = $student->senior_mock_details->examination_no;
    		$remark = $student->senior_mock_details->remark;

    	endif;


    	return view('subjects.ajax.edit-senior-mock',compact('subjects','student','session_id','examination_no','remark'))->render();

	}






	public function update(Request $request){
		

		try{

			DB::transaction(function() use($request){
				extract($request->all());

				$senior_mockDetails = [
							'student_id' => $student_id,
							'remark' => $remark
						];

				$senior_mockScores = [];

				for($x=0; $x < count($subject_id); $x++):

					$senior_mockScores[count($senior_mockScores)] = [
								'student_id' => $student_id,
								'subject_id' => $subject_id[$x],
								'session_id' => $session_id,
								'score' => $score[$x]
							];
				endfor;



				/*Check if senior_mock details already exist*/
				if(DB::table('senior_mock_details')->where('student_id',$student_id)->exists())

					DB::table('senior_mock_details')->where('student_id',$student_id)->update($senior_mockDetails);

				else
					DB::table('senior_mock_details')->insert($senior_mockDetails);

				
				/*Check if score already exists*/
				if(DB::table('senior_mocks')->where('student_id',$student_id)->exists())

					/*Delete all student's senior_mock scores because laravel doesn't allow multiple column update*/
					DB::table('senior_mocks')->where('student_id',$student_id)->delete();

				
				DB::table('senior_mocks')->insert($senior_mockScores);

				

			});
		}
		catch(Exception $e){
			return response(['status'=>0,'message'=>$e->getMessage()]);
		}

		return response(['status'=>1, 'message'=>'Mock details stored successfully!','retain'=>301]);
	}




	public function show($student_id){

		$subjects = Student::subjects($student_id,6);
		$student = Student::find($student_id);

		/*Collect exam academic session*/
		$session = DB::table('sessions')->whereRaw('id = (SELECT session_id FROM senior_mocks WHERE student_id= '.$student_id.' LIMIT 1 )')->first();

		if($session)
			
			$session = explode(' ', $session->name)[0];

		else
			return redirect(url('empty'));

		return view('subjects.senior-mock-statement',compact('subjects','student','session'));
	}



}
