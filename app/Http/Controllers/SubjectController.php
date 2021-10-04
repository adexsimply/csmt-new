<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subject;
use App\Subject_category as Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\MessageBag;

class SubjectController extends Controller
{
    public function index(){

    	/*Collecting all subjects in the subject bank*/
    	$subjects = Subject::join('subject_schools','subject_schools.id','=','subjects.subject_school_id')
    					->select('subjects.*','subject_schools.name as school')
    					->orderBy('name','ASC')
    					->paginate(100);



    	/*Collecting junior secondary school subject categories*/
        $juniorSubjects = Category::with('subjects')->where('subject_school_id',2)->get();

        /*Collecting junior secondary school subject categories*/
    	$seniorSubjects = Category::with('subjects')->where('subject_school_id',3)->get();
       

    	$x=1;
    	return view('subjects.index',compact('subjects','juniorSubjects','seniorSubjects','x'));
    }



    public function store(Request $request){
    	$request->validate([
    		'name' => 'string|required',
    		'subject_school_id' => 'string|required'
    	]);

        if(Subject::where('name',$request->name)->exists())

            return response(['status'=>0,'message'=>$request->name.' already exist!']);

        /*Insert subject into database*/
    	if(Subject::create($request->all()))

    		return response(['status'=>1,'message'=>$request->name.' created!','retain'=>301]);

        else

            return response(['status'=>0,'message'=>'Connection error!']);
    }




    public function edit($id)
    {
        $subject = Subject::find($id);
        return response(compact('subject'));
    }

    




    public function update(Request $request)
    {
        $request->validate([
            'name' => 'string|required',
    		'subject_school_id' => 'string|required'
        ]);

        $subject = Subject::find($request->id);

        if($subject->update($request->all()))

            return response(['status'=>1,'message'=>$request->name.' updated!','retain'=>301]);

        else

            return response(['status'=>0,'message'=>'Connection error!']);
    }

    




    public function destroy(Request $request)
    {
        $id = $request->id;

        if(Subject::destroy($id))


            return response(['status'=>1,'message'=>'Subject deleted!','retain'=>301]);


        else


            return response(['status'=>0,'message'=>'Connection error!']);


    }

}
