<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Aagc;
use Exception;
use App\Plugin\Addon;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;

class EmailController extends Controller
{	
	private $session_id, $term_id,$username,$apikey;
    private $table = 'sms_pin';

	function __construct(){
		$Aagc = new Aagc;
		$active = $Aagc::active();
		$this->session_id = $active->session_id;
		$this->term_id = $active->term_id;
        /*// CSMT API
        $this->username="csmtschools@gmail.com";
        $this->apikey = "b0a73a5a0d061f7966ad1551f259ef5e229b1b07";*/

        // Godson API
        $this->username="godsonoffor@rocketmail.com";
        $this->apikey = "e1e379c163f9069d68c43b0a695e8174fdd99c1c";
	}


    private function sendBulkSMS($sender="CSMT",$message,$phone){
        return [
            "SMS" => [
                "auth" => [
                    "username" => $this->username,
                    "apikey" => $this->apikey
                ],

                "message" => [
                    "sender" => $sender,
                    "messagetext" => $message,
                    "flash" => "0"
                ],

                "recipients" => [

                    "gsm" => $phone
                ],

                "dndsender" => 1

            ]
        ];
    }

    public function mail()
{
   $name = 'Shina';
   Mail::to('adetoyeshina@gmail.com')->send(new SendMailable($name));
   
   return 'Email was sent';
}



    /*Collect all generated pins*/
	public function pin(){
		$pins = DB::table($this->table)
					->join('students','sms_pin.student_id','students.id')
                    ->join('parents','parents.id','students.parent_id')
					->get(['surname','othernames','pin','admission_no','parents.phone1 as phone']);

		$pins = Addon::isEmpty($pins);

		return view('sms.pins',compact('pins'));
	}




    /*Send message to parents*/
    public function sendPinToParent(Request $request){
        
        $group_class_id = (int) $request->group_class_id;
        $category_id = (int) $request->category_id;

        $condition= array(
                            ['students.student_category_id',$category_id]);

        if($category_id > 0){
            $condition[] = ['students.student_category_id',$category_id];
        }

        $parents = DB::table('parents')
                        ->join('students','students.parent_id','parents.id')
                        ->join('sms_pin','sms_pin.student_id','students.id')
                        ->where($condition)
                        ->select('parents.email as email','sms_pin.pin','students.surname','students.othernames','students.admission_no','sms_pin.student_id')
                        ->get();

        $messages=[];

        foreach($parents as $x => $parent){
            $email_address = $parent->email;
            if (!empty($email_address)) {
           $name = 'Shina';
           $dada = 'Hello Dada';
           Mail::to($email_address)->send(new SendMailable($name,$parent->admission_no,$parent->pin));
            }

        }

        return response(['status'=>1,'message'=>' Mail Sent', 'retain'=>301]);

    }
        /*Send message to parents*/
    public function sendPinToParent1(Request $request){
        
        extract($request->all());
        $group_class_id = $request->group_class_id;
        $category_id = $request->category_id;

        $condition= array(['sms_pin.session_id',$this->session_id],
                            ['sms_pin.group_class_id',$group_class_id]);

        if($category_id > 0){
            $condition[] = ['sms_pin.student_category_id',$category_id];
        }

        $parents = DB::table('parents')
                        ->join('students','students.parent_id','parents.id')
                        ->join('sms_pin','sms_pin.student_id','students.id')
                        ->where($condition)
                        ->select('parents.phone1 as phone','sms_pin.pin','students.surname','students.othernames','students.admission_no','sms_pin.student_id')
                        ->get();

        //$messages=[];

        foreach($parents as $parent){
    $name = 'Shina';
   Mail::to('adetoyeshina@gmail.com')->send(new SendMailable($name));

            /*Message to send to parents*/
            // $mail_add = $parent->email;
            // $message = "Please use this pin ".$parent->pin." to check your ".$parent->admission_no." result";

            // if(is_null($mail_add)) {

            // }
            // else {

            // Mail::to($mail_add)->send(new SendMailable($name));
            // }

        }

        
        return response(['status'=>1,'message'=>' Mail Sent', 'retain'=>301]);

    }






