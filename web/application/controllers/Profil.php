<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Profil extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $data = [];
    $this->template->content_frontend("frontend/profil/index", $data);
  }

  public function tugas_fungsi()
  {
    $where            = [
      'id'            => 2,
      'id_menu_utama' => 2
    ];
    $get_row          = $this->db->where($where)->get('menu')->row();
    $data             = [
      'li_profil'     => 'active',
      'row'           => $get_row,
    ];
    $this->template->content_frontend("frontend/profil/tugas_fungsi", $data);
  }

  public function visi_misi()
  {
    $where            = [
      'id'            => 3,
      'id_menu_utama' => 2
    ];
    $get_row          = $this->db->where($where)->get('menu')->row();
    $data             = [
      'li_profil'     => 'active',
      'row'           => $get_row,
    ];
    $this->template->content_frontend("frontend/profil/visi_misi", $data);
  }

  public function struktur_organisasi()
  {
    $where            = [
      'id'            => 4,
      'id_menu_utama' => 2
    ];
    $get_row          = $this->db->where($where)->get('menu')->row();
    $data             = [
      'li_profil'     => 'active',
      'row'           => $get_row,
    ];
    $this->template->content_frontend("frontend/profil/struktur_organisasi", $data);
  }

  public function profil_pejabat()
  {
    $pejabat          = '1';
    $data             = $this->get_anggota($pejabat);
    $data             = [
      'li_profil'     => 'active',
      'data'          => $data,
    ];
    $this->template->content_frontend("frontend/profil/profil_pejabat", $data);
  }

  public function profil_pegawai()
  {
    $pegawai          = '2';
    $data             = $this->get_anggota($pegawai);
    $data             = [
      'li_profil'     => 'active',
      'data'          => $data,
    ];
    $this->template->content_frontend("frontend/profil/profil_pegawai", $data);
  }

  public function agenda_pimpinan()
  {
    $data             = [
      'li_profil'     => 'active',
      'extra_css'     => "frontend/profil/agenda_pimpinan_css",
      'extra_js'      => "frontend/profil/agenda_pimpinan_js",
    ];
    $this->template->content_frontend("frontend/profil/agenda_pimpinan", $data);
  }

  private function get_anggota($jenis)
  {
    $where            = [
      'jenis'         => $jenis,
      'aktif'         => '1',
      'dihapus_pada is NULL' => NULL,
    ];
    $data             = $this->db->where($where)->get('profil_anggota')->result();
    return $data;
  }
}
