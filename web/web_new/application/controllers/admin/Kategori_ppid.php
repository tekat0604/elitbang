<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori_ppid extends MY_Controller
{
    private $base           = 'admin';
    private $menu           = 'kategori_ppid';
    private $table          = 'kategori_ppid';
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

    // Referensi KategoriBerita
    public function index()
    {
        $data = [
            'isi'       => "$this->base/referensi/$this->menu/index",
            'modal'     => array(
                $this->load->view("$this->base/referensi/$this->menu/modal_tambah", '', true),
                $this->load->view("$this->base/referensi/$this->menu/modal_ubah", '', true),
                $this->load->view("$this->base/referensi/$this->menu/modal_hapus", '', true)
            ),
            'extra_js'  => $this->load->view("$this->base/referensi/$this->menu/index_js", '', true),
        ];
        $this->load->view('layouts/wrapper', $data, FALSE);
    }

    public function prosesTambah()
    {
        $data = array(
            'kategori'    => $this->input->post('kategori'),
            'aktif'                 => '1',
        );
        $proses = $this->page->tambah($data, $this->table);
        echo json_encode("ok");
    }

    public function prosesUbah()
    {
        $id     = $this->input->post('id');
        $where = array(
            'id' => $this->input->post('id')
        );
        $data = array(
            'nama_kategori' => $this->input->post('kategori'),
            'diubah_pada'   => date("Y-m-d H:i:s")
        );
        $proses = $this->page->ubah($data, $where, $this->table);
        echo json_encode("ok");
    }

    public function get_id()
    {
        $where = array(
            'id'            => $this->input->post('id') ? $this->input->post('id') : 0,
        );
        $data = $this->page->get_detail($where, $this->table);
        echo json_encode($data);
    }

    public function get_data()
    {
        $where = array(
            'aktif'         => '1',
            'dihapus_pada'  => NULL,
        );
        $data_page = $this->page->get_data($where, $this->table);

        $no = 0;
        $jum = count($data_page);
        $data = array();
        foreach ($data_page as $row) {
            $no++;
            $row['no'] = $no;
            $data[] = $row;
        }
        $output = array(
            "recordsTotal"  =>  $jum,
            "data"    => $data
        );
        echo json_encode($output);
    }

    public function prosesHapus()
    {
        $where = array(
            'id'            => $this->input->post('id'),
        );
        $data = array(
            'aktif'         => '0',
            'dihapus_pada'  => date("Y-m-d H:i:s")
        );
        $proses = $this->page->ubah($data, $where, $this->table);
        echo json_encode("ok");
    }
}
