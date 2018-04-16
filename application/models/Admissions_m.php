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

    public function get_term_list() {

        $get_term = $this->db->select('t.*,u.username')->from('term_list t')->join('users as u', 't.added_by=u.id', 'left')->order_by('id', 'DESC')->get();
        $term_list = $get_term->result();
        return $term_list;
    }


    public function create_term_name()
    {
        $this->load->helper('url');

        $user_id = $this->session->userdata('active_user')->id;        
        if ($this->input->post('term_id'))
        {           
        $this->db->set('term_name', $this->input->post('term_name'));
        $this->db->where('id', $this->input->post('term_id'));
        $this->db->update('term_list');         
        }
        else {
        $data = array(
            'term_name' => $this->input->post('term_name'),
            'added_by' => $user_id
        );
        $insert = $this->db->insert('term_list', $data);

        return $insert;
        }
    }

    function get_term_by_id(){
        $id = $this->input->post('id');
        $get_term = $this->db->select('*')->from('term_list')->where('id', $id)->get();
        $term_list = $get_term->row();
        return $term_list;
    }

    ///Levels
	public function get_level_list() {

		$get_level = $this->db->select('l.*,u.username')->from('level_list l')->join('users as u', 'l.added_by=u.id', 'left')->order_by('id', 'DESC')->get();
		$level_list = $get_level->result();
		return $level_list;
	}


    public function create_level_name()
    {
        $this->load->helper('url');
        //Capture User id
        $user_id = $this->session->userdata('active_user')->id; 
        //If it's an update request(id)       
        if ($this->input->post('level_id'))
        {    
        $data_level = array(
            'level_name' => $this->input->post('level_name'),
            'level_rank' => $this->input->post('level_rank')
        );         
        //$query_check_rank = $this->db->select('*')->from('level_list')->where('level_rank', $this->input->post('level_rank'))->get();
        //$num_rows = $query_check_rank->num_rows();
        //if ($num_rows=='0' OR  ){
        $this->db->where('id', $this->input->post('level_id'));
        $this->db->update('level_list', $data_level); 
       // }
   	       	
        }//End of Update
        //If it's a new request
        else {
        $data = array(
            'level_name' => $this->input->post('level_name'),
            'level_rank' => $this->input->post('level_rank'),
            'added_by' => $user_id
        );
        $query_check_rank = $this->db->select('*')->from('level_list')->where('level_rank', $this->input->post('level_rank'))->get();
        $num_rows = $query_check_rank->num_rows();
        if ($num_rows=='0'){
        $insert = $this->db->insert('level_list', $data);
        }

        return $insert;
        }//End of New Request
    }

	function get_level_by_id(){
		$id = $this->input->post('id');
		$get_level = $this->db->select('*')->from('level_list')->where('id', $id)->get();
		$level_list = $get_level->row();
		return $level_list;
	}

		
}

?>