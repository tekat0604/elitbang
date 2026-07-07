<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Detail_galeri extends MY_Controller {
    private $base           = 'admin';
    private $id_menu_utama  = 7;
    private $menu           = 'detail_galeri';
    private $table          = 'sub_menu';
    private $folder         = 'sub_menu';
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
    
    public function index($id=null)
    {
        $id = $id ? $id: 0 ;
        if($id!=0){
            $this->data_foto_album($id); 
        }else{
            echo "tidak ada";
        }
    }

    public function data_foto_album($id)
    {
        if($this->Cek_galeri($id)!=''){
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
        }else{ 
            redirect('admin/frontend/galeri');
        }    
    }


    public function prosesTambah(){ 
        if($_FILES['image']){ 
            $config['allowed_types']    = 'jpg|png|jpeg';
            $config['upload_path']      = 'uploads/'.$this->folder.''; 
            $this->upload->initialize($config);
            if($this->upload->do_upload('image')){
                $data_file      = $this->upload->data();
                $file_name      = $data_file['raw_name'].$data_file['file_ext']; 
                $this->page->_create_thumbs($this->table,$file_name); 
            }else{ 
                 $file_name     = ""; 
            }
        }else{
            $file_name      = "";  
        } 
        //
        $jenis_konten = $this->input->post('jenis');
        if($jenis_konten=="on"){ 
            $jenis = '1'; 
        }else{
            $jenis = '0'; 
        }
        //
        $link_youtube = $this->input->post('link');
        if($link_youtube!=''){ 
            $exp_link_youtube = explode("?v=", $link_youtube);
            $link = $exp_link_youtube[1] ; 
        }else{
            $link = "";  
        }

        $data = array(
            'id_menu_utama'     => $this->id_menu_utama,
            'id_menu'           => $this->input->post('id_menu'),
            'id_periode'        => $this->session->userdata('id_periode'),
            'judul'             => $this->input->post('judul'),          
            'image'             => $file_name, 
            'tanggal'           => date("Y-m-d"),
            'jenis'             => $jenis,
            'link'              => $link,
            'aktif'             => '1',
        ); 
        $proses = $this->page->tambah($data,$this->table);
        echo json_encode("ok"); 
    }

    public function prosesUbah(){
        $id                 = $this->input->post('id');
        $kosongkan_image    = $this->input->post('kosongkan_image');
        $data_sub_menu      = $this->db->where('id_menu_utama', $this->id_menu_utama)->where('id', $id)->get($this->table)->row_array();
        $config = array(
            'upload_path'   => 'uploads/'.$this->folder.'',
            'allowed_types' => 'jpg|png|jpeg'
        );

        $this->upload->initialize($config); 
        if($_FILES['image'] != ''){
            if(!$this->upload->do_upload('image')){
                if($kosongkan_image=="1"){
                    if($data_sub_menu['image']!=''){
                        unlink('./uploads/'.$this->folder.'/'.$data_sub_menu['image']);
                        unlink('./uploads/'.$this->folder.'/large/'.$data_sub_menu['image']); 
                        unlink('./uploads/'.$this->folder.'/medium/'.$data_sub_menu['image']); 
                        unlink('./uploads/'.$this->folder.'/small/'.$data_sub_menu['image']); 
                    }
                    $file_name = "";
                }else{
                    $file_name = $data_sub_menu['image'];
                }
            }else{
                if($data_sub_menu['image']!=''){
                    unlink('./uploads/'.$this->folder.'/'.$data_sub_menu['image']);
                    unlink('./uploads/'.$this->folder.'/large/'.$data_sub_menu['image']); 
                    unlink('./uploads/'.$this->folder.'/medium/'.$data_sub_menu['image']); 
                    unlink('./uploads/'.$this->folder.'/small/'.$data_sub_menu['image']); 
                }
                $data_file      = $this->upload->data();
                $file_name      = $data_file['raw_name'].$data_file['file_ext']; 
                $this->page->_create_thumbs($this->table,$file_name);  
            }
        }else{
            $file_name = '';
        }
        //
        $jenis_konten = $this->input->post('jenis');
        if($jenis_konten=="on"){ 
            $jenis = '1'; 
        }else{
            $jenis = '0'; 
        }
        //
        $link_youtube = $this->input->post('link');
        if($link_youtube!=''){ 
            $exp_link_youtube = explode("?v=", $link_youtube);
            $link = $exp_link_youtube[1] ; 
        }else{
            $link = "";  
        }
        $where = array(
            'id' => $this->input->post('id')
        );
        $data = array(  
            'judul'             => $this->input->post('judul'),         
            'image'             => $file_name,           
            'tanggal'           => $this->input->post('tanggal'),
            'jenis'             => $jenis,
            'link'              => $link,
            'diubah_pada'       => date("Y-m-d H:i:s")
        );  
        $proses = $this->page->ubah($data, $where, $this->table); 
        echo json_encode("ok");  
    }
    
    public function get_id()
    {
        $where = array(
            'id'            => $this->input->post('id') ? $this->input->post('id') : 0, 
            'id_menu_utama' => $this->id_menu_utama,
        );
        $data = $this->page->get_detail($where, $this->table); 
        if($data['link']!=''){
            $url_youtube="https://www.youtube.com/watch?v=".$data['link']."";
        }else{
            $url_youtube="";
        }
        $data["link"] = $url_youtube;
        echo json_encode($data);
    }

    public function get_data($get_id_menu)
    {
        $id_menu    = $get_id_menu ? $get_id_menu : 0;
        $where      = array(
            'id_menu'       => $id_menu, 
            'id_periode'    => $this->session->userdata('id_periode'),
            'aktif'         => '1', 
            'dihapus_pada'  => NULL, 
            'id_menu_utama' => $this->id_menu_utama
        );
        $data_page=$this->page->get_data($where, $this->table); 
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
        $proses = $this->page->ubah($data, $where, $this->table); 
        echo json_encode("ok"); 
    }

    public function Cek_galeri($id){
         $data_menu = $this->db->where('id_menu_utama', $this->id_menu_utama)->where('id', $id)->get('menu')->row_array();
         return $data_menu; 
    }
}
?>