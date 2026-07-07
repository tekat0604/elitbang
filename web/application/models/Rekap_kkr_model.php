<?php
class Rekap_kkr_model extends CI_Model {
	var $table = 'tabel_perijinan_kkr'; //nama tabel dari database
    var $column_order = array(null, 'nama_pemohon', 'alamat_pemohon', 'status'); //field yang ada di table user
    var $column_search = array('nama_pemohon', 'alamat_pemohon', 'status'); //field yang diizin untuk pencarian 
    var $order = array('id_perijinan_kkr' => 'asc'); // default order 


	public function __construct() {
		$this->load->database();
	}


	//kebutuhabn server side
	private function _get_datatables_query(){
        $this->db->from($this->table);
 
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
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

	//Batas kebutuhabn server side






	public function tampil_semua($table){
		$query = $this->db->get($table);
		return $query->result_array();
	}

	public function tampil_sebagian($where, $table) {
		$query = $this->db->get_where($table, $where);
		return $query->result_array();
	}

	public function pencarian($where, $table) {
		$query = $this->db->get_where($table, $where);
		return $query->row_array();
	}

	public function simpan($data, $table){
        $this->db->insert($table, $data);
	}

	public function edit($data, $where, $table){
		$this->db->where($where);
		$this->db->update($table, $data);
	}

	public function hapus($where, $table){
		$this->db->where($where);
        $this->db->delete($table);
	}

}