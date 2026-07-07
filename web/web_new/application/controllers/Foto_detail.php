<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Foto_detail extends CI_Controller {

    function __construct(){
		parent::__construct();		
    }
    
    public function index()
    {
        $this->load->view('front/foto_detail/index.php');
    }

}


?>