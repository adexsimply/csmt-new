<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Students extends Base_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index ()
	{		
		$this->load->model('admissions_m');
		$this->data['title'] = 'Admissions';
		$this->data['session_list'] = $this->admissions_m->get_session_list();
		$this->data['term_list'] = $this->admissions_m->get_term_list();
		$this->data['level_list'] = $this->admissions_m->get_level_list();
		$this->data['club_lists'] = $this->admissions_m->get_club_list();
		$this->data['category_list'] = $this->admissions_m->get_category_list();
		$this->data['arm_list'] = $this->admissions_m->get_arm_list();
		$this->data['class_lists'] = $this->admissions_m->get_class_list();
		$this->data['level_group_lists'] = $this->admissions_m->get_level_group_list();
		//$this->data['childview'] = 'dashboard/main';
		$this->load->view('admissions/main', $this->data);
	}
	//Isolating term view
	public function term ()
	{		
		$this->load->model('admissions_m');
		$this->data['title'] = 'Term';
		$this->data['session_list'] = $this->admissions_m->get_session_list();
		$this->data['term_list'] = $this->admissions_m->get_term_list();
		//$this->data['childview'] = 'dashboard/main';
		$this->load->view('admissions/term', $this->data);
	}

	public function validate_session_name()
	{
		$rules = [
			[
				'field' => 'sess_name',
				'label' => 'Session Name',
				'rules' => 'trim|required|is_unique[session_list.sess_name]'
			]
		];

		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run()) {
			header("Content-type:application/json");
			echo json_encode('success');
		} else {
			header("Content-type:application/json");
			echo json_encode($this->form_validation->get_all_errors());
		}

	}


	public function add_session_name()
        {                

        	$this->load->model('admissions_m');
        	$this->admissions_m->create_session_name();

			header('Content-Type: application/json');
	    	echo json_encode('success');
        }


	public function delete_sess()
	{
		$id = $this->input->post('id');
		$this->db->delete('session_list', array('id' => $id));
	}
	public function activate_sess()
	{
		$this->db->set('session_status', '0');
		$this->db->update('session_list');
		$this->db->set('session_status', '1');
		$this->db->where('id', $this->input->post('id'));
		$this->db->update('session_list');
	}

	public function get_session_details() {

        $this->load->model('admissions_m');
        $session_list = $this->admissions_m->get_session_by_id();
		echo "[".json_encode($session_list)."]";		 
	}

	public function validate_term_name()
	{
		$rules = [
			[
				'field' => 'term_name',
				'label' => 'Term Name',
				'rules' => 'trim|required|is_unique[term_list.term_name]'
			]
		];

		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run()) {
			header("Content-type:application/json");
			echo json_encode('success');
		} else {
			header("Content-type:application/json");
			echo json_encode($this->form_validation->get_all_errors());
		}

	}

	public function add_term_name()
        {                

        	$this->load->model('admissions_m');
        	$this->admissions_m->create_term_name();

			header('Content-Type: application/json');
	    	echo json_encode('success');
        }


	public function delete_term()
	{
		$id = $this->input->post('id');
		$this->db->delete('term_list', array('id' => $id));
	}
	public function activate_term()
	{
		$this->db->set('term_status', '0');
		$this->db->update('term_list');
		$this->db->set('term_status', '1');
		$this->db->where('id', $this->input->post('id'));
		$this->db->update('term_list');
	}

	public function get_term_details() {

        $this->load->model('admissions_m');
        $term_list = $this->admissions_m->get_term_by_id();
		echo "[".json_encode($term_list)."]";		 
	}


public function validate_level_name()
	{
		$rules = [
			[
				'field' => 'level_name',
				'label' => 'Level Name',
				'rules' => 'trim|required|is_unique[level_list.level_name]'
			],
			[
				'field' => 'level_rank',
				'label' => 'Level Rank',
				'rules' => 'trim|required|is_unique[level_list.level_rank]'
			]
		];

		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run()) {
			header("Content-type:application/json");
			echo json_encode('success');
		} else {
			header("Content-type:application/json");
			echo json_encode($this->form_validation->get_all_errors());
		}

	}

	public function add_level_name()
        {                

        	$this->load->model('admissions_m');
        	$this->admissions_m->create_level_name();

			header('Content-Type: application/json');
	    	echo json_encode('success');
        }


	public function delete_level()
	{
		$id = $this->input->post('id');
		$this->db->delete('level_list', array('id' => $id));
	}

	public function get_level_details() {

        $this->load->model('admissions_m');
        $level_list = $this->admissions_m->get_level_by_id();
		echo "[".json_encode($level_list)."]";		 
	}




