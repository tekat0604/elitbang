<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengunjung extends MY_Controller
{
    private $base           = 'admin';
    private $menu           = 'pengunjung';
    function __construct()
    {
        parent::__construct();
        $this->load->model('Table_pengunjung', 'm_table');
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
        if ($this->session->userdata('role') != 1) {
            redirect('login');
        }
    }

    public function index()
    {
        $data = [
            'isi'       => "$this->base/$this->menu/index",
            'modal'     => array(
                $this->load->view("$this->base/$this->menu/modal_detail", '', true),
                $this->load->view("$this->base/$this->menu/modal_hapus", '', true)
            ),
            'extra_css'  => $this->load->view("$this->base/$this->menu/index_css", '', true),
            'extra_js'  => $this->load->view("$this->base/$this->menu/index_js", '', true),
        ];
        $this->load->view('layouts/wrapper', $data, FALSE);
    }

    public function datatable()
    {
        echo $this->m_table->generate_table();
    }
}
