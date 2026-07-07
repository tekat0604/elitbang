<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Layanan extends CI_Controller {

    function __construct(){
		parent::__construct();		
    }
    
    public function index()
    {
      $data = [
        'layanan' => $this->db->get('tabel_layanan')->row_array()
      ]  ;
      $this->load->view('front/layanan/index.php',$data);
    }

}


?>