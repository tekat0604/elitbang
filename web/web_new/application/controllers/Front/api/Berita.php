<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Berita extends CI_Controller { 
    function __construct(){
		parent::__construct();
		$this->load->model('frontend/ApiModel', 'ApiModel');
    }
    
    public function index(){
    	$this->berita();
    }

    public function kategori(){
        $this->db->select('id, nama_kategori_menu as nama_kategori');
        $this->db->from('kategori_menu'); 
        $this->db->where('id_menu_utama','3'); 
        $this->db->where('aktif','1'); 
        $this->db->where('dihapus_pada',NULL); 
        $this->db->order_by("id", "ASC"); 
        
        $data = $this->db->get()->result_array();  
         
        echo json_encode($data);
    }

    public function berita(){
    	$data_berita = array();
        $this->db->select(
            'menu.id, menu.id_kategori_menu,  kategori_menu.nama_kategori_menu as kategori_berita, 
            menu.judul, menu.konten, menu.image, menu.tanggal '
        );
        $this->db->from('menu');  
        $this->db->join('kategori_menu','kategori_menu.id = menu.id_kategori_menu', 'LEFT');  
        $this->db->where('menu.id_menu_utama','3');  
        $this->db->where('menu.aktif','1'); 
        $this->db->where('menu.dihapus_pada',NULL); 
        $this->db->order_by("menu.id", "DESC");  
        
        $list_data = $this->db->get()->result_array();  
        foreach ($list_data as $key => $value) { 
            $row                            =  array();
            $row['id']                      = $value['id'];
            $row['id_kategori_berita']      = $value['id_kategori_menu']; 
            $row['kategori_berita']         = $value['kategori_berita'];
            $row['judul']                   = $value['judul']; 
            $row['konten']                  = $this->ApiModel->str_clean_tag(($value['konten']),100) ;  
            $row['tanggal']                 = ($value['tanggal']  != '0000-00-00') ? $this->ApiModel->d($value['tanggal'])  : '00-00-0000';
            if($value['image']!='' && $value['image']!=null){
                $img        = base_url('uploads/menu/medium/'.$value['image'].'');
            }else{
                $img        = '';
            }
            $row['image']   = $img; 
            $data_berita[]  = $row;
        }
        echo json_encode($data_berita);
    }
    public function berita_kategori(){
        $id_kategori = $this->uri->segment(5);
        $id_kategori_menu = $id_kategori ? $id_kategori: 0; 
        $data_berita = array();
        $this->db->select(
            'menu.id, menu.id_kategori_menu,  kategori_menu.nama_kategori_menu as kategori_berita, 
            menu.judul, menu.konten, menu.image, menu.tanggal '
        );
        $this->db->from('menu');  
        $this->db->join('kategori_menu','kategori_menu.id = menu.id_kategori_menu', 'LEFT');  
        $this->db->where('menu.id_menu_utama','3'); 
        $this->db->where('menu.id_kategori_menu',$id_kategori_menu);  
        $this->db->where('menu.aktif','1'); 
        $this->db->where('menu.dihapus_pada',NULL); 
        $this->db->order_by("menu.id", "DESC"); 
        
        $list_data = $this->db->get()->result_array();  
        foreach ($list_data as $key => $value) { 
            $row            =  array();
            $row['id']                  = $value['id'];
            $row['id_kategori_berita']  = $value['id_kategori_menu']; 
            $row['kategori_berita']     = $value['kategori_berita']; 
            $row['judul']               = $value['judul']; 
            $row['konten']              = $this->ApiModel->str_clean_tag(($value['konten']),100) ;  
            $row['tanggal']             = ($value['tanggal']  != '0000-00-00') ? $this->ApiModel->d($value['tanggal'])  : '00-00-0000';
            if($value['image']!='' && $value['image']!=null){
                $img = base_url('uploads/menu/medium/'.$value['image'].'');
            }else{
                $img = '';
            }
            $row['image']   = $img; 
            $data_berita[]  = $row;
        }
        echo json_encode($data_berita);
    }

    public function Detail(){ 
    	$id = $this->uri->segment(5);
        $id = $id ? $id: 0; 
         $this->db->select(
            'menu.id, menu.id_kategori_menu,  kategori_menu.nama_kategori_menu as kategori_berita, 
            menu.judul, menu.konten, menu.image, menu.tanggal '
        );
        $this->db->from('menu');  
        $this->db->join('kategori_menu','kategori_menu.id = menu.id_kategori_menu', 'LEFT');  
        $this->db->where('menu.id_menu_utama','3');   
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
        //$data['konten']     = $this->ApiModel->str_clean_tag(($data['konten']),1000000) ;  
		echo json_encode($data);
    } 
}