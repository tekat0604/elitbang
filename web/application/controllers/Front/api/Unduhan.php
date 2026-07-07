<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unduhan extends CI_Controller { 
    function __construct(){
		parent::__construct();
		$this->load->model('frontend/ApiModel', 'ApiModel');
    }
    
    public function index(){
    	$this->Unduhan();
    }


    public function Unduhan(){
    	$data = array();
        $this->db->select(
            'menu.id, menu.judul, menu.konten AS file, menu.image, menu.tanggal'
        );
        $this->db->from('menu');   
        $this->db->where('menu.id_menu_utama','6');  
        $this->db->where('menu.aktif','1'); 
        $this->db->where('menu.dihapus_pada',NULL); 
        $this->db->order_by("menu.id", "DESC");
        $list_data = $this->db->get()->result_array();  
        foreach ($list_data as $key => $value) { 
            $row                            =  array();
            $row['id']                      = $value['id']; 
            $row['judul']                   = $value['judul'];  
            $row['icon']                    = base_url('assets/img/icon_document.png');;  
            //$row['tanggal']                 = ($value['tanggal']  != '0000-00-00') ? $this->ApiModel->d($value['tanggal'])  : '00-00-0000';
            if($value['file']!='' && $value['file']!=null){
                $file        = base_url('uploads/menu/'.$value['file'].'');
            }else{
                $file        = '';
            }
            $row['file']   = $file; 
            $data[]  = $row;
        }
        echo json_encode($data);
    }
     

    public function detail(){ 
    	$id = $this->uri->segment(5);
        $id = $id ? $id: 0; 
         $this->db->select(
            'menu.id, menu.judul, menu.konten, menu.image, menu.tanggal '
        );
        $this->db->from('menu');   
        $this->db->where('menu.id_menu_utama','6');   
        $this->db->where('menu.aktif','1'); 
        $this->db->where('menu.dihapus_pada',NULL);  
        $this->db->where('menu.id',$id);  
		$data = $this->db->get()->row_array(); 
  
        $data['tanggal']    = ($data['tanggal']  != '0000-00-00') ? $this->ApiModel->d($data['tanggal'])  : '00-00-0000';
		echo json_encode($data);
    } 
}