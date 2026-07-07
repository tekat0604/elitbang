<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil_pegawai extends MY_Controller {
    private $base           = 'admin';
    private $table          = 'profil_anggota';
    private $jenis          = '2';
    private $menu           = 'profil';
    private $folder         = 'profil_pegawai';
    private $folder_upload  = 'profil_anggota';
    
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
        $this->Profil_pegawai();
    }
    // Referensi Profil_pegawai
    public function Profil_pegawai()
    {
        $data = [
            'isi'       => "$this->base/frontend/$this->menu/$this->folder/index",
            'modal'     => array(
                    $this->load->view("$this->base/frontend/$this->menu/$this->folder/modal_tambah", '', true),
                    $this->load->view("$this->base/frontend/$this->menu/$this->folder/modal_ubah", '', true),
                    $this->load->view("$this->base/frontend/$this->menu/$this->folder/modal_hapus", '', true)
            ),
            'extra_css' => $this->load->view("$this->base/frontend/$this->menu/$this->folder/index_css", '', true),
            'extra_js'  => $this->load->view("$this->base/frontend/$this->menu/$this->folder/index_js", '', true),
        ];
        $this->load->view('layouts/wrapper', $data, FALSE);   
    }

    public function prosesTambah(){
        if($_FILES['image']){ 
            $config['allowed_types']    = 'jpg|png|jpeg';
            $config['upload_path']      = 'uploads/'.$this->folder_upload; 
            $this->upload->initialize($config);
            if($this->upload->do_upload('image')){
                $data_file      = $this->upload->data();
                $file_name      = $data_file['raw_name'].$data_file['file_ext']; 
                $this->page->_create_thumbs($this->folder_upload,$file_name); 
            }else{ 
                 $file_name     = ""; 
            }
        }else{
            $file_name          = "";  
        } 
        $data = array(
            'jenis'             => $this->jenis,
            'id_periode'        => $this->session->userdata('id_periode'),
            'nip'               => $this->input->post('nip'),
            'nama'              => $this->input->post('nama'),
            'tempat_lahir'      => $this->input->post('tempat_lahir'),
            'tanggal_lahir'     => $this->input->post('tanggal_lahir'),
            'pangkat_golru' 	=> $this->input->post('pangkat_golru'),
            'tmt_pangkat'       => $this->input->post('tmt_pangkat'),
            'jabatan'           => $this->input->post('jabatan'),
            'tmt_jabatan'       => $this->input->post('tmt_jabatan'),
            'formasi'           => $this->input->post('formasi'),
            'unit_kerja'        => $this->input->post('unit_kerja'),
            'pendidikan'        => $this->input->post('pendidikan'),
            'alamat'            => $this->input->post('alamat'),
            'link'              => $this->input->post('link'),  
            'image'             => $file_name,  
            'aktif'             => '1',
        ); 
        $proses = $this->page->tambah($data,$this->table);
        echo json_encode("ok"); 
    }

    public function prosesUbah(){
        $id                 = $this->input->post('id');  
        $kosongkan_image    = $this->input->post('kosongkan_image');
        $data_old           = $this->db->where('jenis', $this->jenis)->where('id', $id)->get($this->table)->row_array();

        $config = array(
            'upload_path'   => "uploads/".$this->folder_upload,
            'allowed_types' => 'jpg|png|jpeg'
        );
        
        $this->upload->initialize($config); 
        if($_FILES['image'] != ''){
            if(!$this->upload->do_upload('image')){
                if($kosongkan_image=="1"){
                    if($data_old['image']!=''){
                        unlink('./uploads/'.$this->folder_upload.'/'.$data_old['image']);
                        unlink('./uploads/'.$this->folder_upload.'/large/'.$data_old['image']); 
                        unlink('./uploads/'.$this->folder_upload.'/medium/'.$data_old['image']); 
                        unlink('./uploads/'.$this->folder_upload.'/small/'.$data_old['image']); 
                    }
                    $file_name = "";
                }else{
                    $file_name = $data_old['image'];
                }
            }else{
                if($data_old['image']!=''){
                    unlink('./uploads/'.$this->folder_upload.'/'.$data_old['image']);
                    unlink('./uploads/'.$this->folder_upload.'/large/'.$data_old['image']); 
                    unlink('./uploads/'.$this->folder_upload.'/medium/'.$data_old['image']); 
                    unlink('./uploads/'.$this->folder_upload.'/small/'.$data_old['image']); 
                }
                $data_file      = $this->upload->data();
                $file_name      = $data_file['raw_name'].$data_file['file_ext']; 
                $this->page->_create_thumbs($this->table,$file_name);  
            }
        }else{
            $file_name = '';
        }
        $where = array(
            'id' => $this->input->post('id')
        );
        $data = array(
            'nip'               => $this->input->post('nip'),
            'nama'              => $this->input->post('nama'),
            'tempat_lahir'      => $this->input->post('tempat_lahir'),
            'tanggal_lahir'     => $this->input->post('tanggal_lahir'),
            'pangkat_golru' 	=> $this->input->post('pangkat_golru'),
            'tmt_pangkat'       => $this->input->post('tmt_pangkat'),
            'jabatan'           => $this->input->post('jabatan'),
            'tmt_jabatan'       => $this->input->post('tmt_jabatan'),
            'formasi'           => $this->input->post('formasi'),
            'unit_kerja'        => $this->input->post('unit_kerja'),
            'pendidikan'        => $this->input->post('pendidikan'),
            'alamat'            => $this->input->post('alamat'),
            'link'              => $this->input->post('link'),  
            'image'             => $file_name,  
            'diubah_pada'       => date("Y-m-d H:i:s")
        ); 
        $proses = $this->page->ubah($data, $where, $this->table); 
        echo json_encode("ok");  
    }
    
    public function get_id()
    {
        $where = array(
            'id' 		=> $this->input->post('id') ? $this->input->post('id') : 5, 
            'jenis' 	=> $this->jenis,
        );
        $data = $this->page->get_detail($where, $this->table); 
        if(count($data) > 0){ 
        	echo json_encode($data);
        }else{
        	echo json_encode(null);
        } 
    }

    public function get_data()
    {
        $where = array(
            'aktif'         => '1', 
            'id_periode'    => $this->session->userdata('id_periode'),
            'dihapus_pada'  => NULL, 
            'jenis'         => $this->jenis
        );
        $data_page=$this->page->get_data($where, $this->table); 
        
        $no = 0;
        $jum = count($data_page) ;  
        $data = array();
        foreach ($data_page as $row) {
            $no++;
            $row['no']  = $no; 
            $data[]     = $row;
        }
        $output = array(
            "recordsTotal"  =>  $jum, 
            "data"          => $data
        );
        echo json_encode($output);
    }

    public function prosesHapus()
    {
        $where = array(
            'id'        => $this->input->post('id'),
            'jenis'     => $this->jenis, 
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