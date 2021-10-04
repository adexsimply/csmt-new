<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Plugin\Addon;
use App\Aagc;
use Illuminate\Support\Facades\DB;

class HouseController extends Controller
{
    public function index(Request $request){
    	$session_id = Aagc::active()->session_id;
        $house_id = $request->id;
    	$students = DB::table('houses')
    					->join('students','students.club_id','houses.id')
                        ->join('student_spies','student_spies.student_id','=','students.id')
    					->join('aagc_session_student','students.id','aagc_session_student.student_id')
    					->where([
    						['houses.id',$house_id],
                            ['students.status','1'],
    						['aagc_session_student.session_id',$session_id]
    					])
    					->select('students.surname','students.othernames','students.admission_no','students.gender','student_spies.current_class','student_spies.arm')
    					->get();
    	$students = Addon::isEmpty($students);

    	return view('extra.house-student',compact('students'));
    }
}