public function validate_category_name()
	{
		$rules = [
			[
				'field' => 'category_name',
				'label' => 'Category Name',
				'rules' => 'trim|required|is_unique[category_list.category_name]'
			]
		];

		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run()) {
			header("Content-type:application/json");
			echo json_encode('success');
		} else {
			header("Content-type:application/json");
			echo json_encode($this->form_validation->get_all_errors());
		}

	}

	public function add_category_name()
        {                

        	$this->load->model('admissions_m');
        	$this->admissions_m->create_category_name();

			header('Content-Type: application/json');
	    	echo json_encode('success');
        }


	public function delete_category()
	{
		$id = $this->input->post('id');
		$this->db->delete('category_list', array('id' => $id));
	}

	public function get_category_details() {

        $this->load->model('admissions_m');
        $category_list = $this->admissions_m->get_category_by_id();
		echo "[".json_encode($category_list)."]";		 
	}




public function validate_arm_name()
	{
		$rules = [
			[
				'field' => 'arm_name',
				'label' => 'Arm Name',
				'rules' => 'trim|required'
			],
			[
				'field' => 'level_group',
				'label' => 'Level Group',
				'rules' => 'trim|required'
			]
		];

		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run()) {
			header("Content-type:application/json");
			echo json_encode('success');
		} else {
			header("Content-type:application/json");
			echo json_encode($this->form_validation->get_all_errors());
		}

	}

	public function add_arm_name()
        {                

        	$this->load->model('admissions_m');
        	$this->admissions_m->create_arm_name();

			header('Content-Type: application/json');
	    	echo json_encode('success');
        }


	public function delete_arm()
	{
		$id = $this->input->post('id');
		$this->db->delete('arm_list', array('id' => $id));
	}

	public function get_arm_details() {

        $this->load->model('admissions_m');
        $arm_list = $this->admissions_m->get_arm_by_id();
		echo "[".json_encode($arm_list)."]";		 
	}







public function validate_club_name()
	{
		$rules = [
			[
				'field' => 'club_name',
				'label' => 'Club Name',
				'rules' => 'trim|required|is_unique[session_list.sess_name]'
			]
		];

		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run()) {
			header("Content-type:application/json");
			echo json_encode('success');
		} else {
			header("Content-type:application/json");
			echo json_encode($this->form_validation->get_all_errors());
		}

	}

	public function add_club_name()
        {                

        	$this->load->model('admissions_m');
        	$this->admissions_m->create_club_name();

			header('Content-Type: application/json');
	    	echo json_encode('success');
        }


	public function delete_club()
	{
		$id = $this->input->post('id');
		$this->db->delete('club_list', array('id' => $id));
	}

	public function get_club_details() {

        $this->load->model('admissions_m');
        $club_list = $this->admissions_m->get_club_by_id();
		echo "[".json_encode($club_list)."]";		 
	}








public function validate_class_name()
	{
		$rules = [
			[
				'field' => 'level_name',
				'label' => 'Level Name',
				'rules' => 'trim|required'
			],
			[
				'field' => 'arm_name',
				'label' => 'Arm Name',
				'rules' => 'trim|required'
			]
		];

		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run()) {
			header("Content-type:application/json");
			echo json_encode('success');
		} else {
			header("Content-type:application/json");
			echo json_encode($this->form_validation->get_all_errors());
		}

	}

	public function add_class_name()
        {                

        	$this->load->model('admissions_m');
        	$this->admissions_m->create_class_name();

			header('Content-Type: application/json');
	    	echo json_encode('success');
        }


	public function delete_class()
	{
		$id = $this->input->post('id');
		$this->db->delete('class_list', array('id' => $id));
	}

	public function get_class_details() {

        $this->load->model('admissions_m');
        $class_list = $this->admissions_m->get_class_by_id();
		echo "[".json_encode($class_list)."]";		 
	}



}
