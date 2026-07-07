<?php


defined('BASEPATH') or exit('No direct script access allowed');

class PetaQuery extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    function get_maps_ditangani($tahun)
    {
        return $this->db->select('id_lapor,created,subjek,gambar,lokasi,lat,lng')->where('YEAR(created)', $tahun)->where('status_ditangani', '1')->get('tabel_lapor');
    }
}
