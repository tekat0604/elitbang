<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Album extends CI_Controller {
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
            'isi' => "$this->base/website/album/index",
            'extra_js' => $this->load->view("$this->base/website/album/index_js", '', true),
        ];
        $this->load->view('layouts/wrapper', $data, FALSE);
    }

    public function getKecamatan(){
        $data = $this->website->tampil_semua('tabel_kecamatan');

        echo json_encode($data);
    }

    public function get_album_kategori(){
        $data = $this->website->tampil_semua('tabel_album_kategori');

        echo json_encode($data);
    }

    public function getFoto(){
        $id_album_kategori = $this->input->post('id_album_kategori');
        $where = array('id_album_kategori'=>$id_album_kategori);
        $data = $this->website->tampil_sebagian($where, 'tabel_album');

        echo json_encode($data);
    }

    public function simpan(){
        $generate = md5(date('YmdHmi'));
        
        $conf = array(
            'upload_path'   => "assets/img/album/",
			'allowed_types' => 'gif|jpg|png|jpeg',
            'file_name'     => $generate
        );
        $this->upload->initialize($conf);
        if(!$this->upload->do_upload('file')){
            $respon['notif']['status'] = 'error';
            $respon['notif']['message'] = $this->upload->display_errors();
        }else{
            $data_yang_diupload = $this->upload->data();

            $data = [
                'id_album_kategori' => $this->input->post('id_album_kategori'),
                'nama_foto' => $this->input->post('nama_foto'),
                'file' => $generate.$data_yang_diupload['file_ext'],       
            ];
            $data = $this->website->tambah($data, 'tabel_album',true);
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
    }

    public function hapus(){
        $id = $this->input->post('id');
        $data_tabel_album = $this->db->from('tabel_album')->where('id', $id)->get()->row_array();
        $file = $data_tabel_album['file'];

        // Untuk menghapus gambar
        unlink('assets/img/album/'.$file);

        $where = array(
                    'id'=>$id,
                );
        $proses = $this->website->hapus($where, 'tabel_album');

        echo json_encode($proses);
    }

}

/* End of file Website.php */


?>