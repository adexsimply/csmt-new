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
		$this->load->model('students_m');	
		///Admission Model	
		$this->load->model('admissions_m');
		$this->data['session_list'] = $this->admissions_m->get_session_list();
		$this->data['term_list'] = $this->admissions_m->get_term_list();
		$this->data['level_list'] = $this->admissions_m->get_level_list();
		$this->data['club_lists'] = $this->admissions_m->get_club_list();
		//////////////////Ends

		$this->data['title'] = 'Students';
		$this->data['student_lists'] = $this->students_m->get_student_list();
		$this->data['group_lists'] = $this->students_m->get_group_list();
		//$this->data['childview'] = 'dashboard/main';
		$this->load->view('students/main', $this->data);
	}

	public function get_class_list() {

        $this->load->model('students_m');
        $class_list = $this->students_m->get_class_by_group();
		echo json_encode($class_list);		 
	}


	public function get_student_details() {

        $this->load->model('students_m');
        $student_details = $this->students_m->get_student_by_id();
		echo "[".json_encode($student_details)."]";		 
	}

	public function validate_student_name()
	{
		$rules = [
			[
				'field' => 'student_id',
				'label' => 'Student ID',
				'rules' => 'trim|required'
			],
			[
				'field' => 'surname',
				'label' => 'Surname',
				'rules' => 'trim|required'
			],
			[
				'field' => 'other_names',
				'label' => 'Other Names',
				'rules' => 'trim|required'
			],
			[
				'field' => 'dob',
				'label' => 'Date of Birth',
				'rules' => 'trim|required'
			],
			[
				'field' => 'gender',
				'label' => 'Gender',
				'rules' => 'trim|required'
			],
			[
				'field' => 'student_address',
				'label' => 'Student Address',
				'rules' => 'trim|required'
			],
			[
				'field' => 'parent_fullname',
				'label' => 'Parents Name',
				'rules' => 'trim|required'
			],
			[
				'field' => 'state',
				'label' => 'State of Origin',
				'rules' => 'trim|required'
			],
			[
				'field' => 'lga',
				'label' => 'LGA',
				'rules' => 'trim|required'
			],
			[
				'field' => 'relationship',
				'label' => 'Relationship',
				'rules' => 'trim|required'
			],
			[
				'field' => 'phone',
				'label' => 'Phone Number',
				'rules' => 'trim|required'
			],
			[
				'field' => 'club',
				'label' => 'Club',
				'rules' => 'trim|required'
			],
			[
				'field' => 'house',
				'label' => 'House',
				'rules' => 'trim|required'
			],
			[
				'field' => 'sess_name',
				'label' => 'Session Name',
				'rules' => 'trim|required'
			],
			[
				'field' => 'class_category',
				'label' => 'Class Category',
				'rules' => 'trim|required'
			],
			[
				'field' => 'class_name',
				'label' => 'Class Name',
				'rules' => 'trim|required'
			],
			[
				'field' => 'student_category',
				'label' => 'Student Category',
				'rules' => 'trim|required'
			],
			[
				'field' => 'health_challenge',
				'label' => 'Health Challenge',
				'rules' => 'trim|required'
			],
			[
				'field' => 'blood_group',
				'label' => 'Blood Group',
				'rules' => 'trim|required'
			],
			[
				'field' => 'genotype',
				'label' => 'Genotype',
				'rules' => 'trim|required'
			],
			[
				'field' => 'emergency',
				'label' => 'Emergency',
				'rules' => 'trim|required'
			],
			[
				'field' => 'immunize',
				'label' => 'Immunize',
				'rules' => 'trim|required'
			],
			[
				'field' => 'lab_tests',
				'label' => 'Lab Test',
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


	public function add_student_name()
        {                

        	$this->load->model('students_m');
        	$this->students_m->create_student();

			header('Content-Type: application/json');
	    	echo json_encode('success');
        }


	public function delete_student()
	{
		$id = $this->input->post('id');
		$this->db->delete('students', array('id' => $id));
	}
































	
}
