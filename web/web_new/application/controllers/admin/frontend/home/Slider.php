<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Slider extends MY_Controller { 
    private $base   = 'admin'; 
    private $menu   = 'slider';
    private $table  = 'grid_home';
    private $folder = 'grid_home';
    private $jenis  = '1';
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
        $this->Slider();
    } 
    // Referensi Sliderq
    public function Slider()
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
        if($_FILES['image']){ 
            $config['allowed_types']    = 'jpg|png|jpeg';
            $config['upload_path']      = 'uploads/'.$this->folder; 
            $this->upload->initialize($config);
            if($this->upload->do_upload('image')){
                $data_file      = $this->upload->data();
                $file_name      = $data_file['raw_name'].$data_file['file_ext']; 
                $this->page->_create_thumbs($this->folder,$file_name); 
            }else{ 
                 $file_name      = ""; 
            }
        }else{
            $file_name      = "";  
        }  
        $data = array(
            'jenis'     => $this->jenis, 
            'judul'     => $this->input->post('judul'),
            'konten'    => $this->input->post('konten'),
            'image'     => $file_name,  
            'link'      => $this->input->post('link'),
            'aktif'     => '1',
        ); 
        $proses = $this->page->tambah($data,$this->table);
        echo json_encode("ok"); 
    } 
    public function prosesUbah(){
        $id                 = $this->input->post('id');  
        $kosongkan_image    = $this->input->post('kosongkan_image');
        $data_old           = $this->db->where('jenis', $this->jenis)->where('id', $id)->get($this->table)->row_array();

        $config = array(
            'upload_path'   => "uploads/".$this->folder,
            'allowed_types' => 'jpg|png|jpeg'
        );
        
        $this->upload->initialize($config); 
        if($_FILES['image'] != ''){
            if(!$this->upload->do_upload('image')){
                if($kosongkan_image=="1"){
                    if($data_old['image']!=''){
                        unlink('./uploads/'.$this->folder.'/'.$data_old['image']);
                        unlink('./uploads/'.$this->folder.'/large/'.$data_old['image']); 
                        unlink('./uploads/'.$this->folder.'/medium/'.$data_old['image']); 
                        unlink('./uploads/'.$this->folder.'/small/'.$data_old['image']); 
                    }
                    $file_name = "";
                }else{
                    $file_name = $data_old['image'];
                }
            }else{
                if($data_old['image']!=''){
                    unlink('./uploads/'.$this->folder.'/'.$data_old['image']);
                    unlink('./uploads/'.$this->folder.'/large/'.$data_old['image']); 
                    unlink('./uploads/'.$this->folder.'/medium/'.$data_old['image']); 
                    unlink('./uploads/'.$this->folder.'/small/'.$data_old['image']); 
                }
                $data_file      = $this->upload->data();
                $file_name      = $data_file['raw_name'].$data_file['file_ext']; 
                $this->page->_create_thumbs($this->folder,$file_name);  
            }
        }else{
            $file_name = '';
        }
        $where = array(
            'id' => $this->input->post('id')
        );
        $data = array(
            'judul'         => $this->input->post('judul'),
            'konten'        => $this->input->post('konten'),
            'image'         => $file_name,  
            'link'          => $this->input->post('link'),
            'diubah_pada'   => date("Y-m-d H:i:s")
        ); 
        $proses = $this->page->ubah($data, $where, $this->table); 
        echo json_encode("ok");  
    }
    
    public function get_id()
    {
        $where = array(
            'id'    => $this->input->post('id') ? $this->input->post('id') : 0, 
            'jenis' => $this->jenis,
        );
        $data = $this->page->get_detail($where, $this->table); 
        echo json_encode($data);
    }

    public function get_data()
    {
        $where = array(
            'aktif'         => '1', 
            'dihapus_pada'  => NULL, 
            'jenis'         => $this->jenis
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
    public function prosesHapus1()
    {
        $where = array(
            'id'    => $this->input->post('id'),
            'jenis' => '1'
        );
        $data = array( 
            'aktif'         => '0',
            'dihapus_pada'  => date("Y-m-d H:i:s")
        );
        $proses = $this->page->ubah($data, $where, 'grid_home'); 
        if($proses){
            echo json_encode("ok");
        }
    }
    public function prosesHapus()
    {
        $where = array(
            'id'            => $this->input->post('id'),
            'jenis'         => $this->jenis, 
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