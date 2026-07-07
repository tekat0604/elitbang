<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Layer_rtrw extends CI_Controller {

    private $base = 'opd';

    function __construct(){
		parent::__construct();		
        $this->load->model('PetaModel', 'peta');
        $this->load->model('CrudModel', 'crud');
        $this->load->library('upload');
        if ( ! $this->session->userdata('logged_in')){ 
            redirect('login');
        }
        if($this->session->userdata('role') != 2){
            redirect('login');
        }
	}

    public function index()
    {
        $data = [
            'isi' => "$this->base/layer_rtrw/index",
            'extra_js' => $this->load->view("$this->base/layer_rtrw/index_js", '', true),
        ];
        $this->load->view('layouts/wrapper', $data, FALSE);
    }

    public function get_grup_layer()
    {
        $res['data'] = $this->db->get('tabel_grup_layer_rtrw')->result_array();

        echo json_encode($res);
    }

    public function get_opd()
    {
        $res['data'] = $this->db->get('tabel_referensi_opd')->result_array();

        echo json_encode($res);
    }

    public function simpan_grup_layer()
    {
        $res = [];
        $a = array(
            'nama_grup_layer' => $this->input->post('nama_grup_layer'),
            'id_user' => $this->session->userdata('id'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        );
        $this->db->insert('tabel_grup_layer_rtrw', $a);
        if($this->db->affected_rows() > 0)
        {
            $res['data'] = $this->db->get('tabel_grup_layer_rtrw')->result_array();
        }
        echo json_encode($res);
    }

    public function edit_grup_layer()
    {
        $res = [];
        $a = array(
            'nama_grup_layer' => $this->input->post('nama_grup_layer'),
            'id_user' => $this->session->userdata('id'),
            'updated_at' => date('Y-m-d H:i:s')
        );
        $w = array(
            'id_grup_layer' => $this->input->post('id_grup_layer')
        );
        $this->db->where($w)->update('tabel_grup_layer_rtrw',$a);
        if($this->db->affected_rows() > 0)
        {
            $res['status'] = 'success';
        }
        else
        {
            $res['status'] = 'error';
        }
        echo json_encode($res);

    }

    public function hapus_grup_layer()
    {
        $res = [];
        
        if($this->input->post('id_grup_layer') > 0)
        {
            // check layers which linked to the group
            $q = "select count(id_layer) total_layer from tabel_layer_rtrw where id_grup_layer = {$this->input->post('id_grup_layer')}";
            $r = $this->db->query($q)->row_array();
            if(count($r) > 0)
            {
                $res['status'] = 'error';
                $res['message'] = 'Grup layer ini tidak bisa dihapus, karena terdapat '.$r['total_layer'].' layer yang tergabung dalam grup ini. Silahkan hapus layer terlebih dahulu.';
            }
            else
            {
                $w = array(
                    'id_grup_layer' => $this->input->post('id_grup_layer')
                );
                $this->db->where($w)->delete('tabel_grup_layer_rtrw');
                $res['status'] = 'success';
            }

        }
        else
        {
            $res['status'] = 'error';
            $res['message'] = 'Gagal menghapus grup layer!';
        }
        
        echo json_encode($res);
        
    }

    public function simpan_layer(){

        if($_FILES['geojson_layer']['name'] != '')
        {
            $path = $_FILES['geojson_layer']['name'];
            $ext =  pathinfo($path, PATHINFO_EXTENSION);

            if($ext == 'json')
            {
                $a = [
                    'id_grup_layer' => $this->input->post('grup_layer'),
                    'nama_layer' => $this->input->post('nama_layer'),
                    'slug_layer' => str_replace(' ','_',strtolower($this->input->post('nama_layer'))),
                    'id_opd' => $this->input->post('opd_layer'),
                    'id_user' => $this->session->userdata('id'),
                    'status_layer' => 1,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                $conf = array(
                    'upload_path'   => 'assets_front/geojson',
                    'file_name' => $a['slug_layer'],
                    'allowed_types' => '*'
                );
                $this->upload->initialize($conf);
                if(!$this->upload->do_upload('geojson_layer')){
                    $res['status'] = 'error';
                    $res['message'] = $this->upload->display_errors();
                }else{
                    $this->db->insert('tabel_layer_rtrw',$a);
                    if($this->db->affected_rows() > 0)
                    {
                        $res['status'] = 'success';
                        $res['message'] = 'Berhasil menambahkan layer';
                    }
                    else
                    {
                        unlink($conf['upload_path'].'/'.$a['slug_layer'].'.'.$ext);
                        $res['status'] = 'error';
                        $res['message'] = 'Gagal menambahkan layer';
                    }
                }
            }
            else
            {
                $res['status'] = 'error';
                $res['message'] = 'Silahkan upload file dengan ekstensi .json';
            }
     
        }
        else
        {
            $res['status'] = 'error';
            $res['message'] = 'File JSON tidak diketahui.';
        }

        echo json_encode($res);

    }

    public function edit_layer(){

        if($this->input->post('id_layer') > 0)
        {
            if($_FILES['geojson_layer']['name'] != '')
            {
                $path = $_FILES['geojson_layer']['name'];
                $ext =  pathinfo($path, PATHINFO_EXTENSION);
                $slug_old = str_replace(' ','_',strtolower($this->input->post('nama_layer_old')));
                if($ext == 'json')
                {
                    $a = [
                        'id_grup_layer' => $this->input->post('grup_layer'),
                        'nama_layer' => $this->input->post('nama_layer'),
                        'slug_layer' => str_replace(' ','_',strtolower($this->input->post('nama_layer'))),
                        'id_opd' => $this->input->post('opd_layer'),
                        'id_user' => $this->session->userdata('id'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ];
                    $conf = array(
                        'upload_path'   => 'assets_front/geojson',
                        'file_name' => $a['slug_layer'],
                        'allowed_types' => '*'
                    );
                    $w = array(
                        'id_layer' => $this->input->post('id_layer')
                    );

                    if(unlink($conf['upload_path'].'/'.$slug_old.'.'.$ext))
                    {
                        $this->upload->initialize($conf);
                        if(!$this->upload->do_upload('geojson_layer')){
                            $res['status'] = 'error';
                            $res['message'] = $this->upload->display_errors();
                        }else{
                            $this->db->where($w)->update('tabel_layer_rtrw',$a);
                            if($this->db->affected_rows() > 0)
                            {
                                $res['status'] = 'success';
                                $res['message'] = 'Berhasil mengubah layer';
                            }
                            else
                            {
                                unlink($conf['upload_path'].'/'.$a['slug_layer'].'.'.$ext);
                                $res['status'] = 'error';
                                $res['message'] = 'Gagal mengubah layer';
                            }
                        }
                    }
                    else
                    {
                        $res['status'] = 'error';
                        $res['message'] = 'File '.$slug_old.'.json lama tidak ditemukan';
                    }
                    
                }
                else
                {
                    $res['status'] = 'error';
                    $res['message'] = 'Silahkan upload file dengan ekstensi .json';
                }
        
            }
            else
            {
                

                if($this->input->post('nama_layer_old') != $this->input->post('nama_layer'))
                {
                    $path = 'assets_front/geojson/';
                    $slug_old = str_replace(' ','_',strtolower($this->input->post('nama_layer_old')));
                    $slug_new = str_replace(' ','_',strtolower($this->input->post('nama_layer')));
                    $name_old = $path.$slug_old.'.json';
                    $name_new = $path.$slug_new.'.json';

                    if(rename($name_old, $name_new))
                    {
                        $a = [
                            'id_grup_layer' => $this->input->post('grup_layer'),
                            'nama_layer' => $this->input->post('nama_layer'),
                            'slug_layer' => str_replace(' ','_',strtolower($this->input->post('nama_layer'))),
                            'id_opd' => $this->input->post('opd_layer'),
                            'id_user' => $this->session->userdata('id'),
                            'updated_at' => date('Y-m-d H:i:s')
                        ];
                        $w = array(
                            'id_layer' => $this->input->post('id_layer')
                        );
                        $this->db->where($w)->update('tabel_layer_rtrw',$a);
                        if($this->db->affected_rows() > 0)
                        {
                            $res['status'] = 'success';
                            $res['message'] = 'Berhasil mengubah layer';
                        }
                        else
                        {
                            $res['status'] = 'error';
                            $res['message'] = 'Gagal mengubah layer';
                        }
                    }
                    else
                    {
                        $res['status'] = 'error';
                        $res['message'] = 'Gagal mengubah nama file .json mengikuti nama layer baru';
                    }

                }
                else
                {
                    $a = [
                        'id_grup_layer' => $this->input->post('grup_layer'),
                        'id_opd' => $this->input->post('opd_layer'),
                        'id_user' => $this->session->userdata('id'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ];
                    $w = array(
                        'id_layer' => $this->input->post('id_layer')
                    );
                    $this->db->where($w)->update('tabel_layer_rtrw',$a);
                    if($this->db->affected_rows() > 0)
                    {
                        $res['status'] = 'success';
                        $res['message'] = 'Berhasil mengubah layer';
                    }
                    else
                    {
                        $res['status'] = 'error';
                        $res['message'] = 'Gagal mengubah layer';
                    }
                }
                

            }
        }
        

        echo json_encode($res);

    }

    function get_layer(){
        $q = "
            SELECT
            l.id_layer,
            l.nama_layer,
            l.slug_layer,
            gl.nama_grup_layer,
            opd.nama_opd,
            l.status_layer
            FROM tabel_layer_rtrw l
            INNER JOIN tabel_grup_layer_rtrw gl ON gl.id_grup_layer = l.id_grup_layer
            INNER JOIN tabel_referensi_opd opd ON opd.id_opd = l.id_opd
        ";
        $r = $this->db->query($q)->result_array();
        $res['data'] = $r;

        echo json_encode($res);
    }

    function get_layer_by_id(){
        $q = "
            SELECT
            l.id_layer,
            l.id_grup_layer,
            l.id_opd,
            l.nama_layer,
            l.slug_layer,
            gl.nama_grup_layer,
            opd.nama_opd,
            l.status_layer
            FROM tabel_layer_rtrw l
            INNER JOIN tabel_grup_layer_rtrw gl ON gl.id_grup_layer = l.id_grup_layer
            INNER JOIN tabel_referensi_opd opd ON opd.id_opd = l.id_opd
            WHERE 1 = 1
            AND l.id_layer = {$this->input->post('id')}
        ";
        $r = $this->db->query($q)->row_array();
        $res['data'] = $r;

        echo json_encode($res);
    }

    function cek_nama_layer(){
        $res['status'] = 'success';
        $q = "SELECT
        * 
        FROM tabel_layer_rtrw
        WHERE 1 = 1
        AND nama_layer = {$this->db->escape($this->input->post('nama_layer'))}";
        $r = $this->db->query($q)->row_array();
        if(count($r) > 0)
        {
            if( $this->input->post('nama_layer_old') != '' && $r['nama_layer'] == $this->input->post('nama_layer_old'))
            {
                $res['status'] = 'success';
            }
            else
            {
                $res['status'] = 'error';
            }
            
        }

        echo json_encode($res);
    }

    function ganti_status()
    {
        $res['status'] = 'error';
        $a['status_layer'] = $this->input->post('status_layer') == '1' ? 0 : 1;
        $this->db->where('id_layer',$this->input->post('id'))->update('tabel_layer_rtrw',$a);
        if($this->db->affected_rows() > 0)
        {
            $res['status'] = 'success';
        }

        echo json_encode($res);

    }

    function hapus_layer()
    {
        if(unlink('assets_front/geojson/'.$this->input->post('slug_layer').'.json'))
        {
            $this->db->where('id_layer',$this->input->post('id'))->delete('tabel_layer_rtrw');
            $res['status'] = 'success';
        }
        else
        {
            $res['status'] = 'error';
        }

        echo json_encode($res);
    }

    function download_geojson($nama=null)
    {
        if($nama!=null)
        {
            $zip = new ZipArchive;
            if($zip->open('assets_front/geojson_zip/'.$nama.'.zip', ZipArchive::CREATE) === TRUE)
            {
                $zip->addFile('assets_front/geojson/'.$nama.'.json', $nama.'.json');
                $zip->close();
                redirect('assets_front/geojson_zip/'.$nama.'.zip');
            }
        }
        
    }

    
}

?>