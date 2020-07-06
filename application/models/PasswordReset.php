<?
class PasswordReset extends CI_Model{
    public $user_id;
    public $recover_key;
    public $expDate;
    private $TABLE = "password_reset_temp";

    public function __construct(){
        $this->load->database();
    }

    public function createKey(){
        $this->random_key();
        $this->set_expiration(1);

        if(!$this->is_user_exists()){
            $this->db->insert($this->TABLE, array(
                'user_id' => $this->user_id,
                'recover_key' => $this->recover_key,
                'expDate' => $this->expDate
            ));                      
        }
        else{
            $this->db->update($this->TABLE, array(
                'recover_key' => $this->recover_key,
                'expDate' => $this->expDate
            ));
        }

        return $this->get();
    }

    private function random_key(){
        $t=time();

        $this->recover_key = md5($t . $this->user_id);
    }

    private function set_expiration($days){
        $t=time();

        $Date = date('Y-m-d', $t) ; 
        
        $this->expDate = date('Y-m-d', strtotime($Date. " + $days days")); 
    }

    public function is_exists(){
        $result = $this->db->get_where($this->TABLE, array(
            'user_id' => $this->user_id,
            'recover_key' => $this->recover_key
        ));

        $row = $result->row();

        return isset($row);
    }

    public function is_user_exists(){
        $pr = $this->get();
        
        return isset($pr);
    }

    public function get(){
        $result = $this->db->get_where($this->TABLE, array(
            'user_id' => $this->user_id
        ));

        $row = $result->row();

        return $row;
    }
}