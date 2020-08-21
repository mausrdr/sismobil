<?php

class Assessoria_cadastra_matriz_vagas_controller extends MY_controller {
    
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
            
            $this->form();
            
        } else {
            
            redirect('main_controller');
            
        }
        
    }
    
    public function form() {
        
        $data['titulo'] = "Cadastrar Matriz de Vagas";
        
        $this->view_data['atributos'] = array(
            
            'name'      =>  'myform',
            'id'        =>  'myform'
            
        );
        
        $this->view_data['url'] = "index.php/assessoria_cadastra_matriz_vagas_controller";
        
        $this->view_data['legend'] = "Cadastrar Matriz de Vagas";
        
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
                'value'     =>      set_value('vagas')
            
            ),
            array(
                
                'name'      =>      'descricao_campus',
                'id'        =>      'descricao_campus',
                'value'     =>      set_value('descricao_campus')
                
            )
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
            $this->load->view('assessoria_cadastro_matriz_vagas_view', $this->view_data);
            $this->load->view('/footers/footer_view');
            
        } else {
            
            $vagas_campus = new Vagas_campus_to();
            $vagas_campus->setVagas($this->input->post('vagas'));
            $vagas_campus->setEdital_id_edital($this->input->post('edital_id_edital'));
            $vagas_campus->setUniversidade_id_universidade($this->input->post('universidade_id_universidade'));
            $vagas_campus->setCampus_universidade_id_campus_universidade($this->input->post('id_campus'));
            
            if($this->vagas_campus_dao->vagas_campusExiste($vagas_campus)) {
                
                $this->view_data['msg_erro'] = "Esta Matriz de Vagas já existe! Por favor, cadastre outra Matriz de Vagas.";
                
                $this->load->view('/headers/header_matriz_view', $data);
                $this->load->view('assessoria_cadastro_matriz_vagas_view', $this->view_data);
                $this->load->view('/footers/footer_view');
                
            } else {
                
                $data['titulo'] = "Confirmar Dados do Cadastro da Matriz de Vagas";
                
                $this->view_data['h1'] = "Confirmação dos dados";
                $this->view_data['paragrafo'] = "Por favor confira se os dados estão corretos";
                $this->view_data['url'] = "index.php/assessoria_cadastra_matriz_vagas_controller/registrar";

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
        $vagas_campus->setVagas($this->input->post('vagas'));
        $vagas_campus->setEdital_id_edital($this->input->post('edital_id_edital'));
        $vagas_campus->setUniversidade_id_universidade($this->input->post('universidade_id_universidade'));
        $vagas_campus->setCampus_universidade_id_campus_universidade($this->input->post('campus_universidade_id_campus_universidade'));
        
        $resultado = $this->vagas_campus_dao->insertVagasCampus($vagas_campus);
        
        if($resultado) {
            
            $data['titulo'] = "Sucesso!!!";
            
            $this->view_data['mensagem_h3'] = "O cadastro foi realizado com sucesso!!";
            $this->view_data['mensagem_h4'] = "Para realizar outro  cadastro, <a href=\"". base_url() . "index.php/assessoria_cadastra_matriz_vagas_controller\">clique aqui.</a>";
            
            $this->load->view('/headers/header_logged_view', $data);
            $this->load->view('assessoria_sucesso_view', $this->view_data);
            $this->load->view('/footers/footer_view');
            
        } else {
            
            $data['titulo'] = "Falha!!!";
            
            $this->view_data['mensagem_h3'] = "O cadastro falhou!! Verifique se os dados foram informados de forma correta e <a href=\"" . base_url() . "index.php/assessoria_cadastra_matriz_vagas_controller/index\">tente novamente.</a>";
            
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
