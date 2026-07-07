<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Frontend extends MY_Controller
{
    private $base = 'frontend';
    function __construct()
    {
        parent::__construct();
        // $this->load->model('websiteModel', 'website');
        // $this->load->model('CrudModel', 'crud');
        $this->load->model('PageModel', 'page');
        $this->load->model('frontend/FrontendModel', 'front');
        $this->load->model('PetaQuery');
        // $this->load->library('Datatables');
        insert_visitor();
    }

    public function index()
    {
        //Slider
        $this->db->select('id, judul, konten, image, link');
        $this->db->from('grid_home');
        $this->db->where('jenis', '1');
        $this->db->where('aktif', '1');
        $this->db->where('dihapus_pada', NULL);
        $list_slider = $this->db->get()->result_array();

        //Pesan SIngkat
        $where = array(
            'aktif'         => '1',
            'dihapus_pada'  => NULL
        );
        $this->db->select('id, judul, konten');
        $this->db->from('pesan_singkat');
        $this->db->where($where);
        $list_pesan_singkat = $this->db->get()->result_array();

        //Grid 2
        $this->db->select('id, judul, konten, image, link');
        $this->db->from('grid_home');
        $this->db->where('jenis', '2');
        $this->db->where('aktif', '1');
        $this->db->where('dihapus_pada', NULL);
        $list_grid2 = $this->db->get()->result_array();

        //Berita Terbaru 
        $this->db->select('id, judul, konten, image, tanggal');
        $this->db->from('menu');
        $this->db->where('id_menu_utama', '3');
        $this->db->where('aktif', '1');
        $this->db->where('dihapus_pada', NULL);
        $this->db->order_by("id", "DESC");
        $this->db->limit('5');
        $list_berita = $this->db->get()->result_array();

        //Agenda Kegiatan
        $this->db->select('id, judul, konten, image, tanggal');
        $this->db->from('menu');
        $this->db->where('id_menu_utama', '4');
        $this->db->where('aktif', '1');
        $this->db->where('dihapus_pada', NULL);
        $this->db->order_by("id", "DESC");
        $this->db->limit('4');
        $list_agenda_kegiatan = $this->db->get()->result_array();

        //Informasi Kebencanaan
        $this->db->select('id, judul, konten, image, tanggal');
        $this->db->from('menu');
        $this->db->where('id_menu_utama', '8');
        $this->db->where('aktif', '1');
        $this->db->where('dihapus_pada', NULL);
        $this->db->order_by("id", "DESC");
        $this->db->limit('5');
        $list_informasi_kebencanaan = $this->db->get()->result_array();

        //Unduhan
        $this->db->select('id, judul, konten AS file, tanggal');
        $this->db->from('menu');
        $this->db->where('id_menu_utama', '6');
        $this->db->where('aktif', '1');
        $this->db->where('dihapus_pada', NULL);
        $this->db->order_by("id", "DESC");
        $this->db->limit(6);
        $list_unduhan = $this->db->get()->result_array();

        $arr_loc = [];
        $get_loc = $this->PetaQuery->get_maps_ditangani($this->tahun);
        foreach ($get_loc->result() as $row) {
            if ($row->gambar != '' && $row->gambar != null) {
                $baris_img_lapor = '
                <tr>
                    <td> Foto </td>
                    <td> : </td>
                    <td> <img src=" ' . base_url('uploads/lapor/' . $row->gambar . '') . ' " style="width: 100px;"> </td>
                </tr>';
            } else {
                $baris_img_lapor = '';
            }
            $new = [];
            $new[] = '
            <div style="max-width: 360px; z-index: 99999999!important; display: block;">

            <table id="tabel_pesebaran" class="table" style="width: 100%;">
                <tr>
                    <td style="width: 50px; border-top: none;"> Subjek </td>
                    <td style="width: 5px; border-top: none;"> : </td>
                    <td style="width: 300px; border-top: none;"> ' . $row->subjek . ' </td>
                </tr>
                <tr>
                    <td> Tanggal </td>
                    <td> : </td>
                    <td> ' . tgl_indo($row->created, true) . '</td>
                </tr>
                ' . $baris_img_lapor . ' 
                <tr>
                    <td> Lokasi </td>
                    <td> : </td>
                    <td> ' . $row->lokasi . '</td>
                </tr>
                <tr>
                    <td> Link </td>
                    <td> : </td>
                    <td> 
                        <a href="' . base_url('daftar_laporan/detail/' . custom_id($row->id_lapor)) . '" target="_blank" 
                        class="btn btn-primary btn-sm" style="color: #FFF;"> Detail <i class="fa fa-arrow-right"></i> </a>
                    </td>
                </tr>
            </table>
            </div>';
            $new[] = $row->lat;
            $new[] = $row->lng;
            $arr_loc[] = $new;
        }

        $data = [
            'li_beranda'            => 'active',
            'slider'                => $list_slider,
            'pesan_singkat'         => $list_pesan_singkat,
            'grid2'                 => $list_grid2,
            'list_berita'           => $list_berita,
            'agenda_kegiatan'       => $list_agenda_kegiatan,
            'informasi_kebencanaan' => $list_informasi_kebencanaan,
            'unduhan'               => $list_unduhan,
            //'isi'                 => "home/index",
            'locations'             => $arr_loc,
            'extra_js'              => "$this->base/home/index_new_js",
        ];
        $this->template->content_frontend("$this->base/home/index", $data);
    }

    public function berita()
    {
        //konfigurasi pagination
        $this->load->library('pagination');
        $config['base_url'] = site_url('frontend/berita'); //site url
        $config['total_rows'] = $this->db->where(['id_menu_utama' => 3, 'dihapus_pada IS NULL'])->get('menu')->num_rows(); //total row
        $config['per_page'] = 6;  //show record per halaman
        $config['query_string_segment'] = 'start';
        $config['full_tag_open'] = '<ul class="pagination" style="margin-top:0px">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = 'Prev';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);

        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $berita_terbaru = $this->db->select('id,judul,konten,image,tanggal,dibuat_pada')->where(['id_menu_utama' => 3, 'dihapus_pada IS NULL'])->limit(6)->order_by('tanggal DESC, dibuat_pada DESC')->get('menu')->result();

        //$berita_archive = $this->db->query('SELECT COUNT(1) as jumlah, MONTH(dibuat_pada) as bulan, YEAR(dibuat_pada) as tahun FROM `frontend_berita` WHERE tampil="1" AND aktif="1" AND dihapus_pada IS NULL GROUP BY MONTH(dibuat_pada)')->result();
        $data = [
            'li_berita' => 'active',
            //'data' => $this->front->get_berita_list($config["per_page"], $data['page']),
            'data' => $this->front->get_berita_list($config["per_page"], $data['page']),
            'berita_terbaru' => $berita_terbaru,
            //'berita_archive' => $berita_archive,
            'pagination' => $this->pagination->create_links(),
            // 'isi' => "berita/index",
            'extra_js' => "$this->base/berita_v2/index_js",
        ];

        $this->template->content_frontend("$this->base/berita_v2/index", $data);
    }

    public function detail_berita($slug)
    {
        $slug = str_replace('-', ' ', $slug);
        $detail = $this->db->join('user_login', 'frontend_berita.dibuat_oleh = user_login.id_user', 'LEFT')->join('user_detail', 'user_login.id_user = user_detail.id_user_detail', 'LEFT')->where('judul', $slug)->get('frontend_berita')->row();
        $berita_terbaru = $this->db->select('judul, gambar1, dibuat_pada')->where(['aktif' => '1', 'tampil' => '1', 'dihapus_pada IS NULL'])->limit(4)->order_by('dibuat_pada')->get('frontend_berita')->result();

        $data = [
            'data' => $this->front->get_berita_list($config["per_page"], $data['page']),
            'berita_terbaru' => $berita_terbaru,
            'berita_archive' => $berita_archive,
            'pagination' => $this->pagination->create_links(),
            // 'isi' => "berita/detail",
            'extra_js' => "$this->base/berita/index_js",
        ];

        $this->template->content_frontend("$this->base/berita/detail", $data);
    }

    public function profil()
    {
        $get_profil     = $this->page->get_detail(['id' => 1, 'id_menu_utama' => 2], 'menu', 'konten,image');
        $get_tusi       = $this->page->get_detail(['id' => 2, 'id_menu_utama' => 2], 'menu', 'konten');
        $get_visi       = $this->page->get_detail(['id' => 3, 'id_menu_utama' => 2], 'menu', 'konten');
        $get_struktur   = $this->page->get_detail(['id' => 4, 'id_menu_utama' => 2], 'menu', 'image');
        $profil_pejabat = $this->db->query("SELECT * FROM profil_anggota WHERE jenis = '1' AND aktif = '1' AND dihapus_pada is NULL")->result_array();
        $profil_pegawai = $this->db->query("SELECT * FROM profil_anggota WHERE jenis = '2' AND aktif = '1' AND dihapus_pada is NULL")->result_array();

        $data = [
            'li_profil'         => 'active',
            'extra_css'         => "$this->base/profil/index_css",
            'extra_js'          => "$this->base/profil/index_js",
            'profil'            => $get_profil,
            'tusi'              => $get_tusi,
            'visi'              => $get_visi,
            'struktur'          => $get_struktur,
            'profil_pejabat'    => $profil_pejabat,
            'profil_pegawai'    => $profil_pegawai,
        ];

        $this->template->content_frontend("$this->base/profil/index", $data);
    }

    public function unduhan_desktop()
    {
        $data = [
            'li_unduhan' => 'active',
            'extra_js' => "$this->base/unduhan/index_js",
        ];
        $this->template->content_frontend("$this->base/unduhan/index", $data);
    }

    public function unduhan()
    {
        $data = [
            'extra_css'     => "$this->base/unduhan/index_responsive_css",
            'extra_js'      => "$this->base/unduhan/index_js",
        ];
        $this->template->content_frontend("$this->base/unduhan/index_responsive", $data);
    }

    public function kontak()
    {

        $data = [
            // 'isi' => "kontak/index",
            'extra_js' => "$this->base/kontak/index_js",
        ];
        $this->template->content_frontend("$this->base/kontak/index", $data);
    }

    public function lapor()
    {
        $kategori = $this->db->where('dihapus_pada is null', null, false)->select('id,nama_kategori_bencana')->get('ref_kategori_bencana')->result_array();
        $data = [
            'li_lapor' => 'active',
            'extra_js'  => "$this->base/lapor/index_js",
            'kategori' => $kategori
        ];
        $this->template->content_frontend("$this->base/lapor/index", $data);
    }

    public function lapor_mobile()
    {
        $kategori = $this->db->where('dihapus_pada is null', null, false)->select('id,nama_kategori_bencana')->get('ref_kategori_bencana')->result_array();
        $data = [
            'li_lapor'  => 'active',
            'extra_js'  => "$this->base/lapor/index_mobile_js",
            'kategori'  => $kategori
        ];
        $this->template->content_mobile_frontend("$this->base/lapor/index_mobile", $data);
    }


    public function galeri()
    {
        $get_album = $this->page->get_data(['aktif' => '1', 'dihapus_pada' => null, 'id_menu_utama' => 7], 'menu', 'id,judul,image,tanggal');

        $data = [
            'add_plugin_galeri' => true,
            'li_galeri' => 'active',
            'extra_js' => "$this->base/galeri/index_js",
            'album' => $get_album
        ];

        $this->template->content_frontend("$this->base/galeri/index", $data);
    }

    function photos()
    {
        if (@$this->input->get('date') && @$this->input->get('id')) {

            $get_detail = $this->page->get_detail(['id_menu_utama' => 7, 'id' => $this->input->get('id'), 'tanggal' => $this->input->get('date')], 'menu', 'judul,konten');

            $get_photos = $this->page->get_data(
                ['aktif' => '1', 'dihapus_pada' => null, 'id_menu' => $this->input->get('id')],
                'sub_menu',
                'judul,konten,jenis,link,image'
            );

            $data = [
                'add_plugin_galeri' => true,
                'li_galeri' => 'active',
                'extra_js' => "$this->base/galeri/photos_js",
                'photos' => $get_photos,
                'detail' => $get_detail
            ];

            $this->template->content_frontend("$this->base/galeri/photos", $data);
        } else {
            redirect('frontend/galeri');
        }
    }
    function foto_video()
    {
        $data = [
            'add_plugin_galeri' => true,
            'li_galeri' => 'active',
            'extra_js' => "$this->base/galeri/foto_video_js",
        ];
        $this->template->content_frontend("$this->base/galeri/foto_video", $data);
    }
    function get_kategori()
    {
        $this->db->select('id, nama_kategori_menu as nama_kategori');
        $this->db->from('kategori_menu');
        $this->db->where('id_menu_utama', '3');
        $this->db->where('aktif', '1');
        $this->db->where('dihapus_pada', NULL);
        $this->db->order_by("id", "ASC");
        $data = $this->db->get()->result_array();
        echo json_encode($data);
    }
}
/* End of file Front.php */
