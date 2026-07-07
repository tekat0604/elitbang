<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Load_maps extends MY_Controller
{

    function __construct()
    {
        header('Access-Control-Allow-Origin: *');
        parent::__construct();
        $this->load->model('PetaQuery');
    }

    function tahun()
    {
        echo $this->tahun;
    }

    function get_maps()
    {
        $type = $this->input->get('type');
        $param = $this->input->get('param');
        $arr_loc = [];
        switch ($type) {
            case 'kategori':
                $this->db->where('kategori', $param);
                break;
            case 'search':
                $this->db->like('subjek', $param);
                $this->db->or_like('lokasi', $param);
                break;
            default:
                continue;
        }
        $get_loc = $this->PetaQuery->get_maps_ditangani($this->tahun);

        foreach ($get_loc->result() as $row) {
            if ($row->gambar != '' && $row->gambar != null) {
                $baris_img_lapor = '
                <tr>
                    <td> Foto </td>
                    <td> : </td>
                    <td> <img src=" ' . base_url('uploads/lapor/' . $row->gambar . '') . ' " style="width: 100px;"> </td>
                </tr>';
            } else {
                $baris_img_lapor = '';
            }
            $new = [];
            $new[] = '
            <div style="max-width: 360px; z-index: 99999999!important; display: block;">

            <table id="tabel_pesebaran" class="table" style="width: 100%;">
                <tr>
                    <td style="width: 50px; border-top: none;"> Subjek </td>
                    <td style="width: 5px; border-top: none;"> : </td>
                    <td style="width: 300px; border-top: none;"> ' . $row->subjek . ' </td>
                </tr>
                <tr>
                    <td> Tanggal </td>
                    <td> : </td>
                    <td> ' . tgl_indo($row->created, true) . '</td>
                </tr>
                ' . $baris_img_lapor . ' 
                <tr>
                    <td> Lokasi </td>
                    <td> : </td>
                    <td> ' . $row->lokasi . '</td>
                </tr>
                <tr>
                    <td> Link </td>
                    <td> : </td>
                    <td> 
                        <a href="' . base_url('daftar_laporan/detail/' . custom_id($row->id_lapor)) . '" target="_blank" 
                        class="btn btn-primary btn-sm" style="color: #FFF;"> Detail <i class="fa fa-arrow-right"></i> </a>
                    </td>
                </tr>
            </table>
            </div>';
            $new[] = $row->lat;
            $new[] = $row->lng;
            $arr_loc[] = $new;
        }

        echo json_encode($arr_loc);
    }

    function kategori_bencana_json()
    {
        $data = [];
        $get = $this->db->select('id,nama_kategori_bencana')->get('ref_kategori_bencana')->result();
        foreach ($get as $field) {
            $row = [];
            $row['type'] = 'button';
            $row['name'] = $field->nama_kategori_bencana;
            $row['onclick'] = "refresh_map('kategori','$field->nama_kategori_bencana')";
            $row['id'] = $field->id;
            $data[] = $row;
        }
        echo json_encode($data);
    }
}
