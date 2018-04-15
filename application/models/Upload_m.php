<?php
class Upload_m extends CI_Model {

	public function upload_score () {

		$DB2 = $this->load->database('remote_db', TRUE);
		$query = $this->db->select('*')->from('total_score')->where('session_names', '2016/2017')->limit(100)->get();
		$results = $query->result();
		foreach ($results as $result1)
		{
	 	// $id = $result->id;
	 	// $student_id = $result->student_id;
	 	// $total_score = $result->total_score;
	 	// $average_score = $result->average_score;
	 	// $position = $result->position;
	 	// $level_name = $result->level_name;
	 	// $class_arm = $result->class_arm;
	 	// $session_names = $result->session_names;
	 	// $term_name = $result->term_name;

        $data = array(
		 	'id' => $result1->id,
		 	'student_id' => $result1->student_id,
		 	'total_score' => $result1->total_score,
		 	'average_score' => $result1->average_score,
		 	'position' => $result1->position,
		 	'level_name' => $result1->level_name,
		 	'class_arm'=> $result1->class_arm,
		 	'session_names' => $result1->session_names,
		 	'term_name' => $result1->term_name,
        );

        $insert = $DB2->insert('total_score', $data);
	 	}
	 	
		//return $results;
	}

	

}

?>