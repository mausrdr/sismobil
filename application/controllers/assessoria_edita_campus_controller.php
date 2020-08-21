<?php

class Assessoria_edita_campus_controller extends MY_controller {
    
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
        
        $data['titulo'] = "Editar Câmpus";
        
        $this->view_data['atributos'] = array(
            
            'name'      =>  'myform',
            'id'        =>  'myform'
            
        );
        
        $this->view_data['hidden'] = array(
            'id_campus'   =>  ''
        );
        
        $this->view_data['pesquisar'] = TRUE;
        
        $this->view_data['url'] = "index.php/assessoria_edita_campus_controller";
        
        $this->view_data['legend'] = "Editar Câmpus";
        
        $this->view_data['label'] = array(
          
            0   =>  'Nome do Câmpus'
            
        );
        
        $this->view_data['input'] = array(
            
            array(
                
                'name'          =>      'descricao_campus',
                'id'            =>      'descricao_campus',
                'value'         =>      set_value('descricao_campus'),
                
            )
            
        );
        
        $this->view_data['opcao'] = 0;
        
        $this->view_data['content'] = "Buscar Câmpus";
        
        $config = array(
            
            array(
                
                'field'     =>      'descricao_campus',
                'label'     =>      'Nome do Câmpus',
                'rules'     =>      'trim|required|max_length[150]|xss_clean|callback_validaCampus'
                
            )
            
        );
        
        $this->form_validation->set_rules($config);
        
        if($this->form_validation->run() == FALSE) {
            
            $this->load->view('/headers/header_matriz_view', $data);
            $this->load->view('assessoria_edita_view', $this->view_data);
            $this->load->view('/footers/footer_view');
            
        } else {
            
            $data['titulo'] = "Confirmar Dados da Edição do Câmpus";
            
            $this->view_data['h1'] = "Confirmar edição do Câmpus";
            
            $this->view_data['paragrafo'] = "Por favor confira se os dados estão corretos";
            
            $this->view_data['url'] = "index.php/assessoria_edita_campus_controller/registrar";
            
            $campus = new Campus_universidade_to();
            $campus->setId_campus_universidade($this->input->post('id_campus'));
            $campus->setDescricao_campus($this->input->post('descricao_campus'));
            
            $this->view_data['dados'] = array(
                
                'id_campus'    =>  $campus->getId_campus_universidade(),
                'descricao_campus'          =>  $campus->getDescricao_campus()
                
            );
            
            $this->view_data['label'] = array(
                
                0   =>  'Nome do Câmpus'
                
            );
            
            $this->view_data['editar'] = 1;
            
            $this->load->view('/headers/header_confirm_view', $data);
            $this->load->view('assessoria_confirm_view', $this->view_data);
            $this->load->view('/footers/footer_view');
            
        }
        
    }
    
    public function registrar() {
        
        $campus = new Campus_universidade_to();
        $campus->setId_campus_universidade($this->input->post('id_campus'));
        $campus->setDescricao_campus($this->input->post('descricao_campus'));
        
        $descricao_campus = $campus->getDescricao_campus();
        
        $resultado = $this->campus_universidade_dao->updateCampusUniversidade($campus);
        
        if($resultado) {
            
            $data['titulo'] = "Sucesso!!!";
            
            $this->view_data['mensagem_h3'] = "A edição do ". $descricao_campus . " foi realizada com sucesso!!";
            $this->view_data['mensagem_h4'] = "Para editar outro Câmpus, <a href=\"". base_url() . "index.php/assessoria_edita_campus_controller\">clique aqui.</a>";
            
            $this->load->view('/headers/header_logged_view', $data);
            $this->load->view('assessoria_sucesso_view', $this->view_data);
            $this->load->view('/footers/footer_view');
            
        } else {
            
            $data['titulo'] = "Falha!!!";
            
            $this->view_data['mensagem_h3'] = "A edição do " .$descricao_campus. " falhou!! Verifique se os dados foram informados de forma correta e <a href=\"" . base_url() . "index.php/assessoria_edita_campus_controller\">tente novamente.</a>";
            
            $this->load->view('/headers/header_logged_view', $data);
            $this->load->view('assessoria_falha_view', $this->view_data);
            $this->load->view('/footers/footer_view');
            
        }
        
    }
    
    public function validaCampus($descricao_campus) {
        
        $this->form_validation->set_message('validaCampus', 'O '. $descricao_campus .' não existe! Por favor informe um %s que seja cadastrada.');
        
        if($this->campus_universidade_dao->campusExiste($descricao_campus)) {
            
            return TRUE;
            
        }
        
        return FALSE;
        
    }
    
}

?>
