<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Sosmed extends CI_Controller {
    private $base = 'admin/frontend';
    function __construct(){
        parent::__construct();      
        $this->load->model('frontend/FrontendModel', 'sosmed');
        // if ( ! $this->session->userdata('logged_in')){ 
        //     redirect('login');
        // }
        // if($this->session->userdata('role') != 1){
        //     redirect('login');
        // }
        // $this->load->library('upload');
    } 

    public function index()
    {
        $data = [
            'isi' => "$this->base/sosmed/index",
            'extra_js' => $this->load->view("$this->base/sosmed/index_js", '', true),
        ];
        $this->load->view('layouts/wrapper', $data, FALSE);   
    }

    public function form_sosmed()
    { 
        $data_sosmed = '';
        $id = $this->input->post('id');
        if($id == ""){
            $data_sosmed = array(
                'facebook' => $this->input->post('facebook'), 
                'twitter' => $this->input->post('twitter'),
                'linkedin' => $this->input->post('linkedin'),
                'dribbble' => $this->input->post('dribbble'), 
                'dibuat_pada' => date("Y-m-d H:i:s"),

                'dibuat_oleh' => $this->session->userdata('id'),
            ); 

            $data = $this->sosmed->tambah($data_sosmed,'frontend_sosmed');
        }else{
            $where = array('id' => $id);
            $data_sosmed = array(
                'facebook' => $this->input->post('facebook'), 
                'twitter' => $this->input->post('twitter'),
                'linkedin' => $this->input->post('linkedin'),
                'dribbble' => $this->input->post('dribbble'), 

                'diubah_pada' => date("Y-m-d H:i:s"),

                'diubah_oleh' => $this->session->userdata('id'),
            ); 

            $data = $this->sosmed->ubah($data_sosmed, 'frontend_sosmed', $where);        
        }
        echo json_encode($data);
    }

    public function get_sosmed()
    {
        $id = $this->input->get('id');
        $data = $this->sosmed->get_sosmed($id);
        echo json_encode($data);
    }

    public function daftar_sosmed()
    {
        $data=$this->sosmed->daftar_sosmed();
        echo json_encode($data);
    }

    public function hapus_sosmed()
    {
        $id = $this->input->post('id');
        $data = $this->sosmed->hapus_sosmed($id);
        echo json_encode($data);
    }

}

/* End of file Website.php */


?>