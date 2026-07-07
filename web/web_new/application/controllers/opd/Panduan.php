<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Panduan extends CI_Controller {

    private $base = 'opd';

    function __construct(){
		parent::__construct();
	}

    public function index()
    {
        $data = [
            'isi' => "$this->base/panduan/index",
            'extra_js' => $this->load->view("$this->base/panduan/index_js", '', true)
        ];
        $this->load->view('layouts/wrapper', $data, FALSE);
    }

    

}

/* End of file Peta.php */


?>