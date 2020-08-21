<?php

class Assessoria_deleta_edital_controller extends MY_controller {
    
    function __construct() {
        
        parent::__construct();
        
        $this->view_data['base_url'] = base_url();
        
        $this->load->model('assessoria_login_model', 'login_model');
        $this->load->model('edital_to');
        $this->load->model('edital_dao');
        
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
        
        $this->view_data['paragrafo'] = "Por favor selecione o Número do Edital a ser deletado";
        
        $this->view_data['atributos'] = array(
            
            'id'        =>  'myform'
            
        );
        
        $this->view_data['url'] = "index.php/assessoria_deleta_edital_controller";
        
        $this->view_data['legend'] = "Selecione um Edital";
        
        $campo_edital = $this->edital_dao->getEditalDelete(date('Y-m-d'));
        
        $options_edital = array('0' => 'Selecione um Edital');
        
        foreach($campo_edital as $edital) {
            
            $options_edital[$edital['id']] = $edital['numero'];
            
        }
        
        $this->view_data['options_edital'] = $options_edital;
        
        $config = array(
            array(
                'field'     =>      'id_edital',
                'label'     =>      'Número do edital',
                'rules'     =>      'trim|required|xss_clean|callback_validaEdital'
            )
        );
        
        $this->form_validation->set_rules($config);
        
        if($this->form_validation->run() == FALSE) {
            
            $this->load->view('/headers/header_logged_view', $data);
            $this->load->view('assessoria_seleciona_edital_view', $this->view_data);
            $this->load->view('/footers/footer_view');
            
        } else {
            
            $data['titulo'] = "Confirmar Seleção do Edital";
            
            $this->view_data['h1'] = "Confirmar Edital a ser deletado";
            
            $this->view_data['paragrafo'] = "Por favor, confira se o edital que você deseja deletar foi selecionado corretamente";
            
            $this->view_data['url'] = "index.php/assessoria_deleta_edital_controller/deletar";
            
            $this->view_data['label'] = array(
          
                0   =>  'Número do edital',
                1   =>  'Total de Vagas',
                2   =>  'Data de abertura',
                3   =>  'Data de encerramento',
                4   =>  'Opção de Destino',
                5   =>  'Assistência Estudantil'

            );
            
            $numero_edital = $this->input->post('id_edital');
            
            $edital = new Edital_to();
            $edital = $this->edital_dao->loadEdital($numero_edital);
            
            $this->view_data['dados'] = array(
                
                'id_edital'             =>      $edital->getId_edital(),
                'numero_edital'         =>      $edital->getNumero_edital(),
                'total_vagas'           =>      $edital->getTotal_vagas(),
                'data_abertura'         =>      $edital->getData_abertura(),
                'data_encerramento'     =>      $edital->getData_encerramento(),
                'opcao_destino'         =>      $edital->getOpcao_destino(),
                'assistencia'           =>      $edital->getAssistencia()
                
            );
            
            $this->view_data['deletar'] = 1;
            
            //$this->form($edital);
            $this->load->view('/headers/header_confirm_view', $data);
            $this->load->view('assessoria_confirm_view', $this->view_data);
            $this->load->view('/footers/footer_view');
            
        }
        
    }

    public function deletar() {
        
        $id_edital = $this->input->post('id_edital');
                
        $numero_edital = $this->input->post('numero_edital');
        
        $resultado = $this->edital_dao->deleteEdital($id_edital);
        
        if($resultado) {
            
            $data['titulo'] = "Sucesso!!!";
            
            $this->view_data['mensagem_h3'] = "A remoção do edital número ". $numero_edital . " foi realizada com sucesso!!";
            $this->view_data['mensagem_h4'] = "Para remover outro edital, <a href=\"". base_url() . "index.php/assessoria_deleta_edital_controller\">clique aqui.</a>";
            
            $this->load->view('/headers/header_logged_view', $data);
            $this->load->view('assessoria_sucesso_view', $this->view_data);
            $this->load->view('/footers/footer_view');
            
        } else {
            
            $data['titulo'] = "Falha!!!";
            
            $this->view_data['mensagem_h3'] = "A remoção do edital número " .$numero_edital. " falhou!! Verifique se os dados foram informados de forma correta e <a href=\"" . base_url() . "index.php/assessoria_deleta_edital_controller\">tente novamente.</a>";
            
            $this->load->view('/headers/header_logged_view', $data);
            $this->load->view('assessoria_falha_view', $this->view_data);
            $this->load->view('/footers/footer_view');
            
        }
        
    }
    
    public function validaEdital($edital) {
        
        $this->form_validation->set_message('validaEdital', 'O campo %s é obrigatório! Selecione um %s.');
        
        if($edital == 0) {
            
            return FALSE;
            
        }
        
        return TRUE;
        
    }
    
}

?>
