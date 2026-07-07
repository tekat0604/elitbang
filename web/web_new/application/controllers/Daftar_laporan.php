<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Daftar_laporan extends CI_Controller
{
    private $base = 'frontend';
    function __construct()
    {
        parent::__construct();
        $this->load->model('PageModel', 'page');
    }

    public function index()
    {
        $data = [
            'li_informasi' => 'active',
        ];
        $this->template->content_frontend("$this->base/daftar_laporan/ulas", $data);
    }

    public function index_old()
    {
        $max_per_page = 4;

        $total_data =  $this->db->get('tabel_lapor')->num_rows();
        $base_url = '?order=terbaru';

        if (isset($_GET['per_page'])) {
            $per_page = (int)$this->input->get('per_page');
            $this->db->limit($max_per_page, ($per_page - 1) * $max_per_page);
        } else {
            $this->db->limit($max_per_page, 0);
        }

        $lapor = $this->db->order_by('created DESC')->where('status_ditangani', '1')->get('tabel_lapor')->result();
        $pagging = $this->buat_pagging($total_data, $base_url, TRUE);

        $data = [
            'li_informasi' => 'active',
            //'extra_js' => "$this->base/daftar_laporan/index_js",
            'pagging' => $pagging,
            'lapor' => $lapor
        ];

        $this->template->content_frontend("$this->base/daftar_laporan/index", $data);
    }

    function buat_pagging($total_data, $base_url, $page_query_string)
    {
        //pagination
        $this->load->library('pagination');
        $config['base_url'] = $base_url;
        $config['total_rows'] = $total_data;
        $config['per_page'] = 4;
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
        $config['first_link'] = '«';
        $config['last_link'] = '»';
        $config['next_link'] = false;
        $config['prev_link'] = false;
        $this->pagination->initialize($config);
        return $this->pagination->create_links();
        //pagination end
    }

    public function detail($_id = null)
    {
        if (@$_id) {
            $id = real_id($_id);
            if ($id != '') {
                $get = $this->db->where(['id_lapor' => $id])->get('tabel_lapor');
                if ($get->num_rows() == 1) {
                    $row = $get->row();
                    $kategori = $this->db->select('id,nama_kategori_bencana')->get('ref_kategori_bencana')->result_array();
                    $data = [
                        'li_informasi' => 'active',
                        'extra_js' => "$this->base/daftar_laporan/detail_js",
                        'row' => $row,
                        'kategori' => $kategori
                    ];
                    $this->template->content_frontend("$this->base/daftar_laporan/detail", $data);
                } else {
                    redirect('daftar_laporan');
                }
            } else {
                redirect('daftar_laporan');
            }
        } else {
            redirect('daftar_laporan');
        }
    }

    public function daftar_laporan_mobile()
    {
        $max_per_page = 4;

        $total_data =  $this->db->get('tabel_lapor')->num_rows();
        $base_url = '?order=terbaru';

        if (isset($_GET['per_page'])) {
            $per_page = (int)$this->input->get('per_page');
            $this->db->limit($max_per_page, ($per_page - 1) * $max_per_page);
        } else {
            $this->db->limit($max_per_page, 0);
        }

        $lapor = $this->db->order_by('created DESC')->where('status_ditangani', '1')->get('tabel_lapor')->result();
        $pagging = $this->buat_pagging($total_data, $base_url, TRUE);

        $data = [
            'li_informasi' => 'active',
            //'extra_js' => "$this->base/daftar_laporan/index_js",
            'pagging' => $pagging,
            'lapor' => $lapor
        ];

        $this->template->content_mobile_frontend("$this->base/daftar_laporan/index_mobile", $data);
    }
    public function detail_mobile($_id = null)
    {
        if (@$_id) {
            $id = real_id($_id);
            if ($id != '') {
                $get = $this->db->where(['id_lapor' => $id])->get('tabel_lapor');
                if ($get->num_rows() == 1) {
                    $row = $get->row();
                    $kategori = $this->db->select('id,nama_kategori_bencana')->get('ref_kategori_bencana')->result_array();
                    $data = [
                        'li_informasi' => 'active',
                        'extra_js' => "$this->base/daftar_laporan/detail_mobile_js",
                        'row' => $row,
                        'kategori' => $kategori
                    ];
                    $this->template->content_mobile_frontend("$this->base/daftar_laporan/detail_mobile", $data);
                } else {
                    redirect('daftar_laporan/daftar_laporan_mobile');
                }
            } else {
                redirect('daftar_laporan/daftar_laporan_mobile');
            }
        } else {
            redirect('daftar_laporan/daftar_laporan_mobile');
        }
    }
}
