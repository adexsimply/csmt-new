<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Testimonial;
use App\Session;
use App\Student;
use App\Plugin\Addon;
use Illuminate\Support\Facades\DB;

class TestimonialController extends Controller
{
    public function create(){

    	return view('testimonials.ajax.create')->render();
    }


    public function fetchStudents($session_id){
    	$students = Student::whereRaw('admitted_session_id= '.$session_id.' AND id NOT IN (SELECT student_id FROM testimonials)')->orderBy('surname','ASC')->get(['id','surname','othernames','admission_no']);

    	return response(compact('students'));
    }




    public function store(Request $request){
    	extract($request->all());

    	$image = $request->file('image');
    	$imageName = time().'.'.$image->extension();

    	if($image->storeAs(Testimonial::imageUploadPath,$imageName)):

	    	$insert = [
	    		'student_id' => $student_id,
	    		'areas_good_at' => $areas_good_at,
	    		'session_admitted' => Session::find($session_admitted)->name,
	    		'session_graduated' => Session::find($session_graduated)->name,
	    		'post_held' => $post_held,
	    		'abilities' => $abilities,
	    		'conduct' => $conduct,
	    		'image' => $imageName,
	    		'created_at' => date('Y-m-d H:m:s')
	    	];


	    	
	    	if(Testimonial::create($insert))
	    		return response(['status'=>1,'message'=>'Testimonial uploaded','retain'=>301]);

	    	return response(['status'=>0,'message'=>'Connection error']);

    	else:

    		return response(['status'=>0,'message'=>'Image upload failed!']);

    	endif;

    }


    public function print($id){
        $student = Testimonial::join('students','students.id','=','testimonials.student_id')
                    ->select('testimonials.*','students.surname','students.othernames')
                    ->where('testimonials.id',$id)
                    ->first();
      
        return view('testimonials.print',compact('student'));
    }



    public function show(){
    	$testimonials = Testimonial::with('student')->get();
    	$testimonials = Addon::isEmpty($testimonials);

        
    	return view('testimonials.show',compact('testimonials'));
    }


    public function edit($id){
    	$testimonial = Testimonial::find($id);

    	return view('testimonials.ajax.edit',compact('testimonial'))->render();
    }







    public function update(Request $request){
    	extract($request->all());


    	$testimonial = Testimonial::find($id);


    	$insert = [
	    		'areas_good_at' => $areas_good_at,
	    		'session_admitted' => $session_admitted,
	    		'session_graduated' => $session_graduated,
	    		'post_held' => $post_held,
	    		'abilities' => $abilities,
	    		'conduct' => $conduct,
	    		'updated_at' => date('Y-m-d H:m:s')
	    	];


	    	/*Update image*/
	    if($request->hasFile('image')){
	    	$image = $request->file('image');
    		$imageName = time().'.'.$image->extension();

    		if(!$image->storeAs(Testimonial::imageUploadPath,$imageName))
    			return response(['status'=>0,'message'=>'Image upload failed!']);

    		/*Add image to insertion array*/
    		$insert['image'] = $imageName;

    		if(Addon::isFile(Testimonial::imageUploadPath.'/'.$testimonial->image))
    			Addon::deleteFile(Testimonial::imageUploadPath.'/'.$testimonial->image);
	    }
    	

	    	
	    if($testimonial->update($insert))
	    		return response(['status'=>1,'message'=>'Testimonial updated','retain'=>301]);

	    
	    return response(['status'=>0,'message'=>'Connection error']);

    }



    public function destroy(Request $request){
    	$testimonial = Testimonial::find($request->id);

    	/*Remove image*/
    	if(Addon::isFile(Testimonial::imageUploadPath.'/'.$testimonial->image))
    			Addon::deleteFile(Testimonial::imageUploadPath.'/'.$testimonial->image);

    	if(Testimonial::destroy($request->id))
    		return response(['status'=>1,'message'=>'Testimonial uploaded','retain'=>301]);

    	return response(['status'=>0,'message'=>'Unable to delete testimonial, please try again']);
    }



}
