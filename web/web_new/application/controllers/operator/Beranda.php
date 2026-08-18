<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        // $this->load->model('PetaModel', 'peta');
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
        if ($this->session->userdata('role') != 4) {
            redirect('login');
        }
        // redirect('admin/grafik/grafik_laporan');
    }
    private $base = 'operator';
    public function index()
    {
        $this->session->unset_userdata('id_pengaduan');
        $data = [
            'isi' => 'operator/beranda/index',
            // 'extra_css'  => $this->load->view("$this->base/beranda/index_css", '', true),
            'extra_js' => $this->load->view("$this->base/beranda/index_js", '', true),
        ];
        $this->load->view('layouts/wrapper', $data, FALSE);

    }
    function api()
    {
        //DATA JUMLAH TOTAL KERUSAKAN FASILITAS
        $data_total_laporan = array();
        $this->db->select('tabel_kerusakan_fasilitas.id_kerusakan_fasilitas AS id_kategori, tabel_kerusakan_fasilitas.kategori AS kategori,COUNT(*) as total_laporan');
        $this->db->from('tabel_kerusakan_fasilitas');
        $this->db->where('tabel_kerusakan_fasilitas.aktif', '1');
        $this->db->where('tabel_kerusakan_fasilitas.dihapus_pada is NULL');
        $this->db->group_by('tabel_kerusakan_fasilitas.kategori');
        $list_laporan = $this->db->get()->result_array();
        foreach ($list_laporan as $key => $value) {
            $row = array();
            $row['id_kategori'] = $value['id_kategori'];
            $row['kategori'] = $value['kategori'];
            $row['total_laporan'] = ($value['total_laporan'] != null) ? $value['total_laporan'] : '0';
            $data_total_laporan[] = $row;
        }

        //DATA JUMLAh RELAWAN
        $data_total_berita = array();
        $this->db->select('tabel_relawan.id_relawan AS id_kategori, tabel_relawan.kategori AS kategori,COUNT(*) as total_berita');
        $this->db->from('tabel_relawan');
        $this->db->where('tabel_relawan.aktif', '1');
        $this->db->where('tabel_relawan.dihapus_pada is NULL');
        $this->db->group_by('tabel_relawan.kategori');
        $list_berita = $this->db->get()->result_array();
        foreach ($list_berita as $key => $value) {
            $row = array();
            $row['id_kategori'] = $value['id_kategori'];
            $row['kategori'] = $value['kategori'];
            $row['total_berita'] = ($value['total_berita'] != null) ? $value['total_berita'] : '0';
            $data_total_berita[] = $row;
        }

        //DATA JUMLAH Korban Jiwa 
        $data_total_korban = array();
        $this->db->select('tabel_korban_jiwa.id_korban_jiwa AS id_kategori, tabel_korban_jiwa.kategori AS kategori,COUNT(*) as total_korban');
        $this->db->from('tabel_korban_jiwa');
        $this->db->where('tabel_korban_jiwa.aktif', '1');
        $this->db->where('tabel_korban_jiwa.dihapus_pada is NULL');
        $this->db->group_by('tabel_korban_jiwa.kategori');
        $list_korban = $this->db->get()->result_array();
        foreach ($list_korban as $key => $value) {
            $row = array();
            $row['id_kategori'] = $value['id_kategori'];
            $row['kategori'] = $value['kategori'];
            $row['total_korban'] = ($value['total_korban'] != null) ? $value['total_korban'] : '0';
            $data_total_korban[] = $row;
        }
        $ip = $this->input->ip_address(); // Mendapatkan IP user
        $date = date("Y-m-d"); // Mendapatkan tanggal sekarang
        $waktu = time(); //
        $timeinsert = date("Y-m-d H:i:s");
        // Cek berdasarkan IP, apakah user sudah pernah mengakses hari ini
        $s = $this->db->query("SELECT * FROM visitor WHERE ip='" . $ip . "' AND date='" . $date . "'")->num_rows();
        $ss = isset($s) ? ($s) : 0;
        // Kalau belum ada, simpan data user tersebut ke database
        if ($ss == 0) {
            $this->db->query("INSERT INTO visitor(ip, date, hits, online, time) VALUES('" . $ip . "','" . $date . "','1','" . $waktu . "','" . $timeinsert . "')");
        }
        // Jika sudah ada, update
        else {
            $this->db->query("UPDATE visitor SET hits=hits+1, online='" . $waktu . "' WHERE ip='" . $ip . "' AND date='" . $date . "'");
        }
        $dbpengunjung = $this->db->query("SELECT COUNT(hits) as hits FROM visitor")->row();
        $bataswaktu = time() - 300;
        $rows = array();
        $rows['pengunjungonline'] = $this->db->query("SELECT * FROM visitor WHERE online > '" . $bataswaktu . "'")->num_rows(); // hitung pengunjung online
        $rows['pengunjunghariini'] = $this->db->query("SELECT * FROM visitor WHERE date='" . $date . "' GROUP BY ip")->num_rows(); // Hitung jumlah pengunjung        
        $rows['totalpengunjung'] = isset($dbpengunjung->hits) ? ($dbpengunjung->hits) : 0; // hitung total pengunjung        
        $pengunjung[] = $rows;

        $output = array(
            "data_laporan" => $data_total_laporan,
            "data_berita" => $data_total_berita,
            "data_korban" => $data_total_korban,
            "data_statistik" => $pengunjung,
        );
        echo json_encode($output);
    }



}

/* End of file Beranda.php */


?>