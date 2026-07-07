<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends MY_Controller {

    function __construct(){
		parent::__construct();		
        $this->load->model('PetaModel', 'peta');
        if ( ! $this->session->userdata('logged_in')){ 
            redirect('login');
        }
        if($this->session->userdata('role') != 1){
            redirect('login');
        }
        redirect('admin/grafik/grafik_laporan');
    }

    public function index()
    {
     
        
        $chart = [];
        // Start Data Chart Dashboard
        $chart['user'] = count($this->db->get('user_login')->result_array());
        $chart['opd'] = count($this->db->get('tabel_referensi_opd')->result_array());
        $chart['layer'] = count($this->db->get('tabel_layer')->result_array());
        $chart['data_layer'] = count($this->db->get('tabel_collection')->result_array());
        // End Data Chart Dashboard
        $data_js = [];
        $data = [
            'isi' => 'admin/beranda/index',
            // 'extra_js' => 'admin/beranda/index_js',
            'extra_js' => $this->load->view('admin/beranda/index_js', $data_js, TRUE),
            'chart' => $chart
        ];
        $this->load->view('layouts/wrapper', $data, FALSE);
        
    }

    public function data_per_layer()
    {
        $q = "SELECT
        t2.nama_layer,
        COUNT(t1.id_collection) AS total
        FROM tabel_collection t1
        INNER JOIN tabel_layer t2 ON t2.id_layer = t1.id_layer
        GROUP BY t1.id_layer";
        $query['data'] = $this->db->query($q)->result_array();
        echo json_encode($query);
    }

    public function layer_per_opd()
    {
        $q = "SELECT
        t2.nama_opd,
        COUNT(t1.id_layer) AS total
        FROM tabel_layer t1
        INNER JOIN tabel_referensi_opd t2 ON t2.id_opd = t1.id_opd
        GROUP BY t1.id_opd";
        $query['data'] = $this->db->query($q)->result_array();
        echo json_encode($query);
    }

    public function data_per_opd()
    {
        $q = "SELECT
        t3.nama_opd,
        COUNT(t1.id_layer) AS total
        FROM tabel_layer t1
        INNER JOIN tabel_collection t2 ON t2.id_layer = t1.id_layer
        INNER JOIN tabel_referensi_opd t3 ON t3.id_opd = t1.id_opd
        GROUP BY t1.id_opd";
        $query['data'] = $this->db->query($q)->result_array();
        echo json_encode($query);
    }

    public function layer_per_grup_layer()
    {
        $q = "SELECT
        t2.nama_grup_layer,
        COUNT(t1.id_layer) AS total
        FROM tabel_layer t1
        INNER JOIN tabel_grup_layer t2 ON t2.id_grup_layer = t1.id_grup_layer
        GROUP BY t1.id_grup_layer";
        $query['data'] = $this->db->query($q)->result_array();
        echo json_encode($query);
    }

    public function data_per_grup_layer()
    {
        $q = "SELECT
        t2.nama_grup_layer,
        COUNT(t1.id_layer) AS total
        FROM tabel_layer t1
        INNER JOIN tabel_grup_layer t2 ON t2.id_grup_layer = t1.id_grup_layer
        INNER JOIN tabel_collection t3 ON t3.id_layer = t1.id_layer
        GROUP BY t1.id_grup_layer";
        $query['data'] = $this->db->query($q)->result_array();
        echo json_encode($query);
    }

    public function layer_per_jenis_peta()
    {
        $q = "SELECT
        t2.nama_jenis_peta,
        COUNT(t1.id_layer) AS total
        FROM tabel_layer t1
        INNER JOIN tabel_jenis_peta t2 ON t2.id_jenis_peta = t1.id_jenis_peta
        GROUP BY t1.id_jenis_peta";
        $query['data'] = $this->db->query($q)->result_array();
        echo json_encode($query);
    }

    public function data_per_jenis_peta()
    {
        $q = "SELECT
        t2.nama_jenis_peta,
        COUNT(t1.id_layer) AS total
        FROM tabel_layer t1
        INNER JOIN tabel_jenis_peta t2 ON t2.id_jenis_peta = t1.id_jenis_peta
        INNER JOIN tabel_collection t3 ON t3.id_layer = t1.id_layer
        GROUP BY t1.id_jenis_peta";
        $query['data'] = $this->db->query($q)->result_array();
        echo json_encode($query);
    }

    public function data_per_status()
    {
        $q = "SELECT
        IF(t1.`status` = 1, 'Data ditampilkan','Data disembunyikan') AS `status`,
        COUNT(t2.id_layer) AS total
        FROM tabel_layer t1
        INNER JOIN tabel_collection t2 ON t2.id_layer = t1.id_layer
        GROUP BY t1.`status`";
        $query['data'] = $this->db->query($q)->result_array();
        echo json_encode($query);
    }

    public function data_per_halaman_detail()
    {
        $q = "SELECT
        IF(t1.page_detail = 1, 'Halaman Detail Aktif','Halaman Detail Tidak Aktif') AS halaman_detail,
        COUNT(t1.id_collection) AS total
        FROM tabel_collection t1
        GROUP BY t1.page_detail";
        $query['data'] = $this->db->query($q)->result_array();
        echo json_encode($query);
    }

}

/* End of file Beranda.php */


?>