<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class Data_RelawanModel extends CI_Model {

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

    function get_detail($id){
        $ids = (int) $id;
        $name = $this->session->userdata('id_pengaduan');
        $hsl=$this->db->query("SELECT * FROM tabel_relawan where id_relawan='$ids' and id_pengaduan='$name'");
        return json_encode($hsl->result());
    }

    public function get_relawan()
    {
        $name = $this->session->userdata('id_pengaduan');
        $hsl=$this->db->query("SELECT * FROM tabel_relawan where aktif = '1'  and id_pengaduan='$name'");
        if($hsl->num_rows()>0){
            foreach ($hsl->result() as $data) {
                $hasil[] =array(
                    'id' => $data -> id_relawan,
                    'nik' => $data->nik,
                    'nama' => $data->nama,
                    'jenis_kelamin' => $data->jenis_kelamin,
                    'alamat' => $data->alamat,
                    'kategori' => $data->kategori,
                    );
            }
        }
        return $hasil;
    }
    function get_details($id){
        $ids = (int) $id;
        $name = $this->session->userdata('id_pengaduan');
        $hsl=$this->db->query("SELECT * FROM tabel_relawan where id_relawan='$ids'");
        return json_encode($hsl->result());
    }

    public function get_relawans()
    {
        $name = $this->session->userdata('id_pengaduan');
        $hsl=$this->db->query("SELECT * FROM tabel_relawan where aktif = '1'");
        if($hsl->num_rows()>0){
            foreach ($hsl->result() as $data) {
                $hasil[] =array(
                    'id' => $data -> id_relawan,
                    'nik' => $data->nik,
                    'nama' => $data->nama,
                    'jenis_kelamin' => $data->jenis_kelamin,
                    'alamat' => $data->alamat,
                    'kategori' => $data->kategori,
                    );
            }
        }
        else {
            $hasil = $hsl->result();
        }
        return $hasil;
    }

    public function hapus_relawan($id)
    {
        $hasil = $this->db->query("DELETE FROM tabel_relawan WHERE id_relawan='$id'");
        return 'ok';
    }

}

/* End of file ReferensiModel.php */


?>