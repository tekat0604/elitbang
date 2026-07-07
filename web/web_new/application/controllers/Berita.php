<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Berita extends CI_Controller
{
    private $base = 'frontend';
    public function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $id = $this->input->get('id');
        $max_per_page = 6;

        if (@$id != '') {
            $this->db->where('id_kategori_menu', $id);
        }
        $this->db->where(['id_menu_utama' => 3]);
        $this->db->where('dihapus_pada IS NULL', null, false);
        $total_data = $this->db->get('menu')->num_rows();

        $base_url = '?order=terbaru';

        if (isset($_GET['per_page'])) {
            $per_page = (int)$this->input->get('per_page');
            $this->db->limit($max_per_page, ($per_page - 1) * $max_per_page);
        } else {
            $this->db->limit($max_per_page, 0);
        }

        if (@$id != '') {
            $this->db->where('id_kategori_menu', $id);
        }
        $berita = $this->db->select('id,judul,konten,image,tanggal,dibuat_pada')->where(['id_menu_utama' => 3])->where('dihapus_pada IS NULL', null, false)->order_by('tanggal DESC, dibuat_pada DESC')->get('menu')->result();
        $pagging = $this->buat_pagging($total_data, $base_url, TRUE);

        $data = [
            'li_berita' => 'active',
            'extra_js' => "$this->base/berita_v2/index_js",
            'pagging' => $pagging,
            'berita' => $berita
        ];

        $this->template->content_frontend("$this->base/berita_v2/index", $data);
    }

    function buat_pagging($total_data, $base_url, $page_query_string)
    {
        //pagination
        $this->load->library('pagination');
        $config['base_url'] = $base_url;
        $config['total_rows'] = $total_data;
        $config['per_page'] = 6;
        $config['num_links'] = 5;
        $config['use_page_numbers'] = TRUE;
        $config['page_query_string'] = $page_query_string;

		 // Membuat Style pagination
         $config['first_link']       = 'First';
         $config['last_link']        = 'Last';
        //  $config['next_link']        = 'Next';
        //  $config['prev_link']        = 'Prev';
         $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
         $config['full_tag_close']   = '</ul></nav></div>';
         $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
         $config['num_tag_close']    = '</span></li>';
         $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
         $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
         $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
         $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
         $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
         $config['prev_tagl_close']  = '</span>Next</li>';
         $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
         $config['first_tagl_close'] = '</span></li>';
         $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
         $config['last_tagl_close']  = '</span></li>';
         
        $this->pagination->initialize($config);
        return $this->pagination->create_links();
        //pagination end
    }

    function  detail($tanggal, $id)
    {
        # another news
        $berita = $this->db->select('id,judul,konten,image,tanggal,dibuat_pada')->where(['id_menu_utama' => 3, 'id!=' => $id])->where('dihapus_pada IS NULL', null, false)->order_by('tanggal DESC, dibuat_pada DESC')->limit(4)->get('menu')->result();

        $get = $this->db->where(['id_menu_utama' => 3, 'id' => $id, 'tanggal' => $tanggal])->get('menu');
        if ($get->num_rows() == 1) {
            $row = $get->row();
            $data = [
                'li_berita' => 'active',
                //'extra_js' => "$this->base/berita_v2/index_js",
                'row' => $row,
                'berita' => $berita
            ];

            $this->template->content_frontend("$this->base/berita_v2/detail", $data);
        } else {
            redirect('berita');
        }
    }
}
