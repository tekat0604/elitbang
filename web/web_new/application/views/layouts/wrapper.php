<?php
require_once('header.php');
if($this->session->userdata('role') == '4'){
    require_once('menu-operator.php');
}else{
    require_once('menu.php');
}
require_once('header2.php');
require_once('content.php');
require_once('footer.php');
