<?php if ($pin=='Shina') {
	echo $student_id;
} 
else {
	echo "Dear Parent/Guardian, kindly visit www.csmtschools.com.ng/portal to check your child's 1st term result. Use the details provided below for validation. Hard copies of the result sheet are available on request and payment in the school. Thank you. 
<br/>
PIN: ".$pin.
"<br/>
Username: ". $student_id.

"<br/>
Signed: MGT CSMT SCHOOLS";
}
?>