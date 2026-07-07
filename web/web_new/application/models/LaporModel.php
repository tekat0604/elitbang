<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class LaporModel extends CI_Model {

    private $table = 'tabel_lapor';
    private $column_order = array(null, null, null, null, null); //field yang ada di table user
    private $column_search = array('nama','lokasi','subjek'); //field yang diizin untuk pencarian 
    private $order = array('id_lapor' => 'desc'); // default order 

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query($tahun,$status) {
        
        switch($status){
            case 'dibalas': 
                $this->db->where('created_balasan is not null',null,false);
                break;
            case 'belum_dibalas': 
                $this->db->where('created_balasan is null',null,false);
                break;
            case 'ditangani': 
                $this->db->where('status_ditangani','1');
                break;
            default : 
                continue;
        }
        
        $this->db->from($this->table)->where('YEAR(created)',$tahun)->order_by('id_lapor','DESC');
 
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
 
    function get_datatables($tahun,$status) {
        $this->_get_datatables_query($tahun,$status);
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);        
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered($tahun,$status) {
        $this->_get_datatables_query($tahun,$status);        
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all($tahun,$status) {
        $this->_get_datatables_query($tahun,$status);
        return $this->db->count_all_results();
    }
    
    function get_count($tahun){
        return $this->db->select(
            'COUNT(id_lapor) as total, 
            COUNT(CASE WHEN created_balasan is not null then 1 end) as dibalas, 
            COUNT(CASE WHEN created_balasan is null then 1 end) as belum_dibalas, 
            COUNT(CASE WHEN status_ditangani="1" then 1 end) as ditangani'
            )->where('YEAR(created)',$tahun)->get('tabel_lapor')->row();
    }
    function get_status($tahun){
        return $this->db->select(
            "COUNT(id_lapor) as total, 
            COUNT(CASE WHEN tabel_lapor.read  = '0' AND tabel_lapor.status_ditangani  = '0' then 1 end) as belum_dibaca,  
            COUNT(CASE WHEN tabel_lapor.read  = '1' AND tabel_lapor.status_ditangani  = '0' then 1 end) as sudah_dibaca,  
            COUNT(CASE WHEN tabel_lapor.read  = '1' AND tabel_lapor.status_ditangani  = '1' then 1 end) as sudah_ditangani"
            )->where('YEAR(created)',$tahun)->get('tabel_lapor')->row();
    }
}

/* End of file PetaModel.php */


?>