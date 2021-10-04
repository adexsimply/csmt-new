<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Junior_mock as Mock;
use App\Session;
use App\Subject;
use App\Student;
use Illuminate\Support\Facades\DB;

class JuniorMockController extends Controller
{
       public function index($session_id){

    	/*Collect all JSS3 student list*/
    	$students = Student::groupClassStudent(3,$session_id)->with('junior_mock_details')
    						->get(['id','surname','othernames','admission_no']);

    	/*Collect all JSS3 subjects*/
    	$subjects = Subject::groupClassSubject(3,$session_id);

    	$session = Session::find($session_id);

    	$x = 1;

    	return view('subjects.junior-mock',compact('students','subjects','session','x'));
    }



    /*Collect academic session to display junior_mock taken */
    public function session(){
    	$sessions = Session::orderBy('name','DESC')->get();
    	$exam = 'junior-mock';
    	
    	return view('subjects.ajax.external-exam-session',compact('sessions','exam'))->render();
    }




    public function edit($student_id,$session_id){

    	/*Collect all subjects offered by student in JJS 3*/
    	$subjects = Student::subjects($student_id,3);

    	$student = Student::where('id',$student_id)->first(['id','surname','admission_no','othernames']);

    	if(is_null($student->junior_mock_details)):
    		$examination_no = '';
    		$remark = '';

    	else:

    		$examination_no = $student->junior_mock_details->examination_no;
    		$remark = $student->junior_mock_details->remark;

    	endif;


    	return view('subjects.ajax.edit-junior-mock',compact('subjects','student','session_id','examination_no','remark'))->render();

	}






	public function update(Request $request){
		

		try{

			DB::transaction(function() use($request){
				extract($request->all());

				$junior_mockDetails = [
							'student_id' => $student_id,
							'remark' => $remark
						];

				$junior_mockScores = [];

				for($x=0; $x < count($subject_id); $x++):

					$junior_mockScores[count($junior_mockScores)] = [
								'student_id' => $student_id,
								'subject_id' => $subject_id[$x],
								'session_id' => $session_id,
								'score' => $score[$x]
							];
				endfor;



				/*Check if junior_mock details already exist*/
				if(DB::table('junior_mock_details')->where('student_id',$student_id)->exists())

					DB::table('junior_mock_details')->where('student_id',$student_id)->update($junior_mockDetails);

				else
					DB::table('junior_mock_details')->insert($junior_mockDetails);

				
				/*Check if score already exists*/
				if(DB::table('junior_mocks')->where('student_id',$student_id)->exists())

					/*Delete all student's junior_mock scores because laravel doesn't allow multiple column update*/
					DB::table('junior_mocks')->where('student_id',$student_id)->delete();

				
				DB::table('junior_mocks')->insert($junior_mockScores);

				

			});
		}
		catch(Exception $e){
			return response(['status'=>0,'message'=>$e->getMessage()]);
		}

		return response(['status'=>1, 'message'=>'Mock details stored successfully!','retain'=>301]);
	}




	public function show($student_id){

		$subjects = Student::subjects($student_id,3);
		$student = Student::find($student_id);

		/*Collect exam academic session*/
		$session = DB::table('sessions')->whereRaw('id = (SELECT session_id FROM junior_mocks WHERE student_id= '.$student_id.' LIMIT 1 )')->first();

		if($session)
			
			$session = explode(' ', $session->name)[0];

		else
			return redirect(url('empty'));

		return view('subjects.junior-mock-statement',compact('subjects','student','session'));
	}



}
