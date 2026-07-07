<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class FrontendModel extends CI_Model {

    public function tambah($data, $table)
    {
        $this->db->insert($table,$data);
    }
    
    public function ubah($data, $table, $where)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    function daftar_website(){
        $hasil = $this->db->query("SELECT * FROM frontend_website WHERE aktif = '1' AND dihapus_pada is NULL AND  dihapus_oleh is NULL ");
        return $hasil->result();
    }

    public function get_website($id)
    {
        $hsl=$this->db->query("SELECT * FROM frontend_website WHERE id='$id'");
        if($hsl->num_rows()>0){
            foreach ($hsl->result() as $data) {
                $hasil=array(
                    'nama_sistem' => $data->nama_sistem,
                    'logo_header' => $data->logo_header,
                    'logo_footer' => $data->logo_footer,
                    'alamat' => $data->alamat,
                    'nomor_telpon' => $data->nomor_telpon,
                    'email' => $data->email,
                    'text_footer' => $data->text_footer
                    );
            }
        }
        return $hasil;
    }

    public function hapus_website($id)
    {
        $hasil = $this->db->where(['id' => $id])->update('frontend_website',['aktif' => '0','tampil' => '1','dihapus_pada' => date("Y-m-d H:i:s"),'dihapus_oleh' => $this->session->userdata('id')]);
        return $hasil;
    }

    //// sosmed
    function daftar_sosmed(){
        $hasil = $this->db->query("SELECT * FROM frontend_sosmed WHERE dihapus_pada is NULL AND  dihapus_oleh is NULL ");
        return $hasil->result();
    }

    public function get_sosmed($id)
    {
        $hsl=$this->db->query("SELECT * FROM frontend_sosmed WHERE id='$id'");
        if($hsl->num_rows()>0){
            foreach ($hsl->result() as $data) {
                $hasil=array(
                    'facebook' => $data->facebook, 
                    'twitter' => $data->twitter, 
                    'linkedin' => $data->linkedin, 
                    'dribbble' => $data->dribbble
                    );
            }
        }
        return $hasil;
    }

    public function hapus_sosmed($id)
    {
        $hasil = $this->db->where(['id' => $id])->update('frontend_sosmed',['dihapus_pada' => date("Y-m-d H:i:s"),'dihapus_oleh' => $this->session->userdata('id')]);
        return $hasil;
    }

    //// berita
    function daftar_berita(){
        $hasil = $this->db->query("SELECT * FROM frontend_berita WHERE aktif = '1' AND dihapus_pada is NULL AND  dihapus_oleh is NULL ");
        return $hasil->result();
    }

    public function get_berita($id)
    {
        $hsl=$this->db->query("SELECT * FROM frontend_berita WHERE id='$id'");
        if($hsl->num_rows()>0){
            foreach ($hsl->result() as $data) {
                $hasil=array(
                    'judul' => $data->judul,
                    'isi1' => $data->isi1,
                    'isi2' => $data->isi2,
                    'tanggal' => $data->tanggal,
                    'gambar1' => $data->gambar1,
                    'gambar2' => $data->gambar2,
                    'dibuat_oleh' => $data->dibuat_oleh,
                    );
            }
        }
        return $hasil;
    }

    public function hapus_berita($id)
    {
        $hasil = $this->db->where(['id' => $id])->update('frontend_berita',['aktif' => '0','tampil' => '1','dihapus_pada' => date("Y-m-d H:i:s"),'dihapus_oleh' => $this->session->userdata('id')]);
        return $hasil;
    }

    public function aktif_berita($id)
    { 
        $hasil = $this->db->where(['id' => $id])->update('frontend_berita',['tampil' => '1']);
        return $hasil;
    }

    public function nonaktif_berita($id)
    { 
        $hasil = $this->db->where(['id' => $id])->update('frontend_berita',['tampil' => '0']);
        return $hasil;
    }

    //// kajian
    function daftar_kajian(){
        $hasil = $this->db->query("SELECT * FROM frontend_kajian WHERE aktif = '1' AND dihapus_pada is NULL AND  dihapus_oleh is NULL ");
        return $hasil->result();
    }

    public function get_kajian($id)
    {
        $hsl=$this->db->query("SELECT * FROM frontend_kajian WHERE id='$id'");
        if($hsl->num_rows()>0){
            foreach ($hsl->result() as $data) {
                $hasil=array(
                    'judul' => $data->judul,
                    'deskripsi' => $data->deskripsi,
                    'penulis' => $data->penulis,
                    'penerbit' => $data->penerbit,
                    'gambar' => $data->gambar,
                    'file' => $data->file,
                    'dibuat_oleh' => $data->dibuat_oleh,
                    );
            }
        }
        return $hasil;
    }

    public function hapus_kajian($id)
    {
        $hasil = $this->db->where(['id' => $id])->update('frontend_kajian',['aktif' => '0','tampil' => '1','dihapus_pada' => date("Y-m-d H:i:s"),'dihapus_oleh' => $this->session->userdata('id')]);
        return $hasil;
    }

    public function aktif_kajian($id)
    { 
        $hasil = $this->db->where(['id' => $id])->update('frontend_kajian',['tampil' => '1']);
        return $hasil;
    }

    public function nonaktif_kajian($id)
    { 
        $hasil = $this->db->where(['id' => $id])->update('frontend_kajian',['tampil' => '0']);
        return $hasil;
    }

    //// unduhan
    function daftar_unduhan(){
        $hasil = $this->db->query("SELECT * FROM frontend_unduhan WHERE aktif = '1' AND dihapus_pada is NULL AND  dihapus_oleh is NULL ");
        return $hasil->result();
    }

    public function get_unduhan($id)
    {
        $hsl=$this->db->query("SELECT * FROM frontend_unduhan WHERE id='$id'");
        if($hsl->num_rows()>0){
            foreach ($hsl->result() as $data) {
                $hasil=array(
                    'nama' => $data->nama,
                    'file' => $data->file,
                    'dibuat_oleh' => $data->dibuat_oleh,
                    );
            }
        }
        return $hasil;
    }

    public function hapus_unduhan($id)
    {
        $hasil = $this->db->where(['id' => $id])->update('frontend_unduhan',['aktif' => '0','tampil' => '1','dihapus_pada' => date("Y-m-d H:i:s"),'dihapus_oleh' => $this->session->userdata('id')]);
        return $hasil;
    }

    public function aktif_unduhan($id)
    { 
        $hasil = $this->db->where(['id' => $id])->update('frontend_unduhan',['tampil' => '1']);
        return $hasil;
    }

    public function nonaktif_unduhan($id)
    { 
        $hasil = $this->db->where(['id' => $id])->update('frontend_unduhan',['tampil' => '0']);
        return $hasil;
    }

    //// slider
    function daftar_slider(){
        $hasil = $this->db->query("SELECT * FROM frontend_slider WHERE aktif = '1' AND dihapus_pada is NULL AND  dihapus_oleh is NULL ");
        return $hasil->result();
    }

    public function get_slider($id)
    {
        $hsl=$this->db->query("SELECT * FROM frontend_slider WHERE id='$id'");
        if($hsl->num_rows()>0){
            foreach ($hsl->result() as $data) {
                $hasil=array(
                    'nama' => $data->nama,
                    'file' => $data->file,
                    'dibuat_oleh' => $data->dibuat_oleh,
                    );
            }
        }
        return $hasil;
    }

    public function hapus_slider($id)
    {
        $hasil = $this->db->where(['id' => $id])->update('frontend_slider',['aktif' => '0','tampil' => '1','dihapus_pada' => date("Y-m-d H:i:s"),'dihapus_oleh' => $this->session->userdata('id')]);
        return $hasil;
    }

    public function aktif_slider($id)
    { 
        $hasil = $this->db->where(['id' => $id])->update('frontend_slider',['tampil' => '1']);
        return $hasil;
    }

    public function nonaktif_slider($id)
    { 
        $hasil = $this->db->where(['id' => $id])->update('frontend_slider',['tampil' => '0']);
        return $hasil;
    }

    //// data
    function daftar_data(){
        $hasil = $this->db->query("SELECT * FROM frontend_data WHERE aktif = '1' AND dihapus_pada is NULL AND  dihapus_oleh is NULL ");
        return $hasil->result();
    }

    function daftar_detail_data($id){
        $hasil = $this->db->query("SELECT * FROM frontend_data WHERE id = '$id' AND aktif = '1' AND dihapus_pada is NULL AND  dihapus_oleh is NULL ");
        return $hasil->result();
    }

    function daftar_atribut_data($id){
        $hasil = $this->db->query("SELECT * FROM ref_atribut_data WHERE id_data = '$id' AND aktif = '1' AND dihapus_pada is NULL AND  dihapus_oleh is NULL ");
        return $hasil->result();
    }

    function daftar_detail($id){
        $hasil = $this->db->query("
            SELECT 
            a.*,
            b.nama as nama_atribut
            FROM detail_data a
            LEFT JOIN  ref_atribut_data b ON b.id = a.id_ref_atribut_data
            WHERE b.id_data = '$id' 
            AND a.aktif = '1' AND a.dihapus_pada is NULL AND  a.dihapus_oleh is NULL 
            AND b.aktif = '1' AND b.dihapus_pada is NULL AND  b.dihapus_oleh is NULL 
            ");
        return $hasil->result();
    }

    public function get_data($id)
    {
        $hsl=$this->db->query("SELECT * FROM frontend_data WHERE id='$id'");
        if($hsl->num_rows()>0){
            foreach ($hsl->result() as $data) {
                $hasil=array(
                    'judul' => $data->judul,
                    'deskripsi' => $data->deskripsi,
                    'dibuat_oleh' => $data->dibuat_oleh,
                    );
            }
        }
        return $hasil;
    }

    public function get_atribut_data($id)
    {
        $hsl=$this->db->query("SELECT * FROM ref_atribut_data WHERE id='$id'");
        if($hsl->num_rows()>0){
            foreach ($hsl->result() as $data) {
                $hasil=array(
                    'nama' => $data->nama, 
                    );
            }
        }
        return $hasil;
    }

    public function get_detail_data($id)
    {
        $hsl=$this->db->query("SELECT * FROM detail_data WHERE id='$id'");
        if($hsl->num_rows()>0){
            foreach ($hsl->result() as $data) {
                $hasil=array(
                    'id_ref_atribut_data' => $data->id_ref_atribut_data, 
                    'tahun' => $data->tahun, 
                    'nilai' => $data->nilai, 
                    );
            }
        }
        return $hasil;
    }

    public function hapus_data($id)
    {
        $hasil = $this->db->where(['id' => $id])->update('frontend_data',['aktif' => '0','dihapus_pada' => date("Y-m-d H:i:s"),'dihapus_oleh' => $this->session->userdata('id')]);
        return $hasil;
    }

    public function hapus_data_atribut($id)
    {
        $hasil = $this->db->where(['id' => $id])->update('ref_atribut_data',['aktif' => '0','dihapus_pada' => date("Y-m-d H:i:s"),'dihapus_oleh' => $this->session->userdata('id')]);
        return $hasil;
    }

    public function hapus_data_detail($id)
    {
        $hasil = $this->db->where(['id' => $id])->update('detail_data',['aktif' => '0','dihapus_pada' => date("Y-m-d H:i:s"),'dihapus_oleh' => $this->session->userdata('id')]);
        return $hasil;
    }

    public function aktif_atribut($id)
    { 
        $hasil = $this->db->where(['id' => $id])->update('ref_atribut_data',['tampil' => '1']);
        return $hasil;
    }

    public function nonaktif_atribut($id)
    { 
        $hasil = $this->db->where(['id' => $id])->update('ref_atribut_data',['tampil' => '0']);
        return $hasil;
    }

    public function aktif_detail($id)
    { 
        $hasil = $this->db->where(['id' => $id])->update('detail_data',['tampil' => '1']);
        return $hasil;
    }

    public function nonaktif_detail($id)
    { 
        $hasil = $this->db->where(['id' => $id])->update('detail_data',['tampil' => '0']);
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

    public function get_berita_list($limit, $start){
        $query = $this->db->join('user_login', 'frontend_berita.dibuat_oleh = user_login.id_user', 'LEFT')->join('user_detail', 'user_login.id_user = user_detail.id_user_detail', 'LEFT')->where(['aktif' => '1', 'tampil' => '1', 'dihapus_pada IS NULL'])->get('frontend_berita', $limit, $start);
        return $query;
    }

}

/* End of file ReferensiModel.php */


?>