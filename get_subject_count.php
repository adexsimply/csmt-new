<?php
$link = mysqli_connect("localhost","root","","csmt") or die("ERROR CONNECTING TO DATBASE"); 
$query_term_session =  mysqli_query($link, "SELECT * FROM session_term WHERE status='1' ");
$row_t_s = mysqli_fetch_array($query_term_session);
$ts_id = $row_t_s['id'];
$t = $row_t_s['term_id'];
$s = $row_t_s['session_id'];

$i=1;
$get_students = mysqli_query($link, "SELECT * FROM aagc_session_student WHERE session_id='$s' AND aagc_id='1' ");
while ($row_students=mysqli_fetch_array($get_students)) {
	$student_id = $row_students['student_id'];
	echo $student_id."-";
$query_get_subjects = mysqli_query($link, "SELECT * FROM assessments WHERE student_id='$student_id' ");
{
	$subject_count = mysqli_num_rows($query_get_subjects);
	echo $subject_count."<br/>";
	while ($row_get_subjects=mysqli_fetch_array($query_get_subjects)) {

	}
}

}

?>
