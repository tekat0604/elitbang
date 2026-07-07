<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ppid extends CI_Controller
{
    private $base = 'frontend';
    private $folder = 'ppid';
    private $halaman = 'ppid';
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        //echo json_encode(get_menu_ppid());
    }
    public function kategori()
    {
        $id_kategori        = $this->uri->segment(3);
        $get_kategori       = $this->get_kategori($id_kategori);
        $data               = [
            'kategori_ppid' => $get_kategori->nama_kategori,
            'extra_css'     => "$this->base/ppid/kategori/index_css",
            'extra_js'      => "$this->base/ppid/kategori/index_js",
        ];
        $this->template->content_frontend("$this->base/ppid/kategori/index", $data);
    }

    public function get_kategori($id)
    {
        $this->db->where('id', $id);
        $this->db->where('aktif', '1');
        $this->db->select('id,nama_kategori');
        $this->db->from('kategori_ppid');
        $query = $this->db->get();
        $data = $query->row();
        return $data;
    }

    public function get_data()
    {
        $id_kategori = $this->input->get('id_kategori');
        $this->load->model('PageModel');
        $data = array();

        $where = array(
            'id_kategori'   => $id_kategori,
            'aktif'         => '1',
            //'dihapus_pada'  => NULL,
        );
        $list = $this->PageModel->get_data($where, 'ppid');

        $no = 0;
        foreach ($list as $field) {
            if ($field['link'] != '' && $field['link'] != null) {
                $link_file        = ' 
                <a href="http://' . $field['link'] . '" class="btn btn-primary" target="_blank">
                <i class="fa fa-eye"></i> Lihat </a>';
            } else {
                $link_file        = '';
            }

            if ($field['file'] != '' && $field['file'] != null) {
                $lihat_file        = ' <a href="' . base_url('uploads/ppid/' . $field['file'] . '') . '" class="btn btn-primary" target="_blank">
                <i class="fa fa-eye"></i> Lihat </a>';
            } else {
                $lihat_file        = '';
            }
            if ($field['link'] != '' && $field['link'] != null) {
                $btn_file = $link_file;
            } else {
                $btn_file = $lihat_file;
            }
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field['judul'];
            $row[] =  $btn_file;
            $data[] = $row;
        }

        $output = array(
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    public function get_data_()
    {
        $this->db->select(
            'ppid.id, ppid.id_kategori, kategori_ppid.nama_kategori as kategori, 
            ppid.judul, ppid.konten, ppid.file, ppid.tanggal'
        );
        $this->db->from('ppid');
        $this->db->join('kategori_ppid', 'kategori_ppid.id = ppid.id_kategori', 'LEFT');
        $this->db->where('ppid.id_periode', $this->session->userdata('id_periode'));
        $this->db->where('ppid.aktif', '1');
        $this->db->where('ppid.dihapus_pada', NULL);
        $this->db->order_by("ppid.id", "DESC");
        $list_data  = $this->db->get()->result_array();

        $no         = 0;
        $jum        = count($list_data);
        $data       = array();
        foreach ($list_data as $key => $value) {
            $no++;
            $row                            =  array();
            $row['no']                      = $no;
            $row['id']                      = $value['id'];
            $row['id_kategori']             = $value['id_kategori'];
            $row['kategori']                = $value['kategori'];
            $row['judul']                   = $value['judul'];
            $row['konten']                  = $this->str_clean_tag(($value['konten']), 100);
            //$row['tanggal']                 = ($value['tanggal']  != '0000-00-00') ? $this->d($value['tanggal'])  : '00-00-0000';
            if ($value['file'] != '' && $value['file'] != null) {
                $link_file        = base_url('uploads/ppid/' . $value['file'] . '');
            } else {
                $link_file        = '';
            }
            $row['file']        = $link_file;
            $data[]             = $row;
        }
        $output = array(
            "recordsTotal"  =>  $jum,
            "data"          => $data
        );
        echo json_encode($output);
    }

    function page($id)
    {
        //Konten Lainnya
        $this->db->select('id, judul, konten, image, tanggal');
        $this->db->from('page_ppid');
        $this->db->where('id !=', $id);
        $this->db->where('aktif', '1');
        $this->db->where('dihapus_pada', NULL);
        $this->db->order_by("id", "ASC");
        //$this->db->limit('5'); 
        $list_lainnya = $this->db->get()->result();
        //Detail Konten
        $get = $this->db->where(['id' => $id])->get('page_ppid');
        if ($get->num_rows() == 1) {
            $row = $get->row();
            $data = [
                'li_' . $this->halaman . '' => 'active',
                'row'                   => $row,
                'list_lainnya'          => $list_lainnya,
            ];
            $this->template->content_frontend("$this->base/$this->folder/page/detail", $data);
        } else {
            redirect($this->halaman);
        }
    }


    public function str_clean_tag($content, $limit)
    {
        $str_content = substr(strip_tags($content), 0, $limit);
        return $str_content;
    }
    public function d($d, $day = "")
    {
        $str = strtotime($d);
        //Array Hari
        $array_hari = array(1 => 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu');
        $hari = $array_hari[date('N', $str)];
        //Format Tanggal
        $tanggal = date('j', $str);
        //Array Bulan
        $array_bulan = array(1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
        $bulan = $array_bulan[date("n", $str)];
        //Format Tahun
        $tahun = date('Y', $str);
        if ($day == '') {
            $date = $tanggal . " " . $bulan . " " . $tahun;
        } else {
            $date = $hari . ', ' . $tanggal . " " . $bulan . " " . $tahun;
        }
        return $date;
    }
}
