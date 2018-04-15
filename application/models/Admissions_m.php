<?php
class Admissions_m extends CI_Model {

	public function get_session_list() {

		$get_session = $this->db->select('s.*,u.username')->from('session_list s')->join('users as u', 's.added_by=u.id', 'left')->order_by('id', 'DESC')->get();
		$session_list = $get_session->result();
		return $session_list;
		
	}


    public function create_session_name()
    {
        $this->load->helper('url');

        $user_id = $this->session->userdata('active_user')->id;        
        if ($this->input->post('sess_id'))
        {        	
		$this->db->set('sess_name', $this->input->post('sess_name'));
		$this->db->where('id', $this->input->post('sess_id'));
		$this->db->update('session_list');        	
        }
        else {
        $data = array(
            'sess_name' => $this->input->post('sess_name'),
            'added_by' => $user_id
        );
        $insert = $this->db->insert('session_list', $data);

        return $insert;
        }
    }

	function get_session_by_id(){
		$id = $this->input->post('id');
		$get_session = $this->db->select('*')->from('session_list')->where('id', $id)->get();
		$session_list = $get_session->row();
		return $session_list;
	}
}

?>