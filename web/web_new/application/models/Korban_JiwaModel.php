<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class Korban_JiwaModel extends CI_Model {

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

    function daftar_korban_jiwa(){
        $name = $this->session->userdata('id_pengaduan');
        $hasil = $this->db->query("SELECT * FROM tabel_korban_jiwa where aktif='1' and id_pengaduan='$name'");
        return $hasil->result();
    }

    public function get_korban_jiwa($id)
    {
        $ids = $id['id_korban_jiwa'];
        $name = $this->session->userdata('id_pengaduan');
        $hsl=$this->db->query("SELECT * FROM tabel_korban_jiwa WHERE id_korban_jiwa='$ids' and id_pengaduan='$name'");
        if($hsl->num_rows()>0){
            foreach ($hsl->result() as $data) {
                $hasil[]=array(
                    'id_korban_jiwa' => $data -> id_korban_jiwa,
                    'nik' => $data->nik,
                    'nama' => $data->nama,
                    'tmpt_lahir' => $data->tmpt_lahir,
                    'tmpt_lahir' => $data->tmpt_lahir,
                    'jenis_kelamin' => $data->jenis_kelamin,
                    'alamat' => $data->alamat,
                    'kategori' => $data->kategori,
                    );
            }
        }
        return $hasil;
    }
    function daftar_korban_jiwas(){
        $name = $this->session->userdata('id_pengaduan');
        $hasil = $this->db->query("SELECT * FROM tabel_korban_jiwa where aktif='1'");
        return $hasil->result();
    }

    public function get_korban_jiwas($id)
    {
        $ids = $id['id_korban_jiwa'];
        $name = $this->session->userdata('id_pengaduan');
        $hsl=$this->db->query("SELECT * FROM tabel_korban_jiwa WHERE id_korban_jiwa='$ids'");
        if($hsl->num_rows()>0){
            foreach ($hsl->result() as $data) {
                $hasil[]=array(
                    'id_korban_jiwa' => $data -> id_korban_jiwa,
                    'nik' => $data->nik,
                    'nama' => $data->nama,
                    'tmpt_lahir' => $data->tmpt_lahir,
                    'tmpt_lahir' => $data->tmpt_lahir,
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

    public function hapus_korban_jiwa($id)
    {
        $hasil = $this->db->query("DELETE FROM tabel_korban_jiwa WHERE id_korban_jiwa='$id' ");
        return 'ok';
    }

}

/* End of file ReferensiModel.php */


?>