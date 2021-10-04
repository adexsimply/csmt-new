<?php

namespace App\Http\Controllers;

use App\Student_parent;
use App\Plugin\Addon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Exception;

class ParentController extends Controller
{
    //
    public $perPage = 10000;
    public $table = 'parents';


     public function index() {
     	$parents = DB::table('parents')->get();

     	 return view('parents.index', ['parents' => $parents]);

     }
    public function createFull(){
        return view('parents.ajax.full-parent-registration')->render();
    }


    public function store(Request $request){

        try{
        
            $transaction = DB::transaction(function() use($request){

                /*Collect all array data and make them variables*/
                extract($request->all());

                $parent = new Student_parent;
                /*Check if admission no already exists*/
                if(Student_parent::where('phone1',$phone1)->exists())
                    throw new Exception("Phone Number already taken");  

                $parent->name = $parent_name;
                $parent->address = $parent_address;
                $parent->phone1 = $phone1;
                $parent->phone2 = $phone2;
                $parent->email = $email;
                $parent->save();





            });

        } catch(Exception $e){
            
            return response(['status'=>0,'message'=>$e->getMessage()]);
        }

        
        return response(['status'=>1,'message'=>$request->name.' registered successfully!', 'retain'=>301]);
        

    }

    public function destroy(Request $request)
    {
        if(Student_parent::destroy($request->id))

            return response(['status'=>1,'message'=>'Parent deleted successfully','retain'=>301]);

        return response(['status'=>0,'message'=>'Connection error']);
    }
    


    public function edit($parent_id){

        $parent =  DB::table('parents')->where('id', $parent_id)->first();
            // dd($student);
        
        return view('parents.ajax.edit',compact('parent'));
    }


    public function update(Request $request){

        try {

            DB::transaction(function() use($request){

                extract($request->all());


                /*Check if admission no already exists*/
                if(Student_parent::where([['phone1',$phone1],['id','<>',$parent_id]])->exists())
                    throw new Exception("Phone Number already taken");

                /*Update parent details*/
                $parent = Student_parent::find($parent_id);
                $parent->name = $parent_name;
                $parent->address = $parent_address;
                $parent->phone1 = $phone1;
                $parent->phone2 = $phone2;
                $parent->email = $email;
                $parent->save();



            });

            
        } catch (Exception $e) {
             return response(['status'=>0,'message'=>$e->getMessage()]);
        }


        return response(['status'=>1,'message'=>'Parent updated successfully','retain'=>301]);

    }


   











}
