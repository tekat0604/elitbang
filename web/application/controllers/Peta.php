<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Peta extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    // public function index()
    // {
    //     $data = [
    //         'isi' => "$this->base/peta/index",
    //         'extra_js' => $this->load->view("$this->base/peta/index_js", '', true),
    //         'daftar_opd' => $this->peta->daftar_opd(),
    //     ];
    //     $this->load->view('layouts/wrapper', $data, FALSE);
    // }

    public function index()
    {
        $data['layers'] = array();
        $q = "SELECT * FROM tabel_layer
            WHERE 1=1
            AND status = 1
            AND IF(
		    sumber=1,
            id_layer IN (
                SELECT id_layer FROM tabel_collection GROUP BY id_layer
            ),
            1=1)
        ";
        $layers = $this->db->query($q)->result_array();

        if (count($layers) > 0) {
            foreach ($layers as $k => $v) {
                $layer = array();
                $layer['id'] = $v['id_layer'];
                $layer['id_grup_layer'] = $v['id_grup_layer'];
                $layer['id_jenis_peta'] = $v['id_jenis_peta'];
                $layer['id_opd'] = $v['id_opd'];
                $layer['name'] = $v['nama_layer'];
                $layer['slug'] = str_replace(' ', '_', strtolower($v['nama_layer']));
                array_push($data['layers'], $layer);
            }
        }

        $data['grup_layer'] = $this->db->get('tabel_grup_layer')->result_array();
        $data['jenis_peta'] = $this->db->get('tabel_jenis_peta')->result_array();

        $a  = [];

        foreach ($data['jenis_peta'] as $jpk => $jpv) {
            foreach ($data['grup_layer'] as $glk => $glv) {
                foreach ($data['layers'] as $lk => $lv) {
                    if (
                        $lv['id_jenis_peta'] == $jpv['id_jenis_peta'] &&
                        $lv['id_grup_layer'] == $glv['id_grup_layer']
                    ) {
                        $a[$jpv['id_jenis_peta']]['src'] = $jpv;
                        $a[$jpv['id_jenis_peta']]['data'][$glv['id_grup_layer']]['src'] = $glv;
                        $a[$jpv['id_jenis_peta']]['data'][$glv['id_grup_layer']]['data'][] = $lv;
                    }
                }
            }
        }
        $data['list_layer'] = $a;
        $this->load->view("front/peta/index", $data);
    }

    function get_geojson($id)
    {
        $layer = $this->db->where('id_layer', $id)->get('tabel_layer')->row_array();
        switch ($layer['sumber']) {
            case '1':
                $this->sumber_database($id);
                break;
            case '2':
                $this->sumber_api($id, $layer['link_api']);
                break;
            default:
                break;
        }
    }

    private function sumber_database($id)
    {
        $qalias = "SELECT
            t3.*
            FROM tabel_layer t1 
            INNER JOIN tabel_grup_atribut t2 ON t2.id_layer = t1.id_layer
            INNER JOIN tabel_grup_atribut_item t3 ON t3.id_grup_atribut = t2.id_grup_atribut
            WHERE 1 = 1
            AND t1.id_layer = {$this->db->escape($id)}";

        $qdata = "SELECT
        *
        FROM tabel_layer t1 
        INNER JOIN tabel_grup_atribut t2 ON t2.id_layer = t1.id_layer
        WHERE 1 = 1
        AND t1.id_layer = {$this->db->escape($id)}";

        $get_alias = $this->db->query($qalias)->result_array();
        $get_data = $this->db->query($qdata)->result_array();

        $xconfig = [];
        $xdata = [];
        $xalias = [];

        $xconfig['sumber'] = 'database';
        $xconfig['autoopen_infografis'] = true;

        if (count($get_data) > 0) {
            $group_order = json_decode($get_data[0]['pos_grup_atribut'], true);
            $group_order = $group_order['group_sort'];
            $set_order = [];

            foreach ($get_data as $v) {
                $x = [];
                $x['judul_grup'] = $v['judul_grup_atribut'];
                $x['sub_judul_grup'] = $v['sub_judul_grup_atribut'];
                $x['tipe_grup'] = $v['tipe_grup_atribut'];
                $x['ukuran_grup'] = $v['ukuran_grup_atribut'];
                $x['item_grup'] = $v['pos_grup_atribut_item'] == null ? ['item_sort'=>[]] : json_decode($v['pos_grup_atribut_item'], true);

                $set_order[$v['id_grup_atribut']] = $x;
            }

            foreach ($group_order as $v) {
                $xdata[] = $set_order[$v];
            }
        }

        foreach ($get_alias as $v) {
            $xalias[$v['id_atribut']] = $v;
        }

        // echo '<pre>';
        // // print_r($xdata);
        // echo json_encode($xalias, JSON_PRETTY_PRINT);
        // echo '</pre>';

        // // exit;

        $q = "
            SELECT
            t1.id_layer,
            t1.id_opd,
            t1.nama_layer,
            t2.id_atribut,
            t2.nama_atribut,
            t3.id_data,
            t3.id_collection,
            t3.data_value,
            t4.tipe_layer,
            t4.koordinat,
            t4.stroke,
            t4.stroke_opacity,
            t4.stroke_width,
            t4.fill,
            t4.fill_opacity,
            t4.icon_name,
            t4.`name`,
            t4.`group`,
            t4.page_detail
            FROM tabel_layer t1
            INNER JOIN tabel_atribut_layer t2 ON t2.id_layer = t1.id_layer
            INNER JOIN tabel_value_attribut t3 ON t3.id_atribut = t2.id_atribut
            INNER JOIN tabel_collection t4 ON t4.id_collection = t3.id_collection
            WHERE 1 = 1
            AND t1.id_layer = {$this->db->escape($id)}
        ";
        $r = $this->db->query($q)->result_array();
        $features = array();

        if (count($r) > 0) {
            foreach ($r as $k => $v) {
                $features[$v['id_collection']]['id_layer'] = $v['id_layer'];
                $features[$v['id_collection']]['id_opd'] = $v['id_opd'];
                $features[$v['id_collection']]['id_collection'] = $v['id_collection'];
                $features[$v['id_collection']]['nama_layer'] = $v['nama_layer'];
                $features[$v['id_collection']][$v['nama_atribut']] = $v['data_value'];
                $features[$v['id_collection']]['tipe_layer'] = $v['tipe_layer'];
                $features[$v['id_collection']]['koordinat'] = $v['koordinat'];
                $features[$v['id_collection']]['stroke'] = $v['stroke'];
                $features[$v['id_collection']]['stroke_opacity'] = $v['stroke_opacity'];
                $features[$v['id_collection']]['stroke_width'] = $v['stroke_width'];
                $features[$v['id_collection']]['fill'] = $v['fill'];
                $features[$v['id_collection']]['fill_opacity'] = $v['fill_opacity'];
                $features[$v['id_collection']]['icon_name'] = $v['icon_name'];
                $features[$v['id_collection']]['name'] = $v['name'];
                $features[$v['id_collection']]['group'] = $v['group'];
                $features[$v['id_collection']]['page_detail'] = $v['page_detail'];
            }
        }

        $geojson = array(
            "type" => "FeatureCollection",
            "xconfig" => $xconfig,
            "xdata" => $xdata,
            "xalias" => $xalias,
            "features" => array()
        );

        $feature = array();

        foreach ($features as $key => $val) {
            $property = array();
            $geometry = array();

            foreach ($val as $k => $v) {
                if ($k != 'koordinat' && $k != 'tipe_layer') {
                    $property[$k] = $v;
                } else {
                    if ($k == 'tipe_layer') {
                        $geometry['type'] = $v;
                    } else {
                        $c = json_decode($v);
                        $geometry['coordinates'] = $c;
                    }
                }
            }

            $feature[] = array(
                'type' => 'Feature',
                'properties' => $property,
                'geometry' => $geometry
            );
        }

        $geojson['features'] = $feature;



        // echo '<pre>';
        // print_r($geojson);
        // echo '</pre>';
        // print_r($query2);
        // echo '<pre>';
        // echo json_encode($geojson, JSON_PRETTY_PRINT);
        // echo '</pre>';

        // echo json_encode($geojson);

        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';

        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($geojson))
            ->_display();
        exit;
    }

    private function sumber_api($id, $link)
    {
        if ($link != null) {
            $url = $link;
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
            $res = curl_exec($curl);
            curl_close($curl);
        } else {
            $res = 'no link';
        }

        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json', 'utf-8')
            ->set_output($res)
            ->_display();
        exit;
    }

    public function informasi_detail($id = 0)
    {
        if ($id > 0) {
            $data['deskripsi'] = $this->db->where('id_collection', $id)->get('tabel_diskripsi_collection')->row_array();
            $this->load->view("front/peta/informasi_detail", $data);
        } else {
            echo "404";
        }
    }

    public function get_informasi_detail($id = 0)
    {
        if ($id > 0) {

            $q = "
                SELECT
                t1.id_layer,
                t1.id_opd,
                t1.nama_layer,
                t2.id_atribut,
                t2.nama_atribut,
                t3.id_data,
                t3.id_collection,
                t3.data_value,
                t4.tipe_layer,
                t4.koordinat,
                t4.stroke,
                t4.stroke_opacity,
                t4.stroke_width,
                t4.fill,
                t4.fill_opacity,
                t4.icon_name,
                t4.page_detail
                -- t5.deskripsi
                FROM tabel_layer t1
                INNER JOIN tabel_atribut_layer t2 ON t2.id_layer = t1.id_layer
                INNER JOIN tabel_value_attribut t3 ON t3.id_atribut = t2.id_atribut
                INNER JOIN tabel_collection t4 ON t4.id_collection = t3.id_collection
                -- LEFT JOIN tabel_diskripsi_collection t5 ON t4.id_collection = t5.id_collection
                WHERE 1 = 1
                AND t4.id_collection = {$this->db->escape($id)}
            ";
            $r = $this->db->query($q)->result_array();
            //  print_r($r);exit;
            $features = array();

            if (count($r) > 0) {
                foreach ($r as $k => $v) {
                    $features[$v['id_collection']]['id_layer'] = $v['id_layer'];
                    $features[$v['id_collection']]['id_opd'] = $v['id_opd'];
                    $features[$v['id_collection']]['id_collection'] = $v['id_collection'];
                    $features[$v['id_collection']]['nama_layer'] = $v['nama_layer'];
                    $features[$v['id_collection']][$v['nama_atribut']] = $v['data_value'];
                    $features[$v['id_collection']]['tipe_layer'] = $v['tipe_layer'];
                    $features[$v['id_collection']]['koordinat'] = $v['koordinat'];
                    $features[$v['id_collection']]['stroke'] = $v['stroke'];
                    $features[$v['id_collection']]['stroke_opacity'] = $v['stroke_opacity'];
                    $features[$v['id_collection']]['stroke_width'] = $v['stroke_width'];
                    $features[$v['id_collection']]['fill'] = $v['fill'];
                    $features[$v['id_collection']]['fill_opacity'] = $v['fill_opacity'];
                    $features[$v['id_collection']]['icon_name'] = $v['icon_name'];
                    $features[$v['id_collection']]['page_detail'] = $v['page_detail'];
                    // $features[$v['id_collection']]['deskripsi'] = $v['deskripsi'];
                }
            }

            $geojson = array(
                "type" => "FeatureCollection",
                "features" => array()
            );

            $feature = array();

            foreach ($features as $key => $val) {
                $property = array();
                $geometry = array();

                foreach ($val as $k => $v) {
                    if ($k != 'koordinat' && $k != 'tipe_layer') {
                        $property[$k] = $v;
                    } else {
                        if ($k == 'tipe_layer') {
                            $geometry['type'] = $v;
                        } else {
                            $c = json_decode($v);
                            $geometry['coordinates'] = $c;
                        }
                    }
                }

                $feature[] = array(
                    'type' => 'Feature',
                    'properties' => $property,
                    'geometry' => $geometry
                );
            }

            $geojson['features'] = $feature;


            // echo '<pre>';
            // print_r($geojson);
            // echo '</pre>';
            // print_r($query2);
            // echo '<pre>';
            // echo json_encode($geojson, JSON_PRETTY_PRINT);
            // echo '</pre>';
            // exit;

            // echo json_encode($geojson);

            // echo '<pre>';
            // print_r($data);
            // echo '</pre>';

            $this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($geojson))
                ->_display();
            exit;
        }
    }

    public function sanggar()
    {
        $data['layers'] = array();
        $q = "SELECT * FROM tabel_layer
            WHERE 1=1
            AND status = 1
            AND nama_layer IN ('Sanggar','Batas Kecamatan')
            AND id_layer IN (
                SELECT id_layer FROM tabel_collection GROUP BY id_layer
            )
        ";
        $layers = $this->db->query($q)->result_array();

        if (count($layers) > 0) {
            foreach ($layers as $k => $v) {
                $layer = array();
                $layer['id'] = $v['id_layer'];
                $layer['id_grup_layer'] = $v['id_grup_layer'];
                $layer['id_jenis_peta'] = $v['id_jenis_peta'];
                $layer['id_opd'] = $v['id_opd'];
                $layer['name'] = $v['nama_layer'];
                $layer['slug'] = str_replace(' ', '_', strtolower($v['nama_layer']));
                array_push($data['layers'], $layer);
            }
        }

        $data['grup_layer'] = $this->db->get('tabel_grup_layer')->result_array();
        $data['jenis_peta'] = $this->db->get('tabel_jenis_peta')->result_array();

        $a  = [];

        foreach ($data['jenis_peta'] as $jpk => $jpv) {
            foreach ($data['grup_layer'] as $glk => $glv) {
                foreach ($data['layers'] as $lk => $lv) {
                    if (
                        $lv['id_jenis_peta'] == $jpv['id_jenis_peta'] &&
                        $lv['id_grup_layer'] == $glv['id_grup_layer']
                    ) {
                        $a[$jpv['id_jenis_peta']]['src'] = $jpv;
                        $a[$jpv['id_jenis_peta']]['data'][$glv['id_grup_layer']]['src'] = $glv;
                        $a[$jpv['id_jenis_peta']]['data'][$glv['id_grup_layer']]['data'][] = $lv;
                    }
                }
            }
        }
        $data['list_layer'] = $a;
        $this->load->view("front/peta/sanggar", $data);
    }

    public function get_kecamatan()
    {
        $res['data'] = $this->db->get('tabel_kecamatan')->result_array();
        echo json_encode($res);
    }

    public function get_kelurahan()
    {
        $nama_kec = $this->input->post('nama_kec');
        if ($nama_kec != '') {
            $kec = $this->db->like('nama', $nama_kec)->get('tabel_kecamatan')->row_array();
            if ($kec != null) {
                $id_kec = $kec['id_kecamatan'];
                $res['data'] = $this->db->where('id_kecamatan', $id_kec)->get('tabel_kelurahan')->result_array();
            } else {
                $res['data'] = [];
            }
        } else {
            $res['data'] = [];
        }
        echo json_encode($res);
    }

    public function test()
    {
        $this->load->view('front/peta/index2');
    }
}
