<?php

namespace App\Http\Controllers;

use App\Clinic;
use App\Student;
use App\Student_parent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Aagc;
use App\Plugin\Addon;

class ClinicController extends Controller
{
    private $table = 'clinics';
    public $perPage = 10000;
    public $table2 = 'students';

     public function index($status=null,$category_id=null){

        if(!is_null($category_id)){

            $condition = array(['student_category_id',$category_id]);

            if(!is_null($status))
                $condition[] = ['status',$status];

            $students = Student::join('parents','parents.id','=','students.parent_id')
                            ->join('student_spies','student_spies.student_id','=','students.id')
                            ->where($condition)
                            ->select('students.id','students.admission_no','students.surname','students.othernames','students.student_category_id','parents.name as parent','parents.phone1 as phone1','parents.phone2 as phone 2','student_spies.current_class','student_spies.arm','students.status')
                            ->orderBy('surname','ASC')
                            ->paginate($this->perPage);
        }

        else{
        if(is_null($status))
            $students = Student::join('parents','parents.id','=','students.parent_id')
                            ->join('student_spies','student_spies.student_id','=','students.id')
                            ->select('students.id','students.admission_no','students.surname','students.othernames','students.student_category_id','parents.name as parent','parents.phone1 as phone1','parents.phone2 as phone2','student_spies.current_class','student_spies.arm','students.status')
                            ->orderBy('surname','ASC')
                            ->paginate($this->perPage);

        /*Collect active students including graduated jss 3 student now in sss classes*/
        else if($status == 1)
            $students = Student::join('parents','parents.id','=','students.parent_id')
                            ->join('student_spies','student_spies.student_id','=','students.id')
                            ->where([['status',$status],['status',4]])
                            ->select('students.id','students.admission_no','students.surname','students.othernames','students.student_category_id','parents.name as parent','parents.phone1 as phone1','parents.phone2 as phone2','student_spies.current_class','student_spies.arm','students.status')
                            ->orderBy('surname','ASC')
                            ->paginate($this->perPage);

        else
            $students = Student::join('parents','parents.id','=','students.parent_id')
                            ->join('student_spies','student_spies.student_id','=','students.id')
                            ->where('status',$status)
                            ->select('students.id','students.admission_no','students.surname','students.othernames','students.student_category_id','parents.name as parent','parents.phone1 as phone1','parents.phone2 as phone2','student_spies.current_class','student_spies.arm','students.status')
                            ->orderBy('surname','ASC')
                            ->paginate($this->perPage);
            }
        $status = is_null($status) ? null : $status;


        return view('clinic.index',compact('students','status','category_id'));
    }

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

        return view('domains.clinics.create',compact('students','aagc_id','session_id','term_id','category_id'))->render();
    }
  
    /*Mark checked attendance*/
    public function store(Request $request)
    {
        extract($request->all());

        $date = date('Y-m-d',strtotime($date));

        $insert = [];
        for ($i=0; $i < count($student_id); $i++) { 
       
        	if(isset($status[$i])){

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
    public function show1($id)
    {
        //$date = date('Y-m-d',strtotime($clinic_date));
        $current_aagc_id = DB::table('student_spies')->where('student_id',$id)->first()->aagc_id;
        $current_term = DB::table('session_term')->where('status',1)->first()->term_id; 
        $current_session = DB::table('session_term')->where('status',1)->first()->session_id; 

        
        $attendances = DB::table('clinics')->where('student_id',$id)->where('aagc_id',$current_aagc_id)->where('term_id',$current_term)->where('session_id',$current_session)->get();

        return view('clinic.ajax.show',compact('attendances'))->render();

    }


    
    /*Show already marked attendance*/
    public function show(Request $request)
    {
        $aagc_id = (int)$request->aagc_id;
        $session_id = (int) $request->session_id;
        $term_id = (int) $request->term_id;
        $category_id = (int) $request->category_id;
        $date = date('Y-m-d',strtotime($request->date));

        $attendances  = Clinic::join('students','students.id','clinics.student_id')
                        ->where([
                            ['aagc_id',$aagc_id],
                            ['session_id',$session_id],
                            ['term_id',$term_id],
                            ['students.student_category_id',$category_id],
                            ['date',''.$date.'']
                        ])
                        ->get(['surname','students.id as student_id','othernames','admission_no','clinics.status','clinics.date']);

        $attendances  = Addon::isEmpty($attendances);

        return view('domains.clinics.show',compact('attendances','date','aagc_id','session_id','term_id'))->render();

    }

    
    
    /*Mark checked attendance*/
    public function update1(Request $request)
    {
        

        try {

            DB::transaction(function() use($request){
                extract($request->all());

                $date = date('Y-m-d',strtotime($clinic_date));
                $current_aagc_id = DB::table('student_spies')->where('student_id',$id)->first()->aagc_id;
                $current_term = DB::table('session_term')->where('status',1)->first()->term_id; 
                $current_session = DB::table('session_term')->where('status',1)->first()->session_id; 

                  if(!DB::table($this->table)->where([
                ['aagc_id',$current_aagc_id],
                ['session_id',$current_session],
                ['term_id',$current_term],
                ['student_id',$id],
                ['date',$date]
            ])->exists()){

                        $insert[] = [
                            'aagc_id' => $current_aagc_id,
                            'session_id' => $current_session,
                            'term_id' => $current_term,
                            'status' => 1,
                            'student_id' => $id,
                            'date' => $date,
                            'created_at' => date('Y-m-d H:i:s',time())
                        ];
                

                /*Insert the update*/
                DB::table($this->table)->insert($insert);
                    }
            });
            
        } catch (Exception $e) {
            return response([
                'status' => 1,
                'message' => 'Connection error'
            ]);
        }

        
        return response(['status'=>1,'message'=>'updated successfully!','retain'=>1]);
       

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


                    if(isset($status[$i])){
                        $insert[] = [
                            'aagc_id' => $aagc_id,
                            'session_id' => $session_id,
                            'term_id' => $term_id,
                            'status' => $status[$i],
                            'student_id' => $student_id[$i],
                            'date' => $date,
                            'updated_at' => date('Y-m-d H:i:s',time())
                        ];
                    }

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

    public function edit($student_id){

        $student = Student::where('students.id',$student_id)
                            ->join('student_spies','student_spies.student_id','=','students.id')
                            ->join('parents','parents.id','=','students.parent_id')
                            ->join('aagc','aagc.id','=','student_spies.aagc_id')
                            ->select('students.*','students.id as student_id','aagc.id as aagc_id','aagc.group_class_id','parents.*')->first();
            // dd($student);
        
        return view('clinic.ajax.edit',compact('student'));
    }
}
