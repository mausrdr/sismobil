<?php

class Assessoria_cadastra_matriz_curso_controller extends MY_controller {
    
    function __construct() {
        
        parent::__construct();
        
        $this->view_data['base_url'] = base_url();
        
        $this->load->model('assessoria_login_model', 'login_model');
        $this->load->model('edital_has_curso_to');
        $this->load->model('edital_has_curso_dao');
        $this->load->model('edital_dao');
        $this->load->model('universidade_dao');
        $this->load->model('campus_universidade_dao');
        $this->load->model('vagas_campus_dao');
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
        
        $data['titulo'] = "Cadastrar Matriz de Cursos Ofertados";
        
        $this->view_data['atributos'] = array(
            
            'name'      =>  'myform',
            'id'        =>  'myform'
            
        );
        
        $this->view_data['url'] = "index.php/assessoria_cadastra_matriz_curso_controller";
        
        $this->view_data['legend'] = "Cadastrar Matriz de Cursos Ofertados";
        
        /* Carrega array para menu drop down do edital */
        $campo_edital = $this->edital_dao->getEditalMatriz(date('Y-m-d'));
        
        $options_edital = array('0' => 'Selecione um Edital');
        
        foreach($campo_edital as $edital) {
            
            $options_edital[$edital['id']] = $edital['numero'];
            
        }
        
        $this->view_data['options_edital'] = $options_edital;
        
        /* Starta array para menu drop down da universidade */
        $options_universidade = array('0' => '– Escolha um Edital –');
        
        $this->view_data['options_universidade'] = $options_universidade;
        
        /* Starta array para menu drop down do campus */
        $options_campus = array('0' => '– Escolha uma Universidade –');
        
        $this->view_data['options_campus'] = $options_campus;
        
        $this->view_data['input'] = array(
            
                'name'      =>      'descricao_curso',
                'id'        =>      'descricao_curso',
                'value'     =>      set_value('descricao_curso')
            
        );
        
        $config = array(
            array(
                'field'     =>      'edital_id_edital',
                'label'     =>      'Número do edital',
                'rules'     =>      'trim|required|xss_clean|callback_validaEdital'
            ),
            array(
                'field'     =>      'universidade_id_universidade',
                'label'     =>      'Universidade',
                'rules'     =>      'trim|required|xss_clean|callback_validaUniversidade'
            ),
            array(
                'field'     =>      'campus_id_campus',
                'label'     =>      'Câmpus',
                'rules'     =>      'trim|required|xss_clean|callback_validaCampus'
            ),
            array(
                'field'     =>      'descricao_curso',
                'label'     =>      'Curso',
                'rules'     =>      'trim|required|xss_clean'
            )
        );
        
        $this->form_validation->set_rules($config);
        
        if($this->form_validation->run() == FALSE) {
            
            $this->load->view('/headers/header_matriz_view', $data);
            $this->load->view('assessoria_cadastro_matriz_curso_view', $this->view_data);
            $this->load->view('/footers/footer_view');
            
        } else {
            
            $edital_has_curso = new Edital_has_curso_to();
            $edital_has_curso->setEdital_id_edital($this->input->post('edital_id_edital'));
            $edital_has_curso->setUniversidade_id_universidade($this->input->post('universidade_id_universidade'));
            $edital_has_curso->setCampus_universidade_id_campus_universidade($this->input->post('campus_id_campus'));
            $edital_has_curso->setCurso_universidade_id_curso_universidade($this->input->post('id_curso'));
            
            if($this->edital_has_curso_dao->editalHasCursoExiste($edital_has_curso)) {
                
                $this->view_data['msg_erro'] = "Esta Matriz de Cursos Ofertados já existe! Por favor, cadastre outra Matriz de Cursos Ofertados.";
                
                $this->load->view('/headers/header_matriz_view', $data);
                $this->load->view('assessoria_cadastro_matriz_curso_view', $this->view_data);
                $this->load->view('/footers/footer_view');
                
            } else {
                
                $data['titulo'] = "Confirmar Dados do Cadastro da Matriz de Cursos Ofertados";

                $this->view_data['h1'] = "Confirmação dos dados";
                $this->view_data['paragrafo'] = "Por favor confira se os dados estão corretos";
                $this->view_data['url'] = "index.php/assessoria_cadastra_matriz_curso_controller/registrar";

                $numero_edital = $this->edital_dao->getNumeroEdital($edital_has_curso->getEdital_id_edital());
                $descricao_universidade = $this->universidade_dao->getDescricaoUniversidade($edital_has_curso->getUniversidade_id_universidade());
                $descricao_campus = $this->campus_universidade_dao->getDescricaoCampus($edital_has_curso->getCampus_universidade_id_campus_universidade());
                $descricao_curso = $this->input->post('descricao_curso');

                $this->view_data['label'] = array(

                    0   =>  'Número do Edital',
                    1   =>  'Universidade',
                    2   =>  'Campus',
                    3   =>  'Curso'

                );

                $this->view_data['descricao'] = array(

                    0   =>  $numero_edital,
                    1   =>  $descricao_universidade,
                    2   =>  $descricao_campus,
                    3   =>  $descricao_curso

                );

                $this->view_data['dados'] = array(

                    'edital_id_edital'                  =>    $edital_has_curso->getEdital_id_edital(),
                    'universidade_id_universidade'      =>    $edital_has_curso->getUniversidade_id_universidade(),
                    'campus_universidade_id_campus_universidade'    =>    $edital_has_curso->getCampus_universidade_id_campus_universidade(),
                    'curso_universidade_id_curso_universidade'     =>    $edital_has_curso->getCurso_universidade_id_curso_universidade(),

                );

                $this->load->view('/headers/header_confirm_view', $data);
                $this->load->view('assessoria_confirm_matriz_view', $this->view_data);
                $this->load->view('/footers/footer_view');
                
            }
            
        }
        
    }
    
