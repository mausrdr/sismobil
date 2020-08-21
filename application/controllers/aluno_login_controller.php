<?php

class Aluno_login_controller extends MY_controller {
    
    function __construct() {
        
        parent::__construct();
        
        $this->view_data['base_url'] = base_url();
        
        $this->load->model('aluno_login_model', 'login_model');
        $this->load->model('candidato_dao');
        
    }
    
    function index($cpf, $erro = FALSE) {
        
        if($this->login_model->isLogado() === TRUE) {
            
            redirect("aluno_inicio_controller/index");
            
        }
        
        $this->login($cpf, $erro);
        
    }
    
    function login($cpf, $erro) {
        
        $data['titulo'] = "Login";
        
        $this->view_data['url'] = "index.php/aluno_login_controller/index/$cpf";
        
        $this->view_data['cpf'] = array(
            'name'      =>      'cpf',
            'id'        =>      'cpf',
            'value'     =>      $cpf,
            'readonly'  =>      '0'
        );

        $this->view_data['codigo_acesso'] = array(
            'name'      =>      'codigo_acesso',
            'id'        =>      'codigo_acesso',
            'value'     =>      set_value('codigo_acesso')
        );
        
        $config = array(
            array(
                'field' =>  'codigo_acesso',
                'label' =>  'Código de Acesso',
                'rules' =>  'required|trim|xss_clean'
            )
        );
        
        $this->form_validation->set_rules($config);
        
        if($this->form_validation->run() == FALSE) {
            
            if($erro) {
                
                $this->view_data['msg_erro'] = "Login Incorreto! Por favor tente novamente.";
                
                $this->load->view('/headers/header_aluno_login_view', $data);
                $this->load->view('aluno_login_view', $this->view_data);
                $this->load->view('/footers/footer_view');
                
            } else {
                
                $this->load->view('/headers/header_aluno_login_view', $data);
                $this->load->view('aluno_login_view', $this->view_data);
                $this->load->view('/footers/footer_view');
                
            }
            
            
        } else {
            
            $codigo_acesso = $this->input->post('codigo_acesso');
            
            if($this->valida_login($cpf, $codigo_acesso)) {
                
                redirect("aluno_inicio_controller/index");
                
            } else {
                
                $erro = TRUE;
                redirect("aluno_login_controller/index/$erro");
                
            }
            
        }
        
    }
    
    function valida_login($cpf, $codigo_acesso) {
        
        if($this->login_model->logar($cpf, $codigo_acesso)) {
            
            return true;
            
        } else {
            
            return false;
            
        }
        
    }
    
}

?>
