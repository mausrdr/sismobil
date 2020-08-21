<?php

class Assessoria_seleciona_candidato_controller extends MY_controller {
    
    function __construct() {
        
        parent::__construct();
        
        $this->load->model('assessoria_login_model', 'login_model');
        $this->load->model('ficha_candidatura_to');
        $this->load->model('ficha_candidatura_dao');
        $this->load->model('edital_dao');
        
    }
    
    public function index() {
        
        if($this->login_model->isLogado() === TRUE) {
            
            $this->form();
            
        } else {
            
            redirect('main_controller');
            
        }
        
    }
    
    public function form() {
        
        $data['titulo'] = "Seleção dos Candidatos";
        
        $this->view_data['atributos'] = array(
            
            'name'      =>  'myform',
            'id'        =>  'myform'
            
        );
        
        $this->view_data['url'] = "index.php/assessoria_seleciona_candidato_controller/index";
        
        $this->view_data['legend'] = "Seleção dos Candidatos";
        
        /* Carrega array para menu drop down do edital */
        $campo_edital = $this->edital_dao->getEditalAberto(date('Y-m-d'));
        
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
            $this->load->view('assessoria_recebe_candidatura_view', $this->view_data);
            $this->load->view('/footers/footer_view');
            
        } else {
            
            $data['titulo'] = "Seleção dos Candidatos";
            
            $this->view_data['url'] = "index.php/assessoria_seleciona_candidato_controller/index";
            
            $this->view_data['url_selecionar'] = "index.php/assessoria_seleciona_candidato_controller/selecionar";
            
            $id_edital = $this->input->post('edital_id_edital');
            
            $lista = $this->ficha_candidatura_dao->listaFichaClassificar($id_edital);
            
            $this->view_data['lista'] = $lista;
            
            $this->load->view('/headers/header_matriz_view', $data);
            $this->load->view('assessoria_recebe_candidatura_view', $this->view_data);
            $this->load->view('/footers/footer_view');
            
        }
        
    }
    
    public function selecionar() {
        
        $id_ficha = $this->input->get('id');
        
    }
    
}

?>
