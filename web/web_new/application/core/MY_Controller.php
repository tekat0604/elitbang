<?php
class MY_Controller extends CI_Controller {
    
    public $data = array();
    function __construct(){
        parent::__construct();

        $this->user_id = @$this->session->userdata('id')?$this->session->userdata('id'):'';
        
        $CI = &get_instance();
        if(@$CI->session->userdata('id_periode')){
            $this->tahun = $CI->db->select('periode')->where('id',$CI->session->userdata('id_periode'))->get('ref_periode')->row()->periode;
        } else{
            $this->tahun = date('Y');
        }
        
    }
    
    function pusher_process(){
        $CI = &get_instance();
        $CI->load->view('vendor/autoload.php');
        $options = array(
            'cluster' => 'ap1',
            'useTLS' => true
        );
        $pusher = new Pusher\Pusher(
            'ab681d538e4ccc533525',
            'bc1aaae8bdc1fa0b1552',
            '977535',
            $options
        );
        
        $count = count_message();
        
        $data['belum_dibaca'] = $count->belum_dibaca;
        $data['belum_dibalas'] = $count->belum_dibalas;
        $pusher->trigger('bpbd', 'my-event', $data);
    }

    
    public function set_success($data)
    {
        $data = array("status" => true) + $data;
        $this->output
            ->set_content_type('application/json', 'utf-8')
            ->set_status_header(200)
            ->set_output(json_encode($data));
    }

    public function set_failed($data)
    {
        $data = array("status" => false) + $data;
        $this->output
            ->set_content_type('application/json', 'utf-8')
            ->set_status_header(200)
            ->set_output(json_encode($data));
        // die;
    }
}