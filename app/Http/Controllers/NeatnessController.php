<?php

namespace App\Http\Controllers;
use App\Neatness;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Aagc;
use App\Plugin\Addon;

class NeatnessController extends Controller
{
    private $table = 'neatnesses';
    
    
    /*Create marking form*/
    public function create(Request $request)
    {
        $aagc_id = (int)$request->aagc_id;
        $session_id = (int) $request->session_id;
        $term_id = (int) $request->term_id;
        $category_id = (int)$request->category_id;

        $students = Aagc::find($aagc_id)->students()
                    ->where([['aagc_session_student.session_id',$session_id],['students.student_category_id',$category_id]])
                    ->orderBy('students.surname')
                    ->get(['surname','students.id as student_id','othernames','admission_no']);
        $students = Addon::isEmpty($students);

        return view('domains.neatnesses.create',compact('students','aagc_id','session_id','term_id','category_id'))->render();
    }



    /*Mark checked attendance*/
    public function store(Request $request)
    {
        extract($request->all());

        $date = date('Y-m-d',strtotime($date));

        $insert = [];
        for ($i=0; $i < count($student_id); $i++) {

            /*Check if marked already*/
            if(!DB::table($this->table)->where([
                ['aagc_id',$aagc_id],
                ['session_id',$session_id],
                ['term_id',$term_id],
                ['student_id',$student_id[$i]],
                ['date',$date]
            ])->exists()){
                $insert[] = [
                    'aagc_id' => $aagc_id,
                    'session_id' => $session_id,
                    'term_id' => $term_id,
                    'status' => $status[$i],
                    'student_id' => $student_id[$i],
                    'date' => $date,
                    'created_at' => date('Y-m-d H:i:s',time())
                ];
            }
        }

       
    if(count($insert) > 0){
        if(DB::table($this->table)->insert($insert))
            return response(['status'=>1,'message'=>'Marked successfully!','retain'=>301]);
        else
            return response(['status'=>0,'message'=>'Connection error']);
    } else{
            return response(['status'=>0,'message'=>'No changes made']);
        }

    }

    
    /*Show already marked attendance*/
    public function show(Request $request)
    {
        $aagc_id = (int)$request->aagc_id;
        $session_id = (int) $request->session_id;
        $term_id = (int) $request->term_id;
        $category_id = (int) $request->category_id;
        $date = date('Y-m-d',strtotime($request->date));

        $attendances  = Neatness::join('students','students.id','neatnesses.student_id')
                        ->where([
                            ['aagc_id',$aagc_id],
                            ['session_id',$session_id],
                            ['term_id',$term_id],
                            ['students.student_category_id',$category_id],
                            ['date',''.$date.'']
                        ])
                        ->get(['surname','students.id as student_id','othernames','admission_no','neatnesses.status','neatnesses.date']);

        $attendances  = Addon::isEmpty($attendances);

        return view('domains.neatnesses.show',compact('attendances','date','aagc_id','session_id','term_id'))->render();

    }

    
    
    /*Mark checked attendance*/
    public function update(Request $request)
    {
        

        try {

            DB::transaction(function() use($request){
                extract($request->all());

                $date = date('Y-m-d',strtotime($date));

                $insert = [];
                for ($i=0; $i < count($student_id); $i++) { 
                    /*Remove all marked attendance*/
                    DB::table($this->table)->where([
                            ['aagc_id',$aagc_id],
                            ['session_id',$session_id],
                            ['term_id',$term_id],
                            ['student_id',$student_id[$i]],
                            ['date',$date]
                        ])->delete();

                    $insert[] = [
                        'aagc_id' => $aagc_id,
                        'session_id' => $session_id,
                        'term_id' => $term_id,
                        'status' => $status[$i],
                        'student_id' => $student_id[$i],
                        'date' => $date,
                        'created_at' => date('Y-m-d H:i:s',time())
                    ];
                }


                /*Insert the update*/
                DB::table($this->table)->insert($insert);
            });
            
        } catch (Exception $e) {
            return response([
                'status' => 1,
                'message' => 'Connection error'
            ]);
        }

        
        return response(['status'=>1,'message'=>'updated successfully!','retain'=>1]);
       

    }
}
