<?php

class Assessoria_login_controller extends MY_controller {
    
    function __construct() {
        
        parent::__construct();
        
        $this->view_data['base_url'] = base_url();
        
        $this->load->model('assessoria_login_model', 'login_model');
        
    }
    
    function index($erro = FALSE) {
        
        if($this->login_model->isLogado() === TRUE) {
            
            redirect("assessoria_inicio_controller/index");
            
        }
        
        $this->login($erro);
        
    }
    
    public function login($erro) {
        
        $data['titulo'] = "Login";
        
        $config = array(
            array(
                'field'     =>      'username',
                'label'     =>      'Usuário',
                'rules'     =>      'trim|required|max_length[20]|xss_clean'
            ),
            array(
                'field'     =>      'senha',
                'label'     =>      'Senha',
                'rules'     =>      'trim|required|max_legth[16]|min_legth[6]|xss_clean'
            )
        );
        
        $this->form_validation->set_rules($config);
        
        if($this->form_validation->run() == FALSE) {
            
            if($erro) {
                
                $this->view_data['msg_erro'] = "Login Incorreto! Por favor tente novamente.";
                
                $this->load->view('/headers/header_view', $data);
                $this->load->view('assessoria_login_view', $this->view_data);
                $this->load->view('/footers/footer_view');
                
            } else {
                
                $this->load->view('/headers/header_view', $data);
                $this->load->view('assessoria_login_view', $this->view_data);
                $this->load->view('/footers/footer_view');
                
            }
            
        } else {
            
            $username = $this->input->post('username');
            $senha = $this->input->post('senha');
            
            if($this->validaLogin($username, $senha)) {
                
                redirect("assessoria_inicio_controller/");
                
            } else {
                
                $erro = TRUE;
                redirect("assessoria_login_controller/index/$erro");
                
            }
            
        }
        
    }

    public function validaLogin($username, $senha) {
        
        if($this->login_model->logar($username, $senha)) {
            
            return true;
            
        } else {
            
            return false;
            
        }
        
    }
    
}

?>
