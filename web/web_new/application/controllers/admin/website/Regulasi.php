<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Regulasi extends CI_Controller {
    private $base = 'admin';

    function __construct(){
		parent::__construct();		
        $this->load->model('Regulasi_model', 'Regulasi_model');
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
            'isi' => "$this->base/website/regulasi/index",
            'extra_js' => $this->load->view("$this->base/website/regulasi/index_js", '', true),
        ];
        $this->load->view('layouts/wrapper', $data, FALSE);
    }

    public function get_data(){
        $list = $this->Regulasi_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->nama_dokumen;
            $row[] = date('m-d-Y', strtotime($field->tanggal_disahkan));
            $row[] = 
                    '<a target="_blank" href="'.base_url('assets/regulasi/').$field->file.'" class="btn btn-sm btn-success mb-10"> <i class="fa fa-download"></i></a>'.
                    ' '.
                    '<button type="button" class="btn btn-sm btn-danger mb-10" data="'.$field->id.'" onclick="tombol_hapus('.$field->id.')"> <i class="fa fa-trash"></i></button>';
 
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Regulasi_model->count_all(),
            "recordsFiltered" => $this->Regulasi_model->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    public function simpan(){
        $nama_dokumen = $this->input->post('nama_dokumen');
        $pecah_nama_dokumen = explode(" ", $nama_dokumen);
        $nama_dokumen_tanpa_spasi = implode("_", $pecah_nama_dokumen);
        
        $conf = array(
            'upload_path'   => "assets/regulasi/",
			'allowed_types' => 'pdf|doc|docx',
            'file_name'     => $nama_dokumen_tanpa_spasi
        );
        $this->upload->initialize($conf);
        if(!$this->upload->do_upload('file')){
            $respon['notif']['status'] = 'error';
            $respon['notif']['message'] = $this->upload->display_errors();
        }else{
            $data_yang_diupload = $this->upload->data();

            $data = [
                'nama_dokumen' => $this->input->post('nama_dokumen'),
                'tanggal_disahkan' => $this->input->post('tanggal_disahkan'),
                'file' => $nama_dokumen_tanpa_spasi.$data_yang_diupload['file_ext'],       
            ];
            $data = $this->Regulasi_model->simpan($data, 'tabel_regulasi', true);
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
        $data_tabel_album = $this->db->from('tabel_regulasi')->where('id', $id)->get()->row_array();
        $file = $data_tabel_album['file'];

        // Untuk menghapus gambar
        unlink('assets/regulasi/'.$file);

        $where = array(
                    'id'=>$id,
                );
        $proses = $this->Regulasi_model->hapus($where, 'tabel_regulasi');

        echo json_encode($proses);
    }

}

/* End of file Website.php */


?>