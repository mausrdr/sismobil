<?php

class Assessoria_cadastra_universidade_controller extends MY_controller {
    
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
        
        $data['titulo'] = "Cadastrar Universidade";
        
        $this->view_data['atributos'] = array(
            
            'name'      =>  'myform',
            'id'        =>  'myform'
            
        );
        
        $this->view_data['url'] = "index.php/assessoria_cadastra_universidade_controller/index";
        
        $this->view_data['legend'] = "Cadastrar Universidade";
        
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
        
        $config = array(
            
            array(
                
                'field'     =>      'descricao_universidade',
                'label'     =>      'Nome da Universidade',
                'rules'     =>      'trim|required|max_length[150]|xss_clean|callback_validaUniversidade'
                
            )
            
        );
        
        $this->form_validation->set_rules($config);
        
        if($this->form_validation->run() == FALSE) {
            
            $this->load->view('/headers/header_logged_view', $data);
            $this->load->view('assessoria_cadastro_view', $this->view_data);
            $this->load->view('/footers/footer_view');
            
        } else {
            
            $data['titulo'] = "Confirmar Dados do Cadastro da Universidade";
            
            $this->view_data['h1'] = "Confirmação dos dados";
            
            $this->view_data['paragrafo'] = "Por favor confira se os dados estão corretos";
            
            $this->view_data['url'] = "index.php/assessoria_cadastra_universidade_controller/registrar";
            
            $universidade = new Universidade_to();
            $universidade->setDescricao_universidade($this->input->post('descricao_universidade'));
            
            $this->view_data['dados'] = array(
                
                'descricao_universidade'    =>  $universidade->getDescricao_universidade()
                
            );
            
            $this->view_data['label'] = array(
                
                0   =>  'Nome da Universidade'
                
            );
            
            $this->load->view('/headers/header_confirm_view', $data);
            $this->load->view('assessoria_confirm_view', $this->view_data);
            $this->load->view('/footers/footer_view');
            
        }
        
    }
    
    public function registrar() {
        
        $universidade = new Universidade_to();
        $universidade->setDescricao_universidade($this->input->post('descricao_universidade'));
        
        $descricao_universidade = $universidade->getDescricao_universidade();
        
        $resultado = $this->universidade_dao->insereUniversidade($universidade);
        
        if($resultado) {
            
            $data['titulo'] = "Sucesso!!!";
            
            $this->view_data['mensagem_h3'] = "O cadastro da ". $descricao_universidade . " foi realizado com sucesso!!";
            $this->view_data['mensagem_h4'] = "Para cadastrar outra Universidade, <a href=\"". base_url() . "index.php/assessoria_cadastra_universidade_controller/index\">clique aqui.</a>";
            
            $this->load->view('/headers/header_logged_view', $data);
            $this->load->view('assessoria_sucesso_view', $this->view_data);
            $this->load->view('/footers/footer_view');
            
        } else {
            
            $data['titulo'] = "Falha!!!";
            
            $this->view_data['mensagem_h3'] = "O cadastro da " .$descricao_universidade. " falhou!! Verifique se os dados foram informados de forma correta e <a href=\"" . base_url() . "index.php/assessoria_cadastra_universidade_controller/index\">tente novamente.</a>";
            
            $this->load->view('/headers/header_logged_view', $data);
            $this->load->view('assessoria_falha_view', $this->view_data);
            $this->load->view('/footers/footer_view');
            
        }
        
    }
    
    public function validaUniversidade($descricao_universidade) {
        
        $this->form_validation->set_message('validaUniversidade', 'A %s já existe! Por favor informe outro nome de Universidade.');
        
        if($this->universidade_dao->universidadeExiste($descricao_universidade)) {
            
            return FALSE;
            
        }
        
        return TRUE;
        
    }
    
}

?>
