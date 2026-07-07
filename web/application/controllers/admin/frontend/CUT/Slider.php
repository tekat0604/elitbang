<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Slider extends CI_Controller {
    private $base = 'admin/frontend';
    function __construct(){
        parent::__construct();
        $this->load->model('frontend/FrontendModel', 'slider');
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
            'isi' => "$this->base/slider/index",
            'extra_js' => $this->load->view("$this->base/slider/index_js", '', true),
        ];
        $this->load->view('layouts/wrapper', $data, FALSE);
    }

    public function form_slider()
    {
        // print_r($this->input->post()); exit();
        $data_slider = '';
        $id = $this->input->post('id');
        if($id == ""){
            $data_slider = array( 

                'tampil' => '1',
                'aktif' => '1',
                'dibuat_pada' => date("Y-m-d H:i:s"),

                'dibuat_oleh' => $this->session->userdata('id'),
            );
            if (!empty($_FILES['file']['name'])) {
                $config=[
                    'upload_path'   => './assets_frontend/images/file_slider/',
                    'allowed_types' => 'gif|jpg|png|jpeg',
                    'max_size'      => 5024, //5MB
                    'encrypt_name'  => FALSE,
                ];
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('file')){
                    echo json_encode(array('status' => false, 'file' => 'Periksa kembali file anda'));
                }
                $data_slider['gambar']  = $this->upload->data('file_name');
            }

            $data = $this->slider->tambah($data_slider,'frontend_slider');
        }else{
            $where = array('id' => $id);
            $data_slider = array( 

                'tampil' => '1',
                'aktif' => '1',
                'diubah_pada' => date("Y-m-d H:i:s"),

                'diubah_oleh' => $this->session->userdata('id'),
            );

            if (!empty($_FILES['file']['name'])) {
                $config=[
                    'upload_path'   => './assets_frontend/images/slider/',
                    'allowed_types' => 'gif|jpg|png|jpeg',
                    'max_size'      => 5024, //5MB
                    'encrypt_name'  => FALSE,
                ];
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('file')){
                    echo json_encode(array('status' => false, 'file' => 'Periksa kembali file anda'));
                }
                $data_slider['gambar']  = $this->upload->data('file_name');
            }

            $data = $this->slider->ubah($data_slider, 'frontend_slider', $where);
        }
        echo json_encode($data);
    }

    public function get_slider()
    {
        $id = $this->input->get('id');
        $data = $this->slider->get_slider($id);
        echo json_encode($data);
    }

    public function daftar_slider()
    {
        $data=$this->slider->daftar_slider();
        echo json_encode($data);
    }

    public function hapus_slider()
    {
        $id = $this->input->post('id');
        $d = $this->db->where('id', $this->input->post('id'))->get('frontend_slider')->row_array();
        unlink('assets_frontend/images/slider/'.$d['file']);

        $data = $this->slider->hapus_slider($id);
        echo json_encode($data);
    }

    public function aktif_slider()
    {
        $id = $this->input->post('id');
        $data = $this->slider->aktif_slider($id);
        echo json_encode($data);
    }

    public function nonaktif_slider()
    {
        $id = $this->input->post('id');
        $data = $this->slider->nonaktif_slider($id);
        echo json_encode($data);
    }

}

/* End of file slider.php */


?>