    public function registrar() {
        
        $edital_has_curso = new Edital_has_curso_to();
        $edital_has_curso->setEdital_id_edital($this->input->post('edital_id_edital'));
        $edital_has_curso->setUniversidade_id_universidade($this->input->post('universidade_id_universidade'));
        $edital_has_curso->setCampus_universidade_id_campus_universidade($this->input->post('campus_universidade_id_campus_universidade'));
        $edital_has_curso->setCurso_universidade_id_curso_universidade($this->input->post('curso_universidade_id_curso_universidade'));
        
        $resultado = $this->edital_has_curso_dao->insertEditalHasCurso($edital_has_curso);
        
        if($resultado) {
            
            $data['titulo'] = "Sucesso!!!";
            
            $this->view_data['mensagem_h3'] = "O cadastro foi realizado com sucesso!!";
            $this->view_data['mensagem_h4'] = "Para realizar outro  cadastro, <a href=\"". base_url() . "index.php/assessoria_cadastra_matriz_curso_controller\">clique aqui.</a>";
            
            $this->load->view('/headers/header_logged_view', $data);
            $this->load->view('assessoria_sucesso_view', $this->view_data);
            $this->load->view('/footers/footer_view');
            
        } else {
            
            $data['titulo'] = "Falha!!!";
            
            $this->view_data['mensagem_h3'] = "O cadastro falhou!! Verifique se os dados foram informados de forma correta e <a href=\"" . base_url() . "index.php/assessoria_cadastra_matriz_curso_controller/index\">tente novamente.</a>";
            
            $this->load->view('/headers/header_logged_view', $data);
            $this->load->view('assessoria_falha_view', $this->view_data);
            $this->load->view('/footers/footer_view');
            
        }
        
    }
    
    public function validaEdital($edital) {
        
        $this->form_validation->set_message('validaEdital', 'O campo %s é obrigatório');
        
        if($edital == 0) {
            
            return FALSE;
            
        }
        
        return TRUE;
        
    }
    
    public function validaUniversidade($universidade) {
        
        $this->form_validation->set_message('validaUniversidade', 'O campo %s é obrigatório');
        
        if($universidade == 0) {
            
            return FALSE;
            
        }
        
        return TRUE;
        
    }
    
    public function validaCampus($campus) {
        
        $this->form_validation->set_message('validaCampus', 'O campo %s é obrigatório');
        
        if($campus == 0) {
            
            return FALSE;
            
        }
        
        return TRUE;
        
    }
            
}

?>
