<?php


defined('BASEPATH') OR exit('No direct script access allowed');
require 'vendor/autoload.php';
class Peta extends MY_Controller {

    function __construct(){
		parent::__construct();		
        $this->load->model('Korban_JiwaModel', 'korban_jiwa');
        if ( ! $this->session->userdata('logged_in')){ 
            redirect('login');
        }
         
    }

    private $base   = 'operator'; 
    public function index()
    { 
        $this->session->unset_userdata('id_pengaduan');
        $this->Peta();
    } 
    // Referensi Slider
    public function Peta()
    {
        $this->session->unset_userdata('id_pengaduan');
        $data = [
            'isi'       => "$this->base/peta/beranda/index",
            'modal'     => array(
                    $this->load->view("$this->base/peta/beranda/modal_tambah", '', true),
                    $this->load->view("$this->base/peta/beranda/modal_ubah", '', true),
                    $this->load->view("$this->base/peta/beranda/modal_hapus", '', true)
            ),
            'extra_css'  => $this->load->view("$this->base/peta/beranda/index_css", '', true),
            'extra_js'  => $this->load->view("$this->base/peta/beranda/index_js", '', true),
        ];
        $this->load->view('layouts/wrapper', $data, FALSE);   
    }
    public function _sendPusher($bind,$data)
    {                
        $options = array(
            'cluster' => 'ap1',
            'useTLS' => true
        );
        $pusher = new Pusher\Pusher(
            'f62610642fae7b590e3b',
            'f7e59ddef91fd4bee447',
            '1296229',
            $options
        );
        $pusher->trigger('bpbd-surakarta', $bind, $data);        
    }
    public function loop()
    {        
        for ($i=1; $i <= 5; $i++) { 
            return $this->i->get_data($page);
        }
    }
    public function get_data()
    {
        $arr = [];
        for($i = 1; $i <= 5; $i++){
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => "https://ulas.surakarta.go.id/index.php?mod=services&sub=allAspirasi&act=view&typ=html&take=all&attach=1&comment=0&response=0&page={$i}",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Cookie: SessIDUlassoloPortal=18tcvqm5doo18dp7hv3h70s5n1'
            ),
            )
        );
        
        $response = curl_exec($curl);
        $arr [] = json_decode($response);
    }       
    //    echo "<pre>";
    //    print_r($arr);
    //    echo "<pre>";

        //  $res = json_encode($arr);
        //  echo "<pre>";
        //  print_r($arr);
        //  echo "</pre>";
        // curl_close($curl);
        echo json_encode($arr);     
        if ($this->db->affected_rows() > 0) {
            $this->_sendPusher('load-notification-tables', ['load' => false]);
        }
    }
}