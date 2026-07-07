<?php

class Table_form2 extends CI_Model
{
    var $column_order   = array(null,  'b.nomor_identitas', 'a.jenis_kejadian', 'a.nomor_kejadian'); //field yang ada di table user
    var $column_search  = array('b.nomor_identitas', 'a.jenis_kejadian', 'a.nomor_kejadian'); //field yang diizin untuk pencarian
    var $order          = array('a.id' => 'desc'); // default order

    public function __construct()
    {
        parent::__construct();
    }

    private function _get_datatables_query()
    {
        $this->db->select('a.id, b.jenis_identitas, b.nomor_identitas, b.nama_pelapor, a.jenis_kejadian, a.nomor_kejadian,  
        c.nama kecamatan, d.nama kelurahan, a.alamat_kejadian, 
        a.tanggal_kejadian, a.hari_kejadian, a.jam_kejadian, a.jam_laporan, a.kronologi_kejadian');
        $this->db->from('kejadian_bencana a');
        $this->db->join('kejadian_bencana b', 'a.id_pelapor = b.id AND b.jenis_form="form_a1" ', 'LEFT');
        $this->db->join('tabel_kecamatan c', 'a.id_kecamatan_kejadian = c.id_kecamatan', 'LEFT');
        $this->db->join('tabel_kelurahan d', 'a.id_kelurahan_kejadian = d.id_kelurahan', 'LEFT');
        $this->db->where('a.jenis_form="form_a2"');
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

            $pelapor = '
            <div style="float: left; width: 60px; text-transform: Uppercase;"> Nama </div> 
            <div style="float: left; width: 10px;"> : </div>
            <div style="float: left; width: 130px;"> ' . $field->nama_pelapor . ' </div>
            <span style="clear: both;"></span>
            <div style="float: left; width: 60px; text-transform: Uppercase;"> ' . $field->jenis_identitas . ' </div> 
            <div style="float: left; width: 10px;"> : </div>
            <div style="float: left; width: 130px;"> ' . $field->nomor_identitas . ' </div>
            ';

            $tempat_kejadian = '
            <div style="float: left; width: 60px; "> Kec</div> 
            <div style="float: left; width: 10px;"> : </div>
            <div style="float: left; width: 150px;"> ' . $field->kecamatan . ' </div>
            <div style="clear: both;"></div>
            <div style="float: left; width: 60px;  ">  Kel </div> 
            <div style="float: left; width: 10px;"> : </div>
            <div style="float: left; width: 150px;"> ' . $field->kelurahan . ' </div>
            <div style="clear: both;"></div>
            <div style="float: left; width: 60px;  ">  Alamat  </div> 
            <div style="float: left; width: 10px;"> : </div>
            <div style="float: left; width: 150px;"> ' . $field->alamat_kejadian . ' </div>
            ';

            $waktu_kejadian = '
            <div style="float: left; width: 90px; background: none;"> Hari & Tgl </div> 
            <div style="float: left; width: 10px; background: none;"> : </div>
            <div style="float: left; width: 170px; background: none;"> 
                ' . $field->hari_kejadian . ',  ' . $field->tanggal_kejadian . '  
            </div> 
            <div style="clear: both;"></div>
            
            <div style="float: left; width: 90px; background: none;"> Jam Kejadian  </div> 
            <div style="float: left; width: 10px; background: none;"> : </div>
            <div style="float: left; width: 170px; background: none;"> 
                ' . $field->jam_kejadian . '  <b> WIB </b>  
            </div>  
            <div style="clear: both;"></div>
            
            <div style="float: left; width: 90px; background: none;"> Jam Lapor  </div> 
            <div style="float: left; width: 10px; background: none;"> : </div>
            <div style="float: left; width: 170px; background: none;"> 
                ' . $field->jam_laporan . ' <b> WIB </b> 
            </div>  ';

            $btn = ' 
            <a href="' . base_url('admin/kejadian_bencana/form2/edit/' . $field->id) . '" class="btn btn-secondary" style="width: 100px; margin-bottom: 5px;">
                <i class="fa fa-edit"></i> Ubah 
            </a> 
            <button type="button" class="btn btn-secondary" onclick="hapus(' . $field->id . ')" style="width: 100px;">
                <i class="fa fa-trash"></i> Hapus 
            </button> 
            ';
            $no++;
            $row                = [];
            $row[]              = $no;
            $row[]              = $field->nomor_kejadian;
            $row[]              = $pelapor;
            $row[]              = $tempat_kejadian;
            $row[]              = $waktu_kejadian;
            $row[]              = $btn;
            $data[]             = $row;
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
