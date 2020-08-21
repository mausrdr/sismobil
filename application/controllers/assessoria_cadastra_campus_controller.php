<?php

class Assessoria_cadastra_campus_controller extends MY_controller {
    
    function __construct() {
        
        parent::__construct();
        
        $this->view_data['base_url'] = base_url();
        
        $this->load->model('assessoria_login_model', 'login_model');
        $this->load->model('campus_universidade_to');
        $this->load->model('campus_universidade_dao');
        
    }
    
    function index() {
        
        if($this->login_model->isLogado() === TRUE) {
            
            $this->form();
            
        } else {
            
            redirect('main_controller');
            
        }
        
    }
    
    public function form() {
        
        $data['titulo'] = "Cadastrar Campus";
        
        $this->view_data['atributos'] = array(
            
            'name'      =>  'myform',
            'id'        =>  'myform'
            
        );
        
        $this->view_data['url'] = "index.php/assessoria_cadastra_campus_controller/index";
        
        $this->view_data['legend'] = "Cadastrar Campus";
        
        $this->view_data['label'] = array(
          
            0   =>  'Nome do Campus'
            
        );
        
        $this->view_data['input'] = array(
            
            array(
                
                'name'          =>      'descricao_campus',
                'id'            =>      'descricao_campus',
                'value'         =>      set_value('descricao_campus'),
                
            )
            
        );
        
        $config = array(
            
            array(
                
                'field'     =>      'descricao_campus',
                'label'     =>      'Nome do Campus',
                'rules'     =>      'trim|required|max_length[150]|xss_clean|callback_validaCampus'
                
            )
            
        );
        
        $this->form_validation->set_rules($config);
        
        if($this->form_validation->run() == FALSE) {
            
            $this->load->view('/headers/header_logged_view', $data);
            $this->load->view('assessoria_cadastro_view', $this->view_data);
            $this->load->view('/footers/footer_view');
            
        } else {
            
            $data['titulo'] = "Confirmar Dados do Cadastro do Campus";
            
            $this->view_data['h1'] = "Confirmação dos dados";
            
            $this->view_data['paragrafo'] = "Por favor confira se os dados estão corretos";
            
            $this->view_data['url'] = "index.php/assessoria_cadastra_campus_controller/registrar";
            
            $campus = new Campus_universidade_to();
            $campus->setDescricao_campus($this->input->post('descricao_campus'));
            
            $this->view_data['dados'] = array(
                
                'descricao_campus'    =>  $campus->getDescricao_campus()
                
            );
            
            $this->view_data['label'] = array(
                
                0   =>  'Nome do Campus'
                
            );
            
            $this->load->view('/headers/header_confirm_view', $data);
            $this->load->view('assessoria_confirm_view', $this->view_data);
            $this->load->view('/footers/footer_view');
            
        }
        
    }
    
    public function registrar() {
        
        $campus = new Campus_universidade_to();
        $campus->setDescricao_campus($this->input->post('descricao_campus'));
        
        $descricao_campus = $campus->getDescricao_campus();
        
        $resultado = $this->campus_universidade_dao->insereCampus_universidade($campus);
        
        if($resultado) {
            
            $data['titulo'] = "Sucesso!!!";
            
            $this->view_data['mensagem_h3'] = "O cadastro do ". $descricao_campus . " foi realizado com sucesso!!";
            $this->view_data['mensagem_h4'] = "Para cadastrar outro Campus, <a href=\"". base_url() . "index.php/assessoria_cadastra_campus_controller/index\">clique aqui.</a>";
            
            $this->load->view('/headers/header_logged_view', $data);
            $this->load->view('assessoria_sucesso_view', $this->view_data);
            $this->load->view('/footers/footer_view');
            
        } else {
            
            $data['titulo'] = "Falha!!!";
            
            $this->view_data['mensagem_h3'] = "O cadastro do " .$descricao_campus. " falhou!! Verifique se os dados foram informados de forma correta e <a href=\"" . base_url() . "index.php/assessoria_cadastra_campus_controller/index\">tente novamente.</a>";
            
            $this->load->view('/headers/header_logged_view', $data);
            $this->load->view('assessoria_falha_view', $this->view_data);
            $this->load->view('/footers/footer_view');
            
        }
        
    }
    
    public function validaCampus($descricao_campus) {
        
        $this->form_validation->set_message('validaCampus', 'O %s já existe! Por favor informe outro nome de Campus.');
        
        if($this->campus_universidade_dao->campusExiste($descricao_campus)) {
            
            return FALSE;
            
        }
        
        return TRUE;
        
    }
    
}

?>
