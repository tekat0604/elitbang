<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Rekap extends MY_Controller {
    //deklarasi variable
    private $base = 'admin';

    function __construct(){
		parent::__construct();	
        $this->load->model('Rekap_kkr_model');
        $this->load->model('Rekap_rtr_model');
        $this->load->model('CrudModel', 'crud');
        if ( ! $this->session->userdata('logged_in')){ 
            redirect('login');
        }
        if($this->session->userdata('role') != 1){
            redirect('login');
        }
	}

    function detail_rtr() {
        $id = $this->input->post('id');
        $data['hasil'] = $this->db->query("
                SELECT a.*, b.nama_kelurahan as nama_kelurahan, c.nama_kecamatan as nama_kecamatan
                FROM tabel_perijinan_new a 
                LEFT JOIN tabel_kelurahan b ON a.desa=b.id_kelurahan
                LEFT JOIN tabel_kecamatan c ON a.kecamatan = c.id_kecamatan
                WHERE a.id_perijinan='$id'
                ")->row_array(); 
        $data['data_perijinan'] =  $this->crud->get_edit(['id_perijinan' => $id], 'tabel_perijinan_new')->result()[0];
        $this->load->view('admin/rekap/modal_detail_rtr', $data);
    }

    function detail_kkr() {
        $id = $this->input->post('id');
        $data['hasil'] = $this->db->query("
                SELECT a.*, b.nama_kelurahan as nama_kelurahan, c.nama_kecamatan as nama_kecamatan
                FROM tabel_perijinan_kkr a 
                LEFT JOIN tabel_kelurahan b ON a.id_kelurahan_pemohon=b.id_kelurahan
                LEFT JOIN tabel_kecamatan c ON b.id_kecamatan = c.id_kecamatan
                WHERE a.id_perijinan_kkr='$id'
                ")->row_array(); 
        $data['data_perijinan'] =  $this->crud->get_edit(['id_perijinan_kkr' => $id], 'tabel_perijinan_kkr')->result()[0];
        $this->load->view('admin/rekap/modal_detail_kkr', $data);
    }

    public function index()
    {
        $data = [
            'isi' => "$this->base/rekap/index",
            'extra_js' => $this->load->view("$this->base/rekap/index_js", '', true),
        ];
        $this->load->view('layouts/wrapper', $data, FALSE);
        
    }

    public function get_data_kkr(){
        $list = $this->Rekap_kkr_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->nama_pemohon;
            $row[] = $field->alamat_pemohon;
            $row[] = $field->status;
            $row[] = 
                    '<button data-id="'.$field->id_perijinan_kkr.'" type="button" class="btn btn-info btn-sm btn_hapus modal-detail-kkr"><i class="fa fa-search"></i></button>'.
                    '&nbsp;'.
                    '<button data="'.$field->id_perijinan_kkr.'" type="button" class="btn btn-success btn-sm btn_hapus"><i class="fa fa-download"></i></button>';
 
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Rekap_kkr_model->count_all(),
            "recordsFiltered" => $this->Rekap_kkr_model->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    public function get_data_rtr(){
        $list = $this->Rekap_rtr_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->nama;
            $row[] = $field->alamat;
            $row[] = $field->status;
            $row[] = 
                    '<button data-id="'.$field->id_perijinan.'" type="button" class="btn btn-info btn-sm btn_hapus modal-detail-rtr"><i class="fa fa-search"></i></button>'.
                    '&nbsp;'.
                    '<button data="'.$field->id_perijinan.'" type="button" class="btn btn-success btn-sm btn_hapus"><i class="fa fa-download"></i></button>';
 
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Rekap_rtr_model->count_all(),
            "recordsFiltered" => $this->Rekap_rtr_model->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }
}

/* End of file Rekap.php */
?>