<?php

class User extends CI_Model{
    public $user_id;
    public $user_type;
    public $username;
    public $password;
    public $email;
    public $firstname;
    public $middlename;
    public $lastname;

    private $TABLE = "User";

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
    }

    public function create(){
        $this->db->insert($this->TABLE, array(
            $this->user_type,
            $this->email,
            $this->username,
            $this->password,
            $this->firstname,
            $this->middlename,
            $this->lastname
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