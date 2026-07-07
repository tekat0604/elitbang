<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Galeri extends CI_Controller { 
    function __construct(){
		parent::__construct();
		$this->load->model('frontend/ApiModel', 'ApiModel');
    }
    
    public function index(){
    	$this->Galeri();
    }

    public function Galeri(){
    	$data_berita = array();
        $this->db->select('id, judul, konten, image, tanggal');
        $this->db->from('menu'); 
        $this->db->where('id_menu_utama','7'); 
        $this->db->where('aktif','1'); 
        $this->db->where('dihapus_pada',NULL); 
        $this->db->order_by("id", "DESC");
        $this->db->limit('5');
        
        $list_data = $this->db->get()->result_array();  
        foreach ($list_data as $key => $value) { 
            $row            =  array();
            $row['id']      = $value['id'];
            $row['judul']   = $value['judul']; 
            $row['konten']  = $this->ApiModel->str_clean_tag(($value['konten']),100) ;  
            $row['tanggal'] = ($value['tanggal']  != '0000-00-00') ? $this->ApiModel->d($value['tanggal'])  : '00-00-0000';
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
        $id_album = $this->uri->segment(5);
        $id_album = $id_album ? $id_album: 0; 
        $data_detail_galeri = array();
        $this->db->select(
            'sub_menu.id, sub_menu.id_menu, sub_menu.jenis, 
            IF (sub_menu.jenis !=1, "Foto", "Video") AS label, 
            menu.judul as nama_album, 
            sub_menu.judul, sub_menu.konten, sub_menu.image, sub_menu.link, sub_menu.tanggal'
        );
        $this->db->from('sub_menu');  
        $this->db->join('menu','menu.id = sub_menu.id_menu', 'LEFT');  
        $this->db->where('sub_menu.id_menu_utama','7'); 
        $this->db->where('sub_menu.id_menu',$id_album);  
        $this->db->where('sub_menu.aktif','1'); 
        $this->db->where('sub_menu.dihapus_pada',NULL); 
        $this->db->order_by("sub_menu.id", "DESC"); 
        
        $list_data = $this->db->get()->result_array();  
        foreach ($list_data as $key => $value) { 
            $row                =  array();
            $row['id']          = $value['id'];
            $row['id_album']    = $value['id_menu']; 
            $row['nama_album']  = $value['nama_album']; 
            $row['jenis']       = $value['jenis'];   
            $row['label']       = $value['label'];   
            $row['judul']       = $value['judul'];   
            if($value['image']!='' && $value['image']!=null){
                $img = base_url('uploads/sub_menu/medium/'.$value['image'].'');
            }else{
                $img = '';
            }
            $row['image']   = $img;  
            if($value['link']!=''){
                $url_youtube="https://www.youtube.com/watch?v=".$value['link']."";
            }else{
                $url_youtube="";
            }
            $row["link_youtube"] = $url_youtube;  
            $data_detail_galeri[]  = $row;
        }
        echo json_encode($data_detail_galeri);
    }
}