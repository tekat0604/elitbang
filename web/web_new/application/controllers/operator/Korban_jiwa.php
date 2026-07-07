<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Korban_jiwa extends MY_Controller {

    function __construct(){
		parent::__construct();		
        $this->load->model('Korban_JiwaModel', 'korban_jiwa');
        if ( ! $this->session->userdata('logged_in')){ 
            redirect('login');
        }
         
    }

    private $base   = 'operator'; 
    // private $menu   = 'korban_jiwa';
    private $table  = 'tabel_korban_jiwa';
    private $folder = 'tabel_korban_jiwa';
    public function index()
    { 
        $this->Korban_Jiwa();
    } 
    // Referensi Slider
    public function Korban_Jiwa()
    {
        $data = [
            'isi'       => "$this->base/korban_jiwa/beranda/index",
            'modal'     => array(
                    $this->load->view("$this->base/korban_jiwa/beranda/modal_tambah", '', true),
                    $this->load->view("$this->base/korban_jiwa/beranda/modal_ubah", '', true),
                    $this->load->view("$this->base/korban_jiwa/beranda/modal_hapus", '', true)
            ),
            'extra_css'  => $this->load->view("$this->base/korban_jiwa/beranda/index_css", '', true),
            'extra_js'  => $this->load->view("$this->base/korban_jiwa/beranda/index_js", '', true),
        ];
        $this->load->view('layouts/wrapper', $data, FALSE);   
    }
    public function prosesTambah(){        
        $data = array(
            'nik'     => $this->input->post('nik'),
            'nama'     => $this->input->post('nama'),
            'jenis_kelamin'    => $this->input->post('jenis_kelamin'),
            'alamat'     => $this->input->post('alamat'),
            'tgl_lahir'    => $this->input->post('tgl_lahir'),
            'tmpt_lahir'    => $this->input->post('tmpt_lahir'),
            'kategori'    => $this->input->post('kategori'),
            'aktif' => '1'
        ); 
        $proses = $this->korban_jiwa->tambah($data,$this->table);
        echo json_encode("ok"); 
    } 
    public function prosesUbah(){
        $id_korban_jiwa                = $this->input->post('id');  
        $nik     = $this->input->post('nik');
        $nama     = $this->input->post('nama');
        $jenis_kelamin    = $this->input->post('jenis_kelamin');
        $alamat     = $this->input->post('alamat');
        $ttl    = $this->input->post('ttl');
        $kategori    = $this->input->post('kategori');
        $data_old           = $this->db->where('id_korban_jiwa', $id_korban_jiwa)->get($this->table)->row_array();        
        
        $where = array(
            'id_korban_jiwa' => $this->input->post('id')
        );
        $data = array(
            'nik'     => $this->input->post('nik'),
            'nama'     => $this->input->post('nama'),
            'jenis_kelamin'    => $this->input->post('jenis_kelamin'),
            'alamat'     => $this->input->post('alamat'),
            'tmpt_lahir'    => $this->input->post('tmpt_lahir'),
            'tgl_lahir'    => $this->input->post('tgl_lahir'),
            'kategori'    => $this->input->post('kategori'),
        'diubah_pada'   => date("Y-m-d H:i:s")
        ); 
        $proses = $this->korban_jiwa->ubah($data, $where, $this->table); 
        echo json_encode("ok");  
    }
    
    public function get_korban_jiwa()
    {
        $where = array(
            'id_korban_jiwa'    => $this->input->post('id') ? $this->input->post('id') : 0,
        );
        $data = $this->korban_jiwa->get_korban_jiwa($where, $this->table); 
        echo json_encode($data);
    }

    public function daftar_korban_jiwa()
    {
        $where = array(
            'aktif'         => '1', 
            'dihapus_pada'  => NULL
        );
        $list_data=$this->korban_jiwa->daftar_korban_jiwa($where, $this->table); 
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
            'id_korban_jiwa'    => $this->input->post('id')
        );
        $data = array( 
            'aktif'         => '0',
            'dihapus_pada'  => date("Y-m-d H:i:s")
        );
        $proses = $this->korban_jiwa->ubah($data, $where, 'tabel_korban_jiwa'); 
        if($proses){
            echo json_encode("ok");
        }
    }
    public function prosesHapus()
    {
        $where = array(
            'id_korban_jiwa'            => $this->input->post('id')
        );
        $data = array( 
            'aktif'         => '0',
            'dihapus_pada'  => date("Y-m-d H:i:s")
        );  
        $proses = $this->korban_jiwa->ubah($data, $where, $this->table); 
        echo json_encode("ok");  
    } 

} 
?>