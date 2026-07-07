<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gempa extends CI_Controller {
    private $base = 'frontend';
    function __construct(){
		parent::__construct();
    }
    
    public function index(){
        $this->gempa_table();
    }
    public function index_old(){
        $data = [
            'li_beranda'=>'active',
            'extra_js' => "$this->base/gempa/index_js",
        ];
        $this->template->content_frontend("$this->base/gempa/index", $data);
    }
 
    public function gempa_mobile(){
        $data = [ 
            'extra_css'     => "$this->base/gempa/index_mobile_css",
            'extra_js'      => "$this->base/gempa/index_mobile_js",
        ];
        $this->template->content_mobile_frontend("$this->base/gempa/index_mobile", $data);
    }
    public function gempa_desktop(){
        $data = [  
            'extra_css'     => "$this->base/gempa/index_desktop_css",
            'extra_js'      => "$this->base/gempa/index_desktop_js",
        ];
        $this->template->content_frontend("$this->base/gempa/index", $data);
    }
    public function gempa_table(){
        $data = [  
            'extra_css'     => "$this->base/gempa/index_desktop_css",
            'extra_js'      => "$this->base/gempa/index_desktop_js",
        ];
        $this->template->content_frontend("$this->base/gempa/index_table", $data);
    }
    public function contoh(){
        echo "contoh";
    }
}
