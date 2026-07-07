<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Pengungsian extends MY_Controller {

    function __construct(){
		parent::__construct();		
        $this->load->model('PengungsianModel', 'pengungsian');
        if ( ! $this->session->userdata('logged_in')){ 
            redirect('login');
        }
         
    }

    private $base   = 'admin'; 
    // private $menu   = 'pengungsian';
    private $table  = 'tabel_pengungsian';
    private $aktif  = 1;
    private $folder = 'tabel_pengungsian';
    public function index()
    { 
        $this->Pengungsian();
    } 
    // Referensi Slider
    public function Pengungsian()
    {        
        
        $data = [
            'isi'       => "$this->base/pengungsian/beranda/index",
            'modal'     => array(
                    $this->load->view("$this->base/pengungsian/beranda/modal_tambah", '', true),
                    $this->load->view("$this->base/pengungsian/beranda/modal_ubah", '', true),
                    $this->load->view("$this->base/pengungsian/beranda/modal_hapus", '', true)
            ),
            'extra_css'  => $this->load->view("$this->base/pengungsian/beranda/index_css", '', true),
            'extra_js'  => $this->load->view("$this->base/pengungsian/beranda/index_js", '', true),
        ];
        $this->load->view('layouts/wrapper', $data, FALSE);   
    }
    public function prosesTambah(){        
        $data = array(
            'kapasitas'     => $this->input->post('kapasitas'),
            'alamat'     => $this->input->post('alamat'),
            'keterangan'    => $this->input->post('keterangan'),
            'aktif' => '1',
            'id_pengaduan' => $this->session->userdata('id_pengaduan')
        ); 
        $proses = $this->pengungsian->tambah($data,$this->table);
        echo json_encode("ok"); 
    } 
    public function prosesUbah(){
        $id_pengungsian                 = $this->input->post('id');  
        $kapasitas     = $this->input->post('kapasitas');
        $alamat     = $this->input->post('alamat');
        $keterangan    = $this->input->post('keterangan');
        $data_old           = $this->db->where('id_pengungsian', $id_pengungsian)->get($this->table)->row_array();        
        
        $where = array(
            'id_pengungsian' => $this->input->post('id')
        );
        $data = array(
        'kapasitas'     => $this->input->post('kapasitas'),
        'alamat'     => $this->input->post('alamat'),
        'keterangan'    => $this->input->post('keterangan'),
        'diubah_pada'   => date("Y-m-d H:i:s"),
        'id_pengaduan' => $this->session->userdata('id_pengaduan')
        
        ); 
        
        $proses = $this->pengungsian->ubah($data, $where, $this->table); 
        echo json_encode("ok");  
    }
    
    public function get_pengungsian()
    {
        $where = array(
            'id_pengungsian'    => $this->input->post('id') ? $this->input->post('id') : 0,
        );
        $data = $this->pengungsian->get_pengungsians($where, $this->table); 
        echo json_encode($data);
    }

    public function daftar_pengungsian()
    {
        $where = array(
            'aktif'         => 1, 
            'dihapus_pada'  => NULL
        );
        $list_data=$this->pengungsian->daftar_pengungsianz($where, $this->table); 
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
    public function prosesHapus1()
    {
        $where = array(
            'id_pengungsian'    => $this->input->post('id')
        );
        $data = array( 
            'aktif'         => '0',
            'dihapus_pada'  => date("Y-m-d H:i:s")
        );
        $proses = $this->pengungsian->ubah($data, $where, 'tabel_pengungsian'); 
        if($proses){
            echo json_encode("ok");
        }
    }
    public function prosesHapus()
    {
        $where = array(
            'id_pengungsian'            => $this->input->post('id')
        );
        $data = array( 
            'aktif'         => '0',
            'dihapus_pada'  => date("Y-m-d H:i:s")
        );  
        $proses = $this->pengungsian->ubah($data, $where, $this->table); 
        echo json_encode("ok");  
    }

} 
?>