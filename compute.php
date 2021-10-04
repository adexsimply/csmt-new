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
$get_aagc = mysqli_query($link, "SELECT * FROM aagc_session_student WHERE session_id='$s' AND student_id='$student_id' ");
$row_aagc = mysqli_fetch_array($get_aagc);
$aagc_id = $row_aagc['aagc_id'];
	//echo $row['student_id'].'-'.$aagc_id."<br/>";
	$get_scores = mysqli_query($link, "SELECT * FROM assessments WHERE student_id='$student_id' AND aagc_id='$aagc_id' AND session_id='$s' AND term_id='$t' ");
	$subject_total_overall = 0;
	while ($row_scores = mysqli_fetch_array($get_scores)) {
		$subject_total = $row_scores['test1'] + $row_scores['test2'] + $row_scores['test3'] + $row_scores['micro_exam'] + $row_scores['exam'];
		//echo '('.$i.')'.$student_id.'=>'.$row_scores['subject_id'].'%'.$row_scores['test1'].'-'.$row_scores['test2'].'-'.$row_scores['test3'].'-'.$row_scores['micro_exam'].'-'.$row_scores['exam'].' Total:'.$subject_total."<br/>";
		$subject_total_overall += $subject_total;
	}
	//echo $subject_total_overall;
	$check_db = mysqli_query($link, "SELECT * FROM cummulative_assessements2 WHERE student_id='$student_id' AND aagc_id='$aagc_id' AND session_id='$s' AND term_id='$t' ");
	if (mysqli_num_rows($check_db)==0) {

	$query_insert = mysqli_query($link, "INSERT INTO cummulative_assessements2(score,student_id,aagc_id,session_id,term_id) VALUES ('$subject_total_overall','$student_id','$aagc_id','$s','$t')");
	}
	///Update if exists
	else {
		$query_insert = mysqli_query($link, "UPDATE cummulative_assessements2 SET score='$subject_total_overall' WHERE student_id='$student_id' AND aagc_id='$aagc_id' AND session_id='$s' AND term_id='$t'");
	}
$i++;

}
$query_get_scores = mysqli_query($link, "SELECT * FROM cummulative_assessements2 where session_id=1 AND term_id=1 AND aagc_id=7 ORDER BY score ASC ");
while ($row_get_scores=mysqli_fetch_array($query_get_scores)) {
	echo $row_get_scores['student_id'].'-'.$row_get_scores['score']."<br/>";
}
?>