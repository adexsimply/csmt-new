<?php
class submit_ctrl extends CI_Controller {
function __construct() {
parent::__construct();
$this->load->model('submit_model');
}
function index(){
$this->load->library('form_validation'); // Including Validation Library.
$this->form_validation->set_error_delimiters('<div class="error">', '</div>'); // Displaying Errors in Div
$this->form_validation->set_rules('dname', 'Username', 'required|min_length[5]|max_length[15]'); // Validation for Name Field
$this->form_validation->set_rules('demail', 'Email', 'required|valid_email'); // Validation for E-mail field.
$this->form_validation->set_rules('dmobile', 'Contact No.', 'required|regex_match[/^[0-9]{10}$/]'); // Validation for Contact Field.
$this->form_validation->set_rules('daddress', 'Address', 'required|min_length[10]|max_length[50]'); // Validation for Address Field.
if ($this->form_validation->run() == FALSE) {
$this->load->view('submit_view');
}else {
// Initializing database table columns.
$data = array(
'employee_name' => $this->input->post('dname'),
'employee_email' => $this->input->post('demail'),
'employee_contact' => $this->input->post('dmobile'),
'employee_address' => $this->input->post('daddress')
);
$this->submit_model->form_insert($data); // Calling Insert Model and its function.
//echo "<script>alert('Form Submitted Successfully....!!!! ');</script>";
$this->load->view('submit_view'); // Reloading after submit.
}
}
}
?>