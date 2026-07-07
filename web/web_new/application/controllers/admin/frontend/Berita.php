<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Berita extends MY_Controller {
    private $base           = 'admin';
    private $id_menu_utama  = 3;
    private $menu           = 'berita';
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
        $this->Berita();
    }
    // Referensi Berita
    public function Berita()
    {
        $data = [
            'isi'       => "$this->base/frontend/$this->menu/index",
            'modal'     => array(
                    $this->load->view("$this->base/frontend/$this->menu/modal_tambah", '', true),
                    $this->load->view("$this->base/frontend/$this->menu/modal_ubah", '', true),
                    $this->load->view("$this->base/frontend/$this->menu/modal_hapus", '', true)
            ),
            'extra_css'  => $this->load->view("$this->base/frontend/$this->menu/index_css", '', true),
            'extra_js'  => $this->load->view("$this->base/frontend/$this->menu/index_js", '', true),
        ];
        $this->load->view('layouts/wrapper', $data, FALSE);   
    }
    public function get_data()
    {
        $this->db->select(
            'menu.id, menu.id_kategori_menu,  kategori_menu.nama_kategori_menu as kategori_berita, 
            menu.judul, menu.konten, menu.image, menu.tanggal'
        );
        $this->db->from('menu');  
        $this->db->join('kategori_menu','kategori_menu.id = menu.id_kategori_menu', 'LEFT');  
        $this->db->where('menu.id_menu_utama','3');  
        $this->db->where('menu.id_periode',$this->session->userdata('id_periode'));  
        $this->db->where('menu.aktif','1'); 
        $this->db->where('menu.dihapus_pada',NULL); 
        $this->db->order_by("menu.id", "DESC");         
        $list_data = $this->db->get()->result_array();

        $no = 0;
        $jum = count($list_data) ;  
        $data = array();
        foreach ($list_data as $key => $value) { 
            $no++;
            $row                            =  array(); 
            $row['no']                      = $no; 
            $row['id']                      = $value['id'];
            $row['id_kategori_berita']      = $value['id_kategori_menu']; 
            $row['kategori_berita']         = $value['kategori_berita'];
            $row['judul']                   = $value['judul']; 
            $row['konten']                  = $this->page->str_clean_tag(($value['konten']),100) ;  
            $row['tanggal']                 = ($value['tanggal']  != '0000-00-00') ? $this->page->d($value['tanggal'])  : '00-00-0000';
            if($value['image']!='' && $value['image']!=null){
                $img        = base_url('uploads/menu/small/'.$value['image'].'');
            }else{
                $img        = '';
            }
            $row['image']   = $img; 
            $data[]         = $row;
        }
        $output = array(
            "recordsTotal"  =>  $jum, 
            "data"          => $data
        );
        echo json_encode($output);
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
        $tanggal   = $this->input->post('tanggal') ? $this->page->formatDate($this->input->post('tanggal')) : '';
        $data = array(
            'id_menu_utama'     => $this->id_menu_utama,
            'id_kategori_menu'  => $this->input->post('id_kategori'),
            'id_periode'        => $this->session->userdata('id_periode'),
            'judul'             => $this->input->post('judul'),
            'konten'            => $this->input->post('konten'),
            'image'             => $file_name, 
            'tanggal'           => $tanggal,
            'aktif'             => '1',
        ); 
        $proses = $this->page->tambah($data,'menu');
        echo json_encode("ok"); 
    }

    public function prosesUbah(){
        $id                 = $this->input->post('id'); 
        $tanggal            = $this->input->post('tanggal') ? $this->page->formatDate($this->input->post('tanggal')) : '';
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
            'id_kategori_menu'  => $this->input->post('id_kategori'),
            'judul'             => $this->input->post('judul'),
            'konten'            => $this->input->post('konten'),
            'image'             => $file_name, 
            'tanggal'           => $tanggal,
            'diubah_pada'       => date("Y-m-d H:i:s")
        ); 
        $proses = $this->page->ubah($data, $where, 'menu'); 
        echo json_encode("ok");  
    }
    
    public function get_id()
    {
        $where = array(
            'id'            => $this->input->post('id') ? $this->input->post('id') : 5, 
            'id_menu_utama' => $this->id_menu_utama,
        );
        $data                   = $this->page->get_detail($where, 'menu'); 
        $data['id_kategori']    = $data['id_kategori_menu'];
        $data['tanggal']        = ($data['tanggal'] != '0000-00-00') ? $this->page->formatTanggal($data['tanggal']) : '00-00-0000';
        echo json_encode($data);
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
        echo json_encode("ok"); 
    }
    public function select_kategori_berita(){
        $where = array( 
            'id_menu_utama' => $this->id_menu_utama, 
            'aktif'         => '1',
            'dihapus_pada'  => NULL
        ); 
        $data = $this->page->get_data($where, 'kategori_menu','id,nama_kategori_menu AS kategori_berita'); 
        echo json_encode($data);
    }
}
?>