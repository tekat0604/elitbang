<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lapor extends MY_Controller
{
    private $base   = 'frontend';
    private $folder = 'lapor_leaflet';
    function __construct()
    {
        parent::__construct();
        $this->load->model('PageModel', 'page');
    }

    public function index()
    {

        $data               = [
            'li_lapor'      => 'active',
        ];
        $this->template->content_frontend("$this->base/$this->folder/ulas", $data);
    }

    public function lapor()
    {
        //captcha
        $cap = $this->captcha_create();

        //Kategori Bencana
        $this->db->select('id, nama_kategori_bencana');
        $this->db->from('ref_kategori_bencana');
        $this->db->where('aktif', '1');
        $this->db->where('dihapus_pada', NULL);
        $this->db->order_by("id", "ASC");
        $data_kategori      = $this->db->get()->result_array();
        $data               = [
            'li_lapor'      => 'active',
            'extra_css'     => "$this->base/$this->folder/index_css",
            'extra_js'      => "$this->base/$this->folder/index_js",
            'kategori'      => $data_kategori,
            'image'         => $cap['image']
        ];
        $this->session->set_userdata('mycaptcha', $cap['word']);
        $this->template->content_frontend("$this->base/$this->folder/index", $data);
    }
    public function mobile()
    {
        //captcha
        $cap = $this->captcha_create();

        //Kategori Bencana
        $this->db->select('id, nama_kategori_bencana');
        $this->db->from('ref_kategori_bencana');
        $this->db->where('aktif', '1');
        $this->db->where('dihapus_pada', NULL);
        $this->db->order_by("id", "ASC");
        $data_kategori      = $this->db->get()->result_array();
        $data               = [
            'li_lapor'      => 'active',
            'extra_css'     => "$this->base/$this->folder/index_css",
            'extra_js'      => "$this->base/$this->folder/index_js",
            'kategori'      => $data_kategori,
            'image'         => $cap['image']
        ];
        $this->session->set_userdata('mycaptcha', $cap['word']);
        $this->template->content_mobile_frontend("$this->base/$this->folder/index_mobile", $data);
    }

    function captcha_create()
    {
        $vals = array(
            'word'          => rand(1000, 9999),
            'img_path'      => './captcha/',
            'img_url'       => base_url() . 'captcha/',
            // 'font_path'  => './assets/fonts/font22.ttf',
            'img_width'     => '200',
            'img_height'    => 50,
            'border'        => 10,
            'expiration'    => 7200,
            'word_length'   => 4,
            'font_size'     => 30,
            'colors' => array(
                'background'    => array(255, 255, 255),
                'border'        => array(50, 50, 50),
                'text'          => array(0, 0, 0),
                'grid'          => array(255, 40, 40)
            )
        );

        // create captcha image
        $cap = create_captcha($vals);
        return $cap;
    }
    public function proses_old()
    {
    }
    public function proses()
    {
        $captcha            = $this->session->userdata('mycaptcha');
        $input_captcha      = $this->input->post('captcha', true);
        $kategori           = $this->input->post('kategori', true);
        $explode_kategori   = explode('|', $kategori);
        $this->load->library('upload');
        if ($_FILES['image']) {
            $config['allowed_types']    = 'jpg|png|jpeg|gif';
            $config['upload_path']      = 'uploads/lapor';
            $this->upload->initialize($config);
            if ($this->upload->do_upload('image')) {
                $data_file      = $this->upload->data();
                $file_name      = $data_file['raw_name'] . $data_file['file_ext'];
                $this->page->_create_thumbs('lapor', $file_name);
            } else {
                $file_name      = "";
            }
        } else {
            $file_name          = "";
        }

        $data_insert        = [
            'id_kategori'   => $explode_kategori[0],
            'kategori'      => $explode_kategori[1],
            'nama'          => $this->input->post('nama', true),
            'no_hp'         => $this->input->post('no_hp', true),
            'email'         => $this->input->post('email', true),
            'subjek'        => $this->input->post('subjek', true),
            'pesan'         => $this->input->post('pesan', true),
            'lokasi'        => $this->input->post('lokasi', true),
            'lokasi_detail' => $this->input->post('lokasi_detail', true),
            'lat'           => $this->input->post('lat', true),
            'lng'           => $this->input->post('lng', true),
            'created'       => date('Y-m-d H:i:s'),
            'gambar'        => $file_name
        ];
        if ($input_captcha != $captcha) {
            echo json_encode("captcha_salah");
        } else {
            if ($this->db->insert('tabel_lapor', $data_insert)) {
                $this->pusher_process();
            }
            echo json_encode("ok");
        }
    }
}
