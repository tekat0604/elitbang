<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {



    function __construct(){
        header('Access-Control-Allow-Origin: *'); 
        // header('Access-Control-Allow- Methods: POST, GET, PUT, DELETE, OPTIONS'); 
        // header('Access-Control-Allow-Headers: X-Requested-With, content-type, X-Token, x-token');
		parent::__construct();
	}

    public function index()
    {
        redirect(base_url());
    }

    public function get($token=false)
    {
        if($token)
        {
            $api = $this->db->where('token',$token)->get('tabel_api')->row_array();
            if($api === null)
            {
                $data['message'] = 'Token tidak valid, tidak dapat mengakses API';
                $this->load->view("front/api/index_error",$data);
            }
            else
            {
                $akses_layer = json_decode($api['akses_layer']);
                $layer = [];
                if(count($akses_layer>0))
                {
                    $in = '';
                    foreach($akses_layer as $v)
                    {
                        $in .= $v.',';
                    }
                    $in = substr($in,0,-1);
    
                    $q = "select * from tabel_layer where status = 1 and id_layer in ({$in})";
                    $layer = $this->db->query($q)->result_array();
                }
    
                $data = [
                    'extra_js' => $this->load->view("front/api/index_js",'',true),
                    'token' => $token,
                    'akses_layer' => $layer 
                ];
                
                $this->load->view("front/api/index",$data);
            }
            
        }
        else
        {
            redirect(base_url());
        }
        
    }

    public function geojson($token=false,$id=false)
    {
        if($token && $id)
        {
            $api = $this->db->where('token',$token)->get('tabel_api')->row_array();
            if($api === null)
            {
                $data['message'] = 'Token tidak valid, tidak dapat mengakses API';
                $this->load->view("front/api/index_error",$data);
            }
            else
            {
                $akses_layer = json_decode($api['akses_layer']);
                if(in_array($id,$akses_layer))
                {
                    $this->get_geojson($id);
                }
                else
                {
                    $data['message'] = 'Anda tidak memiliki hak akses API';
                    $this->load->view("front/api/index_error",$data);
                }
            }
            
        }
        else
        {
            redirect(base_url());
        }
    }

    private function get_geojson($id){
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

    private function sumber_database($id){
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
            AND t1.status = 1
            AND t1.id_layer = {$this->db->escape($id)}
        ";
        $r = $this->db->query($q)->result_array();
        $features = array();

        if(count($r) > 0){
            foreach($r as $k=>$v){
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
            "features" => array()
        );

        $feature = array();

        foreach($features as $key => $val)
        {
            $property = array();
            $geometry = array();

            foreach($val as $k => $v)
            {
                if($k != 'koordinat' && $k != 'tipe_layer')
                {
                    $property[$k] = $v;
                }
                else
                {
                    if($k == 'tipe_layer')
                    {
                        $geometry['type'] = $v;
                    }
                    else
                    {
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
    


}

/* End of file Peta.php */


?>