<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Berita extends CI_Controller {
    private $base = 'admin';
    function __construct(){
        parent::__construct();      
        $this->load->model('websiteModel', 'website');
        if ( ! $this->session->userdata('logged_in')){ 
            redirect('login');
        }
        if($this->session->userdata('role') != 1){
            redirect('login');
        }
        $this->load->library('upload');
    }

    public function index()
    {
        $data = [
            'isi' => "$this->base/website/berita_list"
        ];
        $this->load->view('layouts/wrapper', $data, FALSE);
    }

    public function berita_baru()
    {
        $data = [
            'isi' => "$this->base/website/berita_new",
            'extra_js' => $this->load->view("$this->base/website/berita_new_js", '', true),
            'data' => 'abc'
        ];
        // print_r($data);
        // $this->load->simpan_berita($data);
        $this->load->view('layouts/wrapper', $data, FALSE);

    }

    public function berita_edit($id)
    {
        $dt = $this->db->where('id_berita',$id)->get('tabel_berita')->row_array();
        $data = [
            'isi' => "$this->base/website/berita_edit",
            'extra_js' => $this->load->view("$this->base/website/berita_edit_js", '', true),
            'data' => $dt
        ];
        $this->load->view('layouts/wrapper', $data, FALSE);
    }

    public function simpan_berita()
    {
        $id = $this->input->post('id_berita');
        $conf = array(
            'upload_path'   => "assets/img/uploads/berita",
            'allowed_types' => 'gif|jpg|png|jpeg'
        );
        $this->upload->initialize($conf);
        if(!$this->upload->do_upload('thumbnail')){
            $respon['notif']['status'] = 'error';
            $respon['notif']['message'] = $this->upload->display_errors();
        }else{
            $data = [
                'judul' => $this->input->post('judul'),
                'slug' => $this->input->post('slug'),
                'isi' => $this->input->post('isi'),
                'thumbnail_url' => $this->upload->data('file_name'),
                'add_by' => $this->session->userdata('id')           
            ];
            $data = $this->website->tambah($data, 'tabel_berita',true);
            if($data > 0){
                $respon['notif']['status'] = 'success';
                $respon['notif']['message'] = 'Berita berhasil ditambahkan.';
            }else{
                $respon['notif']['status'] = 'error';
                $respon['notif']['message'] = 'Berita gagal ditambahkan.';
                $respon['affected'] = $data;
            }
            
        }
        echo json_encode($respon);
        // redirect('berita');
    }

    

    public function simpan_berita_edit()
    {


        if($_FILES['thumbnail']['name'] != ''){
            $conf = array(
                'upload_path'   => "assets/img/uploads/berita",
                'allowed_types' => 'gif|jpg|png|jpeg'
            );
            $this->upload->initialize($conf);
            if(!$this->upload->do_upload('thumbnail')){
                $respon['notif']['status'] = 'error';
                $respon['notif']['message'] = $this->upload->display_errors();
            }else{
                unlink('assets/img/uploads/berita/'.$this->input->post('thumbnail_old'));
                $data = [
                    'judul' => $this->input->post('judul_berita'),
                    'isi' => $this->input->post('content_berita'),
                    'slug' => $this->input->post('slug_berita'),
                    'thumbnail_url' => $this->upload->data('file_name'),
                    'add_by' => $this->session->userdata('id')           
                ];
                $data = $this->website->ubah($data, 'tabel_berita',array('id_berita'=>$this->input->post('id_berita')),true);
                if($data > 0){
                    $respon['notif']['status'] = 'success';
                    $respon['notif']['message'] = 'Berita berhasil diedit.';
                }else{
                    $respon['notif']['status'] = 'error';
                    $respon['notif']['message'] = 'Berita gagal diedit.';
                }
            }
        }else{
            $data = [
                'judul' => $this->input->post('judul_berita'),
                'isi' => $this->input->post('content_berita'),
                'slug' => $this->input->post('slug_berita'),
                'add_by' => $this->session->userdata('id')           
            ];
            $data = $this->website->ubah($data, 'tabel_berita',array('id_berita'=>$this->input->post('id_berita')),true);
            if($data > 0){
                $respon['notif']['status'] = 'success';
                $respon['notif']['message'] = 'Berita berhasil diedit.';
            }else{
                $respon['notif']['status'] = 'error';
                $respon['notif']['message'] = 'Berita gagal diedit.';
                $respon['affected'] = $data;
            }
        }

        echo json_encode($respon);
    }

    public function berita_hapus(){
        $d = $this->db->where('id_berita', $this->input->post('id'))->get('tabel_berita')->row_array();
        unlink('assets/img/uploads/berita/'.$d['thumbnail_url']);
        $this->db->where('id_berita', $this->input->post('id'))->delete('tabel_berita');
        if($this->db->affected_rows() > 0){
            $respon['notif']['status'] = 'success';
            $respon['notif']['message'] = 'Berita berhasil diedit.';
        }else{
            $respon['notif']['status'] = 'error';
            $respon['notif']['message'] = 'Berita gagal diedit.';
        }

        echo json_encode($respon);
    }

    public function get_berita(){
        $q = "
        SELECT (@i:=@i+1) AS no,tabel_berita.* FROM tabel_berita,(SELECT @i:=0)i;
        "; 
        $respon['data'] = $this->db->query($q)->result_array();
        echo json_encode($respon);
    }

}

/* End of file Website.php */


?>