<?php

class Assessoria_edita_curso_controller extends MY_controller {
    
    function __construct() {
        
        parent::__construct();
    
        $this->view_data['base_url'] = base_url();
        
        $this->load->model('assessoria_login_model', 'login_model');
        $this->load->model('curso_universidade_to');
        $this->load->model('curso_universidade_dao');
        
    }
    
    function index() {
        
        if($this->login_model->isLogado() === TRUE) {
            
            $this->form();
            
        } else {
            
            redirect('main_controller');
            
        }
        
    }
    
    public function form() {
        
        $data['titulo'] = "Editar Curso";
        
        $this->view_data['atributos'] = array(
            
            'name'      =>  'myform',
            'id'        =>  'myform'
            
        );
        
        $this->view_data['hidden'] = array(
            'id_curso'   =>  ''
        );
        
        $this->view_data['pesquisar'] = TRUE;
        
        $this->view_data['url'] = "index.php/assessoria_edita_curso_controller";
        
        $this->view_data['legend'] = "Editar Curso";
        
        $this->view_data['label'] = array(
          
            0   =>  'Nome do Curso'
            
        );
        
        $this->view_data['input'] = array(
            
            array(
                
                'name'          =>      'descricao_curso',
                'id'            =>      'descricao_curso',
                'value'         =>      set_value('descricao_curso'),
                
            )
            
        );
        
        $this->view_data['opcao'] = 1;
        
        $this->view_data['content'] = "Buscar Curso";
        
        $config = array(
            
            array(
                
                'field'     =>      'descricao_curso',
                'label'     =>      'Nome do Curso',
                'rules'     =>      'trim|required|max_length[150]|xss_clean|callback_validaCurso'
                
            )
            
        );
        
        $this->form_validation->set_rules($config);
        
        if($this->form_validation->run() == FALSE) {
            
            $this->load->view('/headers/header_matriz_view', $data);
            $this->load->view('assessoria_edita_view', $this->view_data);
            $this->load->view('/footers/footer_view');
            
        } else {
            
            $data['titulo'] = "Confirmar Dados da Edição do Curso";
            
            $this->view_data['h1'] = "Confirmar edição do Curso";
            
            $this->view_data['paragrafo'] = "Por favor confira se os dados estão corretos";
            
            $this->view_data['url'] = "index.php/assessoria_edita_curso_controller/registrar";
            
            $curso = new Curso_Universidade_to();
            $curso->setId_curso_universidade($this->input->post('id_curso'));
            $curso->setDescricao_curso($this->input->post('descricao_curso'));
            
            $this->view_data['dados'] = array(
                
                'id_curso'    =>  $curso->getId_curso_universidade(),
                'descricao_curso'          =>  $curso->getDescricao_curso()
                
            );
            
            $this->view_data['label'] = array(
                
                0   =>  'Nome do Curso'
                
            );
            
            $this->view_data['editar'] = 1;
            
            $this->load->view('/headers/header_confirm_view', $data);
            $this->load->view('assessoria_confirm_view', $this->view_data);
            $this->load->view('/footers/footer_view');
            
        }
        
    }
    
    public function registrar() {
        
        $curso = new Curso_Universidade_to();
        $curso->setId_curso_universidade($this->input->post('id_curso'));
        $curso->setDescricao_curso($this->input->post('descricao_curso'));
        
        $descricao_curso = $curso->getDescricao_curso();
        
        $resultado = $this->curso_universidade_dao->updateCursoUniversidade($curso);
        
        if($resultado) {
            
            $data['titulo'] = "Sucesso!!!";
            
            $this->view_data['mensagem_h3'] = "A edição do ". $descricao_curso . " foi realizada com sucesso!!";
            $this->view_data['mensagem_h4'] = "Para editar outro Curso, <a href=\"". base_url() . "index.php/assessoria_edita_curso_controller\">clique aqui.</a>";
            
            $this->load->view('/headers/header_logged_view', $data);
            $this->load->view('assessoria_sucesso_view', $this->view_data);
            $this->load->view('/footers/footer_view');
            
        } else {
            
            $data['titulo'] = "Falha!!!";
            
            $this->view_data['mensagem_h3'] = "A edição do " .$descricao_curso. " falhou!! Verifique se os dados foram informados de forma correta e <a href=\"" . base_url() . "index.php/assessoria_edita_curso_controller\">tente novamente.</a>";
            
            $this->load->view('/headers/header_logged_view', $data);
            $this->load->view('assessoria_falha_view', $this->view_data);
            $this->load->view('/footers/footer_view');
            
        }
        
    }
    
    public function validaCurso($descricao_curso) {
        
        $this->form_validation->set_message('validaCurso', 'O Curso '. $descricao_curso .' não existe! Por favor informe um %s que seja cadastrada.');
        
        if($this->curso_universidade_dao->cursoExiste($descricao_curso)) {
            
            return TRUE;
            
        }
        
        return FALSE;
        
    }
    
}

?>
