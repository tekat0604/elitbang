<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Map extends MY_Controller {

    function __construct(){
        parent::__construct();       
        $this->load->model('PetaQuery');
    }
    
 
    public function index() {
        $arr_loc=[];
        $get_loc = $this->PetaQuery->get_maps_ditangani($this->tahun);
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
                        <a href="'.base_url('daftar_laporan/detail/'.custom_id($row->id_lapor)).'" " 
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
            'li_lapor'=>'active',
            'locations'     => $arr_loc,
            'extra_js'  => "frontend/map/index_js",
        ];
        $this->template->content_frontend("frontend/map/index", $data);
    }
    public function Map_mobile() {
        $arr_loc=[];
        $get_loc = $this->PetaQuery->get_maps_ditangani($this->tahun);
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
                        <a href="'.base_url('daftar_laporan/detail_mobile/'.custom_id($row->id_lapor)).'" " 
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
            'li_lapor'      =>'active',
            'locations'     => $arr_loc,
            'extra_js'      => "frontend/map/index_mobile_js",
        ];
        $this->template->content_mobile_frontend("frontend/map/index_mobile", $data);
    }
    public function real_time() { 
        $this->load->view("frontend/map/real_time/index");
    }
    public function bpbd() { 
        $this->load->view("frontend/map/bpbd");
    }
    public function api(){
		// $kecamatan_id = $this->input->post('kecamatan_id'); 
        $select=" 'Point' AS type, tabel_lapor.id_lapor, tabel_lapor.created, 
        tabel_lapor.nama, tabel_lapor.email, tabel_lapor.no_hp, 
        tabel_lapor.subjek, tabel_lapor.pesan, tabel_lapor.gambar,
        tabel_lapor.lokasi, tabel_lapor.lokasi_detail, tabel_lapor.read, 
        tabel_lapor.lat, tabel_lapor.lng, 
        CASE  
        WHEN tabel_lapor.read  = '0' AND tabel_lapor.status_ditangani  = '0'  THEN 'belum dibaca'  
        WHEN tabel_lapor.read  = '1' AND tabel_lapor.status_ditangani  = '0'  THEN 'sudah dibaca'  
        WHEN tabel_lapor.read  = '1' AND tabel_lapor.status_ditangani  = '1'  THEN 'sudah ditangani'  
        ELSE 'aaa' END AS status, 
        CASE  
        WHEN tabel_lapor.read  = '0' AND tabel_lapor.status_ditangani  = '0'  THEN 'red'  
        WHEN tabel_lapor.read  = '1' AND tabel_lapor.status_ditangani  = '0'  THEN 'orange'  
        WHEN tabel_lapor.read  = '1' AND tabel_lapor.status_ditangani  = '1'  THEN 'green'  
        ELSE 'black' END AS color, 
        ref_kategori_bencana.nama_kategori_bencana AS kategori_bencana "; 
		$this->db->select($select); 
		$this->db->from('tabel_lapor'); 
		$this->db->join('ref_kategori_bencana', 'ref_kategori_bencana.id = tabel_lapor.id_kategori', 'left'); 
		//$this->db->where('tabel_lapor.deleted_at is NULL); 
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
                    "lng"		        => $dt_pt['lng'] 
                )
			);
		}
		$res['type']        = "FeatureCollection"; 
		$res['features']    = $json; 
		echo json_encode($res); 
	}
}
?>