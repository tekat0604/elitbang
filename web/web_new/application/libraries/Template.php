<?php
class Template{
    protected $_ci;
    
    function __construct(){
        $this->_ci = get_instance();
    }
    
    function content_frontend($content, $data = NULL){
        $data['_menu']         = $this->_ci->load->view('_layouts/menu-frontend', $data, TRUE);
        $include['_header']    = $this->_ci->load->view('_layouts/header', $data, TRUE);
        $include['_content']   = $this->_ci->load->view($content, $data, TRUE);
        $include['_footer']    = $this->_ci->load->view('_layouts/footer', $data, TRUE);
        
        $this->_ci->load->view('_layouts/index', $include);
    } 

    function content_mobile_frontend($content, $data = NULL){ 
        $include['_header']    = $this->_ci->load->view('_layouts/header_mobile', $data, TRUE);
        $include['_content']   = $this->_ci->load->view($content, $data, TRUE);
        $include['_footer']    = $this->_ci->load->view('_layouts/footer_mobile', $data, TRUE);
        $this->_ci->load->view('_layouts/index', $include);
    } 
    
}