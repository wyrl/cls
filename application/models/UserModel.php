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

    private $TABLE = "users";

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

    public function get(){
        $result = $this->db->get_where($this->TABLE, array(
            'user_id' => $this->user_id
        ));

        $row = $result->row();

        return $row;
    }

    public function self_retrieve(){
        $user = $this->get();

        if(isset($user)){
            $this->user_id = $user->user_id;
            $this->user_type = $user->user_type;
            $this->email = $user->email;
            $this->firstname = $user->firstname;
            $this->middlename = $user->middlename;
            $this->lastname = $user->lastname;
            $this->username = $user->username;
            $this->password = $user->password;
        }
    }

    public function update_password(){
        $this->db->update($this->TABLE, array(
            'password' => $this->password
        ), array(
            'user_id' => $this->user_id
        ));
    }

    public function auth(){
        $result = $this->db->get_where($this->TABLE, array(
            'username' => $this->username,
            'password' => $this->password
        ));

        $row = $result->row();

        if(isset($row)){
            $this->user_id = $row->user_id;
            $this->user_type = $row->user_type;
            $this->email = $row->email;
            $this->firstname = $row->firstname;
            $this->middilename = $row->middlename;
            $this->lastname = $row->lastname;

            return true;
        }

        return false;
    }

    public function getByEmail(){
        $result = $this->db->get_where($this->TABLE, array(
            'email' => $this->email
        ));

        return $result->row();
    }

    public function is_email_exists(){
        $a = $this->getByEmail();
        return isset($a);
    }

    public function change(){

    }
}