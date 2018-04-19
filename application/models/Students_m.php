<?php
class Students_m extends CI_Model {

<<<<<<< HEAD
	public function get_student_list() {

		$get_students = $this->db->select('*')->from('students')->where('1=1')->get();
		$student_list = $get_students->result();
		return $student_list;
=======
	public function get_session_list() {

		$get_session = $this->db->select('s.*,u.username')->from('session_list s')->join('users as u', 's.added_by=u.id', 'left')->order_by('id', 'DESC')->get();
		$session_list = $get_session->result();
		return $session_list;
>>>>>>> 6f4e8b47c4007545fe5121bf966dc0267cd642d0
		
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

    

    ///Levels
    public function get_category_list() {

        $get_category = $this->db->select('c.*,u.username')->from('category_list c')->join('users as u', 'c.added_by=u.id', 'left')->order_by('id', 'DESC')->get();
        $category_list = $get_category->result();
        return $category_list;
    }


    public function create_category_name()
    {
        $this->load->helper('url');
        //Capture User id
        $user_id = $this->session->userdata('active_user')->id; 
        //If it's an update request(id)       
        if ($this->input->post('category_id'))
        {    
        $data_category = array(
            'category_name' => $this->input->post('category_name')
        );         
        //$query_check_rank = $this->db->select('*')->from('level_list')->where('level_rank', $this->input->post('level_rank'))->get();
        //$num_rows = $query_check_rank->num_rows();
        //if ($num_rows=='0' OR  ){
        $this->db->where('id', $this->input->post('category_id'));
        $this->db->update('category_list', $data_category); 
       // }
            
        }//End of Update
        //If it's a new request
        else {
        $data = array(
            'category_name' => $this->input->post('category_name'),
            'added_by' => $user_id
        );
        $insert = $this->db->insert('category_list', $data);
        return $insert;
        }//End of New Request
    }

    function get_category_by_id(){
        $id = $this->input->post('id');
        $get_category = $this->db->select('*')->from('category_list')->where('id', $id)->get();
        $category_list = $get_category->row();
        return $category_list;
    }


    

    ///Levels
    public function get_arm_list() {

        $get_arm = $this->db->select('a.*,u.username,g.group_name')->from('arm_list a')->join('users as u', 'a.added_by=u.id', 'left')->join('level_group_list as g', 'a.level_group=g.id', 'left')->order_by('id', 'DESC')->get();
        $arm_list = $get_arm->result();
        return $arm_list;
    }


    public function create_arm_name()
    {
        $this->load->helper('url');
        //Capture User id
        $user_id = $this->session->userdata('active_user')->id; 
        //If it's an update request(id)       
        if ($this->input->post('arm_id'))
        {    
        $data_arm = array(
            'arm_name' => $this->input->post('arm_name'),
            'alias' => $this->input->post('alias'),
            'level_group' => $this->input->post('level_group')
        );         
        //$query_check_rank = $this->db->select('*')->from('level_list')->where('level_rank', $this->input->post('level_rank'))->get();
        //$num_rows = $query_check_rank->num_rows();
        //if ($num_rows=='0' OR  ){
        $this->db->where('id', $this->input->post('arm_id'));
        $this->db->update('arm_list', $data_arm); 
       // }
            
        }//End of Update
        //If it's a new request
        else {
        $data = array(
            'arm_name' => $this->input->post('arm_name'),
            'alias' => $this->input->post('alias'),
            'level_group' => $this->input->post('level_group'),
            'added_by' => $user_id
        );
        $insert = $this->db->insert('arm_list', $data);
        return $insert;
        }//End of New Request
    }

    function get_level_group_list(){
        $get_level_group = $this->db->select('*')->from('level_group_list')->get();
        $level_group_list = $get_level_group->result();
        return $level_group_list;
    }


    function get_arm_by_id(){
        $id = $this->input->post('id');
        $get_arm = $this->db->select('a.*,g.group_name')->from('arm_list a')->join('level_group_list as g', 'a.level_group=g.id', 'left')->where('a.id', $id)->get();
        $arm_list = $get_arm->row();
        return $arm_list;
    }

    

    

    ///Levels
    public function get_club_list() {

        $get_club = $this->db->select('c.*,u.username')->from('club_list c')->join('users as u', 'c.added_by=u.id', 'left')->order_by('id', 'DESC')->get();
        $club_list = $get_club->result();
        return $club_list;
    }


    public function create_club_name()
    {
        $this->load->helper('url');
        //Capture User id
        $user_id = $this->session->userdata('active_user')->id; 
        //If it's an update request(id)       
        if ($this->input->post('club_id'))
        {    
        $data_club = array(
            'club_name' => $this->input->post('club_name')
        );         
        //$query_check_rank = $this->db->select('*')->from('level_list')->where('level_rank', $this->input->post('level_rank'))->get();
        //$num_rows = $query_check_rank->num_rows();
        //if ($num_rows=='0' OR  ){
        $this->db->where('id', $this->input->post('club_id'));
        $this->db->update('club_list', $data_club); 
       // }
            
        }//End of Update
        //If it's a new request
        else {
        $data = array(
            'club_name' => $this->input->post('club_name'),
            'added_by' => $user_id
        );
        $insert = $this->db->insert('club_list', $data);
        return $insert;
        }//End of New Request
    }


    function get_club_by_id(){
        $id = $this->input->post('id');
        $get_club = $this->db->select('*')->from('club_list')->where('id', $id)->get();
        $club_list = $get_club->row();
        return $club_list;
    }

    

    

    ///Levels
	public function get_class_list() {

        $get_class = $this->db->select('c.*,u.username,a.arm_name,l.level_name')->from('class_list c')->join('users as u', 'c.added_by=u.id', 'left')->join('level_list as l', 'c.level_id=l.id', 'left')->join('arm_list as a', 'c.arm_id=a.id', 'left')->order_by('id', 'DESC')->get();
		$class_list = $get_class->result();
		return $class_list;
	}


    public function create_class_name()
    {
        $this->load->helper('url');
        //Capture User id
        $user_id = $this->session->userdata('active_user')->id; 
        //If it's an update request(id)       
        if ($this->input->post('class_id'))
        {    
        $data_class = array(
            'level_id' => $this->input->post('level_name'),
            'arm_id' => $this->input->post('arm_name')
        );         
        //$query_check_rank = $this->db->select('*')->from('level_list')->where('level_rank', $this->input->post('level_rank'))->get();
        //$num_rows = $query_check_rank->num_rows();
        //if ($num_rows=='0' OR  ){
        $this->db->where('id', $this->input->post('class_id'));
        $this->db->update('class_list', $data_class); 
       // }
   	       	
        }//End of Update
        //If it's a new request
        else {
        $data = array(
            'level_id' => $this->input->post('level_name'),
            'arm_id' => $this->input->post('arm_name'),
            'added_by' => $user_id
        );
        $insert = $this->db->insert('class_list', $data);
        return $insert;
        }//End of New Request
    }


	function get_class_by_id(){
		$id = $this->input->post('id');
        $get_class = $this->db->select('c.*,u.username,a.arm_name,l.level_name')->from('class_list c')->join('users as u', 'c.added_by=u.id', 'left')->join('level_list as l', 'c.level_id=l.id', 'left')->join('arm_list as a', 'c.arm_id=a.id', 'left')->where('c.id', $id)->get();
		$class_list = $get_class->row();
		return $class_list;
	}

		
}

?>