<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Form1 extends MY_Controller
{
    private $base           = 'admin';
    private $menu           = 'kejadian_bencana/form1';
    private $folder_upload  = 'kejadian_bencana';
    private $table          = 'kejadian_bencana';

    function __construct()
    {
        parent::__construct();
        $this->load->library('upload');
        $this->load->model('kejadian_bencana/Table_form1', 'm_table');
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
        if ($this->session->userdata('role') != 1) {
            redirect('login');
        }
        $this->link_url = base_url('admin/kejadian_bencana/form1/');
    }

    public function index()
    {
        $data_js['title']       = 'Kejadian Bencana - Form 1';
        $data_js['link_url']    =  $this->link_url;
        $data           = [
            'title'     => 'Kejadian Bencana - Form 1',
            'isi'       => "$this->base/$this->menu/index",
            'modal'     => array(
                $this->load->view("$this->base/$this->menu/modal", '', true),
            ),
            'extra_css' => $this->load->view("$this->base/$this->menu/index_css", $data_js, true),
            'extra_js'  => $this->load->view("$this->base/$this->menu/index_js", '', true),
        ];
        $this->load->view('layouts/wrapper', $data, FALSE);
    }

    public function datatable()
    {
        echo $this->m_table->generate_table();
    }

    public function tambah()
    {
        $data           = ['folder' => $this->menu];
        $html           = $this->load->view('admin/' . $this->menu . '/form', $data, TRUE);
        $output         = [
            'status'    => 'success',
            'html'      => $html,
        ];
        echo json_encode($output);
    }

    public function ubah()
    {
        $id             =  $this->input->post('id');
        $data           = [
            'folder'    => $this->folder_upload,
            'data'      => $this->db->query("SELECT * from {$this->table} where id = {$id} AND dihapus_pada is null")->row(),
        ];
        $html           = $this->load->view('admin/' . $this->menu . '/form', $data, true);
        $output         = [
            'status'    => 'success',
            'html'      => $html,
        ];
        echo json_encode($output);
    }

    public function do_submit()
    {
        cek_post();
        $id                 = $this->input->post('id');
        $hapus              = $this->input->post('hapus');
        $nama_pelapor       = $this->input->post('nama_pelapor');
        $alamat_pelapor     = $this->input->post('alamat_pelapor');
        $jenis_kelamin      = $this->input->post('jenis_kelamin');
        $jenis_identitas    = $this->input->post('jenis_identitas');
        $nomor_identitas    = $this->input->post('nomor_identitas');
        $nomor_telepon      = $this->input->post('nomor_telepon');
        $pelapor_sebagai    = $this->input->post('pelapor_sebagai');
        $media              = $this->input->post('media');

        $kosongkan_file   = $this->input->post('kosongkan_file');

        if (!empty($hapus)) {
            $this->db->where('id', $id);
            $this->db->update($this->table, [
                'aktif'         => '0',
                'dihapus_oleh'  => $this->session->userdata('id'),
                'dihapus_pada'  => date('Y-m-d H:i:s'),
            ]);
        } else {
            if (empty($id)) {
                if ($_FILES['image']) {
                    $config['allowed_types']    = 'gif|jpg|jpeg|png';
                    $config['upload_path']      = 'uploads/images/' . $this->folder_upload . '';
                    $config['encrypt_name']     = FALSE;
                    $this->upload->initialize($config);
                    $upload_data    = $this->upload->do_upload('image');
                    $data_file      = $this->upload->data();
                    $file_name      = $data_file['raw_name'] . $data_file['file_ext'];
                } else {
                    $file_name      = '';
                }
                $create_nomor_pelapor        = create_code('nomor_pelapor', $this->table, 'CDP');
                $this->db->insert($this->table, [
                    'nomor_pelapor'      => $create_nomor_pelapor,
                    'jenis_form'        => 'form_a1',
                    'nama_pelapor'      => $nama_pelapor,
                    'alamat_pelapor'    => $alamat_pelapor,
                    'jenis_kelamin'     => $jenis_kelamin,
                    'jenis_identitas'   => $jenis_identitas,
                    'nomor_identitas'   => $nomor_identitas,
                    'nomor_telepon'     => $nomor_telepon,
                    'pelapor_sebagai'   => $pelapor_sebagai,
                    'media'             => $media,
                    'upload_identitas'  => $file_name,
                    'aktif'             => '1',
                    'dibuat_oleh'       => $this->session->userdata('id'),
                    'dibuat_pada'       => date('Y-m-d H:i:s'),
                ]);
            } else {
                $get_data   = $this->db->where('id', $id)->where('jenis_form', 'form_a1')->get($this->table)->row();
                //
                $config['allowed_types']    = 'gif|jpg|jpeg|png';
                $config['upload_path']      = 'uploads/images/' . $this->folder_upload . '';
                $config['encrypt_name']     = FALSE;
                $this->upload->initialize($config);
                if ($_FILES['image'] != '') {
                    if (!$this->upload->do_upload('image')) {
                        if ($kosongkan_file != '') {
                            $file_name      = '';
                            unlink('./uploads/images/' . $this->folder_upload . '/' . $get_data->upload_identitas);
                        } else {
                            $file_name      = $get_data->upload_identitas;
                        }
                    } else {
                        $file_name = $this->upload->data('file_name');
                        if ($get_data->upload_identitas != '') {
                            unlink('./uploads/images/' . $this->folder_upload . '/' . $get_data->upload_identitas);
                        }
                    }
                } else {
                    $file_name = '';
                }
                $this->db->where('id', $id);
                $this->db->update($this->table, [
                    'nama_pelapor'      => $nama_pelapor,
                    'alamat_pelapor'    => $alamat_pelapor,
                    'jenis_kelamin'     => $jenis_kelamin,
                    'jenis_identitas'   => $jenis_identitas,
                    'nomor_identitas'   => $nomor_identitas,
                    'nomor_telepon'     => $nomor_telepon,
                    'pelapor_sebagai'   => $pelapor_sebagai,
                    'media'             => $media,
                    'upload_identitas'  => $file_name,
                    'diubah_oleh'       => $this->session->userdata('id'),
                    'diubah_pada'       => date('Y-m-d H:i:s'),
                ]);
            }
        }
        echo json_encode(['status' => 'success']);
    }
    public function session_user()
    {
        //$session = $this->session->userdata();
        echo json_encode($this->session->userdata('id'));
    }

    public function buat_kode()
    {
        $kode = create_code('nomor_pelapor', $this->table, 'CDP');
        echo json_encode($kode);
    }
}
