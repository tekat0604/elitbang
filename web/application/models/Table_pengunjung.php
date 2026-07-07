<?php

class Table_pengunjung extends CI_Model
{
    var $column_order   = array(null, 'a.ip', 'a.waktu'); //field yang ada di table user
    var $column_search  = array('a.ip', 'a.waktu'); //field yang diizin untuk pencarian
    var $order          = array('a.id' => 'desc'); // default order

    public function __construct()
    {
        parent::__construct();
    }

    private function _get_datatables_query()
    {
        $tanggal_mulai      = $this->input->get('tanggal_mulai');
        $exp_tgl_mulai      = explode('/',  $tanggal_mulai);
        $tgl_mulai          = '' . $exp_tgl_mulai[2] . '-' . $exp_tgl_mulai[1] . '-' . $exp_tgl_mulai[0] . '';

        $tanggal_selesai    = $this->input->get('tanggal_selesai');
        $exp_tgl_selesai    = explode('/',  $tanggal_selesai);
        $tgl_selesai        = '' . $exp_tgl_selesai[2] . '-' . $exp_tgl_selesai[1] . '-' . $exp_tgl_selesai[0] . '';







        $this->db->select('a.*, ', false);
        $this->db->from('visitor a');
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
            $no++;
            $row        = [];
            $row[]      = $no;
            $row[]      = $field->ip;
            $row[]      = $field->waktu;
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
