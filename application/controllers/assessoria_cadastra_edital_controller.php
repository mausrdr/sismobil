<?php

class Assessoria_cadastra_edital_controller extends MY_controller {
    
    function __construct() {
        
        parent::__construct();
        
        $this->view_data['base_url'] = base_url();
        
        $this->load->model('assessoria_login_model', 'login_model');
        $this->load->model('edital_to');
        $this->load->model('edital_dao');
        
    }
    
    function index() {
        
        if($this->login_model->isLogado() === TRUE) {
            
            $this->form();
            
        } else {
            
            redirect('main_controller');
            
        }
        
    }
    
    public function form() {
        
        $data['titulo'] = "Cadastrar Edital";
        
        $this->view_data['atributos'] = array(
            
            'name'      =>  'myform',
            'id'        =>  'myform'
            
        );
        
        $this->view_data['url'] = "index.php/assessoria_cadastra_edital_controller/index";
        
        $this->view_data['legend'] = "Cadastrar Edital";
        
        $this->view_data['label'] = array(
          
            0   =>  'Número do edital',
            1   =>  'Total de vagas',
            2   =>  'Data de abertura',
            3   =>  'Data de encerramento',
            4   =>  'Opção de destino',
            5   =>  'Assistência estudantil'
            
        );
        
        $this->view_data['input'] = array(
            
            array(
                
                'name'          =>      'numero_edital',
                'id'            =>      'numero_edital',
                'placeholder'   =>      'Ex.: 999/9999',
                'value'         =>      set_value('numero_edital'),
                'pattern'       =>      '\d{3}[\/]\d{4}',
                'title'         =>      '999/9999'
                
            ),
            
            array(

                'name'          =>      'total_vagas',
                'id'            =>      'total_vagas',
                'value'         =>      set_value('total_vagas')

            ),
            
            array(

                'name'          =>      'data_abertura',
                'id'            =>      'data_abertura',
                'placeholder'   =>      'Ex.: dd/mm/aaaa',
                'value'         =>      set_value('data_abertura'),
                'pattern'       =>      '(((0[1-9]|[12]\d|3[01])\/(0[13578]|1[02])\/((19|[2-9]\d)\d{2}))|((0[1-9]|[12]\d|30)\/(0[13456789]|1[012])\/((19|[2-9]\d)\d{2}))|((0[1-9]|1\d|2[0-8])\/02\/((19|[2-9]\d)\d{2}))|(29\/02\/((1[6-9]|[2-9]\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))))',
                'title'         =>      'dd/mm/aaaa'

            ),
            
            array(

                'name'          =>      'data_encerramento',
                'id'            =>      'data_encerramento',
                'placeholder'   =>      'Ex.: dd/mm/aaaa',
                'value'         =>      set_value('data_encerramento'),
                'pattern'       =>      '(((0[1-9]|[12]\d|3[01])\/(0[13578]|1[02])\/((19|[2-9]\d)\d{2}))|((0[1-9]|[12]\d|30)\/(0[13456789]|1[012])\/((19|[2-9]\d)\d{2}))|((0[1-9]|1\d|2[0-8])\/02\/((19|[2-9]\d)\d{2}))|(29\/02\/((1[6-9]|[2-9]\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))))',
                'title'         =>      'dd/mm/aaaa'

            ),
            
            array(
                
                'name'          =>      'opcao_destino',
                'id'            =>      'opcao_destino',
                'class'         =>      'regular-checkbox',
                'value'         =>      '1',
                'style'         =>      'margin:10px'
                
            ),
            
            array(
                
                'name'          =>      'assistencia',
                'id'            =>      'assistencia',
                'class'         =>      'regular-checkbox',
                'value'         =>      '1',
                'style'         =>      'margin:10px'
                
            )
            
        );
        
        $config = array(
            array(
                'field'     =>      'numero_edital',
                'label'     =>      'Número do edital',
                'rules'     =>      'trim|required|xss_clean|callback_validaEdital'
            ),
            array(
                'field'     =>      'total_vagas',
                'label'     =>      'Total de vagas',
                'rules'     =>      'trim|required|numeric|xss_clean'
            ),
            array(
                'field'     =>      'data_abertura',
                'label'     =>      'Data de abertura',
                'rules'     =>      'trim|required|xss_clean'
            ),
            array(
                'field'     =>      'data_encerramento',
                'label'     =>      'Data de encerramento',
                'rules'     =>      'trim|required|xss_clean'
            ),
            array(
                'field'     =>      'opcao_destino',
                'label'     =>      'Opção de destino',
                'rules'     =>      'xss_clean'
            ),
            array(
                'field'     =>      'assistencia',
                'label'     =>      'Assistência dstudantil',
                'rules'     =>      'xss_clean'
            )
        );
        
        $this->form_validation->set_rules($config);
        
        if($this->form_validation->run() == FALSE) {
            
            $this->load->view('/headers/header_logged_view', $data);
            $this->load->view('assessoria_cadastro_view', $this->view_data);
            $this->load->view('/footers/footer_view');
            
        } else {
            
            $data['titulo'] = "Confirmar Dados do Cadastro de Edital";
            
            $this->view_data['h1'] = "Confirmação dos dados";
            
            $this->view_data['paragrafo'] = "Por favor confira se os dados estão corretos";
            
            $this->view_data['url'] = "index.php/assessoria_cadastra_edital_controller/registrar";
            
            $edital = new Edital_to();
            $edital->setNumero_edital($this->input->post('numero_edital'));
            $edital->setTotal_vagas($this->input->post('total_vagas'));
            $edital->setData_abertura($this->input->post('data_abertura'));
            $edital->setData_encerramento($this->input->post('data_encerramento'));
            $edital->setOpcao_destino($this->input->post('opcao_destino'));
            $edital->setAssistencia($this->input->post('assistencia'));
            
            $this->view_data['dados'] = array(

                'numero_edital'         =>      $edital->getNumero_edital(),
                'total_vagas'           =>      $edital->getTotal_vagas(),
                'data_abertura'         =>      $edital->getData_abertura(),
                'data_encerramento'     =>      $edital->getData_encerramento(),
                'opcao_destino'         =>      $edital->getOpcao_destino(),
                'assistencia'           =>      $edital->getAssistencia()

            );
            
            $this->view_data['label'] = array(
                
                0   =>  'Número do edital',
                1   =>  'Total de vagas',
                2   =>  'Data de abertura',
                3   =>  'Data de encerramento',
                4   =>  'Opção de destino',
                5   =>  'Assistência estudantil'
                
            );
            
            $this->load->view('/headers/header_confirm_view', $data);
            $this->load->view('assessoria_confirm_view', $this->view_data);
            $this->load->view('/footers/footer_view');
            
        }
        
    }
    
