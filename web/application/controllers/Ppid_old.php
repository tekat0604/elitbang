<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ppid extends CI_Controller {
    private $base = 'frontend';
    public function __construct(){
        parent::__construct();
        $id_menu_utama = '9';
        $this->id_menu_utama = $id_menu_utama;
        $folder = 'ppid';
        $this->folder = $folder; 
        $halaman = 'ppid';
        $this->halaman = $halaman;
        $judul_halaman = 'PPID';
        $this->judul_halaman = $judul_halaman;
    }
    public function index(){
        //echo json_encode(get_menu_ppid());
    }

    function  detail($id, $judul){ 
    	//Konten Lainnya
	    $this->db->select('id, judul, konten, image, tanggal');
	    $this->db->from('menu'); 
	    $this->db->where('id_menu_utama',$this->id_menu_utama); 
	    $this->db->where('id !=' , $id); 
	    $this->db->where('aktif','1'); 
	    $this->db->where('dihapus_pada',NULL); 
	    $this->db->order_by("id", "ASC");
	    //$this->db->limit('5'); 
	    $list_lainnya = $this->db->get()->result();
        //Detail Konten
        $get = $this->db->where(['id_menu_utama' => $this->id_menu_utama, 'id'=>$id])->get('menu');
        if($get->num_rows()==1){
            $row = $get->row();
            $data = [ 
                'li_'.$this->halaman.'' => 'active',
                'extra_js' 				=> $this->base.'/'.$this->folder.'/index_js',
                'judul_halaman' 		=> $this->judul_halaman,
                'halaman' 				=> $this->halaman,
                'row' 					=> $row,
                'list_lainnya' 			=> $list_lainnya,
            ];
            $this->template->content_frontend("$this->base/$this->folder/detail", $data);
        } else{
            redirect($this->halaman);
        }
        
	}
}
