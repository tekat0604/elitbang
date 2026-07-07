<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Publikasi extends CI_Controller {

    function __construct(){
		parent::__construct();		
    }
    
    public function index()
    {
      $data = [
        'publikasi' => $this->db->get('tabel_berita')->result_array()
      ]  ;
      $this->load->view('front/publikasi/index.php',$data);
    }

    public function detail($id=0)
    {
      if($id>0)
      {
        $data = [
          'publikasi' => $this->db->query("select * from tabel_berita t1 inner join user_detail t2 on t2.id_user = t1.add_by where id_berita = {$id}")->row_array()
        ]  ;
        $this->load->view('front/publikasi/detail.php',$data);
      }
      else
      {
        redirect(base_url());
      }
      
    }

}


?>