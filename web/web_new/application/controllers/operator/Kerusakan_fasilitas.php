<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Kerusakan_fasilitas extends MY_Controller {

    function __construct(){
		parent::__construct();		
        $this->load->model('Kerusakan_FasilitasModel', 'kerusakan_fasilitas');
        if ( ! $this->session->userdata('logged_in')){ 
            redirect('login');
        }         
    }
    private $base   = 'operator'; 
    // private $menu   = 'kerusakan_fasilitas';
    private $table  = 'tabel_kerusakan_fasilitas';
    private $folder = 'tabel_kerusakan_fasilitas';
    public function index()
    { 
        $this->Kerusakan_Fasilitas();
    } 
    // Referensi Slider
    public function Kerusakan_Fasilitas()
    {
        $data = [
            'isi'       => "$this->base/kerusakan_fasilitas/beranda/index",
            'modal'     => array(
                    $this->load->view("$this->base/kerusakan_fasilitas/beranda/modal_tambah", '', true),
                    $this->load->view("$this->base/kerusakan_fasilitas/beranda/modal_ubah", '', true),
                    $this->load->view("$this->base/kerusakan_fasilitas/beranda/modal_hapus", '', true)
            ),
            'extra_css'  => $this->load->view("$this->base/kerusakan_fasilitas/beranda/index_css", '', true),
            'extra_js'  => $this->load->view("$this->base/kerusakan_fasilitas/beranda/index_js", '', true),
        ];
        $this->load->view('layouts/wrapper', $data, FALSE);   
    }
    public function prosesTambah(){        
        $data = array(
            'jumlah_unit'     => $this->input->post('jumlah_unit'),
            'kerugian_biaya'     => $this->input->post('kerugian_biaya'),
            'kategori'    => $this->input->post('kategori'),
            'aktif' => '1'
        ); 
        $proses = $this->kerusakan_fasilitas->tambah($data,$this->table);
        echo json_encode("ok"); 
    } 
    public function prosesUbah(){
        $id_kerusakan_fasilitas                = $this->input->post('id');  
        $jumlah_unit     = $this->input->post('jumlah_unit');
        $kerugian_biaya     = $this->input->post('kerugian_biaya');
        $kategori    = $this->input->post('kategori');
        $data_old           = $this->db->where('id_kerusakan_fasilitas', $id_kerusakan_fasilitas)->get($this->table)->row_array();        
        
        $where = array(
            'id_kerusakan_fasilitas' => $this->input->post('id')
        );
        $data = array(
        'jumlah_unit'     => $this->input->post('jumlah_unit'),
        'kerugian_biaya'     => $this->input->post('kerugian_biaya'),
        'kategori'    => $this->input->post('kategori'),
        'diubah_pada'   => date("Y-m-d H:i:s")
        ); 
        $proses = $this->kerusakan_fasilitas->ubah($data, $where, $this->table); 
        echo json_encode("ok");  
    }
    
    public function get_id()
    {
        $where = array(
            'id_kerusakan_fasilitas'    => $this->input->post('id') ? $this->input->post('id') : 0,
        );        
        $data = $this->kerusakan_fasilitas->get_detail($where, $this->table); 
        echo json_encode($data);
    }

    public function get_data()
    {
        $where = array(
            'aktif'         => '1', 
            'dihapus_pada'  => NULL
        );
        $list_data=$this->kerusakan_fasilitas->get_data($where, $this->table); 
        $no = 0;
        $jum = count($list_data) ;  
        $data = array();
        foreach ($list_data as $row) {
            $no++;
            $row->no = $no; 
            $data[] = $row;
            }
        $output = array(
            "recordsTotal"  =>  $jum, 
            "data"    => $data
        );
        echo json_encode($output);
    }
    public function prosesHapus1()
    {
        $where = array(
            'id_kerusakan_fasilitas'    => $this->input->post('id')
        );
        $data = array( 
            'aktif'         => '0',
            'dihapus_pada'  => date("Y-m-d H:i:s")
        );
        $proses = $this->kerusakan_fasilitas->ubah($data, $where, 'tabel_kerusakan_fasilitas'); 
        if($proses){
            echo json_encode("ok");
        }
    }
    public function prosesHapus()
    {
        $where = array(
            'id_kerusakan_fasilitas'            => $this->input->post('id')
        );
        $data = array( 
            'aktif'         => '0',
            'dihapus_pada'  => date("Y-m-d H:i:s")
        );  
        $proses = $this->kerusakan_fasilitas->ubah($data, $where, $this->table); 
        echo json_encode("ok");  
    }
} 
?>