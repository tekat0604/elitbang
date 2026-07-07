<?php
class PpidModel extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function tambah($data, $table)
    {
        $this->db->insert($table, $data);
    }

    public function ubah($data, $where, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    public function get_detail($where, $table, $select = null)
    {
        if (@$select) {
            $this->db->select($select);
        }
        $query = $this->db->get_where($table, $where);
        return $query->row_array();
    }

    public function get_data($where, $table, $select = null)
    {
        if (@$select) {
            $this->db->select($select);
        }
        $query = $this->db->get_where($table, $where);
        return $query->result_array();
    }

    public function str_clean_tag($content, $limit)
    {
        $str_content = substr(strip_tags($content), 0, $limit);
        return $str_content;
    }
    public function d($d, $day = "")
    {
        $str = strtotime($d);
        //Array Hari
        $array_hari = array(1 => 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu');
        $hari = $array_hari[date('N', $str)];
        //Format Tanggal
        $tanggal = date('j', $str);
        //Array Bulan
        $array_bulan = array(1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
        $bulan = $array_bulan[date("n", $str)];
        //Format Tahun
        $tahun = date('Y', $str);
        if ($day == '') {
            $date = $tanggal . " " . $bulan . " " . $tahun;
        } else {
            $date = $hari . ', ' . $tanggal . " " . $bulan . " " . $tahun;
        }
        return $date;
    }
    function _create_thumbs($folder, $file_name)
    {
        error_reporting(0);
        // Image resizing config
        $configi = array(
            // Image Large
            array(
                'image_library' => 'GD2',
                'source_image'  => './uploads/' . $folder . '/' . $file_name,
                'maintain_ratio' => TRUE,
                'width'         => 1024,
                'height'        => auto,
                'new_image'     => './uploads/' . $folder . '/large/' . $file_name
            ),
            // image Medium
            array(
                'image_library' => 'GD2',
                'source_image'  => './uploads/' . $folder . '/' . $file_name,
                'maintain_ratio' => TRUE,
                'width'         => 700,
                'height'        => auto,
                'new_image'     => './uploads/' . $folder . '/medium/' . $file_name
            ),
            // Image Small
            array(
                'image_library' => 'GD2',
                'source_image'  => './uploads/' . $folder . '/' . $file_name,
                'maintain_ratio' => TRUE,
                'width'         => 300,
                'height'        => auto,
                'new_image'     => './uploads/' . $folder . '/small/' . $file_name
            )
        );

        $this->load->library('image_lib', $configi[0]);
        foreach ($configi as $item) {
            $this->image_lib->initialize($item);
            if (!$this->image_lib->resize()) {
                return false;
            }
            $this->image_lib->clear();
        }
    }

    public function formatDate($tanggal)
    {
        $exp = explode('-', $tanggal);
        $date = $exp[2] . "-" . $exp[1] . "-" . $exp[0];
        return $date;
    }
    public function formatTanggal($date)
    {
        $exp = explode('-', $date);
        $tanggal = $exp[2] . "-" . $exp[1] . "-" . $exp[0];
        return $tanggal;
    }
}
