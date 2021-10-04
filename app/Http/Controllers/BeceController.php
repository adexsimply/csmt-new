<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bece;
use App\Session;
use App\Subject;
use App\Student;
use Illuminate\Support\Facades\DB;

class BeceController extends Controller
{

    public function index($session_id){

    	/*Collect all JSS3 student list*/
    	$students = Student::groupClassStudent(3,$session_id)->with('bece_details')
    						->get(['id','surname','othernames','admission_no']);

    	/*Collect all JSS3 subjects*/
    	$subjects = Subject::groupClassSubject(3,$session_id);

    	$session = Session::find($session_id);

    	$x = 1;

    	return view('subjects.bece',compact('students','subjects','session','x'));
    }



    /*Collect academic session to display bece taken */
    public function session(){
    	$sessions = Session::orderBy('name','DESC')->get();
    	$exam = 'bece';
    	
    	return view('subjects.ajax.external-exam-session',compact('sessions','exam'))->render();
    }




    public function edit($student_id,$session_id){

    	/*Collect all subjects offered by student in JJS 3*/
    	$subjects = Student::subjects($student_id,3);

    	$student = Student::where('id',$student_id)->first(['id','surname','admission_no','othernames']);

    	if(is_null($student->bece_details)):
    		$examination_no = '';
    		$remark = '';

    	else:

    		$examination_no = $student->bece_details->examination_no;
    		$remark = $student->bece_details->remark;

    	endif;
    	

    	return view('subjects.ajax.edit-bece',compact('subjects','student','session_id','examination_no','remark'))->render();

	}






	public function update(Request $request){
		

		try{

			DB::transaction(function() use($request){
				extract($request->all());

				$beceDetails = [
							'student_id' => $student_id,
							'remark' => $remark,
							'examination_no' => $examination_no
						];

				$beceScores = [];

				for($x=0; $x < count($subject_id); $x++):

					$beceScores[count($beceScores)] = [
								'student_id' => $student_id,
								'subject_id' => $subject_id[$x],
								'session_id' => $session_id,
								'score' => $score[$x]
							];
				endfor;



				/*Check if bece details already exist*/
				if(DB::table('bece_details')->where('student_id',$student_id)->exists())

					DB::table('bece_details')->where('student_id',$student_id)->update($beceDetails);

				else
					DB::table('bece_details')->insert($beceDetails);

				
				/*Check if score already exists*/
				if(DB::table('beces')->where('student_id',$student_id)->exists())

					/*Delete all student's bece scores because laravel doesn't allow multiple column update*/
					DB::table('beces')->where('student_id',$student_id)->delete();

				
				DB::table('beces')->insert($beceScores);

				

			});
		}
		catch(Exception $e){
			return response(['status'=>0,'message'=>$e->getMessage()]);
		}

		return response(['status'=>1, 'message'=>'Bece details stored successfully!','retain'=>301]);
	}




	public function show($student_id){

		$subjects = Student::subjects($student_id,3);
		$student = Student::find($student_id);

		/*Collect exam academic session*/
		$session = DB::table('sessions')->whereRaw('id = (SELECT session_id FROM beces WHERE student_id= '.$student_id.' LIMIT 1 )')->first();

		if($session)
			
			$session = explode(' ', $session->name)[0];

		else
			return redirect(url('empty'));

		return view('subjects.bece-statement',compact('subjects','student','session'));
	}



}
