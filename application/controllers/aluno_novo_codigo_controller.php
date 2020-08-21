<?php

class Aluno_novo_codigo_controller extends MY_controller {
    
    function __construct() {
        
        parent::__construct();
        
        $this->view_data['base_url'] = base_url();
        
        $this->load->model('candidato_to');
        $this->load->model('candidato_dao');
        $this->load->model('token_candidato_to');
        $this->load->model('token_candidato_dao');
        
    }
    
    public function index() {
        
        $expiration = time() - 86400; // Limite de 24 horas
        $this->token_candidato_dao->deleteToken($expiration);
        
        $token = new Token_candidato_to();
        $token->setToken_time($expiration);
        $token->setCodigo($this->uri->segment(3));
        
        $valid = $this->token_candidato_dao->tokenExiste($token);
        
        if($valid) {
            
            $id_candidato = $this->token_candidato_dao->getIdCandidato($token);
            $this->form($id_candidato);
            
        } else {
            
            $data['titulo'] = "Falha!!!";

            $this->view_data['mensagem_h3'] = "O tempo de restauração de seu código de acesso expirou! Para solicitar novamente a restauração de seu código de acesso " . anchor('http://localhost/sismobil/index.php/assessoria_restaura_codigo_controller/', 'clique aqui') . ".<br/>" . anchor('http://localhost/sismobil/index.php/main_controller', 'Clique aqui,') . " para retornar a página principal.";

            $this->load->view('/headers/header_restaura_view', $data);
            $this->load->view('aluno_falha_view', $this->view_data);
            $this->load->view('/footers/footer_view');
            
        }
        
        
    }
    
    public function form($id_candidato) {
        
        $data['titulo'] = "SISMOBIL - Restaurar Código de Acesso";
        
        $this->view_data['url'] = "index.php/aluno_novo_codigo_controller/form/$id_candidato";
        $this->view_data['codigo_acesso'] = array(
            'name'      =>  'codigo_acesso',
            'id'        =>  'codigo_acesso',
            'placeholder'   =>  'Ex.: &x3MpL0$',
            'title'     =>  'O código de acesso deverá conter no mínimo uma letra minúscula, uma maiúscula, um número, um caractere especial e com o comprimento mínimo de oito caracteres.',
            'value'     =>  set_value('senha'),
            'pattern'   =>  '(?=^.{8,}$)((?=.*\d)(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$'
        );
        $this->view_data['confirma_codigo'] = array(
            'name'      =>  'confirma_codigo',
            'id'        =>  'confirma_codigo',
            'placeholder'   =>  'Ex.: &x3MpL0$',
            'title'     =>  'O código de acesso deverá conter no mínimo uma letra minúscula, uma maiúscula, um número, um caractere especial e com o comprimento mínimo de oito caracteres.',
            'value'     =>  set_value('senha'),
            'pattern'   =>  '(?=^.{8,}$)((?=.*\d)(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$'
        );
        
        $config = array(
            array(
                'field' =>  'codigo_acesso',
                'label' =>  'Código de Acesso',
                'rules' =>  'trim|required|xss_clean'
            ),
            array(
                'field' =>  'confirma_codigo',
                'label' =>  'Confirmação do Código de Acesso',
                'rules' =>  'trim|required|matches[codigo_acesso]|xss_clean'
            )
        );
        
        $this->form_validation->set_rules($config);
        
        if($this->form_validation->run() == FALSE) {
            
            $this->load->view('/headers/header_restaura_view', $data);
            $this->load->view('aluno_novo_codigo_view', $this->view_data);
            $this->load->view('/footers/footer_view');
            
        } else {
            
            $codigo_acesso = $this->input->post('codigo_acesso');
            
            if($this->candidato_dao->trocaCodigoAcesso($id_candidato, $codigo_acesso)) {
                
                $data['titulo'] = "Sucesso!!!";

                $this->view_data['mensagem_h3'] = "Seu código de acesso foi trocado com sucesso!!";
                $this->view_data['mensagem_h4'] = "<a href=\"". base_url() . "index.php/main_controller\">Clique aqui</a> para retornar a página principal.";

                $this->load->view('/headers/header_restaura_view', $data);
                $this->load->view('aluno_sucesso_view', $this->view_data);
                $this->load->view('/footers/footer_view');
                
            } else {
                
                $data['titulo'] = "Falha!!!";

                $this->view_data['mensagem_h3'] = "A troca do código de acesso falhou! Para tentar novamente a restauração de seu código de acesso acesse seu email e repita a operação.<br/> Ou" . anchor('http://localhost/sismobil/index.php/main_controller', 'clique aqui,') . " para retornar a página principal.";

                $this->load->view('/headers/header_restaura_view', $data);
                $this->load->view('aluno_falha_view', $this->view_data);
                $this->load->view('/footers/footer_view');
                
            }
            
        }
        
    }
    
}

?>
