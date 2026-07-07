<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Data extends CI_Controller {
    private $base = 'admin/frontend';
    function __construct(){
        parent::__construct();      
        $this->load->model('frontend/FrontendModel', 'data');
        // if ( ! $this->session->userdata('logged_in')){ 
        //     redirect('login');
        // }
        // if($this->session->userdata('role') != 1){
        //     redirect('login');
        // }
        // $this->load->library('upload');
    } 

    public function index()
    {
        $data = [
            'isi' => "$this->base/data/index",
            'extra_js' => $this->load->view("$this->base/data/index_js", '', true),
        ];
        $this->load->view('layouts/wrapper', $data, FALSE);   
    }

    public function detail_data($id)
    {
        if (@$id) {
            $data = [
                'id' => $id,
                'isi' => "$this->base/data/detail/index",
                'extra_js' => $this->load->view("$this->base/data/detail/index_js", '', true),
            ];
            $this->load->view('layouts/wrapper', $data, FALSE); 
        } else {
            echo "halaman tidak ditemukan";
        }
          
    }

    public function form_data()
    { 
        // print_r($this->input->post()); exit();
        $data_data = '';
        $id = $this->input->post('id');
        if($id == ""){
            $data_data = array(
                'judul' => $this->input->post('judul'), 
                'deskripsi' => $this->input->post('deskripsi'), 
 
                'aktif' => '1',
                'dibuat_pada' => date("Y-m-d H:i:s"),

                'dibuat_oleh' => $this->session->userdata('id'),
            ); 

            $data = $this->data->tambah($data_data,'frontend_data');
        }else{
            $where = array('id' => $id);
            $data_data = array(
                'judul' => $this->input->post('judul'), 
                'deskripsi' => $this->input->post('deskripsi'), 
 
                'aktif' => '1',
                'diubah_pada' => date("Y-m-d H:i:s"),

                'diubah_oleh' => $this->session->userdata('id'),
            ); 

            $data = $this->data->ubah($data_data, 'frontend_data', $where);        
        }
        echo json_encode($data);
    }

    public function form_data_atribut()
    { 
        // print_r($this->input->post()); exit();
        $data_data = '';
        $id = $this->input->post('id_atribut');
        if($id == ""){
            $data_data = array(
                'nama' => $this->input->post('nama'),   
                'id_data' => $this->input->post('id_data'),   
 
                'tampil' => '1',
                'aktif' => '1',
                'dibuat_pada' => date("Y-m-d H:i:s"),

                'dibuat_oleh' => $this->session->userdata('id'),
            ); 

            $data = $this->data->tambah($data_data,'ref_atribut_data');
        }else{
            $where = array('id' => $id);
            $data_data = array(
                'nama' => $this->input->post('nama'),
                'id_data' => $this->input->post('id_data'), 
 
                'tampil' => '1',
                'aktif' => '1',
                'diubah_pada' => date("Y-m-d H:i:s"),

                'diubah_oleh' => $this->session->userdata('id'),
            ); 

            $data = $this->data->ubah($data_data, 'ref_atribut_data', $where);        
        }
        echo json_encode($data_data);
    }

    public function form_data_detail()
    { 
        // print_r($this->input->post()); exit();
        $data_data = '';
        $id = $this->input->post('id_detail');
        if($id == ""){
            $data_data = array(
                'tahun' => $this->input->post('tahun'),   
                'nilai' => $this->input->post('nilai'),   
                'id_ref_atribut_data' => $this->input->post('id_atribut'),   
 
                'tampil' => '1',
                'aktif' => '1',
                'dibuat_pada' => date("Y-m-d H:i:s"),

                'dibuat_oleh' => $this->session->userdata('id'),
            ); 

            $data = $this->data->tambah($data_data,'detail_data');
        }else{
            $where = array('id' => $id);
            $data_data = array(
                'tahun' => $this->input->post('tahun'),   
                'nilai' => $this->input->post('nilai'),
                'id_ref_atribut_data' => $this->input->post('id_atribut'), 
 
                'tampil' => '1',
                'aktif' => '1',
                'diubah_pada' => date("Y-m-d H:i:s"),

                'diubah_oleh' => $this->session->userdata('id'),
            ); 

            $data = $this->data->ubah($data_data, 'detail_data', $where);        
        } 
        echo json_encode($data);
    }

    public function get_data()
    {
        $id = $this->input->get('id');
        $data = $this->data->get_data($id);
        echo json_encode($data);
    }

    public function get_atribut_data()
    {
        $id = $this->input->get('id');
        $data = $this->data->get_atribut_data($id);
        echo json_encode($data);
    }

    public function get_detail_data()
    {
        $id = $this->input->get('id');
        $data = $this->data->get_detail_data($id);
        echo json_encode($data);
    }

    public function daftar_data()
    {
        $data=$this->data->daftar_data();
        echo json_encode($data);
    }

    public function daftar_detail_data($id)
    {
        // $id = $this->input->post('id');
        $data=$this->data->daftar_detail_data($id);
        echo json_encode($data);
    }

    public function daftar_atribut_data($id)
    {
        // $id = $this->input->post('id');
        $data=$this->data->daftar_atribut_data($id);
        echo json_encode($data);
    }

    public function daftar_detail($id)
    {
        // $id = $this->input->post('id');
        $data=$this->data->daftar_detail($id);
        echo json_encode($data);
    }

    function data_detail_grafik($id)
    { 
        // name: 'Tokyo',
        // data: [7.0, 6.9, 9.5, 14.5, 18.4, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6] 
        $d = $this->db->select('*')->where(['id_data' => $id,'aktif' => '1','tampil' => '1','dihapus_pada is NULL'])->get('ref_atribut_data')->result();
        // echo json_encode($d); exit();
        $res = array();
        foreach ($d as $value_d) {
            $name = array(); 
            $categories = array(); 
            $name['name'] = $value_d->nama; 
            $e = $this->db->select('*')->where(['id_ref_atribut_data' => $value_d->id,'aktif' => '1','tampil' => '1','dihapus_pada is NULL'])->order_by('tahun')->get('detail_data')->result();
            $detail = array();
            foreach ($e as $value_e) {  
                $detail[] = @$value_e->nilai ? (double) $value_e->nilai : 0;  
            }
            $name['data'] = $detail; 

            $res[] = $name; 
        }

        $kategori = $this->db->query("
            SELECT 
            DISTINCT(detail_data.tahun) 
            FROM ref_atribut_data 
            LEFT JOIN detail_data ON ref_atribut_data.id = detail_data.id_ref_atribut_data
            WHERE ref_atribut_data.id_data ='$id' AND ref_atribut_data.aktif = '1' AND ref_atribut_data.tampil = '1' AND ref_atribut_data.dihapus_pada is NULL
            ORDER BY tahun
            ")->result(); 
        $res_kategori = array();
        foreach ($kategori as $value_res_kategori) { 
            $res_kategori[] = $value_res_kategori->tahun; 
        } 

        echo json_encode(array(['res' =>$res,'kategori' => $res_kategori ]));
    }

    public function hapus_data()
    {
        $id = $this->input->post('id');
        // $d = $this->db->where('id', $this->input->post('id'))->get('frontend_data')->row_array(); 

        $data = $this->data->hapus_data($id);
        echo json_encode($data);
    }

    public function hapus_data_atribut()
    {
        $id_atribut = $this->input->post('id_atribut'); 
        $d = $this->db->select('COUNT(id) as jumlah')->where(['id_ref_atribut_data' => $this->input->post('id_atribut'),'aktif' => '1','dihapus_pada is NULL'])->get('detail_data')->row()->jumlah; 
        // print_r($d); exit();
        if (@$d > 0) {
            echo json_encode(['status' => '0','data' => 'Masih ada data detailnya']);
        } else {
            $data = $this->data->hapus_data_atribut($id_atribut);
            echo json_encode(['status' => '1','data' => $data]);
        } 

    }

    public function hapus_data_detail()
    {
        $id = $this->input->post('id');
        // $d = $this->db->where('id', $this->input->post('id'))->get('frontend_data')->row_array(); 

        $data = $this->data->hapus_data_detail($id);
        echo json_encode($data);
    }

    public function aktif_data_atribut()
    {
        $id = $this->input->post('id'); 
        $data = $this->data->aktif_atribut($id);
        echo json_encode($data);
    }

    public function nonaktif_data_atribut()
    {
        $id = $this->input->post('id'); 
        $data = $this->data->nonaktif_atribut($id);
        echo json_encode($data);
    }

    public function aktif_data_detail()
    {
        $id = $this->input->post('id'); 
        $data = $this->data->aktif_detail($id);
        echo json_encode($data);
    }

    public function nonaktif_data_detail()
    {
        $id = $this->input->post('id'); 
        $data = $this->data->nonaktif_detail($id);
        echo json_encode($data);
    }

    public function select_atribut($id){
        $data = $this->db->where(['id_data' => $id,'aktif' => '1', 'tampil' => '1', 'dihapus_pada is NULL'])->get('ref_atribut_data')->result();

        echo json_encode($data);
    }

}

/* End of file data.php */


?>