    public function registrar() {
        
        $edital = new Edital_to();
        $edital->setNumero_edital($this->input->post('numero_edital'));
        $edital->setTotal_vagas($this->input->post('total_vagas'));
        $edital->setData_abertura($this->input->post('data_abertura'));
        $edital->setData_encerramento($this->input->post('data_encerramento'));
        $edital->setOpcao_destino($this->input->post('opcao_destino'));
        $edital->setAssistencia($this->input->post('assistencia'));
        
        $numero_edital = $edital->getNumero_edital();
        
        $resultado = $this->edital_dao->insereEdital($edital);
        
        if($resultado) {
            
            $data['titulo'] = "Sucesso!!!";
            
            $this->view_data['mensagem_h3'] = "O cadastro do edital número ". $numero_edital . " foi realizado com sucesso!!";
            $this->view_data['mensagem_h4'] = "Para cadastrar outro edital, <a href=\"". base_url() . "index.php/assessoria_cadastra_edital_controller/index\">clique aqui.</a>";
            
            $this->load->view('/headers/header_logged_view', $data);
            $this->load->view('assessoria_sucesso_view', $this->view_data);
            $this->load->view('/footers/footer_view');
            
        } else {
            
            $data['titulo'] = "Falha!!!";
            
            $this->view_data['mensagem_h3'] = "O cadastro do edital número " .$numero_edital. " falhou!! Verifique se os dados foram informados de forma correta e <a href=\"" . base_url() . "index.php/assessoria_cadastra_edital_controller/index\">tente novamente.</a>";
            
            $this->load->view('/headers/header_logged_view', $data);
            $this->load->view('assessoria_falha_view', $this->view_data);
            $this->load->view('/footers/footer_view');
            
        }
        
    }
    
    public function validaEdital($numero_edital) {
        
        $this->form_validation->set_message('validaEdital', 'O %s já existe! Por favor informe um número de edital válido');
        
        if($this->edital_dao->editalExiste($numero_edital)) {
            
            return FALSE;
            
        }
        
        return TRUE;
        
    }
       
}

?>
