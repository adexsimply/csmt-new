<?php
class Auth extends CI_Controller {

	//////

	public function login()
	{
		$data['title'] = 'Login';
		$this->load->view('login', $data);
	}
	//////////////
	public function login_attempt()
	{
		$rules = [
			[
				'field' => 'username',
				'label' => 'Username',
				'rules' => 'required'
			],
			[
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'required'
			]
		];

		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run()) {
			$this->load->model('user_m');
			$attempt = $this->user_m->attempt($this->input->post());
			if ($attempt === null) {
				header("Content-type:application/json");
				echo json_encode(['password' => 'Wrong username or password']);
			} else {
				$this->session->set_userdata('active_user', $attempt);
				header("Content-type:application/json");
				echo json_encode(['status' => 'success']);
			}
		} else {
			header("Content-type:application/json");
			echo json_encode($this->form_validation->get_all_errors());
		}
	}

	/**
     * Logout User
     *
     * @access 	public
     * @param 	
     * @return 	redirect
     */

	public function logout() {
		$this->session->unset_userdata('active_user');
		redirect(base_url().'auth/login');
	}

	//////
	public function upload() {
		$this->load->model('upload_m');
		$this->load->view('upload');
	}

	/////
	public function upload_score() {
		$this->load->model('upload_m');
		$this->upload_m->upload_score();
		//$this->load->view('upload', $this->data);
	}

}

?>