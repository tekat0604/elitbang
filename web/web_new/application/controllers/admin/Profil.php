<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends CI_Controller {
    private $base = 'pemohon';
    function __construct(){
		parent::__construct();		
        $this->load->model('UserModel', 'user');
        $this->load->model('CrudModel', 'crud');
        $this->load->model('CrudModel', 'crud');
        // if ( ! $this->session->userdata('logged_in')){ 
        //     redirect('login');
        // }
        // if($this->session->userdata('role') != 1){
        //     redirect('login');
        // }
	}

    public function index()
    {   
        $data_user = $this->db->where('id_user_detail', $this->session->userdata('id_user_detail'))->join('user_detail','user_detail.id_user=user_login.id_user','left')->join('tabel_kelurahan','user_detail.desa=tabel_kelurahan.id_kelurahan','left')->get('user_login')->row_array();

        $data_js = [
            'data_user_detail' => $data_user,
        ];
        $data = [
            'data_user_detail' => $data_user,
            'isi' => "$this->base/profil/index",
            'extra_js' => $this->load->view("$this->base/profil/index_js",$data_js, true),
            'daftar_kecamatan' => $this->crud->daftar('tabel_kecamatan')
        ];
        $this->load->view('layouts/wrapper', $data, FALSE);
    }

    public function data_desa()
    {
        $id = $this->input->post('id');        
        $data = $this->crud->daftar_where(['id_kecamatan' => $id], 'tabel_kelurahan')->result();
        echo json_encode($data);
    }

    public function pencarian_user()
    {
        $hasil = $this->db->select('*');
        $hasil = $this->db->from("user_detail");
        $hasil = $this->db->join("user_login", 'user_detail.id_user = user_login.id_user', 'left');
        $hasil = $this->db->where('user_detail.id_user_detail', $this->session->userdata('id'));
        $hasil = $this->db->get()->row_array();

        echo json_encode($hasil);
    }

    public function ganti_password(){
        //proses edit di tabel user login
        $where = array('id_user' => $this->input->post('ganti_id_user'));
        $data = array(
                    'user_name' => $this->input->post('ganti_username'),
                    'user_pass' => md5($this->input->post('ganti_password')),
                );
        $proses_edit_user_login = $this->user->edit($data, $where, 'user_login');

        echo json_encode($proses_edit_user_login);
    }

    public function edit(){
        //proses edit di tabel user detail
        $where = array('id_user_detail' => $this->session->userdata('id_user_detail'));
        $data = array(
                    'no_ktp' => $this->input->post('no_ktp'),
                    'nama' => $this->input->post('nama'),
                    'no_hp' => $this->input->post('no_hp'),
                    'email' => $this->input->post('email'),
                    'desa' => $this->input->post('desa'),
                    'alamat' => $this->input->post('alamat'),
                );
        $proses_edit_user_detail = $this->user->edit($data, $where, 'user_detail');

        echo json_encode($proses_edit_user_detail);
    }

}

/* End of file Perijinan.php */


?>