<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class PengungsianModel extends CI_Model {

    public function tambah($data, $table)
    {
        $this->db->insert($table,$data);
    }
    
    public function ubah($data, $where, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    public function detail($where, $table) {
        $query = $this->db->get_where($table, $where);
        return $query->row_array();
    }

    function daftar_pengungsian(){
        $name = $this->session->userdata('id_pengaduan');
        $hsl = $this->db->query("SELECT * FROM tabel_pengungsian where aktif='1' and id_pengaduan='$name'");        
        // var_dump($name,$hsl->result());
        // die;
        if($hsl->num_rows()>0){
            foreach ($hsl->result() as $data) {
                $hasil[]=array(
                    'id_pengungsian' => $data -> id_pengungsian,
                    'kapasitas' => $data->kapasitas,
                    'alamat' => $data->alamat,
                    'keterangan' => $data->keterangan,
                    );
            }
        }
        else {
            $hasil = $hsl->result();
        }
        return $hasil;
    }

    public function get_pengungsian($id)
    {
        $ids = (int) $id;
        $name = $this->session->userdata('id_pengaduan');
        $hsl=$this->db->query("SELECT * FROM tabel_pengungsian WHERE id_pengungsian='$ids' and id_pengaduan='$name'");
        return json_encode($hsl->result());        
        
    }
    function daftar_pengungsians(){
        $name = $this->session->userdata('id_pengaduan');
        var_dump($name);
        die;
        $hsl = $this->db->query("SELECT * FROM tabel_pengungsian where aktif='1' and id_pengaduan='$name'");        
        if($hsl->num_rows()>0){
            foreach ($hsl->result() as $data) {
                $hasil[]=array(
                    'id_pengungsian' => $data -> id_pengungsian,
                    'kapasitas' => $data->kapasitas,
                    'alamat' => $data->alamat,
                    'keterangan' => $data->keterangan,
                    );
            }
        }
        return $hasil;
    }
    function daftar_pengungsianz(){
        $name = $this->session->userdata('id_pengaduan');
        $hsl = $this->db->query("SELECT * FROM tabel_pengungsian where aktif='1'");        
        // var_dump($hsl->result());
        // die;
        if($hsl->num_rows()>0){
            foreach ($hsl->result() as $data) {
                $hasil[]=array(
                    'id_pengungsian' => $data -> id_pengungsian,
                    'kapasitas' => $data->kapasitas,
                    'alamat' => $data->alamat,
                    'keterangan' => $data->keterangan,
                    );
            }
        }
        return $hasil;
    }

    public function get_pengungsians($id)
    {
        $ids = (int) $id;
        $name = $this->session->userdata('id_pengaduan');
        $hsl=$this->db->query("SELECT * FROM tabel_pengungsian WHERE id_pengungsian='$ids' and id_pengaduan='$name'");
        return json_encode($hsl->result());        
        
    }

    public function hapus_pengungsian($id)
    {
        $hasil = $this->db->query("DELETE FROM tabel_pengungsian WHERE id_pengungsian='$id'");
        return $hasil;
    }

}
/* End of file ReferensiModel.php */


?>