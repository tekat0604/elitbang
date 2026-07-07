<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller { 
    function __construct(){
		parent::__construct();
		$this->load->model('frontend/ApiModel', 'ApiModel');
    }
    
    public function index(){
    	$this->Profil();
    }

    public function Profil(){ 
         $this->db->select(
            'judul, alamat, telepon, email, facebook, twitter, google_plus, linkedin, dribbble, whatsapp, image AS logo'
        );  
        $this->db->from('profil_website');    
        $this->db->where('aktif','1');  
        $this->db->where('id','1');  
		$data = $this->db->get()->row_array();  

        if($data['logo']!='' && $data['logo']!=null){
            $img        = base_url('uploads/logo/'.$data['logo'].'');
        }else{
            $img        = '';
        }
        $data['logo']   = $img;
		echo json_encode($data);
    } 
}