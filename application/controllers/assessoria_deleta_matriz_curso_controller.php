<?php

class Assessoria_deleta_matriz_curso_controller extends MY_controller {
    
    function __construct() {
        
        parent::__construct();
        
        $this->view_data['base_url'] = base_url();
        
        $this->load->model('assessoria_login_model', 'login_model');
        $this->load->model('edital_has_curso_to');
        $this->load->model('edital_has_curso_dao');
        $this->load->model('edital_dao');
        $this->load->model('universidade_dao');
        $this->load->model('campus_universidade_dao');
        $this->load->model('curso_universidade_dao');
        
    }
    
    public function index() {
        
        if($this->login_model->isLogado() === TRUE) {
            
            $this->selecionar();
            
        } else {
            
            redirect('main_controller');
            
        }
        
    }
    
    public function selecionar() {
        
        $data['titulo'] = "Selecionar Edital";
        
        $this->view_data['paragrafo'] = "Por favor selecione o Número do Edital da matriz a ser removida";
        $this->view_data['atributos'] = array(
            
            'name'      =>  'myform',
            'id'        =>  'myform'
            
        );
        $this->view_data['url'] = "index.php/assessoria_deleta_matriz_curso_controller";
        $this->view_data['legend'] = "Selecione um Edital";
        $this->view_data['tabela'] = 0;
        
        /* Carrega array para menu drop down do edital */
        $campo_edital = $this->edital_dao->getEditalMatriz(date('Y-m-d'));
        
        $options_edital = array('0' => 'Selecione um Edital');
        
        foreach($campo_edital as $edital) {
            
            $options_edital[$edital['id']] = $edital['numero'];
            
        }
        
        $this->view_data['options_edital'] = $options_edital;
        
        $config = array(
            array(
                'field'     =>      'edital_id_edital',
                'label'     =>      'Número do edital',
                'rules'     =>      'trim|required|xss_clean|callback_validaEdital'
            )
        );
        
        $this->form_validation->set_rules($config);
        
        if($this->form_validation->run() == FALSE) {
            
            $this->load->view('/headers/header_matriz_view', $data);
            $this->load->view('assessoria_escolhe_matriz_view', $this->view_data);
            $this->load->view('/footers/footer_view');
            
        } else {
            
            $this->view_data['paragrafo'] = "Por favor selecione um item da Matriz de Cursos Oferecidos a ser removido";
            $this->view_data['legend'] = "Selecione um item";
            $this->view_data['tabela'] = 0;
            $this->view_data['url'] = "index.php/assessoria_deleta_matriz_curso_controller/index";
            $this->view_data['url_receber'] = "index.php/assessoria_deleta_matriz_curso_controller/confirma";
            
            $id_edital = $this->input->post('edital_id_edital');
            
            $lista = $this->edital_has_curso_dao->listMatrizCurso($id_edital);
            
            if(empty($lista)) {
                
                $this->view_data['msg_erro'] = "Não é possivel remover nenhum item da matriz de cursos oferecidos referente a este edital.<br/>Se não foi cadastrado nenhum item nesta matriz <a href=\"". base_url() . "index.php/assessoria_cadastra_matriz_curso_controller\">clique aqui.</a>";
                
            }
            
            $this->view_data['lista'] = $lista;
            
            $this->load->view('/headers/header_matriz_view', $data);
            $this->load->view('assessoria_escolhe_matriz_view', $this->view_data);
            $this->load->view('/footers/footer_view');
            
        }
        
    }
    
