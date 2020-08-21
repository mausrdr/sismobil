<?php

class Campus_controller extends MY_controller {
    
    function __construct() {
        
        parent::__construct();
        
        $this->view_data['base_url'] = base_url();
        
    }
    
    function index($id) {
        
        $this->form($id);
        
    }
    
    public function form($id) {
        
        
        
    }
    
}

?>
