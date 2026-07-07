<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Lapor extends MY_Controller {

    private $base = 'admin';

    function __construct() {
        parent::__construct();
        $this->load->model('LaporModel', 'lapor');
        $this->load->library('upload');
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
        if ($this->session->userdata('role') != 1) {
            redirect('login');
        }
    }

    public function index() {
        $count = $this->lapor->get_count($this->tahun);
        $arr_loc=[];
        $get_loc = $this->db->select('id_lapor,created,subjek,gambar,lokasi,lat,lng')->where('YEAR(created)',$this->tahun)->get('tabel_lapor');
        foreach($get_loc->result() as $row){ 
            $new=[];
             if($row->gambar!='' && $row->gambar!=null){
                $baris_img_lapor = '
                <tr>
                    <td> Foto </td>
                    <td> : </td>
                    <td> <img src=" '.base_url('uploads/lapor/'.$row->gambar.'').' " style="width: 100px;"> </td>
                </tr>';
            }else{
                $baris_img_lapor = '';
            }
            $new[]='
            <div style="max-width: 360px; z-index: 99999999!important; display: block;">

            <table id="tabel_pesebaran" class="table" style="width: 100%;">
                <tr>
                    <td style="width: 50px; border-top: none;"> Subjek </td>
                    <td style="width: 5px; border-top: none;"> : </td>
                    <td style="width: 300px; border-top: none;"> '.$row->subjek.' </td>
                </tr>
                <tr>
                    <td> Tanggal </td>
                    <td> : </td>
                    <td> '.tgl_indo($row->created, true).'</td>
                </tr>
                '.$baris_img_lapor.' 
                <tr>
                    <td> Lokasi </td>
                    <td> : </td>
                    <td> '.$row->lokasi.'</td>
                </tr>
                <tr>
                    <td> Link </td>
                    <td> : </td>
                    <td> 
                        <a href="'.base_url('admin/lapor/detail/'.custom_id($row->id_lapor)).'" " 
                        class="btn btn-primary btn-sm" style="color: #FFF;"> Detail <i class="fa fa-arrow-right"></i> </a>
                    </td>
                </tr>
            </table>
            </div>'; 
            $new[]=$row->lat;
            $new[]=$row->lng;
            $arr_loc[]=$new;
        }
        $data = [
            'li_attr'=>['li_lapor'=>'active'],
            'count'=>$count,
            'isi' => "$this->base/lapor/index",
            'extra_js' => $this->load->view("$this->base/lapor/index_js", ['locations'=>$arr_loc], true)
        ];
        $this->load->view('layouts/wrapper', $data, FALSE);
    }
    
    public function daftar_lapor($status) {
        $list = $this->lapor->get_datatables($this->tahun,$status);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $read = ($field->read=='0'?'<b>'.$field->nama.'</b>':$field->nama);
            $balas = ($field->created_balasan!=null?'<i class="fa fa-check" style="color: green;"></i> ':'<i class="fa fa-times" style="color: red;"></i> ');
            
            # tombol update ditangani muncul setelah dibalas
            $update_status_ditangani = ($field->created_balasan!=null ? '<div class="custom-control custom-checkbox custom-control-inline mb-5">
                        <input class="custom-control-input" type="checkbox" 
                        data-kode="'.strToHex('tabel_lapor|status_ditangani|'.$field->id_lapor).'" 
                        id="'.strToHex('tabel_lapor|status_ditangani|'.$field->id_lapor).'" 
                        '.($field->status_ditangani=='1'?'checked':'').' onchange="update_value(this)">
                        <label class="custom-control-label" for="'.strToHex('tabel_lapor|status_ditangani|'.$field->id_lapor).'"></label>
                    </div>':'<i><span>Belum dibalas</span></i>');
            
            $no++;
            $row = array();
            //$row[] = $no;
            $row[] = $read;
            $row[] = '<b>'.ucfirst($field->kategori).'</b> - '.$field->subjek;
            $row[] = $field->created;
            $row[] = $update_status_ditangani;
            $row[] = '<div class="btn-group btn-group-sm" role="group" aria-label="btnGroup1">
                        <button type="button" class="btn btn-primary" onclick="go_to(\''.base_url('admin/lapor/detail/'.custom_id($field->id_lapor)).'\')" title="Detail"><i class="fa fa-mail-reply"></i> Balas</button>
                    </div>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->lapor->count_all($this->tahun,$status),
            "recordsFiltered" => $this->lapor->count_filtered($this->tahun,$status),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    public function detail($_id=null) {
        if(@$_id){
            $id = real_id($_id);
            if($id!=''){
                $get = $this->db->where('id_lapor',$id)->get('tabel_lapor');
                if($get->num_rows()==1){
                    $row = $get->row();

                    # update read status and last_read
                    $this->db->where('id_lapor',$id)->update('tabel_lapor',['read'=>'1','last_read'=>date('Y-m-d H:i:s')]);
                    $this->pusher_process();

                    $can_reply = (filter_var($row->email, FILTER_VALIDATE_EMAIL)?true:false);
                    $data = [
                        'isi' => "$this->base/lapor/detail",
                        'extra_js' => $this->load->view("$this->base/lapor/detail_js", ['can_reply'=>$can_reply,'data'=>$row], true),
                        'data'=>$row,
                        'can_reply'=>$can_reply
                    ];
                    $this->load->view('layouts/wrapper', $data, FALSE);
                } else{
                    $this->session->set_flashdata('failed','Data tidak ditemukan');
                    redirect('admin/lapor');
                }
            } else{
                $this->session->set_flashdata('failed','Data tidak ditemukan');
                redirect('admin/lapor');
            }
        } else{
            $this->session->set_flashdata('failed','Missing parameters');
            redirect('admin/lapor');
        }
    }
    
    function send_reply(){
        $response=[];
        $this->form_validation->set_rules('id_lapor', '', 'required');
        $this->form_validation->set_rules('balasan', '', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $response=[
                'status'=>false,
                'message'=>'Balasan harus diisi.'
            ];
        } else{
            $id = $this->input->post('id_lapor', true);
            $balasan = $this->input->post('balasan', true);
            $data_update = [
                'balasan'=>$balasan,
                'created_balasan'=>date('Y-m-d H:i:s'),
            ];
            $get = $this->db->where('id_lapor',$id)->get('tabel_lapor');
            
            if($get->num_rows()==1){
                $row = $get->row();
                $data['pengirim'] = $row;
                $data['new_message'] = nl2br($balasan);
                
                # START send email
                $message = $this->load->view('admin/lapor/template_balasan',$data,true);
                $this->load->library('email');
                $this->email->initialize(array(
                    'protocol'    => 'smtp',
                    'smtp_host'   => 'smtp.sendgrid.net',
                    'smtp_user'   => 'ikkinaii@gmail.com',
                    'smtp_pass'   => 'Kemiri270912',
                    'smtp_port'   => 587,
                    'crlf'        => "\r\n",
                    'newline'     => "\r\n"
                ));
                
                $this->email->from('noreply', 'BPBD Kota Surakarta');
                $this->email->to($row->email);
                $this->email->subject('Respon Pengaduan dari BPBD Kota Surakarta');
                $this->email->set_mailtype('html');
                $this->email->message($message);
                $this->email->send();
                # END send email
                
                # update row
                if($this->db->where('id_lapor',$id)->update('tabel_lapor', $data_update)){
                    $this->pusher_process();
                    $response=[
                        'status'=>true,
                        'message'=>'Balasan telah dikirim.'
                    ];
                } else{
                    $response=[
                        'status'=>false,
                        'message'=>'Gagal saat mengirim balasan.'
                    ];
                }
            } else{
                $response=[
                    'status'=>false,
                    'message'=>'Data tidak ditemukan.'
                ];
            }
        }
        echo json_encode($response);
    }
    
    function peta(){
        $count = $this->lapor->get_count($this->tahun);
        
        $arr_loc=[];
        $get_loc = $this->db->select('id_lapor,created,subjek,gambar,lokasi,lat,lng')->where('YEAR(created)',$this->tahun)->get('tabel_lapor');
        foreach($get_loc->result() as $row){ 
            $new=[];
             if($row->gambar!='' && $row->gambar!=null){
                $baris_img_lapor = '
                <tr>
                    <td> Foto </td>
                    <td> : </td>
                    <td> <img src=" '.base_url('uploads/lapor/'.$row->gambar.'').' " style="width: 100px;"> </td>
                </tr>';
            }else{
                $baris_img_lapor = '';
            }
            $new[]='
            <div style="max-width: 360px; z-index: 99999999!important; display: block;">

            <table id="tabel_pesebaran" class="table" style="width: 100%;">
                <tr>
                    <td style="width: 50px; border-top: none;"> Subjek </td>
                    <td style="width: 5px; border-top: none;"> : </td>
                    <td style="width: 300px; border-top: none;"> '.$row->subjek.' </td>
                </tr>
                <tr>
                    <td> Tanggal </td>
                    <td> : </td>
                    <td> '.tgl_indo($row->created, true).'</td>
                </tr>
                '.$baris_img_lapor.' 
                <tr>
                    <td> Lokasi </td>
                    <td> : </td>
                    <td> '.$row->lokasi.'</td>
                </tr>
                <tr>
                    <td> Link </td>
                    <td> : </td>
                    <td> 
                        <a href="'.base_url('admin/lapor/detail/'.custom_id($row->id_lapor)).'" " 
                        class="btn btn-primary btn-sm" style="color: #FFF;"> Detail <i class="fa fa-arrow-right"></i> </a>
                    </td>
                </tr>
            </table>
            </div>'; 
            $new[]=$row->lat;
            $new[]=$row->lng;
            $arr_loc[]=$new;
        }
        
        $data = [
            'li_attr'=>['li_lapor'=>'active'],
            'count'=>$count,
            'isi' => "$this->base/lapor/peta",
            'extra_js' => $this->load->view("$this->base/lapor/peta_js", ['locations'=>$arr_loc], true)
        ];
        $this->load->view('layouts/wrapper', $data, FALSE);
    }
    
    function get_maps($param){
        $arr_loc=[];
        switch($param){
            case 'dibalas': 
                $this->db->where('created_balasan is not null',null,false);
                break;
            case 'belum_dibalas': 
                $this->db->where('created_balasan is null',null,false);
                break;
            case 'ditangani': 
                $this->db->where('status_ditangani','1');
                break;
            default : 
                continue;
        }
        $get_loc = $this->db->select('id_lapor,created,subjek,lat,lng')->where('YEAR(created)',$this->tahun)->get('tabel_lapor');
        
        foreach($get_loc->result() as $row){
            $new=[];
            $new[]='<a href="'.base_url('admin/lapor/detail/'.custom_id($row->id_lapor)).'" target="_blank">'.$row->subjek.'<br><small><i>'.tgl_indo($row->created, true).'</i></small></a>';
            $new[]=$row->lat;
            $new[]=$row->lng;
            $arr_loc[]=$new;
        }
        
        echo json_encode($arr_loc);
    }

    public function api_peta(){ 
        $select=" 'Point' AS type, tabel_lapor.id_lapor, tabel_lapor.created, 
        tabel_lapor.nama, tabel_lapor.email, tabel_lapor.no_hp, 
        tabel_lapor.subjek, tabel_lapor.pesan, tabel_lapor.gambar,
        tabel_lapor.lokasi, tabel_lapor.lokasi_detail, tabel_lapor.read, 
        tabel_lapor.lat, tabel_lapor.lng, 
        CASE  
        WHEN tabel_lapor.read  = '0' AND tabel_lapor.status_ditangani  = '0'  THEN 'belum dibaca'  
        WHEN tabel_lapor.read  = '1' AND tabel_lapor.status_ditangani  = '0'  THEN 'sudah dibaca'  
        WHEN tabel_lapor.read  = '1' AND tabel_lapor.status_ditangani  = '1'  THEN 'sudah ditangani'  
        ELSE 'belum dibaca' END AS status, 
        CASE  
        WHEN tabel_lapor.read  = '0' AND tabel_lapor.status_ditangani  = '0'  THEN 'red'  
        WHEN tabel_lapor.read  = '1' AND tabel_lapor.status_ditangani  = '0'  THEN 'orange'  
        WHEN tabel_lapor.read  = '1' AND tabel_lapor.status_ditangani  = '1'  THEN 'green'  
        ELSE 'red' END AS color, 
        ref_kategori_bencana.nama_kategori_bencana AS kategori_bencana "; 
		$this->db->select($select); 
		$this->db->from('tabel_lapor'); 
		$this->db->join('ref_kategori_bencana', 'ref_kategori_bencana.id = tabel_lapor.id_kategori', 'LEFT');  
        $this->db->where('tabel_lapor.deleted_at is NULL'); 
		$this->db->order_by('tabel_lapor.id_lapor', 'ASC');
		$data_peta = $this->db->get()->result_array(); 
		$json = array(); 
		foreach ($data_peta as $dt_pt) {
            if($dt_pt['gambar']!='' && $dt_pt['gambar']!=null){
                $img = base_url('/uploads/lapor/'.$dt_pt["gambar"].'');
            }else{
                $img = '';
            }
			$json[] = array(
                "type"      => "Feature",
                "geometry" => array(
					"type"          => "Point",
					"coordinates"   => array(
						$dt_pt['lng'] , $dt_pt['lat'] 
					),
				),
				"properties" => array( 
                    "id"                => $dt_pt['id_lapor'],    
                    "nama"		        => $dt_pt['nama'],
                    "email"		        => $dt_pt['email'],
                    "no_hp"		        => $dt_pt['no_hp'],
					"kategori_bencana"	=> $dt_pt['kategori_bencana'],
                    "subjek"		    => $dt_pt['subjek'],
                    "tanggal"		    => tgl_indo($dt_pt['created'], true),
                    "img"		        => $img,
                    "pesan"		        => $dt_pt['pesan'],
                    "lokasi"		    => $dt_pt['lokasi'],
                    "detail_lokasi"     => $dt_pt['lokasi_detail'], 
                    "status"            => $dt_pt['status'],
                    "color"		        => $dt_pt['color'],
                    "lat"		        => $dt_pt['lat'],
                    "lng"		        => $dt_pt['lng'],
                    "link_detail"       => base_url('admin/lapor/detail/'.custom_id($dt_pt['id_lapor']).'')
                )
			);
		}
		$res['type']        = "FeatureCollection"; 
		$res['features']    = $json; 
		echo json_encode($res); 
	}
}

/* End of file Peta.php */
