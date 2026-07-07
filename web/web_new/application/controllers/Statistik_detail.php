<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Statistik_detail extends CI_Controller {

    function __construct(){
		parent::__construct();		
    }
    
    public function index()
    {
        $this->load->view('front/statistik_detail/index.php');
    }

}


?>