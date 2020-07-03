<?php

class UserModel extends CI_Model{
    public $user_id;
    public $user_type;
    public $username;
    public $password;
    public $email;
    public $firstname;
    public $middlename;
    public $lastname;

    private $TABLE = "user";

    public function __construct()
    {
        $this->user_id = -1;
        $this->user_type = "member";
        $this->email = "";
        $this->firstname = "";
        $this->middlename = "";
        $this->lastname = "";
        $this->username = "";
        $this->password = "";
        $this->load->database();
    }

    public function create(){
        $this->db->insert($this->TABLE, array(
            'user_type' => $this->user_type,
            'email' => $this->email,
            'username' => $this->username,
            'password' => $this->password,
            'firstname' => $this->firstname,
            'middlename' => $this->middlename,
            'lastname' => $this->lastname
        ));
    }

    public function auth(){
        $result = $this->db->get_where($this->TABLE, array(
            'username' => $this->username,
            'password' => $this->password
        ));

        $row = $result->row();

        return isset($row);

    }

    public function change(){

    }
}