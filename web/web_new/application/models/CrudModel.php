<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class CrudModel extends CI_Model {

    function daftar_where($where, $table){
        $this->db->where($where);
		return $this->db->get($table);
    }
    function daftar_perijinan($where, $table){
        $this->db->select('id_perijinan');
        $this->db->where('id_perijinan=id_perijinan');
        return $this->db->get($table);
    }
    function daftar_where_join($where, $table){
        $this->db->select('tabel_kelurahan.id_kelurahan, nama_kelurahan, tabel_kelurahan.id_kecamatan, nama_kecamatan');
        $this->db->from('tabel_kelurahan');
        // $this->db->join('tabel_perijinan_kkr','tabel_perijinan_kkr.id_kelurahan_pemohon = tabel_kelurahan.id_kelurahan');
        $this->db->join('tabel_kecamatan', 'tabel_kelurahan.id_kecamatan=tabel_kecamatan.id_kecamatan');
        $this->db->where('tabel_kelurahan.id_kelurahan = tabel_kelurahan.id_kelurahan');
        return $this->db->get($table);
    }

    

    function daftar_where_kecamatan($where, $table){
        $this->db->select('id_kelurahan_pemohon, nama_kecamatan');
        $this->db->join('tabel_kelurahan','tabel_kelurahan.id_kelurahan= tabel_perijinan_kkr.id_kelurahan_pemohon ');
        $this->db->join('tabel_kecamatan', 'tabel_kelurahan.id_kecamatan= tabel_kecamatan.id_kecamatan');
        $this->db->where('tabel_perijinan_kkr.id_kelurahan_pemohon= tabel_perijinan_kkr.id_kelurahan_pemohon');
        return $this->db->get($table);
    }
    function daftar_where_kecamatan_RTR($where, $table){
        $this->db->select('desa, nama_kecamatan, nama_kelurahan');
        $this->db->join('tabel_kelurahan','tabel_kelurahan.id_kelurahan= tabel_perijinan_new.desa ');
        $this->db->join('tabel_kecamatan', 'tabel_kelurahan.id_kecamatan= tabel_kecamatan.id_kecamatan');
        $this->db->where('tabel_perijinan_new.desa= tabel_kelurahan.id_kelurahan');
        return $this->db->get($table);
    }

    function daftar_where_rpr($where, $table){
        $this->db->select('nama_rpr, id_rpr');
        $this->db->join('tabel_referensi_rpr', 'tabel_referensi_rpr.id_rpr= tabel_perijinan_new.id_rencana_penggunaan');
        $this->db->where('tabel_perijinan_new.id_rencana_penggunaan= tabel_referensi_rpr.id_rpr');
        return $this->db->get($table);
    }



    function daftar_where_koordinat($where, $table){
            $this->db->select('koordinat');
            $this->db->join('tabel_perijinan_coord', 'tabel_perijinan_new.id_perijinan = tabel_perijinan_coord.id_perijinan');
            $this->db->where('tabel_perijinan_new.id_perijinan= tabel_perijinan_coord.id_perijinan');
            return $this->db->get($table);
    }
    function daftar_where_idkoordinat($where, $table){
            $this->db->select('id_koordinat');
            $this->db->join('tabel_perijinan_coord', 'tabel_perijinan_new.id_perijinan = tabel_perijinan_coord.id_perijinan');
            $this->db->where('tabel_perijinan_new.id_perijinan= tabel_perijinan_coord.id_perijinan');
            return $this->db->get($table);
    }



    function daftar($table){
		return $this->db->get($table);
    }

    function tambah($data,$table){
		$this->db->insert($table,$data);
	}

    public function edit($where,$data,$table)
    {
        $this->db->where($where);
        $this->db->update($table,$data);
    }

    public function get_edit($where, $table)
    {
        return $this->db->get_where($table,$where);
    }

    public function hapus($where, $table)
    {
        $this->db->delete($table, $where);
    }

    public function hitung($table)
    {
        return $this->db->count_all($table);
    }

    public function hitung_where($where, $table)
    {
        $this->db->where($where);
        return $this->db->count_all($table);
    }

    public function sum($column,$table)
    {
        $this->db->select_sum($column);
        return $this->db->get($table);
    }

    public function sum_where($where, $column,$table)
    {
        $this->db->where($where);
        $this->db->select_sum($column);
        return $this->db->get($table);
    }

    public function raw_qery($query)
    {
        return $this->db->query($query);
    }

    public function last_id($column, $where, $table)
    {
        $this->db->where($where);
        $query = $this->db->get($table);
        if ($query->num_rows() > 0)
        {
            $row = $query->row(); 
            return $row->column;
        }else{
            return 0;
        }
    }

}

/* End of file CrudModel.php */


?>