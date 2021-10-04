<?php
namespace App\Plugin;
use Illuminate\Support\Facades\DB;

class Addon{


		const imageExtensions = ['png','jpg','gif','jpeg'];
		const fileExtensions = ['pdf','doc','docx','psd','csv','xlsx','xls','ppt','pptx','iso','zip','rar'];


		public static function fileName($name,$extension=null){
			if(is_null($extension)){
				return strtolower(str_ireplace(' ', '-', $name)).'-'.time();
			}

			return strtolower(str_ireplace(' ', '-', $name)).'-'.time().'.'.$extension;
			
		}


		public static function url($url=null){
			return is_null($url) ? null : strtolower(str_ireplace(' ', '-', $url));
		}



		public static function upcomingDate($date,$againt=null){
			$date =strtotime($date);
			$againt = is_null($againt) ? strtotime(date("Y-m-d")) : strtotime($againt);

			return ($date >= $againt) ? true : false;
		}



		
		/*Display Price in Naira*/
		public static function price($price=0){
			if(is_numeric($price)){
				return '&#8358;'.number_format($price);
			}
			else{
				return '-';
			}
		}


		public static function position($position){
			$fiddle = str_split($position);
			$lastDigit = end($fiddle);

			if($lastDigit==1 && $position!=11){
				$position = $position."<sup>st</su>";
			}
			
			else if($lastDigit==2 && $position!=12){
				$position = $position."<sup>nd</su>";
			}
			
			else if($lastDigit==3 && $position!=13){
				$position = $position."<sup>rd</su>";
			}
			else if ($position>=11 && $position<=20) {
				$position = $position."<sup>th</su>";
			}
			else{
				$position = $position."<sup>th</su>";
			}

			return $position;

		}


		/*Reduce text*/
		public static function limitText($text,$limit=160,$continue='....') {
		if(strlen($text) > $limit){
			$text = substr($text,0,$limit);
			return $text.$continue;
					}
					else{
			return $text;
					}
			    }
		
		/*Alias to limitText*/
		public static function readMore($text,$limit=160,$continue='....') {
			return self::limitText($text,$limit,$continue);
			    }
		



		/*Collect database table fields*/
		public static function tableFields($table){
			$fields = DB::select('SHOW FIELDS FROM '.$table);

			$result='';
			foreach ($fields as $key => $value) {
				$result.="'".$value->Field."',";
			}
			echo $result;
		}





/*Collect database table fields*/
		public static function showTableFields($table){
			return self::tableFields($table);
		}






		/*Cancel price*/
		public static function regularPrice($price=0){
			if($price > 0){
				return '<strike>&#8358;'.number_format($price).'</strike>';
			}
			else{
				return '-';
			}
		}
		


		/*Delete file without giving permssion error*/
		public static function isFile($path){

			$path = storage_path('app/'.$path);

			return is_file($path) ? true : false;
		}

		


		/*Delete file without giving permssion error*/
		public static function deleteFile($path){

			$path = storage_path('app/'.$path);

			if(is_file($path)){
				return unlink($path) ? true : false;
			}
			return false;
		}


		public static function months($monthNumber=null){
			$months = ['January','February','March','April','May','June','July','August','September','October','November','December'];

			return is_null($monthNumber) ? $months : $months[$monthNumber-1];
			
		}

		/*Authenticate object and array*/
		public static function isEmpty($value){
			return (is_object($value) || is_array($value)) && count($value) > 0 ? $value : false; 
		}


		/*Alert danger*/
		public static function alertDanger($message="Operation Failed"){

			return "<div class='alert alert-danger text-center col-lg-6 col-md-6 col-sm-6 col-xs-12 center-block clearfix'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <i class='fa fa-exclamation-circle'></i> ".$message."</div>";
		}
		

		public static function alertSuccess($message="Operation Successful!"){

			return "<div class='alert alert-success text-center col-lg-6 col-md-6 col-sm-6 col-xs-12 center-block clearfix'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <i class='fa fa-check-circle'></i> ".$message."</div>";
		}
		


	}
