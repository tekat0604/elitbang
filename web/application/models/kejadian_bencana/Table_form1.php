<?php

class Table_form1 extends CI_Model
{
    var $column_order   = array(null, 'a.nomor_pelapor', 'a.nomor_identitas', 'a.nama_pelapor', 'a.nomor_telepon'); //field yang ada di table user
    var $column_search  = array('a.nomor_pelapor', 'a.nomor_identitas', 'a.nama_pelapor', 'a.nomor_telepon'); //field yang diizin untuk pencarian
    var $order          = array('a.id' => 'desc'); // default order

    public function __construct()
    {
        parent::__construct();
    }

    private function _get_datatables_query()
    {
        $this->db->select('a.*, ', false);
        $this->db->from('kejadian_bencana a');
        $this->db->where('a.jenis_form="form_a1"');
        $this->db->where('a.aktif="1"');
        $this->db->where('a.dihapus_pada is NULL ', NULL);
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

            $btn = ' 
            <button type="button" class="btn btn-secondary mr-5 mb-5" onclick="ubah(' . $field->id . ')">
                <i class="fa fa-edit"></i> Ubah 
            </button> 
            <button type="button" class="btn btn-secondary mb-5" onclick="hapus(' . $field->id . ')">
                <i class="fa fa-trash"></i> Hapus 
            </button> 
            ';
            $no++;
            $row        = [];
            $row[]      = $no;
            $row[]      = $field->nomor_pelapor;
            $row[]      = $field->nomor_identitas;
            $row[]      = $field->nama_pelapor;
            $row[]      = $field->nomor_telepon;
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
