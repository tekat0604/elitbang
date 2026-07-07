<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Portal extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data =  [];
        $this->load->view('portal/index', $data);
    }

    public function layanan()
    {
        $layanan        =  $this->db->where('deleted_at is null', NULL)->get('layanan')->result();
        $data           = [
            'layanan'   => $layanan,
        ];
        $this->load->view('portal/layanan', $data);
    }

    public function detail_layanan()
    {
        $id             = $this->input->post('id');
        $row            = $this->get_detail_layanan($id);
        if ($row->file != '' && $row->file != null) {
            $row->file = base_url('uploads/layanan/' . $row->file);
        } else {
            $row->file = '';
        }
        $data           = [
            'data'      => $row,
        ];
        $html           = $this->load->view('portal/layanan_detail', $data, true);
        $output         = [
            'status'    => 'success',
            'row'       => $row,
            'html'      => @$html,
        ];
        echo json_encode($output);
    }

    private function get_detail_layanan($id)
    {
        $this->db->select('a.*, ');
        $this->db->from('layanan a');
        $this->db->where('a.deleted_at is NULL', NULL);
        $this->db->where('a.id', $id);
        $query          = $this->db->get();
        $row           = $query->row();
        return $row;
    }
}
