<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends CI_Controller {

    function __construct(){
		parent::__construct();		
        $this->load->model('PetaModel', 'peta');
        if ( ! $this->session->userdata('logged_in')){ 
            redirect('login');
        }
        if($this->session->userdata('role') != 2){
            redirect('login');
        }
    }

    public function index()
    {
     
        
        $chart = [];
        // Start Data Chart Dashboard
        $chart['user'] = count($this->db->where('id_opd',$this->session->userdata('id_opd'))->get('user_detail')->result_array());
        $chart['ikon'] = count($this->db->where('id_opd',$this->session->userdata('id_opd'))->get('tabel_referensi_icon')->result_array());
        $chart['layer'] = count($this->db->where('id_opd',$this->session->userdata('id_opd'))->get('tabel_layer')->result_array());
        $chart['data_layer'] = count($this->db->query("select t2.id_collection from tabel_layer t1 inner join tabel_collection t2 on t2.id_layer = t1.id_layer where t1.id_opd = {$this->session->userdata('id_opd')}")->result_array());
        // End Data Chart Dashboard
        $data_js = [];
        $data = [
            'isi' => 'opd/beranda/index',
            // 'extra_js' => 'opd/beranda/index_js',
            'extra_js' => $this->load->view('opd/beranda/index_js', $data_js, TRUE),
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
        WHERE 1 = 1
        AND t2.id_opd = {$this->session->userdata('id_opd')}
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
        WHERE 1 = 1
        AND t1.id_opd = {$this->session->userdata('id_opd')}
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
        WHERE 1 = 1
        AND t1.id_opd = {$this->session->userdata('id_opd')}
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
        WHERE 1 = 1
        AND t1.id_opd = {$this->session->userdata('id_opd')}
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
        WHERE 1 = 1
        AND t1.id_opd = {$this->session->userdata('id_opd')}
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
        WHERE 1 = 1
        AND t1.id_opd = {$this->session->userdata('id_opd')}
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
        INNER JOIN tabel_layer t2 ON t2.id_layer = t1.id_layer
        WHERE 1 = 1
        AND t2.id_opd = {$this->session->userdata('id_opd')}
        GROUP BY t1.page_detail";
        $query['data'] = $this->db->query($q)->result_array();
        echo json_encode($query);
    }

}

/* End of file Beranda.php */


?>