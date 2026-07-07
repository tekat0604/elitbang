<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Page_ppid extends MY_Controller
{
    private $base           = 'admin';
    private $menu           = 'ppid';
    private $table          = 'page_ppid';
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
        $data = [
            'isi'       => "$this->base/$this->menu/page/index",
            'modal'     => array(
                $this->load->view("$this->base/$this->menu/page/modal_tambah", '', true),
                $this->load->view("$this->base/$this->menu/page/modal_ubah", '', true),
                $this->load->view("$this->base/$this->menu/page/modal_hapus", '', true)
            ),
            'extra_css'  => $this->load->view("$this->base/$this->menu/page/index_css", '', true),
            'extra_js'  => $this->load->view("$this->base/$this->menu/page/index_js", '', true),
        ];
        $this->load->view('layouts/wrapper', $data, FALSE);
    }
    public function get_data()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('aktif', '1');
        $this->db->where('dihapus_pada', NULL);
        $this->db->order_by("id", "DESC");
        $list_data = $this->db->get()->result_array();

        $no = 0;
        $jum = count($list_data);
        $data = array();
        foreach ($list_data as $key => $value) {
            $no++;
            $row                            =  array();
            $row['no']                      = $no;
            $row['id']                      = $value['id'];
            $row['judul']                   = $value['judul'];
            $row['konten']                  = $this->page->str_clean_tag(($value['konten']), 100);
            $row['tanggal']                 = ($value['tanggal']  != '0000-00-00') ? $this->page->d($value['tanggal'])  : '00-00-0000';
            if ($value['image'] != '' && $value['image'] != null) {
                $img        = base_url('uploads/page_ppid/small/' . $value['image'] . '');
            } else {
                $img        = '';
            }
            $row['image']   = $img;
            $data[]         = $row;
        }
        $output = array(
            "recordsTotal"  =>  $jum,
            "data"          => $data
        );
        echo json_encode($output);
    }

    public function prosesTambah()
    {
        if ($_FILES['image'] != '') {
            $config['encrypt_name']     = TRUE;
            $config['allowed_types']    = 'jpg|png|jpeg';
            $config['upload_path']      = 'uploads/page_ppid';
            $this->upload->initialize($config);
            if ($this->upload->do_upload('image')) {
                $file_name  = $this->upload->data('file_name');
            } else {
                $file_name  =  "";
            }
        } else {
            $file_name      = "";
        }

        $data = array(
            'judul'             => $this->input->post('judul'),
            'konten'            => $this->input->post('konten'),
            'image'             => $file_name,
            'tanggal'           => date('Y-m-d'),
            'aktif'             => '1',
        );
        $proses = $this->page->tambah($data, $this->table);
        echo json_encode("ok");
    }

    public function prosesUbah()
    {
        $id                 = $this->input->post('id');
        $kosongkan_image    = $this->input->post('kosongkan_image');
        $data_ppid          = $this->db->where('id', $id)->get($this->table)->row_array();
        $config = array(
            'encrypt_name'  => TRUE,
            'upload_path'   => "uploads/page_ppid",
            'allowed_types' => 'jpg|png|jpeg'
        );

        $this->upload->initialize($config);
        if ($_FILES['image'] != '') {
            if (!$this->upload->do_upload('image')) {
                if ($kosongkan_image == "1") {
                    if ($data_ppid['image'] != '') {
                        unlink('./uploads/page_ppid/' . $data_ppid['image']);
                        unlink('./uploads/page_ppid/large/' . $data_ppid['image']);
                        unlink('./uploads/page_ppid/medium/' . $data_ppid['image']);
                        unlink('./uploads/page_ppid/small/' . $data_ppid['image']);
                    }
                    $file_name = "";
                } else {
                    $file_name = $data_ppid['image'];
                }
            } else {
                if ($data_ppid['image'] != '') {
                    unlink('./uploads/page_ppid/' . $data_ppid['image']);
                    unlink('./uploads/page_ppid/large/' . $data_ppid['image']);
                    unlink('./uploads/page_ppid/medium/' . $data_ppid['image']);
                    unlink('./uploads/page_ppid/small/' . $data_ppid['image']);
                }
                $file_name = $this->upload->data('file_name');
                $this->page->_create_thumbs('page_ppid', $file_name);
            }
        } else {
            $file_name = '';
        }
        $where = array(
            'id' => $this->input->post('id')
        );
        $data = array(
            'judul'             => $this->input->post('judul'),
            'konten'            => $this->input->post('konten'),
            'image'             => $file_name,
            'diubah_pada'       => date("Y-m-d H:i:s")
        );
        $proses = $this->page->ubah($data, $where, $this->table);
        echo json_encode("ok");
    }

    public function get_id()
    {
        $where      = array(
            'id'    => $this->input->post('id') ? $this->input->post('id') : 5,
        );
        $data       = $this->page->get_detail($where, $this->table);
        echo json_encode($data);
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
