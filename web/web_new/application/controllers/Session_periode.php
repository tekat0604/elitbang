<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Session_periode extends CI_Controller {

    public function __construct()
    {
        parent::__construct(); 
        if (!empty($this->session->userdata('logged_in'))) { 
        }else{ 
            redirect(base_url().'login');
        }
    }
    public function index()
    {
         echo " 
         id => ".$this->session->userdata('id')." <br> 
         id_periode =>  ".$this->session->userdata('id_periode')." <br> 
         role =>  ".$this->session->userdata('role')." <br> 
         ";
    }
    public function rubah_session()
    {
        $where = array(
            //'aktif' => '1', 
            'id_user'    => $this->session->userdata('id'), 
        );
        $data = array( 
            'id_periode'    =>   $this->input->post('id_periode')
        ); 
        $this->db->where($where);
        $proses = $this->db->update('user_login',$data);
        if($proses){
            $this->session->set_userdata($data);
            echo json_encode("ok");
        }
    }
}