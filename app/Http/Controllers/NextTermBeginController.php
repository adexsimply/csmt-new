<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Next_term_begin as Ntb;

class NextTermBeginController extends Controller
{
    public function store(Request $request){
    	
    	if(Ntb::create($request->all()))
    		return response(['status'=>1, 'message'=>'Next term begins created successfully', 'retain'=>301]);
    	else
    		return response(['status'=>0, 'message'=>'Connection error']);

    }



    public function destroy(Request $request){
    	if(Ntb::destroy($request->id))
    		return response(['status'=>1, 'message'=>'Operation done successfully', 'retain'=>301]);
    	else
    		return response(['status'=>0, 'message'=>'Connection error']);
    }
}
