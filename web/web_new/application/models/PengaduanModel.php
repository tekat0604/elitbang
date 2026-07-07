<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class PengaduanModel extends CI_Model {

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

    function daftar_pengaduan(){
        $hasil = $this->db->query("SELECT * FROM tabel_referensi_opd");
        return $hasil->result();
    }

    public function get_pengaduan($id)
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

    public function hapus_pengaduan($id)
    {
        $hasil = $this->db->query("DELETE FROM tabel_referensi_opd WHERE id_opd='$id'");
        return $hasil;
    }

}

/* End of file ReferensiModel.php */


?>