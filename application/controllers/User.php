<?php

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->database();
        $this->load->library('form_validation');
        $this->load->library('session');

        $this->load->model("UserModel");
        $this->load->model('PasswordReset');
    }


    public function register()
    {
        $this->form_validation->set_rules(
            'username',
            'Username',
            'required|min_length[5]|max_length[12]|is_unique[users.username]',
            array(
                'is_unique'     => 'This %s already exists.'
            )
        );
        $this->form_validation->set_rules('firstname', 'Firstname', 'required');
        $this->form_validation->set_rules('lastname', 'Lastname', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('c-password', 'Confirm Password', 'required|matches[password]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('template/header');
            $this->load->view('user/register');
            $this->load->view('template/footer');
        } else {
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
        $data = array(
            'is_success' => true,
        );

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run()) {
            $this->UserModel->username = $this->input->post('username');
            $this->UserModel->password = $this->input->post('password');

            if (!$this->UserModel->auth()) {
                $data['is_success'] = false;
            } else {
                $this->session->set_userdata(array(
                    'user_id' => $this->UserModel->user_id,
                    'logged_in' => true
                ));
                redirect('/');
            }
        } else {
            if (logged_in()) {
                redirect('/');
            }
        }

        $this->load->view('template/header');
        $this->load->view('user/login', $data);
        $this->load->view('template/footer');
    }

    public function logout()
    {
        if ($this->session->has_userdata('logged_in')) {
            $this->session->logged_in = false;
            $this->session->user_id = -1;
            redirect('user/login');
        }
    }

    public function forgot()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_is_email_exists');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('template/header');
            $this->load->view('user/forgot');
            $this->load->view('template/footer');
        } else {
            $this->UserModel->email = $this->input->post('email');

            $user = $this->UserModel->getByEmail();

            $this->PasswordReset->user_id = $user->user_id;

            $pr = $this->PasswordReset->createKey();

            $this->send_email($pr, $user);

            $this->load->view('template/header');
            $this->load->view('user/check_email');
            $this->load->view('template/footer');
        }
    }

    private function send_email($pr, $user)
    {
        $url = site_url("user/reset_password?user_id=$pr->user_id&recover_key=$pr->recover_key");


        $to      = $this->UserModel->email;
        $subject = 'Contact List';
        $message = "<html>
                        <head>
                            <title>Reset you password</title>
                        </head>

                        <body>
                            <h1>Your username: $user->username . Click this link <a href='$url'>$url</a>.</h1>
                        </body>
                    </html>
        
        ";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        $headers .= 'From: <nobody@example.com>' . "\r\n";
        $headers .= 'Cc: ' . "\r\n";

        if (mail($to, $subject, $message, $headers)) {
            return true;
        }

        return false;
    }

    public function reset_password()
    {
        $this->PasswordReset->user_id = $this->input->get('user_id');
        $this->PasswordReset->recover_key = $this->input->get('recover_key');

        $this->UserModel->user_id = $this->input->get('user_id');
        //$user = $this->UserModel->get();

        if ($this->PasswordReset->is_exists()) {
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('c-password', 'Confirm Password', 'required|matches[password]');

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('template/header');
                $this->load->view('user/reset_password_form');
                $this->load->view('template/footer');
            }
            else{
                $this->UserModel->self_retrieve();
                $this->UserModel->password = $this->input->post('password'); 
                $this->UserModel->update_password();

                $this->load->view('template/header');
                $this->load->view('user/success', array('title' => 'Reset Password'));
                $this->load->view('template/footer');
            }
        } else {
            echo "Expire";
        }
    }

    public function is_email_exists($str)
    {
        $this->UserModel->email = $str;

        if (!$this->UserModel->is_email_exists()) {
            $this->form_validation->set_message('is_email_exists', 'This email must be exists.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function test()
    {
        $this->load->view('template/header');
        $this->load->view('user/success');
        $this->load->view('template/footer');
    }
}