    /*Send message to parents*/
    public function sendMessageToParent(Request $request){
        
        $group_class_id = (int) $request->group_class_id;
        $category_id = (int) $request->category_id;

        $condition= array(['aagc_session_student.session_id',$this->session_id],
                            ['aagc.group_class_id',$group_class_id]);

        if($category_id > 0){
            $condition[] = ['students.student_category_id',$category_id];
        }

        $parents = DB::table('parents')
                        ->join('students','students.parent_id','parents.id')
                        ->join('aagc_session_student','aagc_session_student.student_id','students.id')
                        ->join('aagc','aagc_session_student.aagc_id','aagc.id')
                        ->where($condition)
                        ->select(DB::raw('DISTINCT parents.email as email, parents.id'))
                        ->get();

        $messages=[];

        foreach($parents as $x => $parent){
            $email_address = $parent->email;
            if (!empty($email_address)) {
           $pinss = "Shina";
           $name = "Shale";
           Mail::to($email_address)->send(new SendMailable($name,$request->message,$pinss));
            }
        }

        return response(['status'=>1,'message'=>' Mail Sent', 'retain'=>301]);

    }


    /*Send message to parents*/
    public function sendMessageToOthers(Request $request){

        $parentPhones=explode(",",$request->phones);
        $phones = [];
        foreach($parentPhones as $x => $phone){
            $phones[]=[
                "msidn" => $phone,
                "msgid" => $x+1
            ];
        }

    	return response($this->sendBulkSMS($request->sender,$request->message,$phones));

    }





    /*Generate result printing pin*/
    public function generatePin(Request $request){
    	$group_class_id = (int) $request->group_class_id;
        $category_id = (int) $request->category_id;

        $condition = array(
                            ['aagc_session_student.session_id',$this->session_id],
                            ['aagc.group_class_id',$group_class_id]
                        );

        /*Seperate day students from borders*/
        if($category_id > 0)
            $condition[] = ['students.student_category_id',$category_id];
        

    	$students = DB::table('aagc_session_student')
                        ->join('aagc','aagc_session_student.aagc_id','aagc.id')
    					->join('students','students.id','aagc_session_student.student_id')
    					->where($condition)
    					->select('student_id')
    					->get();
    	
    	$insert = [];
    	foreach ($students as $key => $student) {
    		$pin = rand(1000000,9000000).$key.$student->student_id;
    		$insert[] = [
                'student_id' => $student->student_id,
    			'student_category_id' => $category_id,
    			'pin' => $pin,
    			'group_class_id' => $group_class_id,
                'session_id' => $this->session_id,
    			'created_at' => date('Y-m-d H:i:s',time())
    		];
    	}


    	try {
    		DB::transaction(function() use($insert,$group_class_id,$category_id){


                if(DB::table($this->table)->whereRaw(sprintf('group_class_id = %d AND session_id = %d AND (student_category_id = %d OR student_category_id = 0)',$group_class_id,$this->session_id,$category_id)
                            )->exists())

                    throw new Exception("Pin already generated");


                /*Delete condition*/
                $condition = array(
                                    ['group_class_id',$group_class_id],
                                    ['session_id','<>',$this->session_id]
                                );

                if($category_id > 0)
                    $condition[] = ['student_category_id',$category_id];

                /*Check previous session generated pins*/
    			if(DB::table($this->table)->where($condition)->exists())
    				DB::table($this->table)->where($condition)->delete();
                
                
                DB::table($this->table)->insert($insert);
    			
    		});
    	} catch (Exception $e) {
    		return response(['status'=>0,'message'=>$e->getMessage()]);
    	}

    	return response(['status'=>1,'message'=>'Pin generated and stored!','url'=>url('sms/pins')]);
    }



}
