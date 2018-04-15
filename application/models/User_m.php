<?php

class User_m extends CI_Model {   

    function __construct()
    {
        parent::__construct();
       // $this->load->library('datagrid');
    }

    /**
     * Datagrid Data
     *
     * @access  public
     * @param   
     * @return  json(array)
     */

    public function all()
    {
      $users = $this->db->get('users')->result();
    return $users;
    } 

    public function attempt($input)
    {
      $query = $this->db->from('users u')
              ->select('u.*, g.role_name')
              ->where('username', $input['username'])
              ->where('password', $input['password'])
              ->join('roles as g', 'g.id = u.id', 'left')
              ->get();

      return $query->row();
    }

    //////////Add New User

    public function add_staff()
    {
        $this->load->helper('url'); 

        $data = array(
            'full_name' => $this->input->post('fullname'),
            'email' => $this->input->post('email'),
            'role_id' => $this->input->post('role_id'),
            'phone' => $this->input->post('phone'),
            'password' => "123456",
            'address_line' => $this->input->post('address1'),
            'address_line2' => $this->input->post('address2')
        );
        $insert = $this->db->insert('users', $data);
        return $insert;
    }
    //////////////////////////
    public function getJson()
    {
        ////////////Get Group id
        // $user_id = $this->session->userdata('active_user')->id;
        // $query1 = $this->db->select('*')->from('users')->where('id',$user_id)->get();
        // $row1 = $query1->row();
        // $group_id = $row1->group_id;
       //  //////////////////////////////////
       //  $table  = 'datalicious as a';
       //  $select = 'a.*';
       // // $where = '(user, 1)';

       //  $replace_field  = [
       //      ['old_name' => 'CompanyAgent', 'new_name' => 'a.CompanyAgent']
       //  ];

       //  $param = [
       //      'input'     => $input,
       //      'select'    => $select,
       //      'table'     => $table,
       //      'replace_field' => $replace_field
       //  ];
      $this->db->select('*'); // <-- There is never any reason to write this line!
      $this->db->from('roles');
      $this->db->join('users', 'users.role_id = roles.id');
       $query = $this->db->get(); ; 
       $row = $query->result();
       return $row;

    }

    public function edit_profile()
    {
        $this->load->helper('url');
        $user_id = $this->session->userdata('active_user')->id;
        $data = array(
            'full_name' => $this->input->post('first_name')." ".$this->input->post('last_name'),
            'email' => $this->input->post('email'),
            'password' => $this->input->post('password'),
            'about_me' => $this->input->post('about_me')
        );
        $this->db->where('id', $user_id);
        $this->db->update('users', $data);
        redirect('profile');
    }

}