<?php
$link = mysqli_connect("localhost","root","","csmt") or die("ERROR CONNECTING TO DATBASE"); 
$query_term_session =  mysqli_query($link, "SELECT * FROM session_term WHERE status='1' ");
$row_t_s = mysqli_fetch_array($query_term_session);
$ts_id = $row_t_s['id'];
$t = $row_t_s['term_id'];
$s = $row_t_s['session_id'];

$i=1;
$query = mysqli_query($link, "SELECT distinct student_id FROM assessments ORDER BY student_id ASC");
while ($row=mysqli_fetch_array($query)) {
	$student_id = $row['student_id'];
	$query_stud_cat = mysqli_query($link, "SELECT * FROM students WHERE id='$student_id' ");
	$row_stud_cat = mysqli_fetch_array($query_stud_cat);
	$stud_cat = $row_stud_cat['student_category_id'];
echo $row['student_id'].'-'.$stud_cat."<br/>";
$query_update = mysqli_query($link, "UPDATE assessments SET student_category_id='$stud_cat' WHERE student_id='$student_id' ");
$i++;

}

?>
