<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Plugin\Syncr;

class BackupController extends Controller
{
    
    public function index(){
    	$Syncr = new Syncr;

    	/*Check if tables exists*/
    	if($Syncr->hasTable('r')){
    		$Syncr->dropTable('r',false);
    	}
    	
    	if(
    		$Syncr->updateTable('r',false) &&

    		$Syncr->updateData('r',false) 
    	)
    		return response(['status'=>true]);
    	

    	return response(['status'=>false]);

    }
}
