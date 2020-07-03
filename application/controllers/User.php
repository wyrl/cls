<?php

class User extends CI_Controller
{
    
    public function register()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        
        //echo $this->input->post("username");
        $this->form_validation->set_rules(
            'username', 
            'Username',
            'required|min_length[5]|max_length[12]|is_unique[user.email]',
                array(
                        'is_unique'     => 'This %s already exists.'
                )
        );
        $this->form_validation->set_rules('firstname', 'Firstname', 'required');
        $this->form_validation->set_rules('lastname', 'Lastname', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('c-password', 'Confirm Password', 'required|matches[password]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('template/header');
            $this->load->view('user/register');
            $this->load->view('template/footer');
        }
        else{
            $this->load->model("UserModel");
            $this->UserModel->firstname = $this->input->post("firstname");
            $this->UserModel->lastname = $this->input->post("lastname");
            $this->UserModel->email = $this->input->post("email");
            $this->UserModel->username = $this->input->post("username");
            $this->UserModel->password = $this->input->post("password");
            
            $this->UserModel->create();
        }
    }

    public function login()
    {
        
    }

    public function forgot()
    {
    }
    
    public function test(){
        $this->load->database();
    }
}