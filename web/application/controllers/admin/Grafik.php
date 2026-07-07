<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Grafik extends MY_Controller {

    function __construct(){
		parent::__construct();		 
        if ( ! $this->session->userdata('logged_in')){ 
            redirect('login');
        }
        if($this->session->userdata('role') != 1){
            redirect('login');
        } 
    }
    public function index() {
        echo"";
    }
    public function grafik_laporan() {
        $data = [
            'li_attr'       =>['li_lapor'=>'active'], 
            'isi'           => "admin/grafik/laporan/index",
            'extra_js'  => $this->load->view("admin/grafik/laporan/index_js", '', true),
        ];
        $this->load->view('layouts/wrapper', $data, FALSE);
    }
    function api(){
        //DATA JUMLAH TOTAL LAPORAN ADUAN 
        $data_total_laporan = array();
        $this->db->select('ref_kategori_bencana.id AS id_kategori, ref_kategori_bencana.nama_kategori_bencana AS kategori, 
        (select count(*) from tabel_lapor 
        where id_kategori=ref_kategori_bencana.id AND tabel_lapor.deleted_at is NULL  
        GROUP BY id_kategori) AS total_laporan');
        $this->db->from('ref_kategori_bencana'); 
        $this->db->where('ref_kategori_bencana.aktif','1'); 
        $this->db->where('ref_kategori_bencana.dihapus_pada is NULL'); 
        $list_laporan = $this->db->get()->result_array(); 
        foreach ($list_laporan as $key => $value) { 
            $row                    = array();
            $row['id_kategori']     = $value['id_kategori'];
            $row['kategori']        = $value['kategori'];  
            $row['total_laporan']   = ($value['total_laporan']  != null) ? $value['total_laporan']  : '0';  
            $data_total_laporan[]   = $row;
        }

        //DATA JUMLAh TOTAL BERITA
        $data_total_berita = array();
        $this->db->select('kategori_menu.id AS id_kategori, kategori_menu.nama_kategori_menu AS kategori, 
        (select count(*) from menu 
        WHERE id_menu_utama="3" AND id_kategori_menu=kategori_menu.id AND aktif="1" AND dihapus_pada is NULL 
        GROUP BY id_kategori_menu) AS total_berita ');
        $this->db->from('kategori_menu'); 
        $this->db->where('kategori_menu.aktif','1'); 
        $this->db->where('kategori_menu.dihapus_pada is NULL'); 
        $list_berita = $this->db->get()->result_array(); 
        foreach ($list_berita as $key => $value) { 
            $row                    = array();
            $row['id_kategori']     = $value['id_kategori'];
            $row['kategori']        = $value['kategori'];  
            $row['total_berita']   = ($value['total_berita']  != null) ? $value['total_berita']  : '0';  
            $data_total_berita[]   = $row;
        }

        //DATA JUMLAH TOTAL BENCANA 
        $data_total_korban = array();
        $this->db->select('ref_kategori_bencana.id AS id_kategori, ref_kategori_bencana.nama_kategori_bencana AS kategori, 
        (select count(*) from korban_bencana 
        where id_kategori=ref_kategori_bencana.id AND korban_bencana.aktif="1" AND korban_bencana.dihapus_pada is NULL  
        GROUP BY id_kategori) AS total_korban');
        $this->db->from('ref_kategori_bencana'); 
        $this->db->where('ref_kategori_bencana.aktif','1'); 
        $this->db->where('ref_kategori_bencana.dihapus_pada is NULL'); 
        $list_korban = $this->db->get()->result_array();
        foreach ($list_korban as $key => $value) { 
            $row                    = array();
            $row['id_kategori']     = $value['id_kategori'];
            $row['kategori']        = $value['kategori'];  
            $row['total_korban']    = ($value['total_korban']  != null) ? $value['total_korban']  : '0';  
            $data_total_korban[]    = $row;
        }


        $output = array( 
            "data_laporan"  => $data_total_laporan, 
            "data_berita"   => $data_total_berita, 
            "data_korban"   => $data_total_korban, 
        );
        echo json_encode($output); 
    }
}
?>