<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rekap extends MY_Controller
{
    private $base           = 'admin';
    private $menu           = 'kejadian_bencana/rekap';
    private $folder_upload  = 'kejadian_bencana';
    private $table          = 'kejadian_bencana';

    function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
        if ($this->session->userdata('role') != 1) {
            redirect('login');
        }
        $this->link_url = base_url('admin/kejadian_bencana/rekap/');
    }

    public function index()
    {
        $data_js['title']       = 'Rekap Kejadian Bencana ';
        $data_js['link_url']    =  $this->link_url;
        $data           = [
            'title'     => 'Rekap Kejadian Bencana',
            'data'      => $this->get_data(),
            'isi'       => "$this->base/$this->menu/index",
            'extra_css' => $this->load->view("$this->base/$this->menu/index_css", $data_js, true),
            'extra_js'  => $this->load->view("$this->base/$this->menu/index_js", '', true),
        ];
        // $aaa = $data['data'][0]->kb_has_korban;
        // echo count($aaa);
        // die;
        // echo json_encode($data['data'][0]->kb_has_korban);
        // die;
        $this->load->view('layouts/wrapper', $data, FALSE);
    }

    public function excel()
    {
        $file = "rekap_kejadian_bencana.xls";
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=$file");
        $data           = [
            'title'     => 'Rekap Kejadian Bencana',
            'data'      => $this->get_data(),
            'isi'       => "$this->base/$this->menu/excel",
        ];
        $this->load->view("$this->base/$this->menu/excel", $data, FALSE);
    }

    public function get_data()
    {
        $where = [
            'jenis_form' => 'form_a3',
            'aktif' => '1',
            'dihapus_pada is NULL' => NULL,
        ];
        $this->db->select('id, id_form_1, id_form_2, kerugian , kajian_kebutuhan');
        $this->db->from('kejadian_bencana');
        $this->db->where($where);
        $query = $this->db->get();
        $data = $query->result();
        foreach ($data as $dt_item) {
            $dt_item->form1         = $this->get_data_form1($dt_item->id_form_1);
            $dt_item->form2         = $this->get_data_form2($dt_item->id_form_2);
            $dt_item->kb_has_korban = $this->db->where('id_kejadian', $dt_item->id)->get('kb_has_korban')->result();
            $dt_item->count_kb_has_korban = $this->db->where('id_kejadian', $dt_item->id)->get('kb_has_korban')->num_rows();
        }
        return $data;
    }

    public function get_data_form1($id_form_1)
    {
        $where  = [
            'id'                => $id_form_1,
            'jenis_form'        => 'form_a1',
            'aktif'             => '1',
            'dihapus_pada is NULL' => NULL,
        ];
        $this->db->select('
            id, nomor_pelapor,jenis_form, nama_pelapor, jenis_kelamin, 
            alamat_pelapor, jenis_identitas, nomor_identitas, nomor_telepon
        ');

        $this->db->from('kejadian_bencana');
        $this->db->where($where);
        $query = $this->db->get();
        $row = $query->row();
        return $row;
    }

    public function get_data_form2($id_form_2)
    {
        $where  = [
            'a.id'                => $id_form_2,
            'a.jenis_form'        => 'form_a2',
            'a.aktif'             => '1',
            'a.dihapus_pada is NULL' => NULL,
        ];
        $this->db->select('
            a.id, a.jenis_kejadian, a.nomor_kejadian, 
            a.id_kecamatan_kejadian, a.id_kelurahan_kejadian, b.nama kecamatan, c.nama kelurahan,  
            a.alamat_kejadian, a.hari_kejadian, a.tanggal_kejadian, a.jam_kejadian, a.jam_laporan, 
            a.kronologi_kejadian, a.rusak_ringan, a.rusak_sedang, a.rusak_berat, 
            a.luka_ringan, a.luka_berat,a. meninggal_dunia, a.jam_kejadian, 
            a.rencana_penanganan, a.keahlian, a.dampak_kejadian, a.hambatan 
        ');
        $this->db->from('kejadian_bencana a');
        $this->db->join('tabel_kecamatan b', 'a.id_kecamatan_kejadian = b.id_kecamatan', 'LEFT');
        $this->db->join('tabel_kelurahan c', 'a.id_kelurahan_kejadian = c.id_kelurahan', 'LEFT');
        $this->db->where($where);
        $query = $this->db->get();
        $row = $query->row();
        $row->kb_has_personil           = $this->db->where('id_kejadian', $id_form_2)->get('kb_has_personil')->result();
        $row->kb_has_backup_mako        = $this->db->where('id_kejadian', $id_form_2)->get('kb_has_backup_mako')->result();
        $row->kb_has_peralatan          = $this->db->where('id_kejadian', $id_form_2)->get('kb_has_peralatan')->result();
        $row->kb_has_logistik           = $this->db->where('id_kejadian', $id_form_2)->get('kb_has_logistik')->result();
        $row->kb_has_bantuan_personil   = $this->db->where('id_kejadian', $id_form_2)->get('kb_has_bantuan_personil')->result();
        $row->kb_has_bantuan_peralatan  = $this->db->where('id_kejadian', $id_form_2)->get('kb_has_bantuan_peralatan')->result();
        $row->kb_has_bantuan_logistik   = $this->db->where('id_kejadian', $id_form_2)->get('kb_has_bantuan_logistik')->result();
        $row->kb_has_aparat_relawan     = $this->db->where('id_kejadian', $id_form_2)->get('kb_has_aparat_relawan')->result();
        return $row;
    }
}
