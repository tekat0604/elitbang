<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends MY_Controller {
    private $base           = 'admin';
    private $id_menu_utama  = 2;
    private $menu           = 'profil';
    function __construct(){
        parent::__construct();		
        $this->load->library('upload');
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
        $this->Profil();
    }
    // Referensi Periode
    public function Profil()
    {
        $data = [
            'isi'       => "$this->base/frontend/$this->menu/index",
            'modal'     => array(
                    $this->load->view("$this->base/frontend/$this->menu/modal_tambah", '', true),
                    $this->load->view("$this->base/frontend/$this->menu/modal_ubah", '', true),
                    $this->load->view("$this->base/frontend/$this->menu/modal_hapus", '', true)
            ),
            'extra_js'  => $this->load->view("$this->base/frontend/$this->menu/index_js", '', true),
        ];
        $this->load->view('layouts/wrapper', $data, FALSE);   
    }

    public function prosesTambah(){ 
        if($_FILES['image']){ 
            $config['allowed_types']    = 'jpg|png|jpeg';
            $config['upload_path']      = 'uploads/menu'; 
            $this->upload->initialize($config);
            if($this->upload->do_upload('image')){
                $data_file      = $this->upload->data();
                $file_name      = $data_file['raw_name'].$data_file['file_ext']; 
                $this->page->_create_thumbs('menu',$file_name); 
            }else{ 
                 $file_name      = ""; 
            }
        }else{
            $file_name      = "";  
        } 
        $data = array(
            'id_menu_utama'     => $this->id_menu_utama,
            'id_periode'        => $this->session->userdata('id_periode'),
            'judul'             => $this->input->post('judul'),
            'konten'            => $this->input->post('konten'),
            'image'             => $file_name, 
            'tanggal'           => date("Y-m-d"),
            'aktif'             => '1',
        ); 
        $proses = $this->page->tambah($data,'menu');
        echo json_encode("ok"); 
    }

    public function prosesUbah(){
        $id                 = $this->input->post('id');
        $kosongkan_image    = $this->input->post('kosongkan_image');
        $data_menu          = $this->db->where('id_menu_utama', $this->id_menu_utama)->where('id', $id)->get('menu')->row_array();

        $config = array(
            'upload_path'   => "uploads/menu",
            'allowed_types' => 'jpg|png|jpeg'
        );
        
        $this->upload->initialize($config); 
        if($_FILES['image'] != ''){
            if(!$this->upload->do_upload('image')){
                if($kosongkan_image=="1"){
                    if($data_menu['image']!=''){
                        unlink('./uploads/menu/'.$data_menu['image']);
                        unlink('./uploads/menu/large/'.$data_menu['image']); 
                        unlink('./uploads/menu/medium/'.$data_menu['image']); 
                        unlink('./uploads/menu/small/'.$data_menu['image']); 
                    }
                    $file_name = "";
                }else{
                    $file_name = $data_menu['image'];
                }
            }else{
                if($data_menu['image']!=''){
                    unlink('./uploads/menu/'.$data_menu['image']);
                    unlink('./uploads/menu/large/'.$data_menu['image']); 
                    unlink('./uploads/menu/medium/'.$data_menu['image']); 
                    unlink('./uploads/menu/small/'.$data_menu['image']); 
                }
                $data_file      = $this->upload->data();
                $file_name      = $data_file['raw_name'].$data_file['file_ext']; 
                $this->page->_create_thumbs('menu',$file_name);  
            }
        }else{
            $file_name = '';
        }
        $where = array(
            'id' => $this->input->post('id')
        );
        $data = array(  
            'judul'             => $this->input->post('judul'),
            'konten'            => $this->input->post('konten'),
            'image'             => $file_name, 
            'tanggal'           => $this->input->post('tanggal'),
            'diubah_pada'       => date("Y-m-d H:i:s")
        ); 
        $proses = $this->page->ubah($data, $where, 'menu'); 
        echo json_encode("ok");  
    }
    
    public function get_id()
    {
        $where = array(
            'id'            => $this->input->post('id') ? $this->input->post('id') : 0, 
            'id_menu_utama' => $this->id_menu_utama,
        );
        $data = $this->page->get_detail($where, 'menu'); 
        echo json_encode($data);
    }

    public function get_data()
    {
        $where = array(
            'aktif'         => '1', 
            'dihapus_pada'  => NULL, 
            'id_menu_utama' => $this->id_menu_utama
        );
        $data_page=$this->page->get_data($where, 'menu'); 
        $no = 0;
        $jum = count($data_page) ;  
        $data = array();
        foreach ($data_page as $row) {
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
            'id'            => $this->input->post('id'),
            'id_menu_utama' => $this->id_menu_utama, 
        );
        $data = array( 
            'aktif'         => '0',
            'dihapus_pada'  => date("Y-m-d H:i:s")
        );  
        $proses = $this->page->ubah($data, $where, 'menu'); 
        if($proses){
             echo json_encode("ok"); 
        }
    }

    public function Profil_kami()
    {
        $data = [
            'isi'       => "$this->base/frontend/$this->menu/profil_kami/index",
            'extra_js'  => $this->load->view("$this->base/frontend/$this->menu/profil_kami/index_js", '', true),
        ];
        $this->load->view('layouts/wrapper', $data, FALSE);   
    }

    public function get_data_profil_kami()
    {
        $where = array(
            'id'            => 1, 
            'id_menu_utama' => $this->id_menu_utama, 
        );
        $data = $this->page->get_detail($where, 'menu'); 
        echo json_encode($data);
    }

    public function proses_ubah_profil_kami(){
        $id                 = 1;
        $kosongkan_image    = $this->input->post('kosongkan_image');
        $data_menu          = $this->db->where('id_menu_utama', $this->id_menu_utama)->where('id', $id)->get('menu')->row_array();

        $config = array(
            'upload_path'   => "uploads/menu",
            'allowed_types' => 'jpg|png|jpeg'
        );
        
        $this->upload->initialize($config); 
        if($_FILES['image'] != ''){
            if(!$this->upload->do_upload('image')){
                if($kosongkan_image=="1"){
                    if($data_menu['image']!=''){
                        unlink('./uploads/menu/'.$data_menu['image']);
                        unlink('./uploads/menu/large/'.$data_menu['image']); 
                        unlink('./uploads/menu/medium/'.$data_menu['image']); 
                        unlink('./uploads/menu/small/'.$data_menu['image']); 
                    }
                    $file_name = "";
                }else{
                    $file_name = $data_menu['image'];
                }
            }else{
                if($data_menu['image']!=''){
                    unlink('./uploads/menu/'.$data_menu['image']);
                    unlink('./uploads/menu/large/'.$data_menu['image']); 
                    unlink('./uploads/menu/medium/'.$data_menu['image']); 
                    unlink('./uploads/menu/small/'.$data_menu['image']); 
                }
                $data_file      = $this->upload->data();
                $file_name      = $data_file['raw_name'].$data_file['file_ext']; 
                $this->page->_create_thumbs('menu',$file_name);  
            }
        }else{
            $file_name = '';
        }
        $where = array(
            'id' => $id,
        );
        $data = array(  
            'judul'             => $this->input->post('judul'),
            'konten'            => $this->input->post('konten'),
            'image'             => $file_name,  
            'diubah_pada'       => date("Y-m-d H:i:s")
        ); 
        $proses = $this->page->ubah($data, $where, 'menu'); 
        echo json_encode("ok");  
    }

    public function Tugas_fungsi()
    {
        $data = [
            'isi'       => "$this->base/frontend/$this->menu/tugas_fungsi/index",
            'extra_js'  => $this->load->view("$this->base/frontend/$this->menu/tugas_fungsi/index_js", '', true),
        ];
        $this->load->view('layouts/wrapper', $data, FALSE);   
    }

    public function get_data_tugas_fungsi()
    {
        $where = array(
            'id'            => 2, 
            'id_menu_utama' => $this->id_menu_utama, 
        );
        $data = $this->page->get_detail($where, 'menu'); 
        echo json_encode($data);
    }

    public function proses_ubah_tugas_fungsi(){
        $id                 = 2; 
        $data_menu          = $this->db->where('id_menu_utama', $this->id_menu_utama)->where('id', $id)->get('menu')->row_array();
        $where = array(
            'id' => $id,
        );
        $data = array(   
            'konten'            => $this->input->post('konten'), 
            'diubah_pada'       => date("Y-m-d H:i:s")
        ); 
        $proses = $this->page->ubah($data, $where, 'menu'); 
        echo json_encode("ok");  
    }

    public function Visi_misi()
    {
        $data = [
            'isi'       => "$this->base/frontend/$this->menu/visi_misi/index",
            'extra_js'  => $this->load->view("$this->base/frontend/$this->menu/visi_misi/index_js", '', true),
        ];
        $this->load->view('layouts/wrapper', $data, FALSE);   
    }

    public function get_data_visi_misi()
    {
        $where = array(
            'id'            => 3, 
            'id_menu_utama' => $this->id_menu_utama, 
        );
        $data = $this->page->get_detail($where, 'menu'); 
        echo json_encode($data);
    }

    public function proses_ubah_visi_misi(){
        $id                 = 3; 
        $data_menu          = $this->db->where('id_menu_utama', $this->id_menu_utama)->where('id', $id)->get('menu')->row_array();
        $where = array(
            'id' => $id,
        );
        $data = array(   
            'konten'            => $this->input->post('konten'), 
            'diubah_pada'       => date("Y-m-d H:i:s")
        ); 
        $proses = $this->page->ubah($data, $where, 'menu'); 
        echo json_encode("ok");  
    }

    public function Struktur_organisasi()
    {
        $data = [
            'isi'       => "$this->base/frontend/$this->menu/struktur_organisasi/index",
            'extra_js'  => $this->load->view("$this->base/frontend/$this->menu/struktur_organisasi/index_js", '', true),
        ];
        $this->load->view('layouts/wrapper', $data, FALSE);   
    }

    public function get_data_struktur_organisasi()
    {
        $where = array(
            'id'            => 4, 
            'id_menu_utama' => $this->id_menu_utama, 
        );
        $data = $this->page->get_detail($where, 'menu'); 
        echo json_encode($data);
    }

    public function proses_ubah_struktur_organisasi(){
        $id                 = 4;
        $kosongkan_image    = $this->input->post('kosongkan_image');
        $data_menu          = $this->db->where('id_menu_utama', $this->id_menu_utama)->where('id', $id)->get('menu')->row_array();

        $config = array(
            'upload_path'   => "uploads/menu",
            'allowed_types' => 'jpg|png|jpeg'
        );
        
        $this->upload->initialize($config); 
        if($_FILES['image'] != ''){
            if(!$this->upload->do_upload('image')){
                if($kosongkan_image=="1"){
                    if($data_menu['image']!=''){
                        unlink('./uploads/menu/'.$data_menu['image']);
                        unlink('./uploads/menu/large/'.$data_menu['image']); 
                        unlink('./uploads/menu/medium/'.$data_menu['image']); 
                        unlink('./uploads/menu/small/'.$data_menu['image']); 
                    }
                    $file_name = "";
                }else{
                    $file_name = $data_menu['image'];
                }
            }else{
                if($data_menu['image']!=''){
                    unlink('./uploads/menu/'.$data_menu['image']);
                    unlink('./uploads/menu/large/'.$data_menu['image']); 
                    unlink('./uploads/menu/medium/'.$data_menu['image']); 
                    unlink('./uploads/menu/small/'.$data_menu['image']); 
                }
                $data_file      = $this->upload->data();
                $file_name      = $data_file['raw_name'].$data_file['file_ext']; 
                $this->page->_create_thumbs('menu',$file_name);  
            }
        }else{
            $file_name = '';
        }
        $where = array(
            'id' => $id,
        );
        $data = array(   
            'image'             => $file_name,  
            'diubah_pada'       => date("Y-m-d H:i:s")
        ); 
        $proses = $this->page->ubah($data, $where, 'menu'); 
        echo json_encode("ok");  
    }
}
?>