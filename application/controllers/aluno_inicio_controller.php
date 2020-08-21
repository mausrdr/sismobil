<?php

class Aluno_inicio_controller extends MY_controller {
    
    function __construct() {
        
        parent::__construct();
        
        $this->view_data['base_url'] = base_url();
        
        $this->load->model('aluno_login_model', 'login_model');
        
    }
    
    function index($edital_aberto = TRUE) {
        
        $this->validaSessao($edital_aberto);
        
    }

    public function validaSessao($edital_aberto) {
        
        if($this->login_model->isLogado() === TRUE) {
            
            $this->view_data['nome'] = $this->session->userdata('aluno_nome');
            $data['titulo'] = "Início";
            
            if($edital_aberto) {
                
                $this->load->view('/headers/header_aluno_logged_aberto_view', $data);
                $this->load->view('aluno_inicio_view', $this->view_data);
                $this->load->view('/footers/footer_view');
                
            } else {
                
                $this->load->view('/headers/header_aluno_logged_fechado_view', $data);
                $this->load->view('aluno_inicio_view', $this->view_data);
                $this->load->view('/footers/footer_view');
                
            }
            
            
        } else {
            
            redirect('main_controller');
            
        }
        
    }
    
    public function logoutSessao() {
        
        $this->login_model->logout();
        
    }
    
}

?>
