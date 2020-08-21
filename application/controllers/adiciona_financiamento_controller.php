<?php

class Adiciona_financiamento_controller extends MY_controller {
    
    function __construct() {
        
        parent::__construct();
        
        $this->view_data['base_url'] = base_url();
        
        $this->load->model('tipo_financiamento_dao');
        
    }
    
    function index() {
        
        $this->form();
        
    }
    
    public function form() {

        $this->form_validation->set_rules('tipo_financiamento', 'Tipo de Financiamento', 'trim|required|xss_clean|callback_validaFinanciamento');
        
        if($this->form_validation->run() == FALSE) {
            
            $this->load->view('adiciona_financiamento_view', $this->view_data);
            
        } else {
            
            $financiamento = $this->input->post('tipo_financiamento');
            
            if($this->tipo_financiamento_dao->insereTipoFinanciamento($financiamento)) {
                
                $this->view_data['message'] = 'O tipo de financiamento ' . $financiamento . ' foi inserido com sucesso!';
                
                $this->load->view('adiciona_financiamento_view', $this->view_data);
                
            }
            
        }
        
    }
    
    public function validaFinanciamento($financiamento) {
        
        $this->form_validation->set_message('validaFinanciamento', 'O tipo de financiamento ' . $financiamento . ' já existe!');
        
        if($this->tipo_financiamento_dao->tipoFinanciamentoExiste($financiamento)) {
            
            return false;
            
        }
        
        return true;
        
    }
    
}

?>
