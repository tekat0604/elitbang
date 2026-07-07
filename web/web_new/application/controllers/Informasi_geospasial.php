<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Informasi_geospasial extends CI_Controller {

    function __construct(){
		parent::__construct();		
    }
    
    public function index()
    {
      $q1 = "
      select
      t1.nama_layer,
      t1.deskripsi_layer,
      t3.nama_opd,
      count(t2.id_collection) jumlah_data
      from tabel_layer t1
      inner join tabel_collection t2 on t2.id_layer = t1.id_layer
      inner join tabel_referensi_opd t3 on t3.id_opd = t1.id_opd
      where t1.id_jenis_peta = 1
      group by t1.id_layer
      ";

      $q2 = "
      select
      t1.nama_layer,
      t1.deskripsi_layer,
      t3.nama_opd,
      count(t2.id_collection) jumlah_data
      from tabel_layer t1
      inner join tabel_collection t2 on t2.id_layer = t1.id_layer
      inner join tabel_referensi_opd t3 on t3.id_opd = t1.id_opd
      where t1.id_jenis_peta = 2
      group by t1.id_layer
      ";

      $q3 = "
      select
      t1.nama_layer,
      t1.deskripsi_layer,
      t3.nama_opd,
      count(t2.id_collection) jumlah_data
      from tabel_layer t1
      inner join tabel_collection t2 on t2.id_layer = t1.id_layer
      inner join tabel_referensi_opd t3 on t3.id_opd = t1.id_opd
      where t1.id_jenis_peta = 3
      group by t1.id_layer
      ";

      $data = [
        'informasi_dasar' => $this->db->query($q1)->result_array(),
        'rencana_tata_ruang' => $this->db->query($q2)->result_array(),
        'informasi_tata_ruang' => $this->db->query($q3)->result_array()
      ];  
      $this->load->view('front/informasi_geospasial/index.php',$data);
    }

}


?>