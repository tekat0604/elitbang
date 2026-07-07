<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Informasi_kebencanaan extends CI_Controller {
    private $base = 'frontend';
    public function __construct(){
        parent::__construct();
        $id_menu_utama = '8';
        $this->id_menu_utama = $id_menu_utama;
        $folder = 'informasi_kebencanaan';
        $this->folder = $folder; 
        $halaman = 'informasi_kebencanaan';
        $this->halaman = $halaman;
        $judul_halaman = 'Informasi Kebencanaan';
        $this->judul_halaman = $judul_halaman;
    }
    
	function index($kategori=null){
        $max_per_page 	= 6;
        $total_data 	= $this->db
        						   ->where(['id_menu_utama' => $this->id_menu_utama])
        						   ->where('dihapus_pada IS NULL',null,false)
        						   ->get('menu')->num_rows();
        $base_url 		= '?order=terbaru';
        if (isset($_GET['per_page'])) {
			$per_page 	= (int)$this->input->get('per_page');
			$this->db->limit( $max_per_page, ($per_page - 1)*$max_per_page);
		} else {
            $this->db->limit( $max_per_page, 0);
        }
        $list_data 		= $this->db->select('id,judul,konten,image,tanggal,dibuat_pada')
        					->where(['id_menu_utama' => $this->id_menu_utama])
        					->where('dihapus_pada IS NULL',null,false)
        					->order_by('tanggal DESC, dibuat_pada DESC')
        					->get('menu')->result();
        $pagging 		= $this->buat_pagging($total_data, $base_url, TRUE);
        $data 			= [
            'li_'.$this->halaman.'' =>'active',
            'judul_halaman'         => $this->judul_halaman,
            'halaman'               => $this->halaman,
            'extra_js' 				=> "$this->base/$this->folder/index_js",
            'pagging' 				=> $pagging,
            'list_data' 			=> $list_data
        ]; 
        $this->template->content_frontend("$this->base/$this->folder/index", $data);
	}
    
    function buat_pagging($total_data, $base_url, $page_query_string) {
		//pagination
		$this->load->library('pagination');
		$config['base_url'] 			= $base_url;
		$config['total_rows'] 			= $total_data;
		$config['per_page'] 			= 6; 
		$config['num_links'] 			= 5;
		$config['use_page_numbers'] 	= TRUE;
		$config['page_query_string'] 	= $page_query_string;

		$config['full_tag_open'] 		= '<ul class="pagination">';
		$config['full_tag_close'] 		= '</ul>';
		$config['num_tag_open'] 		= '<li>';
		$config['num_tag_close'] 		= '</li>';
		$config['cur_tag_open'] 		= "<li class='active'><a>";
		$config['cur_tag_close'] 		= "</a></li>";
		$config['next_tag_open'] 		= "<li>";
		$config['next_tagl_close'] 		= "</li>";
		$config['prev_tag_open'] 		= "<li>";
		$config['prev_tagl_close'] 		= "</li>";
		$config['first_tag_open'] 		= "<li>";
		$config['first_tagl_close'] 	= "</li>";
		$config['last_tag_open'] 		= "<li>";
		$config['last_tagl_close'] 		= "</li>";
		//$config['display_pages'] 		= FALSE;
		$config['first_link'] 			= '<';
		$config['last_link'] 			= '>';
		$config['next_link'] 			= false;
		$config['prev_link'] 			= false;
		$this->pagination->initialize($config);
		return $this->pagination->create_links();
		//pagination end
	}
    
    function  detail($tanggal, $id){
    	//Konten Lainnya
	    $this->db->select('id, judul, konten, image, tanggal');
	    $this->db->from('menu'); 
	    $this->db->where('id_menu_utama',$this->id_menu_utama); 
	    $this->db->where('id !=' , $id); 
	    $this->db->where('aktif','1'); 
	    $this->db->where('dihapus_pada',NULL); 
	    $this->db->order_by("id", "DESC");
	    $this->db->limit('5'); 
	    $list_lainnya = $this->db->get()->result();
        //Detail Konten
        $get = $this->db->where(['id_menu_utama' => $this->id_menu_utama, 'id'=>$id, 'tanggal'=>$tanggal])->get('menu');
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
