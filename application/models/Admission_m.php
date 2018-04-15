<?php
class Admission_m extends CI_Model {

	public function get_session_list() {

		$get_session = $this->db->select('*')->from('session_list')->order_by('id', 'DESC')->get();
		$session_list = $get_session->result();
		return $session_list;
		
	}
}

?>