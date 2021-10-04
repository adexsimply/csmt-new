<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group_class;

class GroupClassController extends Controller
{
    public function index($group_id=null){

    	if(is_null($group_id))
    		/*Collect all classes*/
    		$groupClasses = Group_class::all();

    	else
    		/*Collect group classes*/
    		$groupClasses = Group_class::where('group_id',$group_id)->get();


    	return view('classes.index',compact('groupClasses'));
    }


    public function aagc(Request $request){
    	
    }
}
