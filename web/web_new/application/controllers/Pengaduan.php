<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaduan extends MY_Controller {

    function __construct(){
		parent::__construct();		
        $this->load->model('PengaduanModel', 'pengaduan');
        if ( ! $this->session->userdata('logged_in')){ 
            redirect('login');
        }
         
    }

    public function index()
    { 
        
    } 

} 
?>