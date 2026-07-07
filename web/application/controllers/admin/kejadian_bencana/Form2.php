<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Form2 extends MY_Controller
{
    private $base           = 'admin';
    private $menu           = 'kejadian_bencana/form2';
    private $folder_upload  = 'kejadian_bencana';
    private $table          = 'kejadian_bencana';

    function __construct()
    {
        parent::__construct();
        $this->load->library('upload');
        $this->load->model('kejadian_bencana/Table_form2', 'm_table');
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
        if ($this->session->userdata('role') != 1) {
            redirect('login');
        }
        $this->link_url = base_url('admin/kejadian_bencana/form2/');
    }

    public function index()
    {
        $data_js['title']       = 'Kejadian Bencana - Form 2';
        $data_js['link_url']    =  $this->link_url;
        $data           = [
            'title'     => 'Kejadian Bencana - Form 2',
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
        ];
        $data                   = [
            'title'             => 'Tambah Kejadian Bencana - Form 2',
            'row'               => '',
            'isi'               => "$this->base/$this->menu/form",
            'list_pelapor'      => $this->get_data_form1(),
            'list_kecamatan'    => $this->get_data_kecamatan(),
            'extra_js'          => $this->load->view("$this->base/$this->menu/form_js",  $data_js, true),
        ];
        $this->load->view('layouts/wrapper', $data, FALSE);
    }

    public function edit()
    {

        $id         = $this->uri->segment(5);
        $row        = $this->get_detail($id);
        $data_js    = [
            'aksi'  => 'ubah',
            'row'   =>  $row,
        ];
        $data                   = [
            'title'             => 'Ubah Kejadian Bencana - Form 2',
            'row'               => $row,
            'list_pelapor'      => $this->get_data_form1(),
            'list_kecamatan'    => $this->get_data_kecamatan(),
            'list_kelurahan'    => $this->get_data_kelurahan_by_kec(@$row->id_kecamatan_kejadian),
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


    public function do_submit()
    {
        // echo json_encode($_POST);
        // die;
        // cek_post();
        $this->db->insert($this->table, [
            'jenis_form'                => 'form_a2',
            'id_pelapor'                => $this->input->post('id_pelapor'),
            'jenis_kejadian'            => $this->input->post('jenis_kejadian'),
            'nomor_kejadian'            => $this->input->post('nomor_kejadian'),
            'id_kecamatan_kejadian'     => $this->input->post('id_kecamatan_kejadian'),
            'id_kelurahan_kejadian'     => $this->input->post('id_kelurahan_kejadian'),
            'alamat_kejadian'           => $this->input->post('alamat_kejadian'),
            'latitude_kejadian'         => $this->input->post('latitude_kejadian'),
            'longitude_kejadian'        => $this->input->post('longitude_kejadian'),
            'hari_kejadian'             => $this->input->post('hari_kejadian'),
            'tanggal_kejadian'          => $this->input->post('tanggal_kejadian'),
            'jam_kejadian'              => $this->input->post('jam_kejadian'),
            'jam_laporan'               => $this->input->post('jam_laporan'),
            'kronologi_kejadian'        => $this->input->post('kronologi_kejadian'),
            'rusak_ringan'              => $this->input->post('rusak_ringan'),
            'rusak_sedang'              => $this->input->post('rusak_sedang'),
            'rusak_berat'               => $this->input->post('rusak_berat'),
            'luka_ringan'               => $this->input->post('luka_ringan'),
            'luka_berat'                => $this->input->post('luka_berat'),
            'meninggal_dunia'           => $this->input->post('meninggal_dunia'),
            'rencana_penanganan'        => $this->input->post('rencana_penanganan'),
            'keahlian'                  => $this->input->post('keahlian'),
            'dampak_kejadian'           => $this->input->post('dampak_kejadian'),
            'hambatan'                  => $this->input->post('hambatan'),
            'aktif'                     => '1',
            'dibuat_oleh'               => $this->session->userdata('id'),
            'dibuat_pada'               => date('Y-m-d H:i:s'),
        ]);
        $last_id = $this->db->insert_id();

        for ($i = 0; $i < count($this->input->post('personil[]')); $i++) {
            $data_insert        = [
                'id_kejadian'   => $last_id,
                'nama'          => $this->input->post('personil[' . $i . ']'),
                'aktif'         => '1',
                'dibuat_pada'   => date('Y-m-d H:i:s')
            ];
            $proses_insert      = $this->db->insert('kb_has_personil', $data_insert);
        }

        for ($i = 0; $i < count($this->input->post('backup_mako[]')); $i++) {
            $data_insert        = [
                'id_kejadian'   => $last_id,
                'nama'          => $this->input->post('backup_mako[' . $i . ']'),
                'aktif'         => '1',
                'dibuat_pada'   => date('Y-m-d H:i:s')
            ];
            $proses_insert      = $this->db->insert('kb_has_backup_mako', $data_insert);
        }

        for ($i = 0; $i < count($this->input->post('jenis_peralatan[]')); $i++) {
            $data_insert        = [
                'id_kejadian'   => $last_id,
                'nama'          => $this->input->post('jenis_peralatan[' . $i . ']'),
                'jumlah'        => $this->input->post('jumlah_peralatan[' . $i . ']'),
                'aktif'         => '1',
                'dibuat_pada'   => date('Y-m-d H:i:s')
            ];
            $proses_insert      = $this->db->insert('kb_has_peralatan', $data_insert);
        }

        for ($i = 0; $i < count($this->input->post('jenis_logistik[]')); $i++) {
            $data_insert        = [
                'id_kejadian'   => $last_id,
                'nama'          => $this->input->post('jenis_logistik[' . $i . ']'),
                'jumlah'        => $this->input->post('jumlah_logistik[' . $i . ']'),
                'aktif'         => '1',
                'dibuat_pada'   => date('Y-m-d H:i:s')
            ];
            $proses_insert      = $this->db->insert('kb_has_logistik', $data_insert);
        }

        for ($i = 0; $i < count($this->input->post('nama_bantuan_personil[]')); $i++) {
            $data_insert        = [
                'id_kejadian'   => $last_id,
                'nama'          => $this->input->post('nama_bantuan_personil[' . $i . ']'),
                'jumlah'        => $this->input->post('jumlah_bantuan_personil[' . $i . ']'),
                'aktif'         => '1',
                'dibuat_pada'   => date('Y-m-d H:i:s')
            ];
            $proses_insert      = $this->db->insert('kb_has_bantuan_personil', $data_insert);
        }

        for ($i = 0; $i < count($this->input->post('jenis_bantuan_peralatan[]')); $i++) {
            $data_insert        = [
                'id_kejadian'   => $last_id,
                'nama'          => $this->input->post('jenis_bantuan_peralatan[' . $i . ']'),
                'jumlah'        => $this->input->post('jumlah_bantuan_peralatan[' . $i . ']'),
                'aktif'         => '1',
                'dibuat_pada'   => date('Y-m-d H:i:s')
            ];
            $proses_insert      = $this->db->insert('kb_has_bantuan_peralatan', $data_insert);
        }

        for ($i = 0; $i < count($this->input->post('jenis_bantuan_logistik[]')); $i++) {
            $data_insert        = [
                'id_kejadian'   => $last_id,
                'nama'          => $this->input->post('jenis_bantuan_logistik[' . $i . ']'),
                'jumlah'        => $this->input->post('jumlah_bantuan_logistik[' . $i . ']'),
                'aktif'         => '1',
                'dibuat_pada'   => date('Y-m-d H:i:s')
            ];
            $proses_insert      = $this->db->insert('kb_has_bantuan_logistik', $data_insert);
        }

        for ($i = 0; $i < count($this->input->post('nama_aparat_relawan[]')); $i++) {
            $data_insert        = [
                'id_kejadian'   => $last_id,
                'nama'          => $this->input->post('nama_aparat_relawan[' . $i . ']'),
                'jumlah'        => $this->input->post('jumlah_aparat_relawan[' . $i . ']'),
                'aktif'         => '1',
                'dibuat_pada'   => date('Y-m-d H:i:s')
            ];
            $proses_insert      = $this->db->insert('kb_has_aparat_relawan', $data_insert);
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
            'id_pelapor'                => $this->input->post('id_pelapor'),
            'jenis_kejadian'            => $this->input->post('jenis_kejadian'),
            'nomor_kejadian'            => $this->input->post('nomor_kejadian'),
            'id_kecamatan_kejadian'     => $this->input->post('id_kecamatan_kejadian'),
            'id_kelurahan_kejadian'     => $this->input->post('id_kelurahan_kejadian'),
            'alamat_kejadian'           => $this->input->post('alamat_kejadian'),
            'latitude_kejadian'         => $this->input->post('latitude_kejadian'),
            'longitude_kejadian'        => $this->input->post('longitude_kejadian'),
            'hari_kejadian'             => $this->input->post('hari_kejadian'),
            'tanggal_kejadian'          => $this->input->post('tanggal_kejadian'),
            'jam_kejadian'              => $this->input->post('jam_kejadian'),
            'jam_laporan'               => $this->input->post('jam_laporan'),
            'kronologi_kejadian'        => $this->input->post('kronologi_kejadian'),
            'rusak_ringan'              => $this->input->post('rusak_ringan'),
            'rusak_sedang'              => $this->input->post('rusak_sedang'),
            'rusak_berat'               => $this->input->post('rusak_berat'),
            'luka_ringan'               => $this->input->post('luka_ringan'),
            'luka_berat'                => $this->input->post('luka_berat'),
            'meninggal_dunia'           => $this->input->post('meninggal_dunia'),
            'keahlian'                  => $this->input->post('keahlian'),
            'rencana_penanganan'        => $this->input->post('rencana_penanganan'),
            'dampak_kejadian'           => $this->input->post('dampak_kejadian'),
            'hambatan'                  => $this->input->post('hambatan'),
            'diubah_oleh'               => $this->session->userdata('id'),
            'diubah_pada'               => date('Y-m-d H:i:s'),
        ]);

        $del_data   = $this->db->where('id_kejadian', $id_kejadian)->delete('kb_has_personil');
        for ($i = 0; $i < count($this->input->post('personil[]')); $i++) {
            $data_insert        = [
                'id_kejadian'   => $id_kejadian,
                'nama'          => $this->input->post('personil[' . $i . ']'),
                'aktif'         => '1',
                'dibuat_pada'   => date('Y-m-d H:i:s')
            ];
            $proses_insert      = $this->db->insert('kb_has_personil', $data_insert);
        }

        $del_data   = $this->db->where('id_kejadian', $id_kejadian)->delete('kb_has_backup_mako');
        for ($i = 0; $i < count($this->input->post('backup_mako[]')); $i++) {
            $data_insert        = [
                'id_kejadian'   => $id_kejadian,
                'nama'          => $this->input->post('backup_mako[' . $i . ']'),
                'aktif'         => '1',
                'dibuat_pada'   => date('Y-m-d H:i:s')
            ];
            $proses_insert      = $this->db->insert('kb_has_backup_mako', $data_insert);
        }

        $del_data   = $this->db->where('id_kejadian', $id_kejadian)->delete('kb_has_peralatan');
        for ($i = 0; $i < count($this->input->post('jenis_peralatan[]')); $i++) {
            $data_insert        = [
                'id_kejadian'   => $id_kejadian,
                'nama'          => $this->input->post('jenis_peralatan[' . $i . ']'),
                'jumlah'        => $this->input->post('jumlah_peralatan[' . $i . ']'),
                'aktif'         => '1',
                'dibuat_pada'   => date('Y-m-d H:i:s')
            ];
            $proses_insert      = $this->db->insert('kb_has_peralatan', $data_insert);
        }

        $del_data   = $this->db->where('id_kejadian', $id_kejadian)->delete('kb_has_logistik');
        for ($i = 0; $i < count($this->input->post('jenis_logistik[]')); $i++) {
            $data_insert        = [
                'id_kejadian'   => $id_kejadian,
                'nama'          => $this->input->post('jenis_logistik[' . $i . ']'),
                'jumlah'        => $this->input->post('jumlah_logistik[' . $i . ']'),
                'aktif'         => '1',
                'dibuat_pada'   => date('Y-m-d H:i:s')
            ];
            $proses_insert      = $this->db->insert('kb_has_logistik', $data_insert);
        }

        $del_data   = $this->db->where('id_kejadian', $id_kejadian)->delete('kb_has_bantuan_personil');
        for ($i = 0; $i < count($this->input->post('nama_bantuan_personil[]')); $i++) {
            $data_insert        = [
                'id_kejadian'   => $id_kejadian,
                'nama'          => $this->input->post('nama_bantuan_personil[' . $i . ']'),
                'jumlah'        => $this->input->post('jumlah_bantuan_personil[' . $i . ']'),
                'aktif'         => '1',
                'dibuat_pada'   => date('Y-m-d H:i:s')
            ];
            $proses_insert      = $this->db->insert('kb_has_bantuan_personil', $data_insert);
        }

        $del_data   = $this->db->where('id_kejadian', $id_kejadian)->delete('kb_has_bantuan_peralatan');
        for ($i = 0; $i < count($this->input->post('jenis_bantuan_peralatan[]')); $i++) {
            $data_insert        = [
                'id_kejadian'   => $id_kejadian,
                'nama'          => $this->input->post('jenis_bantuan_peralatan[' . $i . ']'),
                'jumlah'        => $this->input->post('jumlah_bantuan_peralatan[' . $i . ']'),
                'aktif'         => '1',
                'dibuat_pada'   => date('Y-m-d H:i:s')
            ];
            $proses_insert      = $this->db->insert('kb_has_bantuan_peralatan', $data_insert);
        }

        $del_data   = $this->db->where('id_kejadian', $id_kejadian)->delete('kb_has_bantuan_logistik');
        for ($i = 0; $i < count($this->input->post('jenis_bantuan_logistik[]')); $i++) {
            $data_insert        = [
                'id_kejadian'   => $id_kejadian,
                'nama'          => $this->input->post('jenis_bantuan_logistik[' . $i . ']'),
                'jumlah'        => $this->input->post('jumlah_bantuan_logistik[' . $i . ']'),
                'aktif'         => '1',
                'dibuat_pada'   => date('Y-m-d H:i:s')
            ];
            $proses_insert      = $this->db->insert('kb_has_bantuan_logistik', $data_insert);
        }

        $del_data   = $this->db->where('id_kejadian', $id_kejadian)->delete('kb_has_aparat_relawan');
        for ($i = 0; $i < count($this->input->post('nama_aparat_relawan[]')); $i++) {
            $data_insert        = [
                'id_kejadian'   => $id_kejadian,
                'nama'          => $this->input->post('nama_aparat_relawan[' . $i . ']'),
                'jumlah'        => $this->input->post('jumlah_aparat_relawan[' . $i . ']'),
                'aktif'         => '1',
                'dibuat_pada'   => date('Y-m-d H:i:s')
            ];
            $proses_insert      = $this->db->insert('kb_has_aparat_relawan', $data_insert);
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
        $where              = [
            'id'            => $id,
            'jenis_form'    => 'form_a2',
        ];
        $this->db->where($where);
        $this->db->update($this->table, [
            'aktif'         => '0',
            'dihapus_oleh'  => $this->session->userdata('id'),
            'dihapus_pada'  => date('Y-m-d H:i:s'),
        ]);
        $output         = [
            'status'    => 'success',
            'msg'       => 'Data berhasil di hapus'
        ];
        echo json_encode($output);
    }

    public function select_kelurahan_by_kec()
    {
        $id_kecamatan = $this->input->post('kecamatan_id');
        $data = $this->get_data_kelurahan_by_kec($id_kecamatan);
        echo json_encode($data);
    }

    public function get_data_kecamatan()
    {
        $this->db->select('id_kecamatan, nama');
        $this->db->from('tabel_kecamatan');
        $data = $this->db->get()->result();
        return $data;
    }

    public function get_data_kelurahan_by_kec($id_kecamatan)
    {
        $this->db->select('id_kelurahan, id_kecamatan, nama');
        $this->db->from('tabel_kelurahan');
        $this->db->where('id_kecamatan', $id_kecamatan);
        $data = $this->db->get()->result();
        return $data;
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

    public function get_detail($id_kejadian)
    {
        $where              = [
            'id'            => $id_kejadian,
            'jenis_form'    => 'form_a2'
        ];
        $row                            = $this->db->where($where)->get('kejadian_bencana')->row();
        $row->kb_has_personil           = $this->db->where('id_kejadian', $id_kejadian)->get('kb_has_personil')->result();
        $row->kb_has_backup_mako        = $this->db->where('id_kejadian', $id_kejadian)->get('kb_has_backup_mako')->result();
        $row->kb_has_peralatan          = $this->db->where('id_kejadian', $id_kejadian)->get('kb_has_peralatan')->result();
        $row->kb_has_logistik           = $this->db->where('id_kejadian', $id_kejadian)->get('kb_has_logistik')->result();
        $row->kb_has_bantuan_personil   = $this->db->where('id_kejadian', $id_kejadian)->get('kb_has_bantuan_personil')->result();
        $row->kb_has_bantuan_peralatan  = $this->db->where('id_kejadian', $id_kejadian)->get('kb_has_bantuan_peralatan')->result();
        $row->kb_has_bantuan_logistik   = $this->db->where('id_kejadian', $id_kejadian)->get('kb_has_bantuan_logistik')->result();
        $row->kb_has_aparat_relawan     = $this->db->where('id_kejadian', $id_kejadian)->get('kb_has_aparat_relawan')->result();
        return $row;
    }
}
