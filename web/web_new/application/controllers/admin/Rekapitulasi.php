<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Rekapitulasi extends MY_Controller {

    function __construct(){
		parent::__construct();		
        $this->load->model('PetaModel', 'peta');
        if ( ! $this->session->userdata('logged_in')){ 
            redirect('login');
        }
         
    }

    public function index()
    { 
        // $chart = [];
        // // Start Data Chart Dashboard
        // $chart['user'] = count($this->db->get('user_login')->result_array());
        // $chart['opd'] = count($this->db->get('tabel_referensi_opd')->result_array());
        // $chart['layer'] = count($this->db->get('tabel_layer')->result_array());
        // $chart['data_layer'] = count($this->db->get('tabel_collection')->result_array());
        // // End Data Chart Dashboard
        // $data_js = [];
        // $data = [
        //     'isi' => 'admin/beranda/index',
        //     // 'extra_js' => 'admin/beranda/index_js',
        //     //'extra_js' => $this->load->view('admin/beranda/index_js', $data_js, TRUE),
        //     'chart' => $chart
        // ];
        // $this->load->view('layouts/wrapper', $data, FALSE);
        
    } 

} 
?>