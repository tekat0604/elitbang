<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Layanan extends MY_Controller
{
    private $base           = 'admin';
    private $menu           = 'layanan';
    private $table          = 'layanan';
    private $folder_upload  = 'layanan';
    function __construct()
    {
        parent::__construct();
        $this->load->library('upload');
        $this->load->model('PageModel', 'page');
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
        if ($this->session->userdata('role') != 1) {
            redirect('login');
        }
    }

    public function index()
    {
        $this->layanan();
    }

    public function layanan()
    {
        $data           = [
            'isi'       => "$this->base/portal/$this->menu/index",
            'modal'     => array(
                $this->load->view("$this->base/portal/$this->menu/modal_tambah", '', true),
                $this->load->view("$this->base/portal/$this->menu/modal_ubah", '', true),
                $this->load->view("$this->base/portal/$this->menu/modal_hapus", '', true)
            ),
            'extra_js'  => $this->load->view("$this->base/portal/$this->menu/index_js", '', true),
        ];
        $this->load->view('layouts/wrapper', $data, FALSE);
    }

    public function prosesTambah()
    {
        if ($_FILES['file']) {
            $config['allowed_types']    = 'jpg|png|jpeg|gif|pdf';
            $config['upload_path']      = 'uploads/' . $this->folder_upload;
            $this->upload->initialize($config);
            if ($this->upload->do_upload('file')) {
                $data_file      = $this->upload->data();
                $file_name      = $data_file['raw_name'] . $data_file['file_ext'];
            } else {
                $file_name      = "";
            }
        } else {
            $file_name          = "";
        }
        $data                   = array(
            'judul'             => $this->input->post('judul'),
            'file'              => $file_name,
            'created_at'        => date("Y-m-d H:i:s")
        );
        $proses = $this->page->tambah($data,  $this->table);
        echo json_encode("ok");
    }

    public function prosesUbah()
    {
        $id                 = $this->input->post('id');
        $kosongkan_file     = $this->input->post('kosongkan_file');
        $get_data           = $this->db->where('id', $id)->get($this->table)->row_array();
        $config             = array(
            'upload_path'   => 'uploads/' . $this->folder_upload,
            'allowed_types' => 'jpg|png|jpeg|gif|pdf'
        );

        $this->upload->initialize($config);
        if ($_FILES['file'] != '') {
            if (!$this->upload->do_upload('file')) {
                if ($kosongkan_file == "1") {
                    if ($get_data['file'] != '') {
                        unlink('./uploads/' . $this->folder_upload . '/' . $get_data['file']);
                    }
                    $file_name = "";
                } else {
                    $file_name = $get_data['file'];
                }
            } else {
                if ($get_data['file'] != '') {
                    unlink('./uploads/' . $this->folder_upload . '/' . $get_data['file']);
                }
                $data_file  = $this->upload->data();
                $file_name  = $data_file['raw_name'] . $data_file['file_ext'];
            }
        } else {
            $file_name      = '';
        }
        $where              = array(
            'id'            => $this->input->post('id')
        );
        $data               = array(
            'judul'         => $this->input->post('judul'),
            'file'          => $file_name,
            'updated_at'    => date("Y-m-d H:i:s")
        );
        $proses             = $this->page->ubah($data, $where, $this->table);
        echo json_encode("ok");
    }

    public function get_id()
    {
        $where      = array(
            'id'    => $this->input->post('id') ? $this->input->post('id') : 0,
        );
        $data       = $this->page->get_detail($where, $this->table);
        echo json_encode($data);
    }

    public function get_data()
    {
        $where      = array(
            'deleted_at'  => NULL,
        );
        $data_page  = $this->page->get_data($where, $this->table);
        $no         = 0;
        $jum        = count($data_page);
        $data       = array();
        foreach ($data_page as $row) {
            $no++;
            $row['no']  = $no;
            $data[]     = $row;
        }
        $output             = array(
            "recordsTotal"  =>  $jum,
            "data"          => $data
        );
        echo json_encode($output);
    }

    public function prosesHapus()
    {
        $where              = array(
            'id'            => $this->input->post('id'),
        );
        $data               = array(
            'deleted_at'    => date("Y-m-d H:i:s")
        );
        $proses = $this->page->ubah($data, $where, $this->table);
        echo json_encode("ok");
    }
}
