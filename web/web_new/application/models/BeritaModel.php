<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class BeritaModel extends CI_Model {

    private $id = 'id_berita';
    private $table = 'tabel_berita';
    private $order = 'DESC';

    public function getAllBerita()
    {
        $this->datatables->select('id_berita, judul, added');
        $this->datatables->from($this->table);
        $this->datatables->add_column('aksi', '<center><a href="'.site_url('berita/$1').'" class="btn btn-borders btn-warning"><i class="fa fa-eye"></i> Detail</a></center>','id_berita');
        return $this->datatables->generate();
    }

    public function getRecentPost()
    {
        $this->db->select('*')
                 ->from($this->table)
                 ->limit(8)
                 ->order_by('added',$this->order);
        return $this->db->get()->result_array();
    }

    public function getBeritaById($id_berita)
    {
        return $this->db->get_where($this->table,[$this->id => $id_berita])->row_array();
    }

}