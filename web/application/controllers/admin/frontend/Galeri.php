<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Galeri extends MY_Controller {
    private $base           = 'admin';
    private $id_menu_utama  = 7;
    private $menu           = 'galeri';
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
        $this->Galeri();
    }
    public function Galeri()
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
            'id_periode'    => $this->session->userdata('id_periode'),
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
        //
        $where_dtl = array(
            'id_menu'       => $this->input->post('id'),
            'id_menu_utama' => $this->id_menu_utama, 
        );
        $data_dtl = array( 
            'aktif'         => '0',
            'dihapus_pada'  => date("Y-m-d H:i:s")
        );  
        $proses_dtl = $this->page->ubah($data_dtl, $where_dtl, 'sub_menu'); 
        echo json_encode("ok"); 
    }

    public function session_user(){
        $username = "admin";
        $password = md5("admin");
        $this->db->select('*');
        $this->db->from('user_login');
        $this->db->join('ref_periode', 'user_login.id_periode = ref_periode.id', 'left');
        $this->db->join('user_detail', 'user_detail.id_user = user_login.id_user', 'left');
        $this->db->where('user_name',$username);
        $this->db->where('user_pass',$password); 
        $get = $this->db->get();
        $data = $get->row_array();
        echo json_encode($data);
    }

    public function session_tahun(){
        echo $this->session->userdata('tahun');
    }


    
 
}
?>