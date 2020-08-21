<?php

class Assessoria_inicio_controller extends MY_controller {
    
    function __construct() {
        
        parent::__construct();
        
        $this->view_data['base_url'] = base_url();
        
        $this->load->model('assessoria_login_model', 'login_model');
        
    }
    
    function index() {
        
        $this->validaSessao();
        
    }

    public function validaSessao() {
        
        if($this->login_model->isLogado() === TRUE) {
            
            $this->view_data['username'] = $this->session->userdata('usuario_nome');
            $data['titulo'] = "Início";
            
            $this->load->view('/headers/header_logged_view', $data);
            $this->load->view('assessoria_inicio_view', $this->view_data);
            $this->load->view('/footers/footer_view');
            
        } else {
            
            redirect('main_controller');
            
        }
        
    }
    
    public function logoutSessao() {
        
        $this->login_model->logout();
        
    }
    
}

?>
