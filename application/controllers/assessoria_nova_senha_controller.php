<?php

class Assessoria_nova_senha_controller extends MY_controller {
    
    function __construct() {
        
        parent::__construct();
        
        $this->view_data['base_url'] = base_url();
        
        $this->load->model('pessoas_to');
        $this->load->model('pessoas_dao');
        $this->load->model('token_pessoas_to');
        $this->load->model('token_pessoas_dao');
        
    }
    
    public function index() {
        
        $expiration = time() - 86400; // Limite de 24 horas
        $this->token_pessoas_dao->deleteToken($expiration);
        
        $token = new Token_pessoas_to();
        $token->setToken_time($expiration);
        $token->setCodigo($this->uri->segment(3));
        
        $valid = $this->token_pessoas_dao->tokenExiste($token);
        
        if($valid) {
            
            $id_pessoas = $this->token_pessoas_dao->getIdPessoas($token);
            $this->form($id_pessoas);
            
        } else {
            
            $data['titulo'] = "Falha!!!";

            $this->view_data['mensagem_h3'] = "O tempo de restauração de sua senha expirou! Para solicitar novamente a restauração de sua senha " . anchor('http://localhost/sismobil/index.php/assessoria_restaura_senha_controller/', 'clique aqui') . ".<br/>" . anchor('http://localhost/sismobil/index.php/main_controller', 'Clique aqui,') . " para retornar a página principal.";

            $this->load->view('/headers/header_restaura_view', $data);
            $this->load->view('assessoria_falha_view', $this->view_data);
            $this->load->view('/footers/footer_view');
            
        }
        
        
    }
    
    public function form($id_pessoas) {
        
        $data['titulo'] = "SISMOBIL - Restaurar Senha";
        
        $this->view_data['url'] = "index.php/assessoria_nova_senha_controller/form";
        $this->view_data['senha'] = array(
            'name'      =>  'senha',
            'id'        =>  'senha',
            'placeholder'   =>  'Ex.: &x3MpL0$',
            'title'     =>  'A senha deverá conter no mínimo uma letra minúscula, uma maiúscula, um número, um caractere especial e com o comprimento mínimo de oito caracteres.',
            'value'     =>  set_value('senha'),
            'pattern'   =>  '(?=^.{8,}$)((?=.*\d)(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$'
        );
        $this->view_data['confirma_senha'] = array(
            'name'      =>  'confirma_senha',
            'id'        =>  'confirma_senha',
            'placeholder'   =>  'Ex.: &x3MpL0$',
            'title'     =>  'A senha deverá conter no mínimo uma letra minúscula, uma maiúscula, um número, um caractere especial e com o comprimento mínimo de oito caracteres.',
            'value'     =>  set_value('senha'),
            'pattern'   =>  '(?=^.{8,}$)((?=.*\d)(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$'
        );
        
        $config = array(
            array(
                'field' =>  'senha',
                'label' =>  'Senha',
                'rules' =>  'trim|required|xss_clean'
            ),
            array(
                'field' =>  'confirma_senha',
                'label' =>  'Confirmação de Senha',
                'rules' =>  'trim|required|matches[senha]|xss_clean'
            )
        );
        
        $this->form_validation->set_rules($config);
        
        if($this->form_validation->run() == FALSE) {
            
            $this->load->view('/headers/header_restaura_view', $data);
            $this->load->view('assessoria_nova_senha_view', $this->view_data);
            $this->load->view('/footers/footer_view');
            
        } else {
            
            $senha = $this->input->post('senha');
            
            if($this->pessoas_dao->trocaSenha($id_pessoas, $senha)) {
                
                $data['titulo'] = "Sucesso!!!";

                $this->view_data['mensagem_h3'] = "Sua senha foi trocada com sucesso!!";
                $this->view_data['mensagem_h4'] = "<a href=\"". base_url() . "index.php/main_controller\">Clique aqui</a> para retornar a página principal.";

                $this->load->view('/headers/header_restaura_view', $data);
                $this->load->view('assessoria_sucesso_view', $this->view_data);
                $this->load->view('/footers/footer_view');
                
            } else {
                
                $data['titulo'] = "Falha!!!";

                $this->view_data['mensagem_h3'] = "A troca de senha falhou! Para tentar novamente a restauração de sua senha acesse seu email e repita a operação.<br/> Ou" . anchor('http://localhost/sismobil/index.php/main_controller', 'clique aqui,') . " para retornar a página principal.";

                $this->load->view('/headers/header_restaura_view', $data);
                $this->load->view('assessoria_falha_view', $this->view_data);
                $this->load->view('/footers/footer_view');
                
            }
            
        }
        
    }
    
}

?>
