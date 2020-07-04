<?php
class ContactModel extends CI_Model{
    public $id;
    public $user_id;
    public $contact;
    public $email;
    public $firstname;
    public $middlename;
    public $lastname;
    private $TABLE = "contacts";
    public function __construct()
    {
        $this->id = -1;
        $this->user_id = -1;
        $this->contact = "";
        $this->email = "";
        $this->firstname = "";
        $this->middlename = "";
        $this->lastname = "";
        $this->load->database();
    }

    public function insert(){
        $this->db->insert($this->TABLE, array(
            'user_id' => $this->user_id,
            'email' => $this->email,
            'contact_number' => $this->contact,
            'firstname' => $this->firstname,
            'middlename' => $this->middlename,
            'lastname' => $this->lastname
        ));

        $this->id = $this->last_id();
    }

    private function last_id(){
        $result = $this->db->query("SELECT LAST_INSERT_ID()");

        $row = $result->row_array();
        return $row['LAST_INSERT_ID()'];
    }

    public function update(){
        $this->db->update($this->TABLE, array(
            'contact_number' => $this->contact,
            'email' => $this->email,
            'firstname' => $this->firstname,
            'middlename' => $this->middlename,
            'lastname' => $this->lastname
        ), array(
            'id' => $this->id
        ));
    }

    public function delete(){
        $this->db->delete($this->TABLE, array(
            'id' => $this->id
        ));
    }

    public function get_list($s, $page, $limit){
        $this->db->or_like('contact_number', $s);
        $this->db->or_like('firstname', $s);
        $this->db->or_like('lastname', $s);
        $query = $this->db->get($this->TABLE, $limit, ($page - 1) * $limit);

        return $query->result(); 
    }

    public function count(){
        $this->db->select("count(id) as count");
        $query = $this->db->get($this->TABLE);
        
        return $query->row()->count;
    }
}