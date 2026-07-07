<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Datatables extends CI_Controller
{

    function __construct()
    {
        header('Access-Control-Allow-Origin: *');
        // header('Access-Control-Allow- Methods: POST, GET, PUT, DELETE, OPTIONS'); 
        // header('Access-Control-Allow-Headers: X-Requested-With, content-type, X-Token, x-token');
        parent::__construct();
    }

    function get_unduhan()
    {
        $this->load->model('PageModel');
        $data = array();

        $where = array(
            'aktif'         => '1',
            'dihapus_pada'  => NULL,
            'id_menu_utama' => 6
        );
        $list = $this->PageModel->get_data($where, 'menu');

        $no = 0;
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field['judul'];
            $row[] = '<a class="btn btn-primary" href="' . base_url('uploads/menu/' . $field['konten']) . '" target="_blank">
            <i class="fa fa-download"></i> Unduh </a>';

            $data[] = $row;
        }

        $output = array(
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    function get_gempa()
    {
        $data = array();

        $sXML = $this->download_page('https://data.bmkg.go.id/gempadirasakan.xml');
        $oXML = new SimpleXMLElement($sXML);
        $list = $oXML->Gempa;

        $no = 0;
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = (string) $field[0]->Tanggal;
            $row[] = (string) $field[0]->Posisi;
            $row[] = (string) $field[0]->Magnitude;
            $row[] = (string) $field[0]->Kedalaman;
            $row[] = (string) $field[0]->Dirasakan . '<br><i>(Ket: ' . trim((string) $field[0]->Keterangan) . ')</i>';

            $data[] = $row;
        }

        $output = array(
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    function api_gempa()
    {
        $data   = array();
        $sXML   = $this->download_page('https://data.bmkg.go.id/gempadirasakan.xml');
        $oXML   = new SimpleXMLElement($sXML);
        $list   = $oXML->Gempa;
        $no     = 0;
        foreach ($list as $field) {
            $no++;
            $row                = array();
            $row['no']          = $no;
            $row['waktu']     = (string) $field[0]->Tanggal;
            $row['posisi']      = (string) $field[0]->Posisi;
            $row['magnitude']   = (string) $field[0]->Magnitude;
            $row['kedalaman']   = (string) $field[0]->Kedalaman;
            $row['wilayah']     = (string) $field[0]->Dirasakan;
            $row['keterangan']  = (string) $field[0]->Keterangan;
            $data[]             = $row;
        }

        $output = array(
            "data"          => $data,
            "recordsTotal"  => count($list),
        );
        echo json_encode($output);
    }
    function api_unduhan()
    {
        $data = array();
        $this->db->select(
            'menu.id, menu.judul, menu.konten AS file, menu.image, menu.tanggal'
        );
        $this->db->from('menu');
        $this->db->where('menu.id_menu_utama', '6');
        $this->db->where('menu.aktif', '1');
        $this->db->where('menu.dihapus_pada', NULL);
        $this->db->order_by("menu.id", "DESC");
        $list   = $this->db->get()->result_array();
        $no     = 0;
        foreach ($list as $key => $value) {
            $no++;
            $row                            =  array();
            $row['no']                      = "" . $no . "";
            $row['id']                      = $value['id'];
            $row['judul']                   = $value['judul'];
            $row['icon']                    = base_url('assets/img/icon_document.png');


            //$row['tanggal']                 = ($value['tanggal']  != '0000-00-00') ? $this->PageModel->d($value['tanggal'])  : '00-00-0000';
            if ($value['file'] != '' && $value['file'] != null) {
                $file        = base_url('uploads/menu/' . $value['file'] . '');
            } else {
                $file        = '';
            }
            $row['file']   = $file;
            $data[]  = $row;
        }
        $output = array(
            "data"          => $data,
            "recordsTotal"  => count($list),
        );
        echo json_encode($output);
    }

    function api_agenda_pimpinan()
    {
        $this->load->model('PageModel', 'page');
        $data = array();
        $this->db->select(
            'id, nama_kegiatan, tempat_kegiatan, tanggal_kegiatan'
        );
        $this->db->from('agenda_pimpinan');
        $this->db->where('aktif', '1');
        $this->db->where('dihapus_pada', NULL);
        $this->db->order_by("id", "DESC");
        $list   = $this->db->get()->result_array();
        $no     = 0;
        foreach ($list as $key => $value) {
            $no++;
            $row                        =  array();
            $row['no']                  = "" . $no . "";
            $row['id']                  = $value['id'];
            $row['nama_kegiatan']       = $value['nama_kegiatan'];
            $row['tempat_kegiatan']     = $value['tempat_kegiatan'];
            $row['tanggal_kegiatan']    = ($value['tanggal_kegiatan']  != '0000-00-00') ? $this->page->d($value['tanggal_kegiatan'])  : '00-00-0000';

            $data[]  = $row;
        }
        $output = array(
            "data"          => $data,
            "recordsTotal"  => count($list),
        );
        echo json_encode($output);
    }

    function download_page($path)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $path);
        curl_setopt($ch, CURLOPT_FAILONERROR, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 15);
        $retValue = curl_exec($ch);
        curl_close($ch);
        return $retValue;
    }
}
