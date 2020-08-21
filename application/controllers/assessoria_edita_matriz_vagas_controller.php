<?php

class Assessoria_edita_matriz_vagas_controller extends MY_controller {
    
    function __construct() {
        
        parent::__construct();
        
        $this->view_data['base_url'] = base_url();
        
        $this->load->model('assessoria_login_model', 'login_model');
        $this->load->model('vagas_campus_to');
        $this->load->model('vagas_campus_dao');
        $this->load->model('edital_dao');
        $this->load->model('universidade_dao');
        $this->load->model('campus_universidade_dao');
        
        
    }
    
    function index() {
        
        if($this->login_model->isLogado() === TRUE) {
            
            $this->selecionar();
            
        } else {
            
            redirect('main_controller');
            
        }
        
    }
    
    public function selecionar() {
        
        $data['titulo'] = "Selecionar Edital";
        
        $this->view_data['paragrafo'] = "Por favor selecione o Número do Edital da matriz a ser editada";
        $this->view_data['atributos'] = array(
            
            'name'      =>  'myform',
            'id'        =>  'myform'
            
        );
        $this->view_data['url'] = "index.php/assessoria_edita_matriz_vagas_controller";
        $this->view_data['legend'] = "Selecione um Edital";
        $this->view_data['tabela'] = 1;
        
        /* Carrega array para menu drop down do edital */
        $campo_edital = $this->edital_dao->getUpdateEditalVagas(date('Y-m-d'));
        
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
            
            $this->view_data['paragrafo'] = "Por favor selecione um item da Matriz de Vagas a ser editado";
            $this->view_data['legend'] = "Selecione um item";
            $this->view_data['tabela'] = 1;
            $this->view_data['url'] = "index.php/assessoria_edita_matriz_vagas_controller/index";
            $this->view_data['url_receber'] = "index.php/assessoria_edita_matriz_vagas_controller/form";
            
            $id_edital = $this->input->post('edital_id_edital');
            
            $lista = $this->vagas_campus_dao->listMatrizVagas($id_edital);
            
            if(empty($lista)) {
                
                $this->view_data['msg_erro'] = "Não é possivel editar nenhum item da matriz de vagas referente a este edital.<br/>Se não foi cadastrado nenhum item nesta matriz <a href=\"". base_url() . "index.php/assessoria_cadastra_matriz_vagas_controller\">clique aqui.</a><br/>Ou a matriz já tem cursos ofertados vinculados a ela.";
                
            }
            
            $this->view_data['lista'] = $lista;
            
            $this->load->view('/headers/header_matriz_view', $data);
            $this->load->view('assessoria_escolhe_matriz_view', $this->view_data);
            $this->load->view('/footers/footer_view');
            
        }
        
    }
    
    public function form() {
        
        $vagas_campus = new Vagas_campus_to();
        $vagas_campus->setId_vagas_campus($this->input->get('id'));
        $vagas_campus = $this->vagas_campus_dao->getVagasCampus($vagas_campus->getId_vagas_campus());
        
        $this->view_data['id_vagas'] = $vagas_campus->getId_vagas_campus();
        $this->view_data['id_edital'] = $vagas_campus->getEdital_id_edital();
        $this->view_data['id_universidade'] = $vagas_campus->getUniversidade_id_universidade();
        $this->view_data['id_campus'] = $vagas_campus->getCampus_universidade_id_campus_universidade();
        
        $campus = $this->campus_universidade_dao->getDescricaoCampus($vagas_campus->getCampus_universidade_id_campus_universidade());
        
        $data['titulo'] = "Editar Matriz de Vagas";
        
        $this->view_data['atributos'] = array(
            
            'name'      =>  'myform',
            'id'        =>  'myform'
            
        );
        
        $this->view_data['url'] = "index.php/assessoria_edita_matriz_vagas_controller/form/?id=".$vagas_campus->getId_vagas_campus()."";
        
        $this->view_data['legend'] = "Editar Matriz de Vagas";
        
        /* Carrega array para menu drop down do edital */
        $campo_edital = $this->edital_dao->getEditalMatriz(date('Y-m-d'));
        
        $options_edital = array('0' => 'Selecione um Edital');
        
        foreach($campo_edital as $edital) {
            
            $options_edital[$edital['id']] = $edital['numero'];
            
        }
        
        $this->view_data['options_edital'] = $options_edital;
        
        /* Carrega array para menu drop down da universidade */
        $campo_universidade = $this->universidade_dao->getUniversidadeMatriz();
        
        $options_universidade = array('0' => 'Selecione uma Universidade');
        
        foreach ($campo_universidade as $universidade) {
            
            $options_universidade[$universidade['id']] = $universidade['descricao'];
            
        }
        
        $this->view_data['options_universidade'] = $options_universidade;
        
        $this->view_data['input'] = array(
            array(
            
                'name'      =>      'vagas',
                'id'        =>      'vagas',
                'value'     =>      $vagas_campus->getVagas()
            
            ),
            array(
                
                'name'      =>      'descricao_campus',
                'id'        =>      'descricao_campus',
                'value'     =>      $campus,
                'readonly'  =>      '0'
                
            )
        );
        
        $config = array(
            array(
                'field'     =>      'edital_id_edital',
                'label'     =>      'Número do edital',
                'rules'     =>      'trim|xss_clean'
            ),
            array(
                'field'     =>      'universidade_id_universidade',
                'label'     =>      'Universidade',
                'rules'     =>      'trim|required|xss_clean|callback_validaUniversidade'
            ),
            array(
                'field'     =>      'descricao_campus',
                'label'     =>      'Câmpus',
                'rules'     =>      'trim|required|xss_clean'
            ),
            array(
                'field'     =>      'vagas',
                'label'     =>      'Vagas no Câmpus',
                'rules'     =>      'trim|numeric|required|xss_clean'
            )
        );
        
        $this->form_validation->set_rules($config);
        
        if($this->form_validation->run() == FALSE) {
            
            $this->load->view('/headers/header_matriz_view', $data);
            $this->load->view('assessoria_edita_matriz_vagas_view', $this->view_data);
            $this->load->view('/footers/footer_view');
            
        } else {
            
            $vagas_campus = new Vagas_campus_to();
            $vagas_campus->setId_vagas_campus($this->input->post('id_vagas'));
            $vagas_campus->setVagas($this->input->post('vagas'));
            $vagas_campus->setEdital_id_edital($this->input->post('id_edital'));
            $vagas_campus->setUniversidade_id_universidade($this->input->post('universidade_id_universidade'));
            $vagas_campus->setCampus_universidade_id_campus_universidade($this->input->post('id_campus'));
            
            if($this->vagas_campus_dao->vagasCampusUpdateExiste($vagas_campus)) {
                
                $this->view_data['msg_erro'] = "Este item já existe na Matriz de Vagas referente a este edital! Por favor, Verifique se os dados foram informados de forma correta e tente novamente.";
                
                $this->load->view('/headers/header_matriz_view', $data);
                $this->load->view('assessoria_edita_matriz_vagas_view', $this->view_data);
                $this->load->view('/footers/footer_view');
                
            } else {
                
                $data['titulo'] = "Confirmar Dados da Edição da Matriz de Vagas";

                $this->view_data['h1'] = "Confirmação dos dados";
                $this->view_data['paragrafo'] = "Por favor confira se os dados estão corretos";
                $this->view_data['url'] = "index.php/assessoria_edita_matriz_vagas_controller/registrar";

                $numero_edital = $this->edital_dao->getNumeroEdital($vagas_campus->getEdital_id_edital());
                $descricao_universidade = $this->universidade_dao->getDescricaoUniversidade($vagas_campus->getUniversidade_id_universidade());
                $descricao_campus = $this->input->post('descricao_campus');

                $this->view_data['label'] = array(

                    0   =>  'Número do Edital',
                    1   =>  'Universidade',
                    2   =>  'Campus',
                    3   =>  'Vagas'

                );

                $this->view_data['descricao'] = array(

                    0   =>  $numero_edital,
                    1   =>  $descricao_universidade,
                    2   =>  $descricao_campus,
                    3   =>  $vagas_campus->getVagas()

                );

                $this->view_data['dados'] = array(

                    'id_vagas_campus'                   =>    $vagas_campus->getId_vagas_campus(),
                    'edital_id_edital'                  =>    $vagas_campus->getEdital_id_edital(),
                    'universidade_id_universidade'      =>    $vagas_campus->getUniversidade_id_universidade(),
                    'campus_universidade_id_campus_universidade'    =>    $vagas_campus->getCampus_universidade_id_campus_universidade(),
                    'vagas'     =>    $vagas_campus->getVagas(),

                );

                $this->load->view('/headers/header_confirm_view', $data);
                $this->load->view('assessoria_confirm_matriz_view', $this->view_data);
                $this->load->view('/footers/footer_view');
                
            }
            
        }
        
    }
    
    public function registrar() {
        
        $vagas_campus = new Vagas_campus_to();
        $vagas_campus->setId_vagas_campus($this->input->post('id_vagas_campus'));
        $vagas_campus->setVagas($this->input->post('vagas'));
        $vagas_campus->setEdital_id_edital($this->input->post('edital_id_edital'));
        $vagas_campus->setUniversidade_id_universidade($this->input->post('universidade_id_universidade'));
        $vagas_campus->setCampus_universidade_id_campus_universidade($this->input->post('campus_universidade_id_campus_universidade'));
        
        $resultado = $this->vagas_campus_dao->updateVagasCampus($vagas_campus);
        
        if($resultado) {
            
            $data['titulo'] = "Sucesso!!!";
            
            $this->view_data['mensagem_h3'] = "A edição foi realizada com sucesso!!";
            $this->view_data['mensagem_h4'] = "Para realizar outra edição, <a href=\"". base_url() . "index.php/assessoria_edita_matriz_vagas_controller\">clique aqui.</a>";
            
            $this->load->view('/headers/header_logged_view', $data);
            $this->load->view('assessoria_sucesso_view', $this->view_data);
            $this->load->view('/footers/footer_view');
            
        } else {
            
            $data['titulo'] = "Falha!!!";
            
            $this->view_data['mensagem_h3'] = "A edição falhou!! Verifique se os dados foram informados de forma correta e <a href=\"" . base_url() . "index.php/assessoria_edita_matriz_vagas_controller/index\">tente novamente.</a>";
            
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
    
}

?>
