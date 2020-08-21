<?php

class MY_controller extends CI_Controller {
    
    function __construct() {
        
        parent::__construct();
        
        $this->load->helper('add_ssl');
        
        add_ssl();
        
    }
    
}

?>
