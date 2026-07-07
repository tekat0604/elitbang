<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil_website extends MY_Controller {
    private $base           = 'admin';  
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

    public function Profil()
    {
        $data = [
            'isi'       => "$this->base/frontend/profil_website/index",
            'extra_js'  => $this->load->view("$this->base/frontend/profil_website/index_js", '', true),
        ];
        $this->load->view('layouts/wrapper', $data, FALSE);   
    }

    public function get_data_profil()
    {
        $where = array(
            'id'            => 1,  
        );
        $data = $this->page->get_detail($where, 'profil_website'); 
        echo json_encode($data);
    }

    public function proses_ubah_profil(){
        $id                 = 1;
        $kosongkan_image    = $this->input->post('kosongkan_image');
        $data_profil        = $this->db->where('id', $id)->get('profil_website')->row_array();

        $config = array(
            'upload_path'   => "uploads/logo",
            'allowed_types' => 'jpg|png|jpeg'
        );
        
        $this->upload->initialize($config); 
        if($_FILES['image'] != ''){
            if(!$this->upload->do_upload('image')){
                if($kosongkan_image=="1"){
                    if($data_profil['image']!=''){
                        unlink('./uploads/logo/'.$data_profil['image']); 
                    }
                    $file_name = "";
                }else{
                    $file_name = $data_profil['image'];
                }
            }else{
                if($data_profil['image']!=''){
                    unlink('./uploads/logo/'.$data_profil['image']); 
                }
                $data_file      = $this->upload->data();
                $file_name      = $data_file['raw_name'].$data_file['file_ext'];  
            }
        }else{
            $file_name = '';
        }
        $where = array(
            'id' => $id,
        );
        $data = array(  
            'judul'         => $this->input->post('judul'),
            'alamat'        => $this->input->post('alamat'),
            'telepon'       => $this->input->post('telepon'),
            'email'         => $this->input->post('email'),
            'facebook'      => $this->input->post('facebook'),
            'twitter'       => $this->input->post('twitter'),
            'google_plus'   => $this->input->post('google_plus'), 
            'linkedin'      => $this->input->post('linkedin'),
            'dribbble'      => $this->input->post('dribbble'),
            'whatsapp'      => $this->input->post('whatsapp'),
            'lokasi'        => $this->input->post('lokasi'),
            'image'         => $file_name,  
            'diubah_pada'   => date("Y-m-d H:i:s")
        ); 
        $proses = $this->page->ubah($data, $where, 'profil_website'); 
        echo json_encode("ok");  
    }
 
}
?>