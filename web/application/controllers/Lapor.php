<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lapor extends MY_Controller
{
    private $base   = 'frontend';
    private $folder = 'lapor_leaflet';
    function __construct()
    {
        parent::__construct();
        $this->load->library('upload');
    }

    public function index()
    {
        $this->ulas();
    }


    public function ulas()
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
        $data               = [
            'li_lapor'      => 'active',
            'extra_css'     => "$this->base/lapor_aduan/index_css",
            'extra_js'      => "$this->base/lapor_aduan/index_js",
            'kategori'      => $this->select_kategori_bencana(),
            'kecamatan'     => $this->select_kecamatan(),
            'image'         => $cap['image']
        ];
        $this->session->set_userdata('mycaptcha', $cap['word']);
        $this->template->content_frontend("$this->base/lapor_aduan/index", $data);
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

    public function proses()
    {
        $captcha            = $this->session->userdata('mycaptcha');
        $input_captcha      = $this->input->post('captcha', true);
        if ($input_captcha != $captcha) {
            $output         = [
                'status'    => 'captcha_salah',
                'msg'       => 'Kode captcha salah , Silahkan isi kode dengan benar ',
            ];
            echo json_encode($output);
            die;
        }
        //
        $config_image       = array(
            'upload_path'   => "uploads/lapor",
            'allowed_types' => 'gif|jpg|png|jpeg'
        );
        $this->upload->initialize($config_image);
        if ($_FILES['image'] != '') {
            if (!$this->upload->do_upload('image')) {
                $image = '';
            } else {
                $image = $this->upload->data('file_name');
            }
        } else {
            $image = '';
        }
        $data_insert        = [
            'id_kategori'   => $this->input->post('id_kategori', true),
            'nama'          => $this->input->post('nama', true),
            'no_hp'         => $this->input->post('no_hp', true),
            'email'         => $this->input->post('email', true),
            'subjek'        => $this->input->post('subjek', true),
            'pesan'         => $this->input->post('pesan', true),
            'image'         => $image,
            'id_kecamatan'  => $this->input->post('id_kecamatan'),
            'id_kelurahan'  => $this->input->post('id_kelurahan'),
            'detail_lokasi' => $this->input->post('detail_lokasi'),
            'latitude'      => $this->input->post('latitude', true),
            'longitude'     => $this->input->post('longitude', true),
            'aktif'         => '1',
            'dibuat_pada'   => date('Y-m-d H:i:s'),
        ];
        $this->db->insert('tabel_lapor_aduan', $data_insert);
        $output         = [
            'status'    => 'success',
            'msg'       => 'Laporan Anda telah terkirim',
        ];
        echo json_encode($output);
    }

    public function select_kecamatan()
    {
        $this->db->select('id_kecamatan, nama');
        $this->db->from('tabel_kecamatan');
        $data = $this->db->get()->result();
        return $data;
    }

    public function select_kelurahan_by_kec()
    {
        $id_kecamatan = $this->input->post('kecamatan_id');
        $this->db->select('id_kelurahan, id_kecamatan, nama');
        $this->db->from('tabel_kelurahan');
        $this->db->where('id_kecamatan', $id_kecamatan);
        $data = $this->db->get()->result();
        echo json_encode($data);
    }

    public function select_kategori_bencana()
    {
        $this->db->select('id, nama_kategori_bencana');
        $this->db->from('ref_kategori_bencana');
        $this->db->where('aktif', '1');
        $data = $this->db->get()->result();
        return $data;
    }
}
