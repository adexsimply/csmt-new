<?php
$link = mysqli_connect("localhost","root","","csmt") or die("ERROR CONNECTING TO DATBASE"); 
$query_term_session =  mysqli_query($link, "SELECT * FROM session_term WHERE status='1' ");
$row_t_s = mysqli_fetch_array($query_term_session);
$ts_id = $row_t_s['id'];
$t = $row_t_s['term_id'];
$s = $row_t_s['session_id'];

$i=1;
$query_get_students = mysqli_query($link, "SELECT distinct student_id FROM aagc_session_student ORDER BY student_id ASC");
while ($row_get_students=mysqli_fetch_array($query_get_students)) {
	$student_id = $row_get_students['student_id'];

	$query_stud_cat = mysqli_query($link, "SELECT * FROM aagc_session_student WHERE student_id='$student_id' ");
	$row_stud_cat = mysqli_fetch_array($query_stud_cat);
	$teacher = $row_stud_cat['teacher_comment'];
	$hostel = $row_stud_cat['hostel_comment'];
	$principal = $row_stud_cat['principal_comment'];
echo $row_get_students['student_id'].'-'.$teacher.'-'.$principal.'-'.$hostel."<br/>";
$query_update = mysqli_query($link, "UPDATE comments SET teacher_comment='$teacher',principal_comment='$principal',hostel_comment='$hostel' WHERE student_id='$student_id' ");
$i++;

}

?>
