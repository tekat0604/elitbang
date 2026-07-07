<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Layanan extends CI_Controller {
    private $base = 'admin';

    function __construct(){
		parent::__construct();		
        $this->load->model('Layanan_model', 'Layanan_model');
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
        $id_layanan = "1";

        $where = array( 'id' => $id_layanan );
        $data_layanan = $this->Layanan_model->pencarian($where, 'tabel_layanan');
        
        $data = [
            'data_layanan' => $data_layanan,
            'isi' => "$this->base/website/layanan/index",
            'extra_js' => $this->load->view("$this->base/website/layanan/index_js", '', true),
        ];
        $this->load->view('layouts/wrapper', $data, FALSE);
    }

    public function edit($id_layanan=null)
    {
        $id_layanan = "1";

        $where = array( 'id' => $id_layanan );
        $data_layanan = $this->Layanan_model->pencarian($where, 'tabel_layanan');
        $data = [
            'data_layanan' => $data_layanan,
            'isi' => "$this->base/website/layanan/edit",
            'extra_js' => $this->load->view("$this->base/website/layanan/edit_js", '', true),
        ];
        $this->load->view('layouts/wrapper', $data, FALSE);
    }

    public function get_data(){
        $list = $this->Layanan_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->nama_dokumen;
            $row[] = date('m-d-Y', strtotime($field->tanggal_disahkan));
            $row[] = 
                    '<a href="'.base_url('assets/layanan/').$field->file.'" class="btn btn-sm btn-success mb-10"> <i class="fa fa-download"></i></a>'.
                    ' '.
                    '<button type="button" class="btn btn-sm btn-danger mb-10" data="'.$field->id.'" onclick="tombol_hapus('.$field->id.')"> <i class="fa fa-trash"></i></button>';
 
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Layanan_model->count_all(),
            "recordsFiltered" => $this->Layanan_model->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    public function do_simpan(){
        if ($this->input->post()) {
            $nama_layanan = $this->input->post('nama_layanan');
            $isi_layanan = $this->input->post('isi_layanan');

            $data = array(
                        'nama_layanan' => $nama_layanan,
                        'isi_layanan' => $isi_layanan,
                    );
            $proses = $this->Layanan_model->simpan($data, 'tabel_layanan');

            echo json_encode($proses);
        }
    }

    public function do_edit(){
        if ($this->input->post()) {
            $id = $this->input->post('id');
            $nama_layanan = $this->input->post('nama_layanan');
            $isi_layanan = $this->input->post('isi_layanan');

            $where = array(
                        'id' => $id,
                    );

            $data = array(
                        'nama_layanan' => $nama_layanan,
                        'isi_layanan' => $isi_layanan,
                    );
            $proses = $this->Layanan_model->edit($data, $where, 'tabel_layanan');

            echo json_encode($proses);
        }
    }

    public function do_hapus(){
        if ($this->input->post()) {
            $id = $this->input->post('id');
            $nama_layanan = $this->input->post('nama_layanan');
            $isi_layanan = $this->input->post('isi_layanan');

            $where = array(
                        'id' => $id,
                    );

            $data = array(
                        'nama_layanan' => $nama_layanan,
                        'isi_layanan' => $isi_layanan,
                    );
            $proses = $this->Layanan_model->edit($data, $where, 'tabel_layanan');

            echo json_encode($proses);
        }
    }

}

/* End of file Website.php */


?>