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
		//$this->data['childview'] = 'dashboard/main';
		$this->load->view('admissions/main', $this->data);
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

	public function ajax_text() {
		//$id =12;
		$id = $this->input->post('id');
		$get_session = $this->db->select('*')->from('session_list')->where('id', $id)->get();
		$session_list = $get_session->row();
		echo "[".json_encode($session_list)."]";
		 
	}


}
