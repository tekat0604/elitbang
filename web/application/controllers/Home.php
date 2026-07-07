<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    header("location:" . base_url('frontend/index') . "");
    die;
    $this->load->view('front/home/index.php');
  }

  public function visitor()
  {
    $data = view_visitor();
    echo json_encode($data);
  }
}
