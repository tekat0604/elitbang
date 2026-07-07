<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agenda_pimpinan extends MY_Controller {
    private $base           = 'admin';
    private $menu           = 'agenda_pimpinan';
    private $table          = 'agenda_pimpinan';
    function __construct(){
        parent::__construct();
        $this->load->model('PageModel', 'page');
        if ( ! $this->session->userdata('logged_in')){ 
            redirect('login');
        }
        if($this->session->userdata('role') != 1){
            redirect('login');
        }
    }
    
    public function index()
    {
        $this->Agenda_pimpinan(); 
    }
    // Referensi Agenda_pimpinan
    public function Agenda_pimpinan()
    {
        $data = [
            'isi'       => "$this->base/frontend/profil/$this->menu/index",
            'modal'     => array(
                    $this->load->view("$this->base/frontend/profil/$this->menu/modal_tambah", '', true),
                    $this->load->view("$this->base/frontend/profil/$this->menu/modal_ubah", '', true),
                    $this->load->view("$this->base/frontend/profil/$this->menu/modal_hapus", '', true)
            ),
            'extra_css'  => $this->load->view("$this->base/frontend/profil/$this->menu/index_css", '', true),
            'extra_js'  => $this->load->view("$this->base/frontend/profil/$this->menu/index_js", '', true),
        ];
        $this->load->view('layouts/wrapper', $data, FALSE);   
    }

    public function prosesTambah(){
        $tanggal_kegiatan   = $this->input->post('tanggal_kegiatan') ? $this->page->formatDate($this->input->post('tanggal_kegiatan')) : '';
        $data = array(
            'id_periode'        => $this->session->userdata('id_periode'), 
            'nama_kegiatan'     => $this->input->post('nama_kegiatan'),
            'tempat_kegiatan'   => $this->input->post('tempat_kegiatan'),
            'tanggal_kegiatan'  => $tanggal_kegiatan,
            'aktif'             => '1',
        ); 
        $proses = $this->page->tambah($data,$this->table);
        echo json_encode("ok"); 
    }

    public function prosesUbah(){
        $id                 = $this->input->post('id'); 
        $tanggal_kegiatan   = $this->input->post('tanggal_kegiatan') ? $this->page->formatDate($this->input->post('tanggal_kegiatan')) : '';  
        $where = array(
            'id' => $this->input->post('id')
        );
        $data = array(
            'nama_kegiatan'     => $this->input->post('nama_kegiatan'),
            'tempat_kegiatan'   => $this->input->post('tempat_kegiatan'), 
            'tanggal_kegiatan'  => $tanggal_kegiatan,
            'diubah_pada'       => date("Y-m-d H:i:s")
        ); 
        $proses = $this->page->ubah($data, $where, $this->table); 
        echo json_encode("ok");  
    }
    
    public function get_id()
    {
        $where = array(
            'id'            => $this->input->post('id') ? $this->input->post('id') : 0, 
        );
        $data = $this->page->get_detail($where, $this->table); 
        $data['tanggal_kegiatan']  = ($data['tanggal_kegiatan'] != '0000-00-00') ? $this->page->formatTanggal($data['tanggal_kegiatan']) : '00-00-0000';
        echo json_encode($data);
    }

    public function get_data()
    {
        $where = array(
            'aktif'         => '1', 
            'id_periode'    => $this->session->userdata('id_periode'),
            'dihapus_pada'  => NULL
        );
        $data_page=$this->page->get_data($where, $this->table); 
        
        $no = 0;
        $jum = count($data_page) ;  
        $data = array();
        foreach ($data_page as $row) {
            $no++;
            $row['no'] = $no; 
            $row['tanggal_kegiatan'] = ($row['tanggal_kegiatan'] != '0000-00-00') ? $this->page->d($row['tanggal_kegiatan']) : '00-00-0000';
            $data[] = $row;
        }
        $output = array(
            "recordsTotal"  =>  $jum, 
            "data"    => $data
        );
        echo json_encode($output);
    }

    public function prosesHapus()
    {
        $where = array(
            'id'            => $this->input->post('id'), 
        );
        $data = array( 
            'aktif'         => '0',
            'dihapus_pada'  => date("Y-m-d H:i:s")
        );  
        $proses = $this->page->ubah($data, $where, $this->table); 
        echo json_encode("ok");  
    }
}
?>