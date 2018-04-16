<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admissions extends Base_Controller {

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
				'rules' => 'required'
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
				'rules' => 'required'
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
				'label' => 'Term Name',
				'rules' => 'required'
			],
			[
				'field' => 'level_rank',
				'label' => 'Level Rank',
				'rules' => 'required'
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



}
