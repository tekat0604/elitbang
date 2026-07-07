<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class Kerusakan_FasilitasModel extends CI_Model {

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

    function get_data(){
        $name = $this->session->userdata('id_pengaduan');
        $hsl=$this->db->query("SELECT * FROM tabel_kerusakan_fasilitas where aktif='1' and id_pengaduan='$name'");
        return $hsl->result();
    }

    public function get_detail($id)
    {
        $ids = $id['id_kerusakan_fasilitas'];
        $name = $this->session->userdata('id_pengaduan');
        $hsl=$this->db->query("SELECT * FROM tabel_kerusakan_fasilitas WHERE id_kerusakan_fasilitas='$ids' and id_pengaduan='$name'");
        
        if($hsl->num_rows()>0){
            foreach ($hsl->result() as $data) {
                $hasil[] =array(
                    'id_kerusakan_fasilitas' => $data -> id_kerusakan_fasilitas,
                    'jumlah_unit' => $data->jumlah_unit,
                    'kerugian_biaya' => $data->kerugian_biaya,
                    'kategori' => $data->kategori,
                    );
            }
        }
        else {
            $hasil = $hsl->result();
        }
        return $hasil;
    }
    function get_datas(){
        $name = $this->session->userdata('id_pengaduan');
        $hsl=$this->db->query("SELECT * FROM tabel_kerusakan_fasilitas where aktif='1'");
        return $hsl->result();
    }

    public function get_details($id)
    {
        $ids = $id['id_kerusakan_fasilitas'];
        $name = $this->session->userdata('id_pengaduan');
        $hsl=$this->db->query("SELECT * FROM tabel_kerusakan_fasilitas WHERE id_kerusakan_fasilitas='$ids'");
        
        if($hsl->num_rows()>0){
            foreach ($hsl->result() as $data) {
                $hasil[] =array(
                    'id_kerusakan_fasilitas' => $data -> id_kerusakan_fasilitas,
                    'jumlah_unit' => $data->jumlah_unit,
                    'kerugian_biaya' => $data->kerugian_biaya,
                    'kategori' => $data->kategori,
                    );
            }
        }
        return $hasil;
    }

    public function hapus_kerusakan_fasilitas($id)
    {
        $hasil = $this->db->query("DELETE FROM tabel_kerusakan_fasilitas WHERE id_kerusakan_fasilitas='$id'");
        return $hasil;
    }


}

/* End of file ReferensiModel.php */


?>