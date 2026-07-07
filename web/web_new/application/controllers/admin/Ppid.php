<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ppid extends MY_Controller
{
    private $base           = 'admin';
    private $menu           = 'ppid';
    function __construct()
    {
        parent::__construct();
        $this->load->library('upload');
        $this->load->model('PpidModel', 'ppid');
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
            'isi'       => "$this->base/$this->menu/index",
            'modal'     => array(
                $this->load->view("$this->base/$this->menu/modal_tambah", '', true),
                $this->load->view("$this->base/$this->menu/modal_ubah", '', true),
                $this->load->view("$this->base/$this->menu/modal_hapus", '', true)
            ),
            'extra_css'  => $this->load->view("$this->base/$this->menu/index_css", '', true),
            'extra_js'  => $this->load->view("$this->base/$this->menu/index_js", '', true),
        ];
        $this->load->view('layouts/wrapper', $data, FALSE);
    }

    public function get_data()
    {
        $this->db->select(
            'ppid.id, ppid.id_kategori, kategori_ppid.nama_kategori as kategori, 
            ppid.judul, ppid.konten, ppid.file,  ppid.link, ppid.tanggal'
        );
        $this->db->from('ppid');
        $this->db->join('kategori_ppid', 'kategori_ppid.id = ppid.id_kategori', 'LEFT');
        $this->db->where('ppid.id_periode', $this->session->userdata('id_periode'));
        $this->db->where('ppid.aktif', '1');
        $this->db->where('ppid.dihapus_pada', NULL);
        $this->db->order_by("ppid.id", "DESC");
        $list_data = $this->db->get()->result_array();

        $no = 0;
        $jum = count($list_data);
        $data = array();
        foreach ($list_data as $key => $value) {
            $no++;
            $row                            =  array();
            $row['no']                      = $no;
            $row['id']                      = $value['id'];
            $row['id_kategori']             = $value['id_kategori'];
            $row['kategori']                = $value['kategori'];
            $row['judul']                   = $value['judul'];
            $row['konten']                  = $this->ppid->str_clean_tag(($value['konten']), 100);
            $row['tanggal']                 = ($value['tanggal']  != '0000-00-00') ? $this->ppid->d($value['tanggal'])  : '00-00-0000';
            if ($value['link'] != '' && $value['link'] != null) {
                $link_file        = 'http://' . $value['link'] . '';
            } else {
                $link_file        = '';
            }

            if ($value['file'] != '' && $value['file'] != null) {
                $lihat_file        = base_url('uploads/ppid/' . $value['file'] . '');
            } else {
                $lihat_file        = '';
            }
            if ($value['link'] != '' && $value['link'] != null) {
                $btn_file = $link_file;
            } else {
                $btn_file = $lihat_file;
            }
            $row['file']        = $btn_file;
            $data[]             = $row;
        }
        $output = array(
            "recordsTotal"  =>  $jum,
            "data"          => $data
        );
        echo json_encode($output);
    }

    public function prosesTambah()
    {
        $link               = $this->input->post('link');
        if ($_FILES['file'] != '') {
            $config['encrypt_name']     = TRUE;
            $config['allowed_types']    = 'jpg|png|jpeg|pdf|doc|docx|xlsx|csv|xls';
            $config['upload_path']      = 'uploads/ppid';
            $this->upload->initialize($config);
            if ($this->upload->do_upload('file')) {
                $file_name  = $this->upload->data('file_name');
            } else {
                $file_name  =  "";
            }
        } else {
            $file_name      = "";
        }

        $data = array(
            'id_kategori'       => $this->input->post('id_kategori'),
            'id_periode'        => $this->session->userdata('id_periode'),
            'judul'             => $this->input->post('judul'),
            'konten'            => $this->input->post('konten'),
            'link'              => replace_link_http($link),
            'file'              => $file_name,
            'tanggal'           => date('Y-m-d'),
            'aktif'             => '1',
        );
        $proses = $this->ppid->tambah($data, 'ppid');
        echo json_encode("ok");
    }

    public function prosesUbah()
    {
        $id                 = $this->input->post('id');
        $kosongkan_file     = $this->input->post('kosongkan_file');
        $link               = $this->input->post('link');
        $get_data           = $this->db->where('id', $id)->get('ppid')->row_array();
        $config = array(
            'encrypt_name'  => TRUE,
            'upload_path'   => "uploads/ppid",
            'allowed_types' => 'jpg|png|jpeg|pdf|doc|docx|xlsx|csv|xls'
        );
        $this->upload->initialize($config);
        if ($_FILES['file'] != '') {
            if (!$this->upload->do_upload('file')) {
                $file_name = $get_data['file'];
            } else {
                $file_name = $this->upload->data('file_name');
                if ($get_data['file'] != '') {
                    unlink('./uploads/ppid/' . $get_data['file']);
                }
            }
        } else {
            $file_name = '';
        }

        $where = array(
            'id' => $this->input->post('id')
        );
        $data = array(
            'id_kategori'       => $this->input->post('id_kategori'),
            'judul'             => $this->input->post('judul'),
            'konten'            => $this->input->post('konten'),
            'link'              => replace_link_http($link),
            'file'              => $file_name,
            'diubah_pada'       => date("Y-m-d H:i:s")
        );
        $proses = $this->ppid->ubah($data, $where, 'ppid');
        echo json_encode("ok");
    }

    public function get_id()
    {
        $where = array(
            'id'            => $this->input->post('id') ? $this->input->post('id') : 0,
        );
        $data                   = $this->ppid->get_detail($where, 'ppid');
        $data['id_kategori']    = $data['id_kategori'];
        $data['tanggal']        = ($data['tanggal'] != '0000-00-00') ? $this->ppid->formatTanggal($data['tanggal']) : '00-00-0000';
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
        $proses = $this->ppid->ubah($data, $where, 'ppid');
        echo json_encode("ok");
    }
    public function select_kategori()
    {
        $where = array(
            'aktif'         => '1',
            'dihapus_pada'  => NULL
        );
        $data = $this->ppid->get_data($where, 'kategori_ppid', 'id,nama_kategori AS kategori');
        echo json_encode($data);
    }
}
