<?php

namespace App\Http\Controllers;
use App\Psychomotor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Aagc;
use App\Plugin\Addon;

class PsychomotorController extends Controller
{
    private $table = 'psychomotors';
    
    
    /*Create marking form*/
    public function create(Request $request)
    {
        $aagc_id = (int)$request->aagc_id;
        $session_id = (int) $request->session_id;
        $term_id = (int) $request->term_id;
        $category_id = (int)$request->category_id;

        /*Check if already marked*/
        if(Psychomotor::where([['aagc_id',$aagc_id],['session_id',$session_id],['term_id',$term_id],['student_category_id2',$category_id]])->exists()){

            $students = Psychomotor::join('students','students.id','psychomotors.student_id')
                        ->where([['aagc_id',$aagc_id],['students.student_category_id',$category_id],['session_id',$session_id],['term_id',$term_id],['students.status',1]])
                        ->get(['surname','students.id as student_id','othernames','admission_no','craft_skill','pet_project','sport','remark']);


            return view('domains.psychomotors.show',compact('students','aagc_id','session_id','term_id','category_id'))->render();
        }
        else{

            /*create new*/
            $students = Aagc::find($aagc_id)->students()
                        ->where([['aagc_session_student.session_id',$session_id],['students.student_category_id',$category_id],['students.status',1]])
                        ->orderBy('students.surname')
                        ->get(['surname','students.id as student_id','othernames','admission_no']);
            $students = Addon::isEmpty($students);

            return view('domains.psychomotors.create',compact('students','aagc_id','session_id','term_id','category_id'))->render();
        }

        
    }

    /*Create marking form that opens on new page*/
    public function create2(Request $request)
    {
        $aagc_id = (int)$request->aagc_id;
        $session_id = (int) $request->session_id;
        $term_id = (int) $request->term_id;
        $category_id = (int)$request->category_id;

        /*Check if already marked*/
        if(Psychomotor::where([['aagc_id',$aagc_id],['session_id',$session_id],['term_id',$term_id],['student_category_id2',$category_id]])->exists()){

            $students = Psychomotor::join('students','students.id','psychomotors.student_id')
                        ->where([['aagc_id',$aagc_id],['students.student_category_id',$category_id],['session_id',$session_id],['term_id',$term_id],['students.status',1]])
                        ->get(['surname','students.id as student_id','othernames','admission_no','craft_skill','pet_project','sport','remark']);


            return view('domains.psychomotors.show2',compact('students','aagc_id','session_id','term_id','category_id'))->render();
        }
        else{

            /*create new*/
            $students = Aagc::find($aagc_id)->students()
                        ->where([['aagc_session_student.session_id',$session_id],['students.student_category_id',$category_id],['students.status',1]])
                        ->orderBy('students.surname')
                        ->get(['surname','students.id as student_id','othernames','admission_no']);
            $students = Addon::isEmpty($students);

            return view('domains.psychomotors.create2',compact('students','aagc_id','session_id','term_id','category_id'))->render();
        }

        
    }



    /*Mark checked attendance*/
    public function store(Request $request)
    {
        extract($request->all());


        $insert = [];
        for ($i=0; $i < count($student_id); $i++) { 
            $insert[] = [
                'aagc_id' => $aagc_id,
                'session_id' => $session_id,
                'term_id' => $term_id,
                'pet_project' => $pet_project[$i],
                'craft_skill' => $craft_skill[$i],
                'sport' => $sport[$i],
                'remark' => $remark[$i],
                'student_category_id2' => $category_id,
                'student_id' => $student_id[$i],
                'created_at' => date('Y-m-d H:i:s',time())
            ];
        }


        if(DB::table($this->table)->insert($insert))
            return response(['status'=>1,'message'=>'Marked successfully!','retain'=>301]);
        else
            return response(['status'=>0,'message'=>'Connection error']);

    }


    
    
    /*Mark checked attendance*/
    public function update(Request $request)
    {
        extract($request->all());

        $insert = [];
        for ($i=0; $i < count($student_id); $i++) { 
            $insert[] = [
                'aagc_id' => $aagc_id,
                'session_id' => $session_id,
                'term_id' => $term_id,
                'pet_project' => $pet_project[$i],
                'craft_skill' => $craft_skill[$i],
                'sport' => $sport[$i],
                'remark' => $remark[$i],
                'student_category_id2' => $category_id,
                'student_id' => $student_id[$i],
                'created_at' => date('Y-m-d H:i:s',time())
            ];
        }

        try {

            DB::transaction(function() use($insert,$aagc_id,$session_id,$term_id,$category_id){
                /*Remove all marked attendance*/
                DB::table($this->table)->where([
                        ['aagc_id',$aagc_id],
                        ['session_id',$session_id],
                        ['student_category_id2',$category_id],
                        ['term_id',$term_id]
                    ])->delete();

                /*Insert the update*/
                DB::table($this->table)->insert($insert);
            });
            
        } catch (Exception $e) {
            return response([
                'status' => 1,
                'message' => 'Connection error'
            ]);
        }

        
        return response(['status'=>1,'message'=>'updated successfully!','retain'=>301]);
       

    }
}
