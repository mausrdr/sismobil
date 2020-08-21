<?php

class Aluno_acompanhamento_controller extends MY_controller {
    
    function __construct() {
        
        parent::__construct();
        
        $this->view_data['base_url'] = base_url();
        
        $this->load->model('aluno_login_model', 'login_model');
        $this->load->model('ficha_candidatura_dao');
        $this->load->model('edital_dao');
        
    }
    
    public function index() {
        
        if($this->login_model->isLogado() === TRUE) {
            
            $this->acompanha();
            
        } else {
            
            redirect('main_controller');
            
        }
        
    }
    
    public function acompanha() {
        
        $data['titulo'] = "SISMOBIL - Acompanhamento";
        
        $this->view_data['atributos'] = array(
            
            'name'      =>  'myform',
            'id'        =>  'myform'
            
        );
        
        $this->view_data['legend'] = "Acompanhamento da Candidatura";
        
        $candidato_id_candidato = $this->session->userdata('aluno_id');
        
        $this->view_data['url'] = "index.php/aluno_acompanhamento_controller/";
        
        $campo_edital = $this->edital_dao->getEditalAcompanhamento($candidato_id_candidato);
        
        if($campo_edital != FALSE) {
            
            $this->view_data['edital_aberto'] = TRUE;
            
            $options_edital = array('0' => 'Selecione um Edital');

            foreach($campo_edital as $edital) {

                $options_edital[$edital['id']] = $edital['numero'];

            }

            $this->view_data['options_edital'] = $options_edital;
            
        } else {
            
            $this->view_data['edital_aberto'] = FALSE;
            
        }
        
        $config = array(
            array(
                'field' =>  'edital_id_edital',
                'label' =>  'Edital',
                'rules' =>  'trim|required|xss_clean'
            )
        );
        
        $this->form_validation->set_rules($config);
        
        if($this->form_validation->run() == FALSE) {
            
            $this->load->view('/headers/header_aluno_logged_aberto_view', $data);
            $this->load->view('aluno_acompanhamento_view', $this->view_data);
            $this->load->view('/footers/footer_view');
            
        } else {
            
            $edital_id_edital = $this->input->post('edital_id_edital');
            
            $acompanhamento = $this->ficha_candidatura_dao->getAcompanhamento($candidato_id_candidato, $edital_id_edital);

            $this->view_data['label'] = array(
                0   =>  'Candidatura Recebida',
                1   =>  'Data do Recebimento',
                2   =>  'Justificativa',
                3   =>  'Aprovado'
            );
            $this->view_data['index'] = array(
                0   =>  'aceite',
                1   =>  'data_aceite',
                2   =>  'justificativa',
                3   =>  'aprovado'
            );
            $this->view_data['acompanhamento'] = $acompanhamento;
            $this->view_data['edital_id_edital'] = $edital_id_edital;

            $this->load->view('/headers/header_aluno_logged_aberto_view', $data);
            $this->load->view('aluno_acompanhamento_view', $this->view_data);
            $this->load->view('/footers/footer_view');
            
        }
        
    }
    
}

?>
