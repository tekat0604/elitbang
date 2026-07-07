<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Informasi_kebencanaan extends CI_Controller { 
    function __construct(){
		parent::__construct();
		$this->load->model('frontend/ApiModel', 'ApiModel');
    }
    
    public function index(){
    	$this->Informasi_kebencanaan();
    }


    public function Informasi_kebencanaan(){
    	$data = array();
        $this->db->select(
            'menu.id, menu.judul, menu.konten, menu.image, menu.tanggal'
        );
        $this->db->from('menu');   
        $this->db->where('menu.id_menu_utama','8');  
        $this->db->where('menu.aktif','1'); 
        $this->db->where('menu.dihapus_pada',NULL); 
        $this->db->order_by("menu.id", "DESC");
        $list_data = $this->db->get()->result_array();  
        foreach ($list_data as $key => $value) { 
            $row                            =  array();
            $row['id']                      = $value['id']; 
            $row['judul']                   = $value['judul']; 
            $row['konten']                  = $this->ApiModel->str_clean_tag(($value['konten']),100) ;  
            $row['tanggal']                 = ($value['tanggal']  != '0000-00-00') ? $this->ApiModel->d($value['tanggal'])  : '00-00-0000';
            if($value['image']!='' && $value['image']!=null){
                $img        = base_url('uploads/menu/medium/'.$value['image'].'');
            }else{
                $img        = '';
            }
            $row['image']   = $img; 
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
        $this->db->where('menu.id_menu_utama','8');   
        $this->db->where('menu.aktif','1'); 
        $this->db->where('menu.dihapus_pada',NULL);  
        $this->db->where('menu.id',$id);  
		$data = $this->db->get()->row_array(); 
        if($data['image']!='' && $data['image']!=null){
            $img            = base_url('uploads/menu/large/'.$data['image'].'');
        }else{
            $img            = '';
        }
        $data['image']      = $img;
        $data['tanggal']    = ($data['tanggal']  != '0000-00-00') ? $this->ApiModel->d($data['tanggal'])  : '00-00-0000';
		echo json_encode($data);
    } 
}