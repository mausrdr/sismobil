<?php

class Assessoria_listar_matriz_controller extends MY_controller {
    
    function __construct() {
        
        parent::__construct();
        
        $this->view_data['base_url'] = base_url();
        
        $this->load->model('assessoria_login_model', 'login_model');
        $this->load->model('edital_has_curso_to');
        $this->load->model('edital_has_curso_dao');
        $this->load->model('vagas_campus_to');
        $this->load->model('vagas_campus_dao');
        $this->load->model('edital_dao');
        
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
        
        $this->view_data['paragrafo'] = "Por favor selecione o Número do Edital da matriz a ser listada";
        $this->view_data['atributos'] = array(
            
            'name'      =>  'myform',
            'id'        =>  'myform'
            
        );
        $this->view_data['url'] = "index.php/assessoria_listar_matriz_controller";
        $this->view_data['legend'] = "Selecione um Edital";
        $this->view_data['tabela'] = 0;
        
        /* Carrega array para menu drop down do edital */
        $campo_edital = $this->edital_dao->listEdital();
        
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
            
            $this->load->view('/headers/header_logged_view', $data);
            $this->load->view('assessoria_listar_matriz_view', $this->view_data);
            $this->load->view('/footers/footer_view');
            
        } else {
            
            $this->view_data['paragrafo'] = "";
            $this->view_data['legend'] = "";
            $this->view_data['tabela'] = 0;
            $this->view_data['url'] = "index.php/assessoria_listar_matriz_controller";
            $this->view_data['url_editar'] = "index.php/assessoria_edita_matriz_curso_controller/form";
            $this->view_data['url_deletar'] = "index.php/assessoria_deleta_matriz_curso_controller/confirma";
            
            $id_edital = $this->input->post('edital_id_edital');
            
            $this->view_data['links'] = $this->edital_dao->verificaData($id_edital, date('Y-m-d'));
            
            $lista = $this->edital_has_curso_dao->listMatrizCurso($id_edital);
            
            if(empty($lista)) {
                
                $this->view_data['msg_erro'] = "Não é possivel listar nenhum item da matriz referente a este edital.<br/>Se não foi cadastrado nenhum item nesta matriz <a href=\"". base_url() . "index.php/assessoria_cadastra_matriz_curso_controller\">clique aqui.</a>";
                
            }
            
            $this->view_data['lista'] = $lista;
            
            $this->load->view('/headers/header_logged_view', $data);
            $this->load->view('assessoria_listar_matriz_view', $this->view_data);
            $this->load->view('/footers/footer_view');
            
        }
        
    }
    
}

?>
