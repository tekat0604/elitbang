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
        foreach ($berita as $dt_berita) {
            $dt_berita->link_detail = base_url('berita/detail/' . $dt_berita->tanggal . '/' . $dt_berita->id);
        }
        $pagging = $this->buat_pagging($total_data, $base_url, TRUE);

        $data               = [
            'li_berita'     => 'active',
            'extra_js'      => "$this->base/berita_v2/index_js",
            'pagging'       => $pagging,
            'berita'        => $berita
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

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='active'><a>";
        $config['cur_tag_close'] = "</a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
        //$config['display_pages'] = FALSE;
        $config['first_link'] = '<';
        $config['last_link'] = '>';
        $config['next_link'] = false;
        $config['prev_link'] = false;
        $this->pagination->initialize($config);
        return $this->pagination->create_links();
        //pagination end
    }

    function  detail($tanggal, $id)
    {
        # another news
        $berita = $this->db->select('id,judul,konten,image,tanggal,dibuat_pada')->where(['id_menu_utama' => 3, 'id!=' => $id])->where('dihapus_pada IS NULL', null, false)->order_by('tanggal DESC, dibuat_pada DESC')->limit(4)->get('menu')->result();

        $where_detail = [
            'id_menu_utama' => 3, 
            'id' => $id, 
            'dihapus_pada is null' => null, 
            'tanggal' => $tanggal
        ]; 

        $get = $this->db->where($where_detail)->get('menu');
        if ($get->num_rows() == 1) {
            $row = $get->row();
            $row->link_detail = base_url('berita/detail/' . $row->tanggal . '/' . $row->id);
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
