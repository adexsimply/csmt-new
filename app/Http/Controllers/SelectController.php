<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SelectController extends Controller
{
    public function groups(){
    	$groups=DB::table('groups')->orderBy('name','ASC')->get(['id','name']);

    	return response(compact('groups'));
    }


  public function sessions(){
    	$sessions=DB::table('sessions')->orderBy('id','DESC')->get(['id','name']);

    	return response(compact('sessions'));
    }


  public function arms(){
        $arms=DB::table('arms')->orderBy('name','ASC')->get(['id','name']);

        return response(compact('arms'));
    }



  public function fullArms($group_class_id){
    	$fullArms=DB::table('aagc_view')
                    ->whereRaw('id IN (SELECT id FROM aagc where group_class_id = '.$group_class_id.' )')
                    ->orderBy('arm','ASC')
                    ->get(['id','arm']);

    	return response(compact('fullArms'));
    }



public function session_term(){
    	$session_term=DB::table('session_term')
    					->join('sessions','sessions.id','=','session_term.session_id')
    					->join('terms','terms.id','=','session_term.term_id')
    					->select('session_term.id as id','sessions.name as session','terms.name as term')
    					->orderBy('session_term.id','DESC')
    					->get();

    	return response(compact('session_term'));
    }



  public function aliases(){
    	$aliases=DB::table('aliases')->orderBy('name','ASC')->get(['id','name']);

    	return response(compact('aliases'));
    }


  public function assessment_types(){
    	$assessment_types=DB::table('assessment_types')->orderBy('name','ASC')->get(['id','name']);

    	return response(compact('assessment_types'));
    }


  public function classes(){
    	$classes=DB::table('group_classes')->orderBy('name','ASC')->get(['id','name']);

    	return response(compact('classes'));
    }


public function subjects($sql=null){
        if(is_null($sql))
    	$subjects=DB::table('subjects')->orderBy('name','ASC')->get(['id','name']);

        
        /*If there is a query*/
        else
        $subjects=DB::table('subjects')->whereRaw($sql)->orderBy('name','ASC')->get(['id','name']);

    	return response(compact('subjects'));
    }


public function clubs(){
    	$clubs=DB::table('clubs')->orderBy('name','ASC')->get(['id','name']);

    	return response(compact('clubs'));
    }


public function grades(){
    	$grades=DB::table('grades')->orderBy('name','ASC')->get(['id','name']);

    	return response(compact('grades'));
    }


public function houses(){
    	$houses=DB::table('houses')->orderBy('colour','ASC')->get(['id','colour']);

    	return response(compact('houses'));
    }


public function lgas(Request $request){
    	$lgas = DB::table('lgas')->where('state_id',$request->state_id)->orderBy('name','ASC')->get(['id','name']);

    	return response(compact('lgas'));
    }


public function states(){
    	$states=DB::table('states')->orderBy('name','ASC')->get(['id','name']);

    	return response(compact('states'));
    }



public function student_abilities(){
    	$student_abilities=DB::table('student_abilities')->orderBy('name','ASC')->get(['id','name']);

    	return response(compact('student_abilities'));
    }



public function student_categories(){
    	$student_categories=DB::table('student_categories')->orderBy('name','ASC')->get(['id','name']);

    	return response(compact('student_categories'));
    }



public function student_posts(){
    	$student_posts=DB::table('student_posts')->orderBy('name','ASC')->get(['id','name']);

    	return response(compact('student_posts'));
    }



public function subject_schools(){
        $subject_schools=DB::table('subject_schools')->get(['id','name']);

        return response(compact('subject_schools'));
    }




public function subject_categories(){
    	$subject_categories=DB::table('subject_categories')->orderBy('name','ASC')->get(['id','name']);

    	return response(compact('subject_categories'));
    }



public function terms(){
    	$terms=DB::table('terms')->orderBy('name','ASC')->get(['id','name']);

    	return response(compact('terms'));
    }


}
