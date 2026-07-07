<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Processing extends MY_Controller {
    private $base = 'frontend';
    function __construct(){
		parent::__construct();
        $this->load->model('frontend/FrontendModel', 'front');
        $this->load->model('LaporModel', 'lapor');
        $this->load->model('PageModel', 'page');
    }
    
    public function lapor() {
        $data = [
            'extra_js'  => "$this->base/lapor/index_js",
        ];
        $this->template->content_frontend("$this->base/lapor/index", $data);
    }
    
    public function save_lapor() {
        //echo json_encode($this->input->post()); exit();
        $this->form_validation->set_rules('nama', '', 'required');
        $this->form_validation->set_rules('no_hp', '', 'required');
        $this->form_validation->set_rules('email', '', 'required');
        $this->form_validation->set_rules('subjek', '', 'required');
        $this->form_validation->set_rules('pesan', '', 'required');
        $this->form_validation->set_rules('lokasi', '', 'required');
        $this->form_validation->set_rules('lat', '', 'required');
        $this->form_validation->set_rules('lng', '', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('failed', '<span class="label label-danger">Semua kolom harus diisi.</span>');
            $this->lapor();
        } else{
            $kategori = $this->input->post('kategori', true);
            $explode_kategori = explode('|',$kategori);
            $this->load->library('upload');
            if($_FILES['image']){
                $config['allowed_types']    = 'jpg|png|jpeg|gif';
                $config['upload_path']      = 'uploads/lapor'; 
                $this->upload->initialize($config);
                if($this->upload->do_upload('image')){
                    $data_file      = $this->upload->data();
                    $file_name      = $data_file['raw_name'].$data_file['file_ext']; 
                    $this->page->_create_thumbs('lapor',$file_name); 
                }else{ 
                    $file_name = "";
                }
            }else{
                $file_name = "";  
            }
            
            $data_insert = [
                'id_kategori'=>$explode_kategori[0],
                'kategori'=>$explode_kategori[1],
                'nama'=>$this->input->post('nama', true),
                'no_hp'=>$this->input->post('no_hp', true),
                'email'=>$this->input->post('email', true),
                'subjek'=>$this->input->post('subjek', true),
                'pesan'=>$this->input->post('pesan', true),
                'lokasi'=>$this->input->post('lokasi', true),
                'lokasi_detail'=>$this->input->post('lokasi_detail', true),
                'lat'=>$this->input->post('lat', true),
                'lng'=>$this->input->post('lng', true),
                'created'=>date('Y-m-d H:i:s'),
                'gambar'=>$file_name
            ];

            if($this->db->insert('tabel_lapor', $data_insert)){
                $this->pusher_process();
                $this->session->set_flashdata('success', '<span class="label label-success">Laporan Anda telah dikirim.</span>');
                redirect('frontend/lapor');
            } else{
                $this->session->set_flashdata('failed', '<span class="label label-danger">Gagal saat mengirim.</span>');
                $this->lapor();
            }
        }
    }

    public function lapor_mobile() {
        $data = [
            'extra_js'  => "$this->base/lapor/index_mobile_js",
        ];
        $this->template->content_frontend("$this->base/lapor/index_mobile", $data);
    }

    public function save_lapor_mobile() {
        $this->form_validation->set_rules('nama', '', 'required');
        $this->form_validation->set_rules('no_hp', '', 'required');
        $this->form_validation->set_rules('email', '', 'required');
        $this->form_validation->set_rules('subjek', '', 'required');
        $this->form_validation->set_rules('pesan', '', 'required');
        $this->form_validation->set_rules('lokasi', '', 'required');
        $this->form_validation->set_rules('lat', '', 'required');
        $this->form_validation->set_rules('lng', '', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('failed', '<span class="label label-danger">Semua kolom harus diisi.</span>');
            $this->lapor_mobile();
        } else{
            $kategori = $this->input->post('kategori', true);
            $explode_kategori = explode('|',$kategori);
            $this->load->library('upload');
            if($_FILES['image']){
                $config['allowed_types']    = 'jpg|png|jpeg|gif';
                $config['upload_path']      = 'uploads/lapor'; 
                $this->upload->initialize($config);
                if($this->upload->do_upload('image')){
                    $data_file      = $this->upload->data();
                    $file_name      = $data_file['raw_name'].$data_file['file_ext']; 
                    $this->page->_create_thumbs('lapor',$file_name); 
                }else{ 
                    $file_name = "";
                }
            }else{
                $file_name = "";  
            }
            
            $data_insert = [
                'id_kategori'   => $explode_kategori[0],
                'kategori'      => $explode_kategori[1],
                'nama'          => $this->input->post('nama', true),
                'no_hp'         => $this->input->post('no_hp', true),
                'email'         => $this->input->post('email', true),
                'subjek'        => $this->input->post('subjek', true),
                'pesan'         => $this->input->post('pesan', true),
                'lokasi'        => $this->input->post('lokasi', true),
                'lokasi_detail' => $this->input->post('lokasi_detail', true),
                'lat'           => $this->input->post('lat', true),
                'lng'           => $this->input->post('lng', true),
                'created'       => date('Y-m-d H:i:s'),
                'gambar'        => $file_name
            ];

            if($this->db->insert('tabel_lapor', $data_insert)){
                $this->pusher_process();
                $this->session->set_flashdata('success', '<span class="label label-success">Laporan Anda telah dikirim.</span>');
                redirect('frontend/lapor_mobile');
            } else{
                $this->session->set_flashdata('failed', '<span class="label label-danger">Gagal saat mengirim.</span>');
                $this->lapor_mobile();
            }
        }
    }
    
    function update_tb_lapor(){
        $response = [];
        $value = $this->input->get('new_value');
        $kode = $this->input->get('kode', true); //table & field update & id_increment
        
        $decode_kode = hexToStr($kode);
        $explode_kode = explode('|', $decode_kode);
        
        if($explode_kode==[]){
            $response['status'] = FALSE;
            $response['message'] = 'Invalid code.';
        } else{
            $table = $explode_kode[0];
            $field = $explode_kode[1];
            $id = $explode_kode[2];
            $cek = $this->db->where('id_lapor',$id)->get($table);
            
            if($cek->num_rows()==0 || check_field_exist($table, $field)==FALSE){
                $response['status'] = FALSE;
                $response['message'] = 'Data tidak ditemukan.';
            } else{
                $this->db->where('id_lapor',$id)->update($table, [$field=>$value]);
                $response['status'] = TRUE;
                $response['message'] = 'Telah diupdate.';
            }
        }
        
        # count new
        $recount = $this->lapor->get_count($this->tahun);
        $response['count_ditangani'] = $recount->ditangani;
        
        echo json_encode($response);
    }

}

/* End of file Front.php */


?>
