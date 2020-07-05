<?php
class Contact extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('ContactModel');

        if(!logged_in())
            die("logged out");
    }


    public function get($id){

    }

    public function create(){
        

        $this->load->helper(array('form'));
        $this->load->library('session');

        $contact = $this->ContactModel;
        $input = $this->input;

        $contact->user_id = $this->session->user_id;
        $contact->contact = $input->post('contact');
        $contact->email = $input->post('email');
        $contact->firstname = $input->post('firstname');
        $contact->lastname = $input->post('lastname');

        header('Content-Type: application/json');

        if($this->send_email($contact->email)){
            $contact->insert();

            echo json_encode(array(
                'is_success' => true,
                'error_msg' => '',
                'contact' => $contact
            ));
            exit;
        }
        
        echo json_encode(array(
            'is_success' => false,
            'error_msg' => 'Email sending failed'
        ));
    }

    private function send_email($email){
        $to      = $email;
        $subject = 'Contact List';
        $message = "<html>
                        <head>
                            <title>Contact List</title>
                        </head>

                        <body>
                            <h1>We added you in our contact list. Thank you.</h1>
                        </body>
                    </html>
        
        ";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        $headers .= 'From: <nobody@example.com>' . "\r\n";
        $headers .= 'Cc: ' . "\r\n";

        if(mail($to, $subject, $message, $headers)){
            return true;
        }

        return false;
    }

    public function update($id){
        header('Content-Type: application/json');

        $contact = $this->ContactModel;

        $contact->id = $id;
        $contact->contact = $this->input->post('contact');
        $contact->email = $this->input->post('email');
        $contact->firstname = $this->input->post('firstname');
        $contact->lastname = $this->input->post('lastname');

        $contact->update();

        echo json_encode(array(
            'is_success' => true
        ));
    }

    public function delete($id){
        header('Content-Type: application/json');

        $this->ContactModel->id = $id;
        $this->ContactModel->delete();

        echo json_encode(array(
            'is_success' => true
        ));
    }

    public function check_email(){
        header('Content-Type: application/json');
        
        $email = urldecode($this->input->post('email'));
        $action = $this->input->post('action');
        
        $this->ContactModel->email = $email;
        $this->ContactModel->user_id = $this->session->user_id;
        
        echo json_encode($this->ContactModel->is_email_exists() && $action == 'add' ? "This email is already exists." : true);
    }

    public function check_contact(){
        header('Content-Type: application/json');
        
        $contact = $this->input->post('contact');
        $action = $this->input->post('action');
        
        $this->ContactModel->contact = $contact;
        $this->ContactModel->user_id = $this->session->user_id;

        echo json_encode($this->ContactModel->is_contact_exists() && $action ? "This contact is already exists." : true);
    }
}