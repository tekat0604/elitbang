<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Website extends CI_Controller {
    private $base = 'admin/frontend';
    function __construct(){
        parent::__construct();      
        $this->load->model('frontend/FrontendModel', 'website');
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
            'isi' => "$this->base/website/index",
            'extra_js' => $this->load->view("$this->base/website/index_js", '', true),
        ];
        $this->load->view('layouts/wrapper', $data, FALSE);   
    }

    public function form_website()
    { 
        $data_website = '';
        $id = $this->input->post('id');
        if($id == ""){
            $data_website = array(
                'nama_sistem' => $this->input->post('nama_sistem'), 
                'alamat' => $this->input->post('alamat'),
                'nomor_telpon' => $this->input->post('nomor_telpon'),
                'email' => $this->input->post('email'),
                'text_footer' => $this->input->post('text_footer'),

                'aktif' => '1',
                'dibuat_pada' => date("Y-m-d H:i:s"),

                'dibuat_oleh' => $this->session->userdata('id'),
            );
            if (!empty($_FILES['logo_header']['name'])) {
                $config=[
                    'upload_path'   => './assets_frontend/assets/images/',
                    'allowed_types' => 'gif|jpg|png|jpeg',
                    'max_size'      => 1024, //1MB
                    'encrypt_name'  => TRUE,
                ];
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('logo_header')){
                    echo json_encode(array('status' => false, 'logo_header' => 'Periksa kembali file anda'));
                }
                $data_website['logo_header']  = $this->upload->data('file_name');
            }

            if (!empty($_FILES['logo_footer']['name'])) {
                $config=[
                    'upload_path'   => './assets_frontend/assets/images/',
                    'allowed_types' => 'gif|jpg|png|jpeg',
                    'max_size'      => 1024, //1MB
                    'encrypt_name'  => TRUE,
                ];
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('logo_footer')){
                    echo json_encode(array('status' => false, 'logo_footer' => 'Periksa kembali file anda'));
                }
                $data_website['logo_footer']  = $this->upload->data('file_name');
            }

            $data = $this->website->tambah($data_website,'frontend_website');
        }else{
            $where = array('id' => $id);
            $data_website = array(
                'nama_sistem' => $this->input->post('nama_sistem'), 
                'alamat' => $this->input->post('alamat'),
                'nomor_telpon' => $this->input->post('nomor_telpon'),
                'email' => $this->input->post('email'),
                'text_footer' => $this->input->post('text_footer'),

                'aktif' => '1',
                'diubah_pada' => date("Y-m-d H:i:s"),

                'diubah_oleh' => $this->session->userdata('id'),
            );

            if (!empty($_FILES['logo_header']['name'])) {
                $config=[
                    'upload_path'   => './assets_frontend/assets/images/',
                    'allowed_types' => 'gif|jpg|png|jpeg',
                    'max_size'      => 1024, //1MB
                    'encrypt_name'  => FALSE,
                ];
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('logo_header')){
                    echo json_encode(array('status' => false, 'logo_header' => 'Periksa kembali file anda'));
                }
                $data_website['logo_header']  = $this->upload->data('file_name');
            }

            if (!empty($_FILES['logo_footer']['name'])) {
                $config=[
                    'upload_path'   => './assets_frontend/assets/images/',
                    'allowed_types' => 'gif|jpg|png|jpeg',
                    'max_size'      => 1024, //1MB
                    'encrypt_name'  => FALSE,
                ];
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('logo_footer')){
                    echo json_encode(array('status' => false, 'logo_footer' => 'Periksa kembali file anda'));
                }
                $data_website['logo_footer']  = $this->upload->data('file_name');
            }

            $data = $this->website->ubah($data_website, 'frontend_website', $where);        
        }
        echo json_encode($data);
    }

    public function get_website()
    {
        $id = $this->input->get('id');
        $data = $this->website->get_website($id);
        echo json_encode($data);
    }

    public function daftar_website()
    {
        $data=$this->website->daftar_website();
        echo json_encode($data);
    }

    public function hapus_website()
    {
        $id = $this->input->post('id');
        $data = $this->website->hapus_website($id);
        echo json_encode($data);
    }

}

/* End of file Website.php */


?>