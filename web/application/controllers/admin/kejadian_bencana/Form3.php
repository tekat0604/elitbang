<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Form3 extends MY_Controller
{
    private $base           = 'admin';
    private $menu           = 'kejadian_bencana/form3';
    private $folder_upload  = 'kejadian_bencana';
    private $table          = 'kejadian_bencana';

    function __construct()
    {
        parent::__construct();
        $this->load->library('upload');
        $this->load->model('kejadian_bencana/Table_form3', 'm_table');
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
        if ($this->session->userdata('role') != 1) {
            redirect('login');
        }
        $this->link_url = base_url('admin/kejadian_bencana/form3/');
    }

    public function index()
    {
        $data_js['title']       = 'Kejadian Bencana - Form 3';
        $data_js['link_url']    =  $this->link_url;
        $data           = [
            'title'     => 'Kejadian Bencana - Form 3',
            'isi'       => "$this->base/$this->menu/index",
            'modal'     => array(
                $this->load->view("$this->base/$this->menu/modal", '', true),
            ),
            'extra_css' => $this->load->view("$this->base/$this->menu/index_css", $data_js, true),
            'extra_js'  => $this->load->view("$this->base/$this->menu/index_js", '', true),
        ];
        $this->load->view('layouts/wrapper', $data, FALSE);
    }

    public function tambah()
    {
        $data_js        = [
            'aksi'      => 'tambah',
            'link_url'  => $this->link_url,
        ];
        $data                   = [
            'title'             => 'Tambah Kejadian Bencana - Form 3',
            'row'               => '',
            'isi'               => "$this->base/$this->menu/form",
            'list_form1'        => $this->get_data_form1(),
            'extra_js'          => $this->load->view("$this->base/$this->menu/form_js",  $data_js, true),
        ];
        $this->load->view('layouts/wrapper', $data, FALSE);
    }

    public function edit()
    {

        $id         = $this->uri->segment(5);
        $row        = $this->get_detail($id);
        $data_js    = [
            'aksi'      => 'ubah',
            'row'       =>  $row,
            'link_url'  => $this->link_url,
        ];
        $data                   = [
            'title'             => 'Ubah Kejadian Bencana - Form 2',
            'row'               => $row,
            'list_form1'        => $this->get_data_form1(),
            'list_form2'        => $this->get_data_form2(@$row->id_kejadian),
            'isi'               => "$this->base/$this->menu/form",
            'extra_js'          => $this->load->view("$this->base/$this->menu/form_js", $data_js, true),
        ];
        $this->load->view('layouts/wrapper', $data, FALSE);
    }

    public function datatable()
    {
        echo $this->m_table->generate_table();
    }

    public function load_form1()
    {
        $id     = $this->input->post('id');
        $row    = $this->db->where('id', $id)->where('jenis_form', 'form_a1')->get('kejadian_bencana')->row();
        $data       = [
            'row'   => $row,
        ];
        $html       = $this->load->view("$this->base/$this->menu/load_form1", $data, true);
        $output     = [
            'status'    => 'success',
            'html'      => $html,
        ];
        echo json_encode($output);
    }

    public function load_form2()
    {
        $id     = $this->input->post('id');
        $row    = $this->get_detail_from2($id);
        $data       = [
            'row'   => $row,
        ];
        $html       = $this->load->view("$this->base/$this->menu/load_form2", $data, true);
        $output     = [
            'status'    => 'success',
            'html'      => $html,
        ];
        echo json_encode($output);
    }

    public function do_submit()
    {
        cek_post();
        $id_kejadian = $this->input->post('id');
        if ($id_kejadian != "") {
            //edit data 
            $this->db->where('id', $id_kejadian);
            $this->db->update($this->table, [
                'id_form_1'         => $this->input->post('id_form_1'),
                'id_form_2'         => $this->input->post('id_form_2'),
                'kerugian'          => $this->input->post('kerugian'),
                'kajian_kebutuhan'  => $this->input->post('kajian_kebutuhan'),
                'diubah_oleh'       => $this->session->userdata('id'),
                'diubah_pada'       => date('Y-m-d H:i:s'),
            ]);

            $del_data   = $this->db->where('id_kejadian', $id_kejadian)->delete('kb_has_korban');
            for ($i = 0; $i < count($this->input->post('nama_korban[]')); $i++) {
                $data_insert            = [
                    'id_kejadian'       => $id_kejadian,
                    'rs_rujukan'        => $this->input->post('rs_rujukan_korban[' . $i . ']'),
                    'alamat'            => $this->input->post('alamat_korban[' . $i . ']'),
                    'nama'              => $this->input->post('nama_korban[' . $i . ']'),
                    'jenis_identitas'   => $this->input->post('jenis_identitas_korban[' . $i . ']'),
                    'nomor_identitas'   => $this->input->post('nomor_identitas_korban[' . $i . ']'),
                    'ciri_ciri'         => $this->input->post('ciri_ciri_korban[' . $i . ']'),
                    'aktif'             => '1',
                    'dibuat_pada'       => date('Y-m-d H:i:s')
                ];
                $proses_insert      = $this->db->insert('kb_has_korban', $data_insert);
            }
        } else {
            //tambah 
            $this->db->insert($this->table, [
                'jenis_form'        => 'form_a3',
                'id_form_1'         => $this->input->post('id_form_1'),
                'id_form_2'         => $this->input->post('id_form_2'),
                'kerugian'          => $this->input->post('kerugian'),
                'kajian_kebutuhan'  => $this->input->post('kajian_kebutuhan'),
                'aktif'             => '1',
                'dibuat_oleh'       => $this->session->userdata('id'),
                'dibuat_pada'       => date('Y-m-d H:i:s'),
            ]);
            $last_id = $this->db->insert_id();

            for ($i = 0; $i < count($this->input->post('nama_korban[]')); $i++) {
                $data_insert        = [
                    'id_kejadian'       => $last_id,
                    'rs_rujukan'        => $this->input->post('rs_rujukan_korban[' . $i . ']'),
                    'alamat'            => $this->input->post('alamat_korban[' . $i . ']'),
                    'nama'              => $this->input->post('nama_korban[' . $i . ']'),
                    'jenis_identitas'   => $this->input->post('jenis_identitas_korban[' . $i . ']'),
                    'nomor_identitas'   => $this->input->post('nomor_identitas_korban[' . $i . ']'),
                    'ciri_ciri'          => $this->input->post('ciri_ciri_korban[' . $i . ']'),
                    'aktif'             => '1',
                    'dibuat_pada'       => date('Y-m-d H:i:s')
                ];
                $proses_insert      = $this->db->insert('kb_has_korban', $data_insert);
            }
        }
        $output         = [
            'status'    => 'success',
            'msg'       => 'Data berhasil di simpan'
        ];
        echo json_encode($output);
    }

    public function do_update()
    {
        $id_kejadian = $this->input->post('id');
        $this->db->where('id', $id_kejadian);
        $this->db->update($this->table, [
            'id_form_1'         => $this->input->post('id_form_1'),
            'id_form_2'         => $this->input->post('id_form_2'),
            'kerugian'          => $this->input->post('kerugian'),
            'kajian_kebutuhan'  => $this->input->post('kajian_kebutuhan'),
            'diubah_oleh'       => $this->session->userdata('id'),
            'diubah_pada'       => date('Y-m-d H:i:s'),
        ]);

        $del_data   = $this->db->where('id_kejadian', $id_kejadian)->delete('kb_has_korban');
        for ($i = 0; $i < count($this->input->post('nama_korban[]')); $i++) {
            $data_insert            = [
                'id_kejadian'       => $id_kejadian,
                'rs_rujukan'        => $this->input->post('rs_rujukan_korban[' . $i . ']'),
                'alamat'            => $this->input->post('alamat_korban[' . $i . ']'),
                'nama'              => $this->input->post('nama_korban[' . $i . ']'),
                'jenis_identitas'   => $this->input->post('jenis_identitas_korban[' . $i . ']'),
                'nomor_identitas'   => $this->input->post('nomor_identitas_korban[' . $i . ']'),
                'ciri_ciri'         => $this->input->post('ciri_ciri_korban[' . $i . ']'),
                'aktif'             => '1',
                'dibuat_pada'       => date('Y-m-d H:i:s')
            ];
            $proses_insert      = $this->db->insert('kb_has_korban', $data_insert);
        }


        $output         = [
            'status'    => 'success',
            'msg'       => 'Data berhasil di simpan'
        ];
        echo json_encode($output);
    }

    public function do_delete()
    {
        $id                 = $this->input->post('id');
        $this->db->where(['id' => $id, 'jenis_form' => 'form_a3'])->update($this->table, ['aktif' => '0', 'dihapus_oleh'  => $this->session->userdata('id'), 'dihapus_pada'  => date('Y-m-d H:i:s')]);
        // $this->db->where(['id' => $id, 'jenis_form' => 'form_a2'])->update($this->table, ['aktif' => '0', 'dihapus_oleh'  => $this->session->userdata('id'), 'dihapus_pada'  => date('Y-m-d H:i:s')]);
        // $this->db->where(['id' => $id, 'jenis_form' => 'form_a1'])->update($this->table, ['aktif' => '0', 'dihapus_oleh'  => $this->session->userdata('id'), 'dihapus_pada'  => date('Y-m-d H:i:s')]);
        $output         = [
            'status'    => 'success',
            'msg'       => 'Data berhasil di hapus'
        ];
        echo json_encode($output);
    }

    public function get_data_form1()
    {
        $where              = [
            'aktif'         => '1',
            'jenis_form'    => 'form_a1',
        ];
        $this->db->select('id, nomor_pelapor, nama_pelapor');
        $this->db->from('kejadian_bencana');
        $this->db->where($where);
        $data = $this->db->get()->result();

        return $data;
    }

    public function  select_form2_by_id_pelapor()
    {
        $id_pelapor         = $this->input->post('id_pelapor');
        $where              = [
            'aktif'         => '1',
            'jenis_form'    => 'form_a2',
            'id_pelapor'    => $id_pelapor,
        ];
        $this->db->select('id, nomor_kejadian, jenis_kejadian, jenis_form');
        $this->db->from('kejadian_bencana');
        $this->db->where($where);
        $data = $this->db->get()->result();
        echo json_encode($data);
    }

    public function get_data_form2()
    {
        $where              = [
            'aktif'         => '1',
            'jenis_form'    => 'form_a2',
        ];
        $this->db->select('id, jenis_kejadian, nomor_kejadian');
        $this->db->from('kejadian_bencana');
        $this->db->where($where);
        $data = $this->db->get()->result();
        return $data;
    }

    public function get_detail_from2($id_kejadian)
    {
        $where                      = [
            'a.id'                    => $id_kejadian,
            'a.jenis_form'            => 'form_a2'
        ];
        $this->db->where($where);
        $this->db->select('a.*, c.nama kecamatan, d.nama kelurahan ');
        $this->db->from('kejadian_bencana a');
        $this->db->join('kejadian_bencana b', 'a.id_pelapor = b.id AND b.jenis_form="form_a1" ', 'LEFT');
        $this->db->join('tabel_kecamatan c', 'a.id_kecamatan_kejadian = c.id_kecamatan', 'LEFT');
        $this->db->join('tabel_kelurahan d', 'a.id_kelurahan_kejadian = d.id_kelurahan', 'LEFT');
        $query  = $this->db->get();
        $row    = $query->row();
        $row->kb_has_personil           = $this->db->where('id_kejadian', $id_kejadian)->get('kb_has_personil')->result();
        $row->kb_has_backup_mako        = $this->db->where('id_kejadian', $id_kejadian)->get('kb_has_backup_mako')->result();
        $row->kb_has_peralatan          = $this->db->where('id_kejadian', $id_kejadian)->get('kb_has_peralatan')->result();
        $row->kb_has_logistik           = $this->db->where('id_kejadian', $id_kejadian)->get('kb_has_logistik')->result();
        $row->kb_has_bantuan_personil   = $this->db->where('id_kejadian', $id_kejadian)->get('kb_has_bantuan_personil')->result();
        $row->kb_has_bantuan_peralatan  = $this->db->where('id_kejadian', $id_kejadian)->get('kb_has_bantuan_peralatan')->result();
        $row->kb_has_bantuan_logistik   = $this->db->where('id_kejadian', $id_kejadian)->get('kb_has_bantuan_logistik')->result();
        $row->kb_has_aparat_relawan     = $this->db->where('id_kejadian', $id_kejadian)->get('kb_has_aparat_relawan')->result();
        $row->kb_has_foto_kejadian      = $this->db->where('id_kejadian', $id_kejadian)->get('kb_has_foto_kondisi_bencana')->result();
        return $row;
    }

    public function get_detail($id_kejadian)
    {
        $where              = [
            'id'            => $id_kejadian,
            'jenis_form'    => 'form_a3'
        ];
        $row                    = $this->db->where($where)->get('kejadian_bencana')->row();
        $row->kb_has_korban     = $this->db->where('id_kejadian', $id_kejadian)->get('kb_has_korban')->result();
        return $row;
    }
}
