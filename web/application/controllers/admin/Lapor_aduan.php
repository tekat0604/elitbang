<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lapor_aduan extends MY_Controller
{
    private $base           = 'admin';
    private $menu           = 'lapor_aduan';
    private $folder_upload  = 'lapor_aduan';
    private $table          = 'tabel_lapor_aduan';

    function __construct()
    {
        parent::__construct();
        $this->load->model('Table_lapor_aduan', 'm_table');
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
        if ($this->session->userdata('role') != 1) {
            redirect('login');
        }
        $this->link_url = base_url('admin/lapor_aduan/');
    }

    public function index()
    {
        $data_js['title']       = 'Lapor Aduan';
        $data_js['link_url']    =  $this->link_url;
        $data               = [
            'title'         => 'Lapor Aduan',
            'kecamatan'     => $this->select_kecamatan(),
            'kategori'      => $this->select_kategori_bencana(),
            'isi'           => "$this->base/$this->menu/index",
            'modal'         => array(
                $this->load->view("$this->base/$this->menu/modal", '', true),
            ),
            'extra_css'     => $this->load->view("$this->base/$this->menu/index_css", $data_js, true),
            'extra_js'      => $this->load->view("$this->base/$this->menu/index_js", '', true),
        ];
        $this->load->view('layouts/wrapper', $data, FALSE);
    }

    public function datatable()
    {
        echo $this->m_table->generate_table();
    }

    public function detail()
    {
        $id             =  $this->uri->segment(4);
        $row            = $this->get_detail($id);
        $data_js        =  [
            'data'      => @$row,
            'link_url'  => $this->link_url,
        ];
        $data           = [
            'isi'       => "$this->base/lapor_aduan/detail",
            'link_url'  => $this->link_url,
            'extra_css'  => $this->load->view("$this->base/lapor_aduan/detail_css", $data_js, true),
            'extra_js'  => $this->load->view("$this->base/lapor_aduan/detail_js", $data_js, true),
            'data'      => @$row,
        ];
        $this->load->view('layouts/wrapper', $data, FALSE);
    }

    public function detail_old()
    {
        $id             =  $this->uri->segment(4);
        $data           = [
            'folder'    => $this->folder_upload,
            'data'      => $this->db->query("SELECT * from {$this->table} where id = {$id} AND dihapus_pada is null")->row(),
        ];
        $html           = $this->load->view('admin/' . $this->menu . '/detail', $data, true);
        $output         = [
            'status'    => 'success',
            'html'      => $html,
        ];
        echo json_encode($data);
    }


    public function do_submit()
    {
        cek_post();
        $id             = $this->input->post('id');
        $balasan        = $this->input->post('balasan');
        $this->db->where('id', $id);
        $this->db->update($this->table, [
            'diubah_oleh'       => $this->session->userdata('id'),
            'balasan'           => $this->session->userdata('balasan'),
            'diubah_pada'       => date('Y-m-d H:i:s'),
        ]);
        $output         = [
            'status'    => 'success',
            'msg'       => 'Data berhasil tersimpan',
        ];
        echo json_encode($output);
    }

    public function get_detail($id)
    {
        $select = " a.id, a.dibuat_pada, 
        a.nama, a.email, a.no_hp, a.subjek, a.pesan, a.image, 
        a.detail_lokasi,  a.latitude, a.longitude, 
        b.nama_kategori_bencana AS kategori_bencana,  
        c.nama AS kecamatan, d.nama AS kelurahan 
        ";
        $this->db->select($select);
        $this->db->from('tabel_lapor_aduan a');
        $this->db->join('ref_kategori_bencana b', 'b.id = a.id_kategori', 'LEFT');
        $this->db->join('tabel_kecamatan c', 'a.id_kecamatan = c.id_kecamatan', 'LEFT');
        $this->db->join('tabel_kelurahan d', 'a.id_kelurahan = d.id_kelurahan', 'LEFT');
        $this->db->where('a.dihapus_pada is NULL', NULL);
        $this->db->where('a.id', $id);
        $query = $this->db->get();
        $data = $query->row();
        return $data;
    }

    public function api_peta()
    {
        $select = " 'Point' AS type, a.id_lapor, a.dibuat_pada, 
        a.nama, a.email, a.no_hp, a.subjek, a.pesan, a.image, 
        a.detail_lokasi, 
        a.read, a.latitude, a.longitude, 
        CASE  
        WHEN a.read  = '0' AND a.status_ditangani  = '0'  THEN 'belum dibaca'  
        WHEN a.read  = '1' AND a.status_ditangani  = '0'  THEN 'sudah dibaca'  
        WHEN a.read  = '1' AND a.status_ditangani  = '1'  THEN 'sudah ditangani'  
        ELSE 'belum dibaca' END AS status, 
        CASE  
        WHEN a.read  = '0' AND a.status_ditangani  = '0'  THEN 'red'  
        WHEN a.read  = '1' AND a.status_ditangani  = '0'  THEN 'orange'  
        WHEN a.read  = '1' AND a.status_ditangani  = '1'  THEN 'green'  
        ELSE 'red' END AS color, 
        ref_kategori_bencana.nama_kategori_bencana AS kategori_bencana ";
        $this->db->select($select);
        $this->db->from('tabel_lapor_aduan a');
        $this->db->join('ref_kategori_bencana', 'ref_kategori_bencana.id = a.id_kategori', 'LEFT');
        $this->db->where('a.dihapus_pada is NULL', NULL);
        $this->db->order_by('a.id', 'ASC');
        $data_peta = $this->db->get()->result_array();
        $json = array();
        foreach ($data_peta as $dt_pt) {
            if ($dt_pt['image'] != '' && $dt_pt['image'] != null) {
                $img = base_url('/uploads/lapor/' . $dt_pt["image"] . '');
            } else {
                $img = '';
            }
            $json[]                 = array(
                "type"              => "Feature",
                "geometry"          => array(
                    "type"          => "Point",
                    "coordinates"   => array(
                        $dt_pt['longitude'], $dt_pt['latitude']
                    ),
                ),
                "properties"            => array(
                    "id"                => $dt_pt['id_lapor'],
                    "nama"              => $dt_pt['nama'],
                    "email"             => $dt_pt['email'],
                    "no_hp"             => $dt_pt['no_hp'],
                    "kategori_bencana"  => $dt_pt['kategori_bencana'],
                    "subjek"            => $dt_pt['subjek'],
                    "tanggal"           => tgl_indo($dt_pt['dibuat_pada'], true),
                    "img"               => $img,
                    "pesan"             => $dt_pt['pesan'],
                    "detail_lokasi"     => $dt_pt['detail_lokasi'],
                    "status"            => $dt_pt['status'],
                    "color"             => $dt_pt['color'],
                    "latitude"          => $dt_pt['latitude'],
                    "longitude"         => $dt_pt['longitude'],
                    "link_detail"       => base_url('admin/lapor_aduan/detail/' . $dt_pt['id'])
                )
            );
        }
        $res['type']        = "FeatureCollection";
        $res['features']    = $json;
        echo json_encode($res);
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
        $data = $this->db->get()->result_array();
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

    public function testing_email()
    {
        $balasan = "sudah kami tangani ni bos, silahkan dicek kembali ";
        $data['pengirim'] = 'Subagiono';
        $data['new_message'] = nl2br($balasan);

        # START send email
        $message = $this->load->view('admin/lapor_aduan/template_balasan', $data, true);
        $this->load->library('email');
        $this->email->initialize(array(
            'protocol'    => 'smtp',
            'smtp_host'   => 'smtp.sendgrid.net',
            'smtp_user'   => 'ikkinaii@gmail.com',
            'smtp_pass'   => 'Kemiri270912',
            'smtp_port'   => 587,
            'crlf'        => "\r\n",
            'newline'     => "\r\n"
        ));

        $this->email->from('noreply', 'Testing BPBD Kota Surakarta');
        $this->email->to('subagisubagi@gmail.com');
        $this->email->subject('Respon Pengaduan dari BPBD Kota Surakarta');
        $this->email->set_mailtype('html');
        $this->email->message($message);
        $this->email->send();
        echo json_encode('success');
    }


    public function kirim_email()
    {
        $this->load->library('email');
        $alamat_email       = 'subagisubagi@gmail.com';
        $kode               = '1q2w3e4r';
        $created            = '';
        $html               =  '<h1 style="color: #ffcc00;"> Konten HTML </h1>';

        $this->email->from('work_alief@outlook.com', 'E-PPID KEMENKO MARVES'); // Ganti dengan alamat email dan nama pengirim
        $this->email->to($alamat_email); // Ganti dengan alamat email penerima
        $this->email->subject('Kode Verifikasi (E-PPID KEMENKO MARVES)');
        $this->email->message($html);

        if ($this->email->send()) {
            $output         = [
                'status'    => 'success',
                'msg'       => 'Berhasil Terkirim',
            ];
        } else {
            $output         = [
                'status'    => 'success',
                'msg'       => 'Gagal Terkirim',
            ];
        }
        echo json_encode($output);
    }
}
