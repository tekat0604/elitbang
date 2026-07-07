<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class ReferensiModel extends CI_Model {

    public function tambah($data, $table)
    {
        $this->db->insert($table,$data);
    }
    
    public function ubah($data, $table, $where)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    public function detail($where, $table) {
        $query = $this->db->get_where($table, $where);
        return $query->row_array();
    }

    function daftar_opd(){
        $hasil = $this->db->query("SELECT * FROM tabel_referensi_opd");
        return $hasil->result();
    }

    public function get_opd($id)
    {
        $hsl=$this->db->query("SELECT * FROM tabel_referensi_opd WHERE id_opd='$id'");
        if($hsl->num_rows()>0){
            foreach ($hsl->result() as $data) {
                $hasil=array(
                    'nama' => $data->nama_opd,
                    );
            }
        }
        return $hasil;
    }

    public function hapus_opd($id)
    {
        $hasil = $this->db->query("DELETE FROM tabel_referensi_opd WHERE id_opd='$id'");
        return $hasil;
    }


    // Ref Periode
    function daftar_periode(){
        $hasil = $this->db->query("SELECT * FROM ref_periode WHERE aktif='1'");
        return $hasil->result();
    }

    public function get_periode($id)
    {
        $hsl=$this->db->query("SELECT * FROM ref_periode WHERE  aktif='1' AND id='$id'");
        if($hsl->num_rows()>0){
            foreach ($hsl->result() as $data) {
                $hasil=array(
                    'periode' => $data->periode,
                    );
            }
        }
        return $hasil;
    } 
    // Ref RPR
    function daftar_rpr(){
        $hasil = $this->db->query("SELECT * FROM tabel_referensi_rpr");
        return $hasil->result();
    }

    public function get_rpr($id)
    {
        $hsl=$this->db->query("SELECT * FROM tabel_referensi_rpr WHERE id_rpr='$id'");
        if($hsl->num_rows()>0){
            foreach ($hsl->result() as $data) {
                $hasil=array(
                    'nama' => $data->nama_rpr,
                    );
            }
        }
        return $hasil;
    }

    public function hapus_rpr($id)
    {
        $hasil = $this->db->query("DELETE FROM tabel_referensi_rpr WHERE id_rpr='$id'");
        return $hasil;
    }

    // Ref Status Tanah
    function daftar_st(){
        $hasil = $this->db->query("SELECT * FROM tabel_referensi_st");
        return $hasil->result();
    }

    public function get_st($id)
    {
        $hsl=$this->db->query("SELECT * FROM tabel_referensi_st WHERE id_st='$id'");
        if($hsl->num_rows()>0){
            foreach ($hsl->result() as $data) {
                $hasil=array(
                    'nama' => $data->nama_st,
                    );
            }
        }
        return $hasil;
    }

    public function hapus_st($id)
    {
        $hasil = $this->db->query("DELETE FROM tabel_referensi_st WHERE id_st='$id'");
        return $hasil;
    }



    // Ref Rencana Pola Ruang
    public function daftar_rencana_pola_ruang(){
        $hasil = $this->db->query("SELECT * FROM tabel_referensi_rencana_pola_ruang");
        return $hasil->result();
    }

    public function get_rencana_pola_ruang($id)
    {
        $hsl=$this->db->query("SELECT * FROM tabel_referensi_rencana_pola_ruang WHERE id='$id'");
        if($hsl->num_rows()>0){
            foreach ($hsl->result() as $data) {
                $hasil=array(
                    'nama_rencana_pola_ruang' => $data->nama_rencana_pola_ruang,
                    );
            }
        }
        return $hasil;
    }

    public function hapus_rencana_pola_ruang($id)
    {
        $hasil = $this->db->query("DELETE FROM tabel_referensi_rencana_pola_ruang WHERE id='$id'");
        return $hasil;
    }

    // Referensi Icon
    function daftar_icon(){
        if($this->session->userdata('role') == 1)
        {
            $hasil = $this->db->query("SELECT * FROM tabel_referensi_icon");
        }
        else
        {
            $hasil = $this->db->query("SELECT * FROM tabel_referensi_icon WHERE id_opd = {$this->session->userdata('id_opd')}");
        }
        
        return $hasil->result();
    }

    public function get_icon($id)
    {
        $hsl=$this->db->query("SELECT * FROM tabel_referensi_icon WHERE id_icon='$id'");
        if($hsl->num_rows()>0){
            foreach ($hsl->result() as $data) {
                $hasil=array(
                    'nama' => $data->nama_icon,
                    );
            }
        }
        return $hasil;
    }

    public function hapus_icon($id)
    {
        $hasil = $this->db->query("DELETE FROM tabel_referensi_icon WHERE id_icon='$id'");
        return $hasil;
    }

    // Referensi Koordinat
    function daftar_koordinat(){
        if($this->session->userdata('role') == 1)
        {
            $hasil = $this->db->query("SELECT * FROM tabel_referensi_koordinat");
        }
        else
        {
            $hasil = $this->db->query("SELECT * FROM tabel_referensi_koordinat WHERE id_opd = {$this->session->userdata('id_opd')} OR id_opd = 0");
        }
        
        return $hasil->result();
    }

    public function get_koordinat($id)
    {
        $hsl=$this->db->query("SELECT * FROM tabel_referensi_koordinat WHERE id_koordinat='$id'")->row_array();
        // if($hsl->num_rows()>0){
        //     foreach ($hsl->result() as $data) {
        //         $hasil=array(
        //             'nama' => $data->nama_koordinat,
        //             'ket' =>$data->ket_koordinat
        //             );
        //     }
        // }
        return $hsl;
    }

    public function hapus_koordinat($id)
    {
        $hasil = $this->db->query("DELETE FROM tabel_referensi_koordinat WHERE id_koordinat='$id'");
        return $hasil;
    }


}

/* End of file ReferensiModel.php */


?>