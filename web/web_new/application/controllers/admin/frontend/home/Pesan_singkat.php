<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesan_singkat extends My_Controller { 
    private $base   = 'admin'; 
    private $menu   = 'pesan_singkat';
    private $table  = 'pesan_singkat'; 
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
        $this->PesanSingkat();
    } 
    // Data PesanSingkat
    public function PesanSingkat()
    {
        $data = [
            'isi'       => "$this->base/frontend/beranda/$this->menu/index",
            'modal'     => array(
                    $this->load->view("$this->base/frontend/beranda/$this->menu/modal_tambah", '', true),
                    $this->load->view("$this->base/frontend/beranda/$this->menu/modal_ubah", '', true),
                    $this->load->view("$this->base/frontend/beranda/$this->menu/modal_hapus", '', true)
            ),
            'extra_css'  => $this->load->view("$this->base/frontend/beranda/$this->menu/index_css", '', true),
            'extra_js'  => $this->load->view("$this->base/frontend/beranda/$this->menu/index_js", '', true),
        ];
        $this->load->view('layouts/wrapper', $data, FALSE);   
    }
    public function prosesTambah(){
        $data = array(
            'judul'     => $this->input->post('judul'),
            'konten'    => $this->input->post('konten'), 
            'aktif'     => '1',
        );
        $proses = $this->page->tambah($data,$this->table);
        echo json_encode("ok"); 
    } 
    public function prosesUbah(){
        $id         = $this->input->post('id');  
        $where      = array(
            'id'    => $this->input->post('id')
        );
        $data       = array(
            'judul'         => $this->input->post('judul'),
            'konten'        => $this->input->post('konten'), 
            'diubah_pada'   => date("Y-m-d H:i:s")
        ); 
        $proses = $this->page->ubah($data, $where, $this->table); 
        echo json_encode("ok");  
    }
    
    public function get_id()
    {
        $where = array(
            'id'    => $this->input->post('id') ? $this->input->post('id') : 0
        );
        $data = $this->page->get_detail($where, $this->table); 
        echo json_encode($data);
    }

    public function get_data()
    {
        $where = array(
            'aktif'         => '1', 
            'dihapus_pada'  => NULL
        );
        $list_data=$this->page->get_data($where, $this->table); 
        $no = 0;
        $jum = count($list_data) ;  
        $data = array();
        foreach ($list_data as $row) {
            $no++;
            $row['no'] = $no; 
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
            'id'    => $this->input->post('id')
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