<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller { 
    function __construct(){
		parent::__construct();
		$this->load->model('frontend/ApiModel', 'ApiModel');
    }
    
    public function index(){
    	echo "aaa";
         
    }

    public function slider(){
    	$data_slider = array();
    	$this->db->select('id, judul, konten, image, link');
		$this->db->from('grid_home'); 
		$this->db->where('jenis','1'); 
		$this->db->where('aktif','1'); 
		$this->db->where('dihapus_pada',NULL); 
		$list_slider = $this->db->get()->result_array();  
		foreach ($list_slider as $key => $value) { 
        	$row 			=  array();
        	$row['id'] 		= $value['id'];
        	$row['judul'] 	= $value['judul']; 
        	$row['konten'] 	= $value['konten']; 
        	$row['link'] 	= $value['link']; 
        	if($value['image']!='' && $value['image']!=null){
        		$img = base_url('uploads/grid_home/'.$value['image'].'');
        	}else{
				$img = '';
        	}
    		$row['image'] 	= $img; 
        	$data_slider[] 	= $row;
        }
		echo json_encode($data_slider);
    }

    public function pesan_singkat(){
    	$data_pesan = array();
    	$where = array( 
            'aktif'         => '1',  
            'dihapus_pada'  => NULL
        );
        $this->db->select('konten');
		$this->db->from('pesan_singkat'); 
		$this->db->where($where);
		$data = $this->db->get()->result_array(); 
		if(count($data)>0){
			$data_pesan = "";
			foreach ($data as $key => $value) {   
	        	$data_pesan .= "".$value['konten']." | ";
	        }
	        $output = array(
                "status" 		=> true, 
                "data_pesan" 	=> rtrim($data_pesan,'|').'', 
            ); 
		}else{
			$output = array(
                "status" 		=> false, 
                "data_pesan" 	=> '', 
            );
		}
		echo json_encode($output); 
    }
    public function pesan(){
    	$data_pesan = array();
    	$where = array( 
            'aktif'         => '0',  
            'dihapus_pada'  => NULL
        );
        $this->db->select('konten');
		$this->db->from('pesan_singkat'); 
		$this->db->where($where);
		$data = $this->db->get()->result_array(); 
		$data_pesan = "";
		foreach ($data as $key => $value) {   
	        	$data_pesan .= "".$value['konten']."|";
	        }
		echo json_encode(rtrim($data_pesan,'|').''); 
    }

    public function detail_pesan_singkat(){ 
    	$id = $this->uri->segment(5);
        $id = $id ? $id: 0; 
    	$where = array( 
            'id'         	=> $id,  
            'aktif'         => '1',  
            'dihapus_pada'  => NULL
        );
        $this->db->select('id, judul, konten');
		$this->db->from('pesan_singkat'); 
		$this->db->where($where);
		$data = $this->db->get()->row_array(); 
		echo json_encode($data);
    }

    public function berita_terbaru(){
    	$data_berita_terbaru = array();
    	$this->db->select('id, judul, konten, image, tanggal');
		$this->db->from('menu'); 
		$this->db->where('id_menu_utama','3'); 
		$this->db->where('aktif','1'); 
		$this->db->where('dihapus_pada',NULL); 
		$this->db->order_by("id", "DESC");
		$this->db->limit('5');
		
		$list_data = $this->db->get()->result_array();  
		foreach ($list_data as $key => $value) { 
        	$row 			=  array();
        	$row['id'] 		= $value['id'];
        	$row['judul'] 	= $value['judul']; 
        	$row['konten'] 	= $this->ApiModel->str_clean_tag(($value['konten']),100) ;  
        	$row['tanggal'] = ($value['tanggal']  != '0000-00-00') ? $this->ApiModel->d($value['tanggal'])  : '00-00-0000';
        	if($value['image']!='' && $value['image']!=null){
        		$img = base_url('uploads/menu/small/'.$value['image'].'');
        	}else{
				$img = '';
        	}
    		$row['image'] 	= $img; 
        	$data_berita_terbaru[] 	= $row;
        }
		echo json_encode($data_berita_terbaru);
    }



}