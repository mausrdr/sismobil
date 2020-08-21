<?php

class Main_controller extends MY_controller {

    function __construct() {

        parent::__construct();

        $this->view_data['base_url'] = base_url();
        
        $this->load->model('assessoria_login_model');
        $this->load->model('aluno_login_model');
        $this->load->model('candidato_dao');
        $this->load->model('edital_dao');
        
    }

    function index($erro = FALSE) {

        $this->main($erro);
        
    }

    public function main($erro) {
        
        $data['titulo'] = "SISMOBIL - Sistema de Gerenciamento da Mobilidade Estudantil";
        
        $this->view_data['url'] = "index.php/main_controller/index/";
        $this->view_data['ativo'] = " class=\"active\"";
        
        $campo_edital = $this->edital_dao->getEditalAberto(date('Y-m-d'));
        
        if($campo_edital != FALSE) {
            
            $this->view_data['edital_aberto'] = TRUE;
            
            $options_edital = array('0' => 'Selecione um Edital');

            foreach($campo_edital as $edital) {

                $options_edital[$edital['id']] = $edital['numero'];

            }

            $this->view_data['options_edital'] = $options_edital;
            
        } else {
            
            $this->view_data['edital_aberto'] = FALSE;
            $this->view_data['codigo_acesso'] = array(
                'name'      =>  'codigo_acesso',
                'id'        =>  'codigo_acesso',
                'value'     =>  set_value('codigo_acesso')
            );
            
        }
        
        $this->view_data['cpf'] = array(
            'name'      =>      'cpf',
            'id'        =>      'cpf',
            'value'     =>      set_value('cpf')
        );
        $this->view_data['username'] = array(
            'name'      =>      'username',
            'id'        =>      'username',
            'value'     =>      set_value('username')
        );
        $this->view_data['senha'] = array(
            'name'      =>      'senha',
            'id'        =>      'senha',
            'value'     =>      set_value('senha')
        );
        
        if($this->input->post('aba') == 'assessoria') {
            
            $config = array(
                array(
                    'field'     =>      'username',
                    'label'     =>      'Usuário',
                    'rules'     =>      'trim|required|max_length[20]|xss_clean'
                ),
                array(
                    'field'     =>      'senha',
                    'label'     =>      'Senha',
                    'rules'     =>      'trim|required|max_legth[16]|min_legth[6]|xss_clean'
                )
            );
            
        } else {
            
            if($this->view_data['edital_aberto']) {
                
                $config = array(
                    array(
                        'field'     =>      'edital_id_edital',
                        'label'     =>      'Número do edital',
                        'rules'     =>      'trim|xss_clean|callback_validaEdital'
                    ),
                    array(
                        'field'     =>      'cpf',
                        'label'     =>      'CPF',
                        'rules'     =>      'trim|required|numeric|exact_length[11]|xss_clean|callback_validaCpf'
                    )
                );
                
            } else {
                
                $config = array(
                    array(
                        'field'     =>      'codigo_acesso',
                        'label'     =>      'Código de acesso',
                        'rules'     =>      'trim|required|xss_clean'
                    ),
                    array(
                        'field'     =>      'cpf',
                        'label'     =>      'CPF',
                        'rules'     =>      'trim|required|numeric|exact_length[11]|xss_clean|callback_validaCpf'
                    )
                );
                
            }
            
            
        }
        

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            // hasn't been run or there are validation errors
            $aba = $this->input->post('aba');
            
            if($aba == '') {
                $aba = $this->input->get('aba');
            }
            
            if(isset($aba) && $aba == 'assessoria') {
                
                $this->view_data['aba'] = $aba;
                if($erro) {
                    
                    $this->view_data['aba'] = TRUE;
                    $this->view_data['msg_erro'] = "Login Incorreto! Por favor tente novamente.";

                    $this->load->view('/headers/header_main_view', $data);
                    $this->load->view('main_view', $this->view_data);
                    $this->load->view('/footers/footer_view');

                } else {
                    
                    $this->view_data['aba'] = TRUE;
                    $this->load->view('/headers/header_main_view', $data);
                    $this->load->view('main_view', $this->view_data);
                    $this->load->view('/footers/footer_view');
                    
                }

            } else {
                
                if($erro) {
                    
                    $this->view_data['aba'] = FALSE;
                    $this->view_data['msg_erro'] = "Login Incorreto! Por favor tente novamente.";
                    $this->load->view('/headers/header_main_view', $data);
                    $this->load->view('main_view', $this->view_data);
                    $this->load->view('/footers/footer_view');
                    
                } else {
                    
                    $this->view_data['aba'] = FALSE;
                    $this->load->view('/headers/header_main_view', $data);
                    $this->load->view('main_view', $this->view_data);
                    $this->load->view('/footers/footer_view');
                    
                }

            }
            
            
        } else {
            
            $aba = $this->input->post('aba');
            if($aba == 'assessoria') {

                $username = $this->input->post('username');
                $senha = $this->input->post('senha');

                if($this->validaLoginAssessoria($username, $senha)) {

                    redirect("assessoria_inicio_controller/");

                } else {

                    $erro = TRUE;
                    redirect("main_controller/index/$erro/?aba=$aba");

                }

            } else {
                
                $edital_aberto = $this->input->post('edital_aberto');
                
                if($edital_aberto) {
                    
                    $cpf = $this->input->post('cpf');

                    $id_edital = $this->input->post('edital_id_edital');

                    /*
                     * A variável receberá os valores se haverá opções de destino e se será via assistência estudantil
                     */
                    $verif = $this->edital_dao->getOpcaoDestino($id_edital);

                    $verif .= $this->edital_dao->getAssistencia($id_edital);

                    if($this->cpfExiste($cpf)) {

                        redirect("aluno_login_controller/index/$cpf");

                    } else {

                        switch ($verif) {
                            case 00:
                                redirect("dados_pessoais_controller/index/?cpf=$cpf&id=$id_edital");
                                break;
                            case 01:
                                redirect("dados_pessoais_assistencia_controller/index/?cpf=$cpf&id=$id_edital");
                                break;
                            case 10:
                                redirect("dados_pessoais_opcao_controller/index/?cpf=$cpf&id=$id_edital");
                                break;
                            case 11:
                                redirect("dados_pessoais_opcao_assistencia_controller/index/?cpf=$cpf&id=$id_edital");
                                break;
                            default:
                                redirect("main_controller");
                                break;
                        }


                    }
                    
                } else {
                    
                    $cpf = $this->input->post('cpf');
                    
                    $codigo_acesso = $this->input->post('codigo_acesso');

                    if($this->validaLoginAluno($cpf, $codigo_acesso)) {

                        redirect("aluno_inicio_controller/index/");

                    } else {

                        $erro = TRUE;
                        redirect("main_controller/index/$erro");

                    }
                    
                }

            }
            
        }
        
    }
    
    

    public function validaCpf($cpf) {
        
        $this->form_validation->set_message('validaCpf', 'O %s é inválido. Por favor verifique se digitou seu CPF corretamente e tente novamente!');

        $nCpf = array();
        $somatorio1 = 0;
        $somatorio2 = 0;

        for ($i = 0; $i < 11; $i++) {

            $nCpf[$i] = $cpf{$i};
            if ($i < 9) {

                $somatorio1 += $nCpf[$i] * ($i + 1);
                $somatorio2 += $nCpf[$i] * (9 - $i);
            }
        }

        $verificador1 = ($somatorio1 % 11 == 10) ? 0 : $somatorio1 % 11;
        $verificador2 = ($somatorio2 % 11 == 10) ? 0 : $somatorio2 % 11;

        return ($verificador1 == $nCpf[9] && $verificador2 == $nCpf[10]);
    }
    
    function cpfExiste($cpf){
        
        if ($this->candidato_dao->candidatoExiste($cpf)) {
            
            return true;
            
        } else {
            
            return false;
            
        }
        
    }
    
    public function validaEdital($edital) {
        
        $this->form_validation->set_message('validaEdital', 'O campo %s é obrigatório');
        
        if($edital == 0) {
            
            return FALSE;
            
        }
        
        return TRUE;
        
    }
    
    public function validaLoginAssessoria($username, $senha) {
        
        if($this->assessoria_login_model->logar($username, $senha)) {
            
            return true;
            
        } else {
            
            return false;
            
        }
        
    }
    
    public function validaLoginAluno($cpf, $codigo_acesso) {
        
        if($this->aluno_login_model->logar($cpf, $codigo_acesso)) {
            
            return true;
            
        } else {
            
            return false;
            
        }
        
    }

}

