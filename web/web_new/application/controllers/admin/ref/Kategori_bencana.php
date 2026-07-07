<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_bencana extends MY_Controller {
    private $base           = 'admin'; 
    private $menu           = 'kategori_bencana';
    private $table          = 'ref_kategori_bencana';
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
        $this->KategoriBencana();
    }
    // Referensi KategoriBencana
    public function KategoriBencana()
    {
        $data = [
            'isi'       => "$this->base/referensi/$this->menu/index",
            'modal'     => array(
                    $this->load->view("$this->base/referensi/$this->menu/modal_tambah", '', true),
                    $this->load->view("$this->base/referensi/$this->menu/modal_ubah", '', true),
                    $this->load->view("$this->base/referensi/$this->menu/modal_hapus", '', true)
            ), 
            'extra_js'  => $this->load->view("$this->base/referensi/$this->menu/index_js", '', true),
        ];
        $this->load->view('layouts/wrapper', $data, FALSE);   
    }

    public function prosesTambah(){
        $data = array( 
            'nama_kategori_bencana'    => $this->input->post('nama_kategori_bencana'),
            'aktif'                 => '1',
        ); 
        $proses = $this->page->tambah($data,$this->table);
        echo json_encode("ok"); 
    }

    public function prosesUbah(){
        $id     = $this->input->post('id');  
        $where = array(
            'id' => $this->input->post('id')
        );
        $data = array(
            'nama_kategori_bencana'    => $this->input->post('nama_kategori_bencana'),
            'diubah_pada'           => date("Y-m-d H:i:s")
        ); 
        $proses = $this->page->ubah($data, $where, $this->table);
        
        #proses update field kategori pada tabel_lapor
        $this->page->ubah(['kategori'=>$this->input->post('nama_kategori_bencana')], ['id_kategori'=>$id], 'tabel_lapor');
        
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
            'id'            => $this->input->post('id')
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