<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Regulasi extends CI_Controller {

    function __construct(){
		parent::__construct();		
    }
    
    public function index()
    {
      $data = [
        'regulasi' => $this->db->get('tabel_regulasi')->result_array()
      ]  ;
      $this->load->view('front/regulasi/index.php', $data);
    }

}


?>