    public function confirma() {
        
        $edital_has_curso = new Edital_has_curso_to();
        $edital_has_curso->setId_edital_has_curso($this->input->get('id'));
        $edital_has_curso = $this->edital_has_curso_dao->getEditalHasCurso($edital_has_curso->getId_edital_has_curso());
        
        $data['titulo'] = "Confirmar Dados da Remoção da Matriz de Cursos Oferecidos";

        $this->view_data['h1'] = "Confirmação dos dados da remoção da Matriz de Cursos Oferecidos";
        $this->view_data['paragrafo'] = "Por favor confira se os dados estão corretos. Se você realmente deseja deletar esses dados da Matriz de Cursos Oferecidos, clique em AVANÇAR. Caso contrário, clique em VOLTAR.";
        $this->view_data['url'] = "index.php/assessoria_edita_matriz_curso_controller/remover";

        $numero_edital = $this->edital_dao->getNumeroEdital($edital_has_curso->getEdital_id_edital());
        $descricao_universidade = $this->universidade_dao->getDescricaoUniversidade($edital_has_curso->getUniversidade_id_universidade());
        $descricao_campus = $this->campus_universidade_dao->getDescricaoCampus($edital_has_curso->getCampus_universidade_id_campus_universidade());
        $descricao_curso = $this->curso_universidade_dao->getDescricaoCurso($edital_has_curso->getCurso_universidade_id_curso_universidade());
        
        $this->view_data['desc'] = $numero_edital . ", que vincula a " . $descricao_universidade . " ao " . $descricao_campus . ", e com o Curso de " . $descricao_curso;

        $this->view_data['label'] = array(

            0   =>  'Número do Edital',
            1   =>  'Universidade',
            2   =>  'Câmpus',
            3   =>  'Curso'

        );

        $this->view_data['descricao'] = array(

            0   =>  $numero_edital,
            1   =>  $descricao_universidade,
            2   =>  $descricao_campus,
            3   =>  $descricao_curso

        );

        $this->view_data['dados'] = array(

            'id_edital_has_curso'       =>    $edital_has_curso->getId_edital_has_curso(),
            'numero_edital'             =>    $numero_edital,
            'descricao_universidade'    =>    $descricao_universidade,
            'descricao_campus'          =>    $descricao_campus,
            'descricao_curso'           =>    $descricao_curso,

        );
        
        $this->view_data['deletar'] = 2;

        $this->load->view('/headers/header_confirm_view', $data);
        $this->load->view('assessoria_confirm_matriz_view', $this->view_data);
        $this->load->view('/footers/footer_view');
        
    }
    
    public function remover() {
        
        $edital_has_curso = new Edital_has_curso_to();
        $edital_has_curso->setId_edital_has_curso($this->input->post('id_edital_has_curso'));
        
        $numero_edital = $this->input->post('numero_edital');
        $descricao_universidade = $this->input->post('descricao_universidade');
        $descricao_campus = $this->input->post('descricao_campus');
        $descricao_curso = $this->input->post('descricao_curso');
        
        $resultado = $this->vagas_campus_dao->deleteEditalHasCurso($edital_has_curso->getId_edital_has_curso());
        
        if($resultado) {
            
            $data['titulo'] = "Sucesso!!!";
            
            $this->view_data['mensagem_h3'] = "O vínculo entre o edital número " . $numero_edital . ", a " . $descricao_universidade . ", o " . $descricao_campus . " e com o Curso de " . $descricao_curso . " foi removido com sucesso!!";
            $this->view_data['mensagem_h4'] = "Para realizar outra remoção, <a href=\"". base_url() . "index.php/assessoria_deleta_matriz_curso_controller\">clique aqui.</a>";
            
            $this->load->view('/headers/header_logged_view', $data);
            $this->load->view('assessoria_sucesso_view', $this->view_data);
            $this->load->view('/footers/footer_view');
            
        } else {
            
            $data['titulo'] = "Falha!!!";
            
            $this->view_data['mensagem_h3'] = "A remoção falhou!! Verifique se os dados foram informados de forma correta e <a href=\"" . base_url() . "index.php/assessoria_deleta_matriz_curso_controller/index\">tente novamente.</a>";
            
            $this->load->view('/headers/header_logged_view', $data);
            $this->load->view('assessoria_falha_view', $this->view_data);
            $this->load->view('/footers/footer_view');
            
        }
        
    }
    
}

?>
