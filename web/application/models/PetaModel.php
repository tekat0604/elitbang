<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class PetaModel extends CI_Model {

    private $table = 'tabel_layer';
    private $table_join = 'tabel_referensi_opd'; 
    private $column_order = array(null, 'nama_layer','nama_opd','sumber', 'status', null); //field yang ada di table user
    private $column_search = array('nama_layer','nama_opd'); //field yang diizin untuk pencarian 
    private $order = array('id_layer' => 'asc'); // default order 

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query()
    {
        $this->db->select('*');
        //add custom filter here
        if($this->input->post('filter_nama'))
        {
            $this->db->like("$this->table.nama_layer", $this->input->post('filter_nama'));
        }
        if($this->input->post('filter_opd'))
        {
            $this->db->where("$this->table.id_opd", $this->input->post('filter_opd'));
        }
        if($this->input->post('filter_sumber'))
        {
            $this->db->where('sumber', $this->input->post('filter_sumber'));
        }
        if($this->input->post('filter_status'))
        {
            $this->db->where('status', $this->input->post('filter_status'));
        }

        $this->db->from($this->table);

        if($this->session->userdata('role') != 1)
        {
            $this->db->where("$this->table.id_opd",$this->session->userdata("id_opd"));
        }
 
        $i = 0;
     
        foreach ($this->column_search as $item) // looping awal
        {
            if($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
            {
                 
                if($i===0) // looping awal
                {
                    $this->db->group_start(); 
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) 
                    $this->db->group_end(); 
            }
            $i++;
        }
         
        if(isset($_POST['order'])) 
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $this->db->join("$this->table_join", "$this->table.id_opd = $this->table_join.id_opd", 'left');
        
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered()
    {
        $this->_get_datatables_query();
        $this->db->join("$this->table_join", "$this->table.id_opd = $this->table_join.id_opd", 'left');
        
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // function daftar_layer_peta(){
    //     $hasil = $this->db->select('*');
    //     $hasil = $this->db->from("$this->table a");
    //     $hasil = $this->db->join("$this->table_join b", 'a.id_opd = b.id_opd', 'left');
    //     $hasil = $this->db->get();
    //     return $hasil->result();
    // }

    public function daftar_grup_layer()
    {
        $query = $this->db->get('tabel_grup_layer');
        return $query;
    }

    public function daftar_jenis_peta()
    {
        $query = $this->db->get('tabel_jenis_peta');
        return $query;
    }

    public function daftar_opd()
    {
        $query = $this->db->get("$this->table_join");
        return $query;
    }

    public function tambah($data, $table)
    {
        $this->db->insert($table,$data);
    }
    
    public function ubah($data, $table, $where)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    function get_layer_data($id){
        $hsl=$this->db->query("SELECT * FROM $this->table WHERE id_layer = '$id'");
        if($hsl->num_rows()>0){
            foreach ($hsl->result() as $data) {
                
                $sumber = $data->sumber;
                switch ($sumber) {
                    case 2:$sumber = 'API';break;
                    case 3:$sumber = 'File JSON';break;
                    default:$sumber = 'Database';break;
                }

                $hasil=array(
                    'nama' => $data->nama_layer,
                    'opd' => $data->id_opd,
                    'sumber' => $sumber,
                    'status' => $data->status,
                    );
            }
        }
        return $hasil;
    }

    function get_layer_data2($id){
        $q = "
        SELECT * FROM $this->table t1
        LEFT JOIN tabel_grup_layer t2 ON t2.id_grup_layer = t1.id_grup_layer
        LEFT JOIN tabel_jenis_peta t2 ON t3.id_jenis_peta = t1.id_jeni_peta 
        WHERE id_layer = '$id' 
        ";
        $hsl=$this->db->query("SELECT * FROM $this->table WHERE id_layer = '$id'");
        if($hsl->num_rows()>0){
            foreach ($hsl->result() as $data) {
                
                $sumber = $data->sumber;
                switch ($sumber) {
                    case 2:$sumber = 'API';break;
                    case 3:$sumber = 'File JSON';break;
                    default:$sumber = 'Database';break;
                }

                $hasil=array(
                    'nama' => $data->nama_layer,
                    'grup_layer' => $data->id_grup_layer,
                    'jenis_peta' => $data->id_jenis_peta,
                    'opd' => $data->id_opd,
                    'sumber' => $sumber,
                    'link_api' => $data->link_api,
                    'status' => $data->status,
                    'deskripsi_layer' => $data->deskripsi_layer
                    );
            }
        }
        return $hasil;
    }

    public function hapus_layer($id)
    {
        $hasil = $this->db->query("DELETE FROM tabel_layer WHERE id_layer='$id'");
        return $hasil;
    }

    public function daftar_atribut($id)
    {
        $hasil = $this->db->query("SELECT * FROM tabel_atribut_layer WHERE id_layer = '$id'");
        return $hasil->result();
    }

    function get_atribut($id){
        $hsl=$this->db->query("SELECT * FROM tabel_atribut_layer WHERE id_atribut='$id'");
        if($hsl->num_rows()>0){
            foreach ($hsl->result() as $data) {
                $hasil=array(
                    'nama' => $data->nama_atribut,
                    'tipe' => $data->tipe_data,
                    );
            }
        }
        return $hasil;
    }

    public function hapus_atribut($id)
    {
        $hasil = $this->db->query("DELETE FROM tabel_atribut_layer WHERE id_atribut='$id'");
        return $hasil;
    }

    public function header_data_peta($id)
    {
        $query = $this->db->where('id_layer', $id)->get('tabel_atribut_layer');
        if ($query->num_rows() > 0)
        {
            return $query->result(); 
        }
        return 0;
    }

    public function data_peta()
    {
        // return $this->db->get_where($table,$where);
    }

    public function id_collection()
    {
        $query = $this->db->order_by('id_collection', 'DESC');
        $query = $this->db->limit(1);
        $query = $this->db->get('tabel_collection');
        if ($query->num_rows() > 0)
        {
            $ret = $query->row();
            return $ret->id_collection; 
        }
        else
        {
            return 0;
        }
        
    }

    // public function get_collection_data($id=0)
    // {
    //     if($id>0)
    //     {
    //         $q = "SELECT
    //         * 
    //         FROM tabel_layer t1
    //         INNER JOIN tabel_atribut_layer t2 ON t2.id_layer = t1.id_layer
    //         INNER JOIN tabel_value_attribut t3 ON t3.id_atribut = t2.id_atribut
    //         INNER JOIN tabel_collection t4 ON t4.id_collection = t3.id_collection
    //         WHERE 1 = 1
    //         AND t4.id_collection = {$id}";

    //         $query = $this->db->query($q)->result_array();

    //         if(count($query)>0)
    //         {
    //             return $query;
    //         }
    //     }
    // }

    public function get_collection_data($id=0)
    {
        if($id>0)
        {
            //get layer id
            $id_layer = $this->db->select('id_layer')->where('id_collection', $id)->get('tabel_collection')->row_array()['id_layer'];

            $q = "SELECT
            * 
            FROM tabel_layer t1
            INNER JOIN tabel_atribut_layer t2 ON t2.id_layer=t1.id_layer
            LEFT JOIN (
            SELECT
            * 
            FROM tabel_value_attribut
            WHERE 1 = 1
            AND id_collection={$id}
            ) t3 ON t3.id_atribut=t2.id_atribut
            LEFT JOIN tabel_collection t4 ON t4.id_collection=t3.id_collection
            WHERE 1 = 1
            AND t1.id_layer={$id_layer}";

            $query = $this->db->query($q)->result_array();

            if(count($query)>0)
            {
                return $query;
            }
        }
    }

}

/* End of file PetaModel.php */


?>