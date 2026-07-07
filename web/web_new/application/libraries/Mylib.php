<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Mylib
{
    protected $ci;

    public function __construct()
    {
        $this->ci =& get_instance();
    }

    public function tgl_indo($tgl){
        $bulan = [
            1 => 'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember',
        ];
        $pecah = explode('-', $tgl);
        return $pecah[2].' '.$bulan[ (int)$pecah[1]].' '.$pecah[0];
    }

     //input_post
	public function array_from_post($fields) {
        $data = array();
        foreach ($fields as $field) {
           $data[$field] = ($this->ci->input->post($field, TRUE) == "") ? null : $this->ci->input->post($field, TRUE);
        }
        return $data;
     }
  
      //form_validation
    public function array_to_validation($fields) {
        foreach ($fields as $field) {
              $this->form_validation->set_rules($field, ucwords($field), 'required', array('required' => '%s harus diisi.'));
        }
        return $this->form_validation->run();
     }
    

}

/* End of file Mylib.php */


?>