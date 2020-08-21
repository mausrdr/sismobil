<?php

class Assessoria_edita_universidade_controller extends MY_controller {
    
    function __construct() {
        
        parent::__construct();
    
        $this->view_data['base_url'] = base_url();
        
        $this->load->model('assessoria_login_model', 'login_model');
        $this->load->model('universidade_to');
        $this->load->model('universidade_dao');
        
    }
    
    function index() {
        
        if($this->login_model->isLogado() === TRUE) {
            
            $this->form();
            
        } else {
            
            redirect('main_controller');
            
        }
        
    }
    
    public function form() {
        
        $data['titulo'] = "Editar Universidade";
        
        $this->view_data['atributos'] = array(
            
            'name'      =>  'myform',
            'id'        =>  'myform'
            
        );
        
        $this->view_data['hidden'] = array(
            'id_universidade'   =>  ''
        );
        
        $this->view_data['pesquisar'] = TRUE;
        
        $this->view_data['url'] = "index.php/assessoria_edita_universidade_controller";
        
        $this->view_data['legend'] = "Editar Universidade";
        
        $this->view_data['label'] = array(
          
            0   =>  'Nome da Universidade'
            
        );
        
        $this->view_data['input'] = array(
            
            array(
                
                'name'          =>      'descricao_universidade',
                'id'            =>      'descricao_universidade',
                'value'         =>      set_value('descricao_universidade'),
                
            )
            
        );
        
        $this->view_data['opcao'] = 2;
        
        $this->view_data['content'] = "Buscar Universidade";
        
        $config = array(
            
            array(
                
                'field'     =>      'descricao_universidade',
                'label'     =>      'Nome da Universidade',
                'rules'     =>      'trim|required|max_length[150]|xss_clean|callback_validaUniversidade'
                
            )
            
        );
        
        $this->form_validation->set_rules($config);
        
        if($this->form_validation->run() == FALSE) {
            
            $this->load->view('/headers/header_matriz_view', $data);
            $this->load->view('assessoria_edita_view', $this->view_data);
            $this->load->view('/footers/footer_view');
            
        } else {
            
            $data['titulo'] = "Confirmar Dados da Edição da Universidade";
            
            $this->view_data['h1'] = "Confirmar edição da Universidade";
            
            $this->view_data['paragrafo'] = "Por favor confira se os dados estão corretos";
            
            $this->view_data['url'] = "index.php/assessoria_edita_universidade_controller/registrar";
            
            $universidade = new Universidade_to();
            $universidade->setId_universidade($this->input->post('id_universidade'));
            $universidade->setDescricao_universidade($this->input->post('descricao_universidade'));
            
            $this->view_data['dados'] = array(
                
                'id_universidade'           =>  $universidade->getId_universidade(),
                'descricao_universidade'    =>  $universidade->getDescricao_universidade()
                
            );
            
            $this->view_data['label'] = array(
                
                0   =>  'Nome da Universidade'
                
            );
            
            $this->view_data['editar'] = 1;
            
            $this->load->view('/headers/header_confirm_view', $data);
            $this->load->view('assessoria_confirm_view', $this->view_data);
            $this->load->view('/footers/footer_view');
            
        }
        
    }
    
    public function registrar() {
        
        $universidade = new Universidade_to();
        $universidade->setId_universidade($this->input->post('id_universidade'));
        $universidade->setDescricao_universidade($this->input->post('descricao_universidade'));
        
        $descricao_universidade = $universidade->getDescricao_universidade();
        
        $resultado = $this->universidade_dao->updateUniversidade($universidade);
        
        if($resultado) {
            
            $data['titulo'] = "Sucesso!!!";
            
            $this->view_data['mensagem_h3'] = "A edição da ". $descricao_universidade . " foi realizada com sucesso!!";
            $this->view_data['mensagem_h4'] = "Para editar outra Universidade, <a href=\"". base_url() . "index.php/assessoria_edita_universidade_controller\">clique aqui.</a>";
            
            $this->load->view('/headers/header_logged_view', $data);
            $this->load->view('assessoria_sucesso_view', $this->view_data);
            $this->load->view('/footers/footer_view');
            
        } else {
            
            $data['titulo'] = "Falha!!!";
            
            $this->view_data['mensagem_h3'] = "A edição da " .$descricao_universidade. " falhou!! Verifique se os dados foram informados de forma correta e <a href=\"" . base_url() . "index.php/assessoria_edita_universidade_controller\">tente novamente.</a>";
            
            $this->load->view('/headers/header_logged_view', $data);
            $this->load->view('assessoria_falha_view', $this->view_data);
            $this->load->view('/footers/footer_view');
            
        }
        
    }
    
    public function validaUniversidade($descricao_universidade) {
        
        $this->form_validation->set_message('validaUniversidade', 'A '. $descricao_universidade .' não existe! Por favor informe um %s que seja cadastrada.');
        
        if($this->universidade_dao->universidadeExiste($descricao_universidade)) {
            
            return TRUE;
            
        }
        
        return FALSE;
        
    }
    
}

?>
