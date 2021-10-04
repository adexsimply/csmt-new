<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Old_testimonial as Testimonial;
use App\Session;
use App\Student;
use App\Plugin\Addon;
use Illuminate\Support\Facades\DB;

class OldTestimonialController extends Controller
{
    public function create(){

    	return view('old-testimonials.ajax.create')->render();
    }




    public function store(Request $request){
    	extract($request->all());

    	$image = $request->file('image');
    	$imageName = time().'.'.$image->extension();

    	if($image->storeAs(Testimonial::imageUploadPath,$imageName)):

	    	$insert = [
	    		'name' => $name,
                'admission_no' => $admission_no,
	    		'areas_good_at' => $areas_good_at,
	    		'session_admitted' => $session_admitted,
	    		'session_graduated' => $session_graduated,
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



    public function show(){
    	$testimonials = Testimonial::all()->sortByDesc('id');
    	$x=1;
    	return view('old-testimonials.show',compact('testimonials','x'));
    }


    public function edit($id){
    	$testimonial = Testimonial::find($id);

    	return view('old-testimonials.ajax.edit',compact('testimonial'))->render();
    }



    public function print($id){
        $student = Testimonial::find($id);
        return view('old-testimonials.print2',compact('student'));
    }


    public function update(Request $request){
    	extract($request->all());


    	$testimonial = Testimonial::find($id);


    	$insert = [
	    		'name' => $name,
                'admission_no' => $admission_no,
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
