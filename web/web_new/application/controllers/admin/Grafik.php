<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Grafik extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
        if ($this->session->userdata('role') != 1) {
            redirect('login');
        }
    }
    public function index()
    {
        echo "";
    }
    public function grafik_laporan()
    {
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
        $pengunjunghariini = $this->db->query("SELECT * FROM visitor WHERE date='" . $date . "' GROUP BY ip")->num_rows(); // Hitung jumlah pengunjung        
        $dbpengunjung = $this->db->query("SELECT COUNT(hits) as hits FROM visitor")->row();
        $totalpengunjung = isset($dbpengunjung->hits) ? ($dbpengunjung->hits) : 0; // hitung total pengunjung        
        $bataswaktu = time() - 300;

        $pengunjungonline = $this->db->query("SELECT * FROM visitor WHERE online > '" . $bataswaktu . "'")->num_rows(); // hitung pengunjung online

        $data = [
            'li_attr' => ['li_lapor' => 'active'],
            'pengunjunghariini' => $pengunjunghariini,
            'totalpengunjung' => $totalpengunjung,
            'pengunjungonline' => $pengunjungonline,
            'isi' => "admin/grafik/laporan/index",
            'extra_js' => $this->load->view("admin/grafik/laporan/index_js", '', true),
        ];
        $this->load->view('layouts/wrapper', $data, FALSE);
    }
    function api()
    {
        //DATA JUMLAH TOTAL LAPORAN ADUAN 
        $data_total_laporan = array();
        $this->db->select('ref_kategori_bencana.id AS id_kategori, ref_kategori_bencana.nama_kategori_bencana AS kategori, 
        (select count(*) from tabel_lapor 
        where id_kategori=ref_kategori_bencana.id AND tabel_lapor.deleted_at is NULL  
        GROUP BY id_kategori) AS total_laporan');
        $this->db->from('ref_kategori_bencana');
        $this->db->where('ref_kategori_bencana.aktif', '1');
        $this->db->where('ref_kategori_bencana.dihapus_pada is NULL');
        $list_laporan = $this->db->get()->result_array();
        foreach ($list_laporan as $key => $value) {
            $row = array();
            $row['id_kategori'] = $value['id_kategori'];
            $row['kategori'] = $value['kategori'];
            $row['total_laporan'] = ($value['total_laporan'] != null) ? $value['total_laporan'] : '0';
            $data_total_laporan[] = $row;
        }

        //DATA JUMLAh TOTAL BERITA
        $data_total_berita = array();
        $this->db->select('kategori_menu.id AS id_kategori, kategori_menu.nama_kategori_menu AS kategori, 
        (select count(*) from menu 
        WHERE id_menu_utama="3" AND id_kategori_menu=kategori_menu.id AND aktif="1" AND dihapus_pada is NULL 
        GROUP BY id_kategori_menu) AS total_berita');
        $this->db->from('kategori_menu');
        $this->db->where('kategori_menu.aktif', '1');
        $this->db->where('kategori_menu.dihapus_pada is NULL');
        $list_berita = $this->db->get()->result_array();
        foreach ($list_berita as $key => $value) {
            $row = array();
            $row['id_kategori'] = $value['id_kategori'];
            $row['kategori'] = $value['kategori'];
            $row['total_berita'] = ($value['total_berita'] != null) ? $value['total_berita'] : '0';
            $data_total_berita[] = $row;
        }

        //DATA JUMLAH TOTAL BENCANA 
        $data_total_korban = array();
        $this->db->select('ref_kategori_bencana.id AS id_kategori, ref_kategori_bencana.nama_kategori_bencana AS kategori, 
        (select count(*) from korban_bencana 
        where id_kategori=ref_kategori_bencana.id AND korban_bencana.aktif="1" AND korban_bencana.dihapus_pada is NULL  
        GROUP BY id_kategori) AS total_korban');
        $this->db->from('ref_kategori_bencana');
        $this->db->where('ref_kategori_bencana.aktif', '1');
        $this->db->where('ref_kategori_bencana.dihapus_pada is NULL');
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
    function statistik()
    {
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
        $pengunjunghariini = $this->db->query("SELECT * FROM visitor WHERE date='" . $date . "' GROUP BY ip")->num_rows(); // Hitung jumlah pengunjung        
        $dbpengunjung = $this->db->query("SELECT COUNT(hits) as hits FROM visitor")->row();
        $totalpengunjung = isset($dbpengunjung->hits) ? ($dbpengunjung->hits) : 0; // hitung total pengunjung        
        $bataswaktu = time() - 300;

        $pengunjungonline = $this->db->query("SELECT * FROM visitor WHERE online > '" . $bataswaktu . "'")->num_rows(); // hitung pengunjung online
        $output = array(
            'pengunjunghariini' => $pengunjunghariini,
            'totalpengunjung' => $totalpengunjung,
            'pengunjungonline' => $pengunjungonline,
        );
        echo json_encode($output);
    }
}
?>