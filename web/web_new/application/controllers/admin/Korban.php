<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Korban extends MY_Controller
{
    private $base           = 'admin';
    private $menu           = 'korban_bencana';
    function __construct()
    {
        parent::__construct();
        $this->load->library('upload');
        $this->load->model('PageModel', 'page');
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
        if ($this->session->userdata('role') != 1) {
            redirect('login');
        }
    }

    public function index()
    {
        $this->Korban();
    }
    // Referensi Berita
    public function Korban()
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

    public function tambah()
    {
        $data = [
            'isi'       => "$this->base/$this->menu/tambah/index",
            'extra_js'  => $this->load->view("$this->base/$this->menu/tambah/index_js", '', true),
        ];
        $this->load->view('layouts/wrapper', $data, FALSE);
    }

    public function edit()
    {
        $data = [
            'isi'       => "$this->base/$this->menu/edit/index",
            'extra_js'  => $this->load->view("$this->base/$this->menu/edit/index_js", '', true),
        ];
        $this->load->view('layouts/wrapper', $data, FALSE);
    }

    public function kategori_bencanas()
    {        
        $ch = curl_init(); 
        $url = "https://ulas.surakarta.go.id/index.php?mod=services&sub=aspCat&act=view&typ=html&page=1";
        curl_setopt_array($ch, [
            CURLOPT_URL             => $url, 
            CURLOPT_HTTPGET            => true, 
            CURLOPT_RETURNTRANSFER  => true
        ]);
        $return = curl_exec($ch);
        curl_close ($ch);
        echo $return;
    }

    function jumlah_korban()
    {
        //DATA JUMLAH TOTAL SEMUA KORBAN BENCANA  
        $this->db->select('count(*) AS total');
        $this->db->from('korban_bencana');
        $this->db->where('korban_bencana.aktif', '1');
        $this->db->where('korban_bencana.dihapus_pada', NULL);
        $data_korban = $this->db->get()->row_array();
        //DATA JUMLAH TOTAL KORBAN BENCANA BERDASRKAN KATEGORI
        $data_total_korban = array();
        $this->db->select('ref_kategori_bencana.id AS id_kategori, ref_kategori_bencana.nama_kategori_bencana AS kategori, 
        (select count(*) from korban_bencana 
        where id_kategori=ref_kategori_bencana.id AND korban_bencana.aktif="1" AND korban_bencana.dihapus_pada is NULL  
        GROUP BY id_kategori) AS total_korban');
        $this->db->from('ref_kategori_bencana');
        $this->db->where('ref_kategori_bencana.aktif', '1');
        $this->db->where('ref_kategori_bencana.dihapus_pada', NULL);
        $list_kategori_korban = $this->db->get()->result_array();
        foreach ($list_kategori_korban as $key => $value) {
            $row                    = array();
            $row['id_kategori']     = $value['id_kategori'];
            $row['kategori']        = $value['kategori'];
            $row['total_korban']    = ($value['total_korban']  != null) ? $value['total_korban']  : '0';
            $data_total_korban[]    = $row;
        }

        $output = array(
            "data_semua_korban" => $data_korban['total'],
            "data_korban"       => $data_total_korban,
        );
        echo json_encode($output);

    }

    public function get_data()
    {
        $id_kategori    = $this->input->post('id_kategori')  ? $this->input->post('id_kategori')  : '';
        $kerusakan_fasilitas = $this->db->select('tabel_kerusakan_fasilitas.jumlah_unit,
        tabel_kerusakan_fasilitas.kerugian_biaya,
        tabel_kerusakan_fasilitas.kategori as kategori_kerusakan_fasilitas,
        tabel_kerusakan_fasilitas.id_pengaduan,
        tabel_kerusakan_fasilitas.id_kategori'
        )->from('tabel_kerusakan_fasilitas')->get()->result();
        foreach ($kerusakan_fasilitas as $key => $value) {            
            $relawan = $this->db->select('tabel_relawan.nik as nik_relawan,
            tabel_relawan.nama as nama_relawan,
            tabel_relawan.alamat as alamat_relawan,
            tabel_relawan.kategori as kategori_relawan,
            tabel_relawan.id_pengaduan'
            )->from('tabel_relawan')
            ->where('id_pengaduan',$value->id_pengaduan)->get()->result_array();
            $pengungsian = $this->db->select('tabel_pengungsian.keterangan as keterangan_pengungsian,
            tabel_pengungsian.kapasitas as kapasitas_pengungsian,
            tabel_pengungsian.alamat as alamat_pengungsian,
            tabel_pengungsian.id_pengaduan')->from('tabel_pengungsian')->where('id_pengaduan',$value->id_pengaduan)->get()->result_array();
            $korban_jiwa = $this->db->select('tabel_korban_jiwa.nik as nik_korban_jiwa,
            tabel_korban_jiwa.nama as nama_korban_jiwa,
            tabel_korban_jiwa.alamat as alamat_korban_jiwa,
            tabel_korban_jiwa.tgl_lahir,
            tabel_korban_jiwa.tmpt_lahir,
            tabel_korban_jiwa.id_pengaduan,
            tabel_korban_jiwa.kategori as kategori_korban_jiwa')->from('tabel_korban_jiwa')->where('id_pengaduan',$value->id_pengaduan)->get()->result_array();
            $list_data = array_merge($korban_jiwa,$relawan,$pengungsian);
            
        }
        
        // $this->db->select(
        //     'tabel_relawan.nik as nik_relawan,
        //     tabel_relawan.nama as nama_relawan,
        //     tabel_relawan.alamat as alamat_relawan,
        //     tabel_relawan.kategori as kategori_relawan,
        //     tabel_relawan.id_pengaduan,
        //     tabel_pengungsian.keterangan as keterangan_pengungsian,
        //     tabel_pengungsian.kapasitas as kapasitas_pengungsian,
        //     tabel_pengungsian.alamat as alamat_pengungsian,
        //     tabel_pengungsian.id_pengaduan,
        //     tabel_kerusakan_fasilitas.jumlah_unit,
        //     tabel_kerusakan_fasilitas.kerugian_biaya,
        //     tabel_kerusakan_fasilitas.kategori as kategori_kerusakan_fasilitas,
        //     tabel_kerusakan_fasilitas.id_kategori,
        //     tabel_korban_jiwa.nik as nik_korban_jiwa,
        //     tabel_korban_jiwa.nama as nama_korban_jiwa,
        //     tabel_korban_jiwa.alamat as alamat_korban_jiwa,
        //     tabel_korban_jiwa.tgl_lahir,
        //     tabel_korban_jiwa.tmpt_lahir,
        //     tabel_korban_jiwa.kategori as kategori_korban_jiwa,
        //     '
        // );
        // $this->db->from('tabel_kerusakan_fasilitas');
        // $this->db->join('tabel_relawan', 'tabel_relawan.id_pengaduan = tabel_kerusakan_fasilitas.id_pengaduan', 'LEFT');
        // $this->db->join('tabel_pengungsian', 'tabel_pengungsian.id_pengaduan = tabel_kerusakan_fasilitas.id_pengaduan', 'LEFT');
        // $this->db->join('tabel_korban_jiwa', 'tabel_korban_jiwa.id_pengaduan = tabel_kerusakan_fasilitas.id_pengaduan', 'LEFT');        
        // $this->db->where('tabel_kerusakan_fasilitas.aktif', '1');
        // $this->db->where('tabel_kerusakan_fasilitas.dihapus_pada', NULL);        
        // if ($id_kategori != '') {
        //     $this->db->where('korban_bencana.id_kategori', $id_kategori);
        // }

        // $this->db->order_by("tabel_kerusakan_fasilitas.id_kerusakan_fasilitas", "DESC");
        // $list_data = $this->db->get()->result();
        
        $jum = count($list_data);
        $no = 0;
        $data = array();
        foreach ($list_data as $row) {
            $no++;
            $row['no'] = $no; 
            $data[] = $row;
        }
        $output = array(
            "recordsTotal"  =>  $jum,
            "data"          => $list_data
        );
        echo json_encode($output);
    }


    public function jumlah_data($where, $table)
    {
        $query = $this->db->get_where($table, $where);
        return $query->num_rows();
    }


    public function prosesTambah()
    {
        if ($_FILES['image']) {
            $config['allowed_types']    = 'jpg|png|jpeg';
            $config['upload_path']      = 'uploads/korban_bencana';
            $this->upload->initialize($config);
            if ($this->upload->do_upload('image')) {
                $data_file      = $this->upload->data();
                $file_name      = $data_file['raw_name'] . $data_file['file_ext'];
                $this->page->_create_thumbs('korban_bencana', $file_name);
            } else {
                $file_name      = "";
            }
        } else {
            $file_name      = "";
        }
        //$tanggal   = $this->input->post('tanggal') ? $this->page->formatDate($this->input->post('tanggal')) : '';
        $post_tanggal_lahir   = $this->input->post('tanggal_lahir') ? $this->input->post('tanggal_lahir') : '';
        $exp_tgl_lahir = explode("-", $post_tanggal_lahir);
        if ($post_tanggal_lahir != '') {
            $tanggal_lahir = $exp_tgl_lahir[2] . "-" . $exp_tgl_lahir[1] . "-" . $exp_tgl_lahir[0];
        } else {
            $tanggal_lahir = $post_tanggal_lahir;
        }

        $data = array(
            'id_periode'        => $this->session->userdata('id_periode'),
            'id_user'           => $this->session->userdata('id'),
            'id_kategori'       => $this->input->post('id_kategori'),
            'keterangan'        => $this->input->post('keterangan'),
            'nik'               => $this->input->post('nik'),
            'nomor_kk'          => $this->input->post('nomor_kk'),
            'nama_lengkap'      => $this->input->post('nama_lengkap'),
            'id_kecamatan'      => $this->input->post('id_kecamatan'),
            'id_kelurahan'      => $this->input->post('id_kelurahan'),
            'alamat_lengkap'    => $this->input->post('alamat_lengkap'),
            'rt'                => $this->input->post('rt'),
            'rw'                => $this->input->post('rw'),
            'tempat_lahir'      => $this->input->post('tempat_lahir'),
            'tanggal_lahir'     => $tanggal_lahir,
            'agama'             => $this->input->post('agama'),
            'jenis_kelamin'     => $this->input->post('jenis_kelamin'),
            'image'             => $file_name,
            //'tanggal'           => $tanggal,
            'aktif'             => '1',
            'dibuat_pada'       => date("Y-m-d H:i:s")
        );
        $proses = $this->page->tambah($data, 'korban_bencana');
        echo json_encode("ok");
    }


    public function prosesUbah()
    {
        $id                 = $this->input->post('id');
        $tanggal            = $this->input->post('tanggal') ? $this->page->formatDate($this->input->post('tanggal')) : '';
        $kosongkan_image    = $this->input->post('kosongkan_image');
        $data_korban        = $this->db->where('id', $id)->get('korban_bencana')->row_array();
        $config = array(
            'upload_path'   => "uploads/korban_bencana",
            'allowed_types' => 'jpg|png|jpeg'
        );

        $this->upload->initialize($config);
        if ($_FILES['image'] != '') {
            if (!$this->upload->do_upload('image')) {
                if ($kosongkan_image == "1") {
                    if ($data_korban['image'] != '') {
                        unlink('./uploads/korban_bencana/' . $data_korban['image']);
                        unlink('./uploads/korban_bencana/large/' . $data_korban['image']);
                        unlink('./uploads/korban_bencana/medium/' . $data_korban['image']);
                        unlink('./uploads/korban_bencana/small/' . $data_korban['image']);
                    }
                    $file_name = "";
                } else {
                    $file_name = $data_korban['image'];
                }
            } else {
                if ($data_korban['image'] != '') {
                    unlink('./uploads/korban_bencana/' . $data_korban['image']);
                    unlink('./uploads/korban_bencana/large/' . $data_korban['image']);
                    unlink('./uploads/korban_bencana/medium/' . $data_korban['image']);
                    unlink('./uploads/korban_bencana/small/' . $data_korban['image']);
                }
                $data_file      = $this->upload->data();
                $file_name      = $data_file['raw_name'] . $data_file['file_ext'];
                $this->page->_create_thumbs('korban_bencana', $file_name);
            }
        } else {
            $file_name = '';
        }
        $where = array(
            'id' => $this->input->post('id')
        );
        $post_tanggal_lahir   = $this->input->post('tanggal_lahir') ? $this->input->post('tanggal_lahir') : '';
        $exp_tgl_lahir = explode("-", $post_tanggal_lahir);
        if ($post_tanggal_lahir != '') {
            $tanggal_lahir = $exp_tgl_lahir[2] . "-" . $exp_tgl_lahir[1] . "-" . $exp_tgl_lahir[0];
        } else {
            $tanggal_lahir = $post_tanggal_lahir;
        }
        $data = array(
            'id_user'           => $this->session->userdata('id'),
            'id_kategori'       => $this->input->post('id_kategori'),
            'keterangan'        => $this->input->post('keterangan'),
            'nik'               => $this->input->post('nik'),
            'nomor_kk'          => $this->input->post('nomor_kk'),
            'nama_lengkap'      => $this->input->post('nama_lengkap'),
            'id_kecamatan'      => $this->input->post('id_kecamatan'),
            'id_kelurahan'      => $this->input->post('id_kelurahan'),
            'alamat_lengkap'    => $this->input->post('alamat_lengkap'),
            'rt'                => $this->input->post('rt'),
            'rw'                => $this->input->post('rw'),
            'tempat_lahir'      => $this->input->post('tempat_lahir'),
            'tanggal_lahir'     => $tanggal_lahir,
            'jenis_kelamin'     => $this->input->post('jenis_kelamin'),
            'image'             => $file_name,
            //'tanggal'           => $tanggal,
            'diubah_pada'       => date("Y-m-d H:i:s")
        );
        $proses = $this->page->ubah($data, $where, 'korban_bencana');
        echo json_encode("ok");
    }

    public function get_id()
    {
        $id = $this->input->post('id') ? $this->input->post('id') : 2;
        $this->db->select(
            'korban_bencana.id, korban_bencana.nik, korban_bencana.nomor_kk, korban_bencana.nama_lengkap, 
            korban_bencana.jenis_kelamin, 
            korban_bencana.tempat_lahir, korban_bencana.tanggal_lahir,
            korban_bencana.kabupaten, korban_bencana.id_kecamatan, tabel_kecamatan.nama as kecamatan, 
            korban_bencana.id_kelurahan, tabel_kelurahan.nama as kelurahan, 
            korban_bencana.rt, korban_bencana.rw, korban_bencana.alamat_lengkap, 
            ref_kategori_bencana.nama_kategori_bencana AS kategori_bencana, korban_bencana.keterangan, 
            korban_bencana.id_kategori,korban_bencana.image'
        );
        $this->db->from('korban_bencana');
        $this->db->join('ref_kategori_bencana', 'ref_kategori_bencana.id = korban_bencana.id_kategori', 'LEFT');
        $this->db->join('tabel_kecamatan', 'tabel_kecamatan.id_kecamatan = korban_bencana.id_kecamatan', 'LEFT');
        $this->db->join('tabel_kelurahan', 'tabel_kelurahan.id_kelurahan = korban_bencana.id_kelurahan', 'LEFT');
        $this->db->where('korban_bencana.id', $id);
        $this->db->where('korban_bencana.aktif', '1');
        $this->db->where('korban_bencana.dihapus_pada', NULL);
        $data = $this->db->get()->row_array();
        $exp_tgl_lahir = explode("-", $data['tanggal_lahir']);
        if ($data['tanggal_lahir'] != '') {
            $tanggal_lahir = $exp_tgl_lahir[2] . "-" . $exp_tgl_lahir[1] . "-" . $exp_tgl_lahir[0];
        } else {
            $tanggal_lahir = $data['tanggal_lahir'];
        }
        $data['tanggal_lahir'] = $tanggal_lahir;
        echo json_encode($data);
    }

    public function prosesHapus()
    {
        $where = array(
            'id'        => $this->input->post('id'),
            'aktif'     => '1',
        );
        $data = array(
            'aktif'         => '0',
            'dihapus_pada'  => date("Y-m-d H:i:s")
        );
        $proses = $this->page->ubah($data, $where, 'korban_bencana');
        echo json_encode("ok");
    }

    public function select_kecamatan()
    {
        $this->db->select('id_kecamatan, nama');
        $this->db->from('tabel_kecamatan');
        $data = $this->db->get()->result_array();
        echo json_encode($data);
    }

    public function select_kelurahan()
    {
        $this->db->select('id_kelurahan, id_kecamatan, nama');
        $this->db->from('tabel_kelurahan');
        $data = $this->db->get()->result_array();
        echo json_encode($data);
    }

    public function select_kelurahan_by_kec()
    {
        $id_kecamatan = $this->input->post('kecamatan_id');
        $this->db->select('id_kelurahan, id_kecamatan, nama');
        $this->db->from('tabel_kelurahan');
        $this->db->where('id_kecamatan', $id_kecamatan);
        $data = $this->db->get()->result_array();
        echo json_encode($data);
    }
    public function select_kategori_bencana()
    {
        $this->db->select('id, nama_kategori_bencana');
        $this->db->from('ref_kategori_bencana');
        $this->db->where('aktif', '1');
        $data = $this->db->get()->result_array();
        echo json_encode($data);
    }

    public function assesment_bencana()
    {
    
        var_dump($data);
        die;
        echo json_encode($data);
    }
}
