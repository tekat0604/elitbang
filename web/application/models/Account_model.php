<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account_model extends CI_Model {

    // cek keberadaan user di sistem
    function check_user_account($username, $password) {
        $this->db->select('*');
        $this->db->from('user_login');
        $this->db->where('user_name', $username);
        $this->db->where('user_pass', md5($password));
        // $this->db->where('is_active', 1);

        return $this->db->get();
    }
	
    function addUser($data){
	   return	$this->db->insert('user', $data);
	}
}
