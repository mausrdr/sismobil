<?php

class Assessoria_edita_edital_controller extends MY_controller {
    
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
        
        $this->view_data['paragrafo'] = "Por favor selecione o Número do Edital a ser editado";
        
        $this->view_data['url'] = "index.php/assessoria_edita_edital_controller";
        
        $this->view_data['legend'] = "Selecione um Edital";
        
        $campo_edital = $this->edital_dao->getEditalMatriz(date('Y-m-d'));
        
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
            
            $this->view_data['h1'] = "Confirmar Edital a ser editado";
            
            $this->view_data['paragrafo'] = "Por favor, confira se o edital que você deseja editar foi selecionado corretamente";
            
            $this->view_data['url'] = "index.php/assessoria_edita_edital_controller/form";
            
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
            
            $this->view_data['editar'] = 1;
            
            //$this->form($edital);
            $this->load->view('/headers/header_confirm_view', $data);
            $this->load->view('assessoria_confirm_view', $this->view_data);
            $this->load->view('/footers/footer_view');
            
        }
        
    }

    public function form() {
        
        $data['titulo'] = "Editar Edital";
        
        $this->view_data['atributos'] = array(
            
            'name'      =>  'myform',
            'id'        =>  'myform'
            
        );
        
        $this->view_data['url'] = "index.php/assessoria_edita_edital_controller/form/";
        
        $this->view_data['legend'] = "Editar Edital";
        
        $this->view_data['label'] = array(
          
            0   =>  'Número do edital',
            1   =>  'Total de Vagas',
            2   =>  'Data de abertura',
            3   =>  'Data de encerramento',
            4   =>  'Opção de Destino',
            5   =>  'Assistência Estudantil'
            
        );
        
        $edital = new Edital_to();
        $edital->setId_edital($this->input->post('id_edital'));
        $edital->setNumero_edital($this->input->post('numero_edital'));
        $edital->setTotal_vagas($this->input->post('total_vagas'));
        $edital->setData_abertura($this->input->post('data_abertura'));
        $edital->setData_encerramento($this->input->post('data_encerramento'));
        $edital->setOpcao_destino($this->input->post('opcao_destino'));
        $edital->setAssistencia($this->input->post('assistencia'));
        
        $this->view_data['hidden'] = array(
                        'id_edital'     =>      $edital->getId_edital(),
                        'form'          =>      1
                    );
        
        if(!$this->input->post('form')) {
            
            $_POST = NULL;
            
        }
        
        
        $this->view_data['id_edital'] = $edital->getId_edital();
        
        $verif = $edital->getOpcao_destino();
        $verif .= $edital->getAssistencia();
        
        switch ($verif) {
            case 00:
                $this->view_data['input'] = array(
            
                    array(

                        'name'          =>      'numero_edital',
                        'id'            =>      'numero_edital',
                        'placeholder'   =>      'Ex.: 999/9999',
                        'value'         =>      $edital->getNumero_edital(),
                        'pattern'       =>      '\d{3}[\/]\d{4}',
                        'title'         =>      '999/9999'

                    ),

                    array(

                        'name'          =>      'total_vagas',
                        'id'            =>      'total_vagas',
                        'value'         =>      $edital->getTotal_vagas()

                    ),

                    array(

                        'name'          =>      'data_abertura',
                        'id'            =>      'data_abertura',
                        'placeholder'   =>      'Ex.: dd/mm/aaaa',
                        'value'         =>      $edital->getData_abertura(),
                        'pattern'       =>      '(((0[1-9]|[12]\d|3[01])\/(0[13578]|1[02])\/((19|[2-9]\d)\d{2}))|((0[1-9]|[12]\d|30)\/(0[13456789]|1[012])\/((19|[2-9]\d)\d{2}))|((0[1-9]|1\d|2[0-8])\/02\/((19|[2-9]\d)\d{2}))|(29\/02\/((1[6-9]|[2-9]\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))))',
                        'title'         =>      'dd/mm/aaaa'

                    ),

                    array(

                        'name'          =>      'data_encerramento',
                        'id'            =>      'data_encerramento',
                        'placeholder'   =>      'Ex.: dd/mm/aaaa',
                        'value'         =>      $edital->getData_encerramento(),
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
                break;
            
            case 01:
                $this->view_data['input'] = array(
            
                    array(

                        'name'          =>      'numero_edital',
                        'id'            =>      'numero_edital',
                        'placeholder'   =>      'Ex.: 999/9999',
                        'value'         =>      $edital->getNumero_edital(),
                        'pattern'       =>      '\d{3}[\/]\d{4}',
                        'title'         =>      '999/9999'

                    ),

                    array(

                        'name'          =>      'total_vagas',
                        'id'            =>      'total_vagas',
                        'value'         =>      $edital->getTotal_vagas()

                    ),

                    array(

                        'name'          =>      'data_abertura',
                        'id'            =>      'data_abertura',
                        'placeholder'   =>      'Ex.: dd/mm/aaaa',
                        'value'         =>      $edital->getData_abertura(),
                        'pattern'       =>      '(((0[1-9]|[12]\d|3[01])\/(0[13578]|1[02])\/((19|[2-9]\d)\d{2}))|((0[1-9]|[12]\d|30)\/(0[13456789]|1[012])\/((19|[2-9]\d)\d{2}))|((0[1-9]|1\d|2[0-8])\/02\/((19|[2-9]\d)\d{2}))|(29\/02\/((1[6-9]|[2-9]\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))))',
                        'title'         =>      'dd/mm/aaaa'

                    ),

                    array(

                        'name'          =>      'data_encerramento',
                        'id'            =>      'data_encerramento',
                        'placeholder'   =>      'Ex.: dd/mm/aaaa',
                        'value'         =>      $edital->getData_encerramento(),
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
                        'checked'       =>      TRUE,
                        'style'         =>      'margin:10px'

                    )

                );
                break;
            case 10:
                $this->view_data['input'] = array(
            
                    array(

                        'name'          =>      'numero_edital',
                        'id'            =>      'numero_edital',
                        'placeholder'   =>      'Ex.: 999/9999',
                        'value'         =>      $edital->getNumero_edital(),
                        'pattern'       =>      '\d{3}[\/]\d{4}',
                        'title'         =>      '999/9999'

                    ),

                    array(

                        'name'          =>      'total_vagas',
                        'id'            =>      'total_vagas',
                        'value'         =>      $edital->getTotal_vagas()

                    ),

                    array(

                        'name'          =>      'data_abertura',
                        'id'            =>      'data_abertura',
                        'placeholder'   =>      'Ex.: dd/mm/aaaa',
                        'value'         =>      $edital->getData_abertura(),
                        'pattern'       =>      '(((0[1-9]|[12]\d|3[01])\/(0[13578]|1[02])\/((19|[2-9]\d)\d{2}))|((0[1-9]|[12]\d|30)\/(0[13456789]|1[012])\/((19|[2-9]\d)\d{2}))|((0[1-9]|1\d|2[0-8])\/02\/((19|[2-9]\d)\d{2}))|(29\/02\/((1[6-9]|[2-9]\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))))',
                        'title'         =>      'dd/mm/aaaa'

                    ),

                    array(

                        'name'          =>      'data_encerramento',
                        'id'            =>      'data_encerramento',
                        'placeholder'   =>      'Ex.: dd/mm/aaaa',
                        'value'         =>      $edital->getData_encerramento(),
                        'pattern'       =>      '(((0[1-9]|[12]\d|3[01])\/(0[13578]|1[02])\/((19|[2-9]\d)\d{2}))|((0[1-9]|[12]\d|30)\/(0[13456789]|1[012])\/((19|[2-9]\d)\d{2}))|((0[1-9]|1\d|2[0-8])\/02\/((19|[2-9]\d)\d{2}))|(29\/02\/((1[6-9]|[2-9]\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))))',
                        'title'         =>      'dd/mm/aaaa'

                    ),

                    array(

                        'name'          =>      'opcao_destino',
                        'id'            =>      'opcao_destino',
                        'class'         =>      'regular-checkbox',
                        'value'         =>      '1',
                        'checked'       =>      TRUE,
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
                break;
            case 11:
                $this->view_data['input'] = array(
            
                    array(

                        'name'          =>      'numero_edital',
                        'id'            =>      'numero_edital',
                        'placeholder'   =>      'Ex.: 999/9999',
                        'value'         =>      $edital->getNumero_edital(),
                        'pattern'       =>      '\d{3}[\/]\d{4}',
                        'title'         =>      '999/9999'

                    ),

                    array(

                        'name'          =>      'total_vagas',
                        'id'            =>      'total_vagas',
                        'value'         =>      $edital->getTotal_vagas()

                    ),

                    array(

                        'name'          =>      'data_abertura',
                        'id'            =>      'data_abertura',
                        'placeholder'   =>      'Ex.: dd/mm/aaaa',
                        'value'         =>      $edital->getData_abertura(),
                        'pattern'       =>      '(((0[1-9]|[12]\d|3[01])\/(0[13578]|1[02])\/((19|[2-9]\d)\d{2}))|((0[1-9]|[12]\d|30)\/(0[13456789]|1[012])\/((19|[2-9]\d)\d{2}))|((0[1-9]|1\d|2[0-8])\/02\/((19|[2-9]\d)\d{2}))|(29\/02\/((1[6-9]|[2-9]\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))))',
                        'title'         =>      'dd/mm/aaaa'

                    ),

                    array(

                        'name'          =>      'data_encerramento',
                        'id'            =>      'data_encerramento',
                        'placeholder'   =>      'Ex.: dd/mm/aaaa',
                        'value'         =>      $edital->getData_encerramento(),
                        'pattern'       =>      '(((0[1-9]|[12]\d|3[01])\/(0[13578]|1[02])\/((19|[2-9]\d)\d{2}))|((0[1-9]|[12]\d|30)\/(0[13456789]|1[012])\/((19|[2-9]\d)\d{2}))|((0[1-9]|1\d|2[0-8])\/02\/((19|[2-9]\d)\d{2}))|(29\/02\/((1[6-9]|[2-9]\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))))',
                        'title'         =>      'dd/mm/aaaa'

                    ),

                    array(

                        'name'          =>      'opcao_destino',
                        'id'            =>      'opcao_destino',
                        'class'         =>      'regular-checkbox',
                        'value'         =>      '1',
                        'checked'       =>      TRUE,
                        'style'         =>      'margin:10px'

                    ),

                    array(

                        'name'          =>      'assistencia',
                        'id'            =>      'assistencia',
                        'class'         =>      'regular-checkbox',
                        'value'         =>      '1',
                        'checked'       =>      TRUE,
                        'style'         =>      'margin:10px'

                    )

                );
                break;

            default:
                break;
        }
        
        
        
        $config = array(
            array(
                'field'     =>      'numero_edital',
                'label'     =>      'Número do edital',
                'rules'     =>      'trim|required|xss_clean'
            ),
            array(
                'field'     =>      'total_vagas',
                'label'     =>      'Total de vagas',
                'rules'     =>      'trim|required|xss_clean'
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
                'label'     =>      'Opção de Destino',
                'rules'     =>      'xss_clean'
            ),
            array(
                'field'     =>      'assistencia',
                'label'     =>      'Assistência Estudantil',
                'rules'     =>      'xss_clean'
            )
        );
        
        $this->form_validation->set_rules($config);
        
        if($this->form_validation->run() == FALSE) {
            
            $this->load->view('/headers/header_logged_view', $data);
            $this->load->view('assessoria_edita_view', $this->view_data);
            $this->load->view('/footers/footer_view');
            
        } else {
            
            $data['titulo'] = "Confirmar Dados da Edição de Edital";
            
            $this->view_data['h1'] = "Confirmar edição do Edital";
            
            $this->view_data['paragrafo'] = "Por favor confira se os dados estão corretos";
            
            $this->view_data['url'] = "index.php/assessoria_edita_edital_controller/registrar";
            
            $this->view_data['label'] = array(
          
                0   =>  'Número do edital',
                1   =>  'Total de Vagas',
                2   =>  'Data de abertura',
                3   =>  'Data de encerramento',
                4   =>  'Opção de Destino',
                5   =>  'Assistência Estudantil'

            );
            
            $edital = new Edital_to();
            $edital->setId_edital($this->input->post('id_edital'));
            $edital->setNumero_edital($this->input->post('numero_edital'));
            $edital->setTotal_vagas($this->input->post('total_vagas'));
            $edital->setData_abertura($this->input->post('data_abertura'));
            $edital->setData_encerramento($this->input->post('data_encerramento'));
            $edital->setOpcao_destino($this->input->post('opcao_destino'));
            $edital->setAssistencia($this->input->post('assistencia'));
            
            $this->view_data['dados'] = array(
                
                'id_edital'             =>      $edital->getId_edital(),
                'numero_edital'         =>      $edital->getNumero_edital(),
                'total_vagas'           =>      $edital->getTotal_vagas(),
                'data_abertura'         =>      $edital->getData_abertura(),
                'data_encerramento'     =>      $edital->getData_encerramento(),
                'opcao_destino'         =>      $edital->getOpcao_destino(),
                'assistencia'           =>      $edital->getAssistencia()
                
            );
            
            $this->view_data['editar'] = 1;
            
            $this->load->view('/headers/header_confirm_view', $data);
            $this->load->view('assessoria_confirm_view', $this->view_data);
            $this->load->view('/footers/footer_view');
            
        }
        
    }
    
    public function registrar() {
        
        $edital = new Edital_to();
        $edital->setId_edital($this->input->post('id_edital'));
        $edital->setNumero_edital($this->input->post('numero_edital'));
        $edital->setTotal_vagas($this->input->post('total_vagas'));
        $edital->setData_abertura($this->input->post('data_abertura'));
        $edital->setData_encerramento($this->input->post('data_encerramento'));
        
        if($this->input->post('opcao_destino') == 1) {
            
            $edital->setOpcao_destino($this->input->post('opcao_destino'));
            
        } else {
            
            $edital->setOpcao_destino(0);
            
        }
        
        if($this->input->post('assistencia') == 1) {
            
            $edital->setAssistencia($this->input->post('assistencia'));
            
        } else {
            
            $edital->setAssistencia(0);
            
        }
        
        $numero_edital = $edital->getNumero_edital();
        
        $resultado = $this->edital_dao->updateEdital($edital);
        
        if($resultado) {
            
            $data['titulo'] = "Sucesso!!!";
            
            $this->view_data['mensagem_h3'] = "A edição do edital número ". $numero_edital . " foi realizada com sucesso!!";
            $this->view_data['mensagem_h4'] = "Para atualizar outro edital, <a href=\"". base_url() . "index.php/assessoria_edita_edital_controller\">clique aqui.</a>";
            
            $this->load->view('/headers/header_logged_view', $data);
            $this->load->view('assessoria_sucesso_view', $this->view_data);
            $this->load->view('/footers/footer_view');
            
        } else {
            
            $data['titulo'] = "Falha!!!";
            
            $this->view_data['mensagem_h3'] = "A edição do edital número " .$numero_edital. " falhou!! Verifique se os dados foram informados de forma correta e <a href=\"" . base_url() . "index.php/assessoria_edita_edital_controller\">tente novamente.</a>";
            
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
