<?php

class Table_lapor_aduan extends CI_Model
{
    var $column_order   = array(null, 'a.subjek', 'a.nama', 'b.kecamatan_nama', 'a.no_hp'); //field yang ada di table user
    var $column_search  = array('a.subjek', 'a.nama', 'b.kecamatan_nama', 'c.kelurahan_nama', 'a.email', 'a.no_hp'); //field yang diizin untuk pencarian
    var $order          = array('a.id' => 'desc'); // default order

    public function __construct()
    {
        parent::__construct();
    }

    private function _get_datatables_query()
    {
        $id_kategori = $this->input->get('id_kategori');
        $id_kecamatan = $this->input->get('id_kecamatan');
        $this->db->select('a.*, b.kecamatan_nama kecamatan, c.kelurahan_nama kelurahan, ', false);
        $this->db->from('tabel_lapor_aduan a');
        $this->db->join('ref_kecamatan b', 'a.id_kecamatan = b.kecamatan_id', 'LEFT');
        $this->db->join('ref_kelurahan c', 'a.id_kelurahan = c.id', 'LEFT');
        $this->db->where('a.aktif', '1');
        $this->db->where('a.dihapus_pada is NULL ', NULL);
        if ($id_kategori != '') {
            $this->db->where('a.id_kategori', $id_kategori);
        }
        if ($id_kecamatan != '') {
            $this->db->where('a.id_kecamatan', $id_kecamatan);
        }
        $i = 0;

        foreach ($this->column_search as $item) { // looping awal
            if ($_GET['search']['value']) { // jika datatable mengirimkan pencarian dengan metode POST

                if ($i === 0) // looping awal
                {
                    $this->db->group_start();
                    $this->db->like($item, $_GET['search']['value']);
                } else {
                    $this->db->or_like($item, $_GET['search']['value']);
                }

                if (count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_GET['order'])) {
            $this->db->order_by($this->column_order[$_GET['order']['0']['column']], $_GET['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_GET['length'] != -1)
            $this->db->limit($_GET['length'], $_GET['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->_get_datatables_query();
        return $this->db->count_all_results();
    }

    function generate_table()
    {
        $list       = $this->get_datatables();
        $data       = array();
        $no         = $_GET['start'];
        foreach ($list as $field) {
            $lokasi = '  
            <div style="clear: both; width: 150px;"></div>
                <div style="float: left; width: 45px;"> Kec </div>
                <div style="float: left; width: 10px;"> : </div>
                <div style="float: left; width: 90px;"> ' . $field->kecamatan . ' </div>
                <div style="clear: both;"></div>
                <div style="float: left; width: 45px;"> Kel  </div>
                <div style="float: left; width: 10px;"> : </div>
                <div style="float: left; width: 90px;"> ' . $field->kelurahan . ' </div>
            ';
            $kontak = '  
            <div style="clear: both; width: 150px;"></div>
            <div style="float: left; width: 45px;"> Email </div>
            <div style="float: left; width: 10px;"> : </div>
            <div style="float: left; width: 90px;"> ' . $field->email . ' </div>
            <div style="clear: both;"></div>
            <div style="float: left; width: 45px;"> No HP  </div>
            <div style="float: left; width: 10px;"> : </div>
            <div style="float: left; width: 90px;"> ' . $field->no_hp . ' </div>
            ';

            $btn = ' 
                <a href="' . base_url('admin/lapor_aduan/detail/' . $field->id . '') . '" class="btn btn-secondary" >
                    <i class="fa fa-eye"></i> Detail 
                </a>  
            ';
            $no++;
            $row        = [];
            $row[]      = $no;
            $row[]      = $field->subjek;
            $row[]      = $field->nama;
            $row[]      = $lokasi;
            $row[]      = $kontak;
            $row[]      = $btn;
            $data[]     = $row;
        }
        $output                 = array(
            "draw"              => $_GET['draw'],
            "recordsTotal"      => $this->count_all(),
            "recordsFiltered"   => $this->count_filtered(),
            "data"              => $data,
        );
        return json_encode($output);
    }
}
