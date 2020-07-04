<?php

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("UserModel");
    }


    public function register()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->database();
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules(
            'username', 
            'Username',
            'required|min_length[5]|max_length[12]|is_unique[user.username]',
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
            $this->UserModel->firstname = $this->input->post("firstname");
            $this->UserModel->lastname = $this->input->post("lastname");
            $this->UserModel->email = $this->input->post("email");
            $this->UserModel->username = $this->input->post("username");
            $this->UserModel->password = $this->input->post("password");
            
            $this->UserModel->create();

            $this->load->view('template/header');
            $this->load->view('user/success');
            $this->load->view('template/footer');
        }
    }

    public function login()
    {
        $this->load->helper(array('form'));
        $this->load->library('form_validation');
        $this->load->library('session');        

        $submit = $this->input->post('submit');
        $data = array(
            'is_success' => true,
        );

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run()) {
            $this->UserModel->username = $this->input->post('username');
            $this->UserModel->password = $this->input->post('password');

            if(!$this->UserModel->auth()){
                $data['is_success'] = false;
            }
            else{
                $this->session->set_userdata(array(
                    'user_id' => $this->UserModel->user_id,
                    'logged_in' => true
                ));
                redirect('/');
            }
        }
        else{
            if(logged_in()){
                redirect('/');
            }
        }

        $this->load->view('template/header');
        $this->load->view('user/login', $data);
        $this->load->view('template/footer');
        
    }

    public function forgot()
    {
        $this->load->view('template/header');
        $this->load->view('user/forgot');
        $this->load->view('template/footer');
    }
    
    public function test(){
        $this->load->view('template/header');
        $this->load->view('user/success');
        $this->load->view('template/footer');
    }
}