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

        $contact->insert();

        header('Content-Type: application/json');

        echo json_encode(array(
            'is_success' => true,
            'result' => $contact
        ));
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
}