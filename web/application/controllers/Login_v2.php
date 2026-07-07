<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class Login_v2 extends CI_Controller {

    function __construct(){
		parent::__construct();		
        $this->load->model('LoginModel', 'login');
	}

    public function index()
    {
        $cap = $this->captcha_create();
        // store image html code in a variable
        $data['image'] = $cap['image'];

        // store the captcha word in a session
        $this->session->set_userdata('mycaptcha', $cap['word']);

        $this->load->view('auth_v2/login', $data);
    }

    function captcha_create(){
        $vals = array(
            'word' 			=> rand(1000,9999),
            'img_path'	 	=> './captcha/',
            'img_url'	 	=> base_url().'captcha/',
            // 'font_path'  => './assets/fonts/font22.ttf',
            'img_width'	 	=> '120',
            'img_height' 	=> 50,
            'border' 		=> 0, 
            'border_radius' => '25 0 0 25',
            'expiration' 	=> 7200,
            'word_length'   => 4,
            'font_size'     => 20,
            'colors' => array(
                'background' 	=> array(255, 255, 255),
                'border' 		=> array(0, 0, 0),
                'text' 			=> array(0, 0, 0),
                'grid' 			=> array(255, 40, 40)
            )
        );

        // create captcha image
        $cap = create_captcha($vals);
        return $cap;
    }

    public function change_captcha()
    {
        $cap = $this->captcha_create();
        $data['image'] = $cap['image'];

        // store the captcha word in a session
        $this->session->set_userdata('mycaptcha', $cap['word']);
        echo json_encode($data['image']);
    }

    public function auth()
    {
        $username = $this->input->post('username',TRUE);
        $password = $this->input->post('password',TRUE);
        $validate = $this->login->validate($username,$password);
        $captcha = $this->session->userdata('mycaptcha');
        if ($this->input->post() && ($this->input->post('captcha') == $captcha)) {
        // if ($this->input->post() && ($this->input->post('captcha') == "1234")) {
            if($validate->num_rows() > 0){
                $data  = $validate->row_array();
                $role  = $data['role'];
                $id = $data['id_user'];
                $sesdata = array(
                    'id'            => $id,
                    'username'      => $username,
                    'nama'          => $data['nama'],
                    'id_opd'        => $data['id_opd'],
                    'id_user_detail'=> $data['id_user_detail'],
                    'logged_in'     => TRUE,
                    'role'          => $role,
                    'id_periode'    => $data['id_periode'],
                );
                $this->session->set_userdata($sesdata);
                // access login for admin
                switch ($role) {
                    case 1: redirect('admin/beranda');break;
                    case 2: redirect('opd/peta');break;
                    case 3: redirect('pemohon/perijinan');break;
                    default: echo "belum login";break;
                }

            }else{
                echo $this->session->set_flashdata('msg','Username atau password salah!');
                redirect('login_v2','refresh');
            }
        }else{
                echo $this->session->set_flashdata('msg','Kode captcha salah');
                redirect('login_v2','refresh');
        }
    }

    public function out()
    {
        // $this->session->sess_destroy();
        session_destroy();
        redirect('login_v2');
    }
}
/* End of file Login.php */
?>