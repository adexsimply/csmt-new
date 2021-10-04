<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Session;
use Illuminate\Support\Facades\DB;

class SessionController extends Controller
{
    public function index(){
    	$sessions = Session::with('terms')->orderBy('sessions.id','DESC')->paginate(10);

    	return view('sessions.index',compact('sessions'));
    }




    /*Add new session */
    public function store(Request $request){

    	$request->validate([
    		'name' => 'string|required'
    	]);


    	$name = $request->name;
    	$transaction = DB::transaction(function() use($request){

            $name = $request->name;
            $activate = $request->activate;

    		/*Insert and get session added*/
    		$id = DB::table('sessions')->insertGetId(['name'=>$name]);


            if($activate == 1){

                /*Deactivate active active session*/
                DB::table('session_term')->where('status',1)->update(['status'=>0]);


                /*Add all terms to created session and activate the first term*/
                $insert = [
                    ['session_id' => $id, 'term_id' => 1, 'status'=>1 ],
                    ['session_id' => $id, 'term_id' => 2, 'status'=>0 ],
                    ['session_id' => $id, 'term_id' => 3, 'status'=>0 ],
                ];

            }

            else{

            /*Add all terms to created session and activate the first term*/
            $insert = [
                ['session_id' => $id, 'term_id' => 1, 'status'=>0 ],
                ['session_id' => $id, 'term_id' => 2, 'status'=>0 ],
                ['session_id' => $id, 'term_id' => 3, 'status'=>0 ],
            ];

            }


            /*Create new session*/
    		DB::table('session_term')->insert($insert);

            /*Add session to all classes*/
            $aagcs = DB::table('aagc')->get(['id']);

            $insert = array();

            foreach($aagcs as $aagc){
                $insert[count($insert)] = ['aagc_id'=>$aagc->id, 'session_id'=>$id];
            }

            DB::table('aagc_session')->insert($insert);


    	});


    	if(is_null($transaction)){
    		return response(['status'=>1,'message'=>'Session created!','retain'=>301]);
    	}

    		return response(['status'=>0,'message'=>'Connection error']);

    }



    /*Collect session details for modification */
    public function edit($id){
    	$session = Session::find($id);
    	return response(compact('session'));
    }



    public function update(Request $request){
    	$request->validate([
    		'name' => 'string|required'
    	]);

    	$session = Session::find($request->id);

    	/*Update session*/
    	if($session->update($request->all()))

    		/*Session update successful */
    		return response(['status'=>1,'message'=>'Changes saved successfully!','retain'=>301]);
                
    	/*Session update failed*/
        return response(['status'=>0,'message'=>'Unable to change status']);

    }


    public function destroy(Request $request){

    	 if(Session::destroy($request->id))
              
              return response(['status'=>1,'message'=>'Status Changed']);

        return response(['status'=>0,'message'=>'Unable to change status']);
                
    }



     public function activate(Request $request){

     			$id = $request->id;

                $transaction = DB::transaction(function() use($id){
                	/*Deactivate previously activated session term*/
                	DB::table('session_term')->where('status',1)->update(['status'=>0]);

                	/*Active selected session term*/
                	DB::table('session_term')->where('id',$id)->update(['status'=>1]);

                });

                if(is_null($transaction)){
                    return response(['status'=>1,'message'=>'Status Changed']);
                }
                else{
                    return response(['status'=>0,'message'=>'Unable to change status']);
                }
          
        
    }




}
