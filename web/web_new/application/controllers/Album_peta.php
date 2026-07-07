<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Album_peta extends CI_Controller {

    function __construct(){
		parent::__construct();		
    }
    
    public function index()
    {
      $data = [
        'kategori' => $this->db->get('tabel_album_kategori')->result_array(),
        'album' => $this->db->query('select * from tabel_album t1 inner join tabel_album_kategori t2 on t2.id_album_kategori = t1.id_album_kategori')->result_array()
      ];
      $this->load->view('front/album_peta/index.php',$data);
    }

}


?>