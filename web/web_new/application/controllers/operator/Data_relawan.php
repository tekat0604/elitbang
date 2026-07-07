<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Data_relawan extends MY_Controller {

    function __construct(){
		parent::__construct();		
        $this->load->model('Data_RelawanModel', 'data_relawan');
        if ( ! $this->session->userdata('logged_in')){ 
            redirect('login');
        }
         
    }

    private $base   = 'operator'; 
    // private $menu   = 'relawan';
    private $table  = 'tabel_relawan';
    private $folder = 'tabel_relawan';
    public function index()
    { 
        $this->Relawan();
    } 
    // Referensi Slider
    public function Relawan()
    {
        $data = [
            'isi'       => "$this->base/relawan/beranda/index",
            'modal'     => array(
                    $this->load->view("$this->base/relawan/beranda/modal_tambah", '', true),
                    $this->load->view("$this->base/relawan/beranda/modal_ubah", '', true),
                    $this->load->view("$this->base/relawan/beranda/modal_hapus", '', true)
            ),
            'extra_css'  => $this->load->view("$this->base/relawan/beranda/index_css", '', true),
            'extra_js'  => $this->load->view("$this->base/relawan/beranda/index_js", '', true),
        ];
        $this->load->view('layouts/wrapper', $data, FALSE);   
    }
    public function prosesTambah(){        
        $data = array(
            'nik'     => $this->input->post('nik'),
            'nama'     => $this->input->post('nama'),
            'kategori'    => $this->input->post('kategori'),
            'jenis_kelamin'    => $this->input->post('jenis_kelamin'),
            'alamat'    => $this->input->post('alamat'),
            'aktif' => '1',
            'id_pengaduan' => $this->session->userdata('id_pengaduan')
        ); 
        $proses = $this->data_relawan->tambah($data,$this->table);
        echo json_encode("ok"); 
    } 
    public function prosesUbah(){
        $id_relawan                = $this->input->post('id');  
        $nik     = $this->input->post('nik');
        $nama     = $this->input->post('nama');
        $kategori    = $this->input->post('kategori');
        $jenis_kelamin    = $this->input->post('jenis_kelamin');
        $alamat    = $this->input->post('alamat');
        $data_old           = $this->db->where('id_relawan', $id_relawan)->get($this->table)->row_array();                
        $where = array(
            'id_relawan' => $this->input->post('id')
        );
        $data = array(
        'nik'     => $this->input->post('nik'),
        'nama'     => $this->input->post('nama'),
        'kategori'    => $this->input->post('kategori'),
        'jenis_kelamin'    => $this->input->post('jenis_kelamin'),
        'alamat'    => $this->input->post('alamat'),
        'diubah_pada'   => date("Y-m-d H:i:s"),
        'id_pengaduan' => $this->session->userdata('id_pengaduan')
        );
        $proses = $this->data_relawan->ubah($data, $where, $this->table); 
        echo json_encode("ok");  
    }
    
    public function get_id()
    {
        $where = array(
            'id_relawan'    => $this->input->post('id') ? $this->input->post('id') : 0,
        );
        $data = $this->data_relawan->get_detail($where, $this->table); 
        echo json_encode($data);
    }

    public function get_data()
    {
        $where = array(
            'aktif'         => '1', 
            'dihapus_pada'  => NULL
        );
        $list_data=$this->data_relawan->get_relawan();         
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
            'id_relawan'    => $this->input->post('id')
        );
        $data = array( 
            'aktif'         => '0',
            'dihapus_pada'  => date("Y-m-d H:i:s")
        );
        $proses = $this->data_relawan->ubah($data, $where, 'tabel_relawan'); 
        if($proses){
            echo json_encode("ok");
        }
    }
    public function prosesHapus()
    {
        $where = array(
            'id_relawan'            => $this->input->post('id')
        );
        $data = array( 
            'aktif'         => '0',
            'dihapus_pada'  => date("Y-m-d H:i:s")
        );  
        $proses = $this->data_relawan->ubah($data, $where, $this->table); 
        echo json_encode("ok");  
    }

} 
?>