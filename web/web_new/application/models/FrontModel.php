<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class FrontModel extends CI_Model {

    public function last_iduser()
    {
        $query = $this->db->order_by('id_user', 'DESC');
        $query = $this->db->limit(1);
        $query = $this->db->get('user_login');
        if ($query->num_rows() > 0)
        {
            $ret = $query->row();
            return $ret->id_user; 
        }
        return 0;
    }

}

/* End of file FrontModel.php */


?>