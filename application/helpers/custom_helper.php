<?php
    function logged_in(){
        $ci =& get_instance();
        $ci->load->library('session');

        if($ci->session->has_userdata('logged_in') && 
            $ci->session->logged_in){
            return true;
        }

        return false;
    }
?>