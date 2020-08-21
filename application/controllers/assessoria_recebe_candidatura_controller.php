<?php

class Assessoria_recebe_candidatura_controller extends MY_controller {
    
    function __construct() {
        
        parent::__construct();
        
        $this->view_data['base_url'] = base_url();
        
        $this->load->model('assessoria_login_model', 'login_model');
        $this->load->model('ficha_candidatura_to');
        $this->load->model('ficha_candidatura_dao');
        $this->load->model('classificacao_to');
        $this->load->model('classificacao_dao');
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
        
        $data['titulo'] = "Receber Candidatura";
        
        $this->view_data['atributos'] = array(
            
            'name'      =>  'myform',
            'id'        =>  'myform'
            
        );
        
        $this->view_data['url'] = "index.php/assessoria_recebe_candidatura_controller/index";
        
        $this->view_data['legend'] = "Receber Candidatura";
        
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
            $this->load->view('assessoria_recebe_candidatura_main_view', $this->view_data);
            $this->load->view('/footers/footer_view');
            
        } else {
            
            $data['titulo'] = "Receber Candidatura";
            
            $this->view_data['url'] = "index.php/assessoria_recebe_candidatura_controller/index";
            $this->view_data['url_receber'] = "index.php/assessoria_recebe_candidatura_controller/formreceber";
            $this->view_data['url_indeferir'] = "index.php/assessoria_recebe_candidatura_controller/formindeferir";
            
            $id_edital = $this->input->post('edital_id_edital');
            
            $lista = $this->ficha_candidatura_dao->listaFichaReceber($id_edital);
            
            $this->view_data['lista'] = $lista;
            
            $this->load->view('/headers/header_matriz_view', $data);
            $this->load->view('assessoria_recebe_candidatura_main_view', $this->view_data);
            $this->load->view('/footers/footer_view');
            
        }
        
    }
    
    public function formindeferir() {
        
        if($this->login_model->isLogado() === TRUE) {
            
            $id_ficha = $this->input->get('id');

            $dados = $this->ficha_candidatura_dao->getDadosReceber($id_ficha);

            $this->view_data['nome'] = array(
                'name'      =>  'nome',
                'id'        =>  'nome',
                'value'     =>  $dados[0]['nome'],
                'readonly'  =>  '0'
            );
            $this->view_data['cpf'] = array(
                'name'      =>  'cpf',
                'id'        =>  'cpf',
                'value'     =>  $dados[0]['cpf'],
                'readonly'  =>  '0'
            );
            $this->view_data['bic'] = array(
                'name'      =>  'bic',
                'id'        =>  'bic',
                'class'     =>  'regular-checkbox',
                'value'     =>  '1',
                'checked'   =>  $dados[0]['bic'],
                'style'     =>  'margin:10px'
            );
            $this->view_data['pvpp'] = array(
                'name'      =>  'pvpp',
                'id'        =>  'pvpp',
                'class'     =>  'regular-checkbox',
                'value'     =>  '1',
                'checked'   =>  $dados[0]['pvpp'],
                'style'     =>  'margin:10px'
            );
            $this->view_data['po'] = array(
                'name'      =>  'po',
                'id'        =>  'po',
                'class'     =>  'regular-checkbox',
                'value'     =>  '1',
                'checked'   =>  $dados[0]['po'],
                'style'     =>  'margin:10px'
            );
            $this->view_data['estagio'] = array(
                'name'      =>  'estagio',
                'id'        =>  'estagio',
                'class'     =>  'regular-checkbox',
                'value'     =>  '1',
                'checked'   =>  $dados[0]['estagio'],
                'style'     =>  'margin:10px'
            );
            $this->view_data['ecc'] = array(
                'name'      =>  'ecc',
                'id'        =>  'ecc',
                'class'     =>  'regular-checkbox',
                'value'     =>  '1',
                'checked'   =>  $dados[0]['ecc'],
                'style'     =>  'margin:10px'
            );
            $this->view_data['justificativa'] = array(
                'name'      =>  'justificativa',
                'id'        =>  'justificativa',
                'rows'      =>  '8',
                'cols'      =>  '142',
                'value'     =>  set_value('justificativa')
            );
            $this->view_data['hidden'] = array(
                'id_ficha'  =>  $id_ficha
            );

            $data['titulo'] = "Indeferir Candidatura";

            $this->view_data['atributos'] = array(

                'name'      =>  'myform',
                'id'        =>  'myform'

            );

            $this->view_data['url'] = "index.php/assessoria_recebe_candidatura_controller/formindeferir/?id=$id_ficha";

            $this->view_data['legend'] = "Indeferir Candidatura";

            $config = array(
                array(
                'field'     =>      'bic',
                'label'     =>      'Bolsa de Iniciação Científica',
                'rules'     =>      'trim|xss_clean'
                ),
                array(
                'field'     =>      'pvpp',
                'label'     =>      'Participação Voluntária de Projeto de Pesquisa',
                'rules'     =>      'trim|xss_clean'
                ),
                array(
                'field'     =>      'po',
                'label'     =>      'Participação em Olimpíadas de Conhecimento',
                'rules'     =>      'trim|xss_clean'
                ),
                array(
                'field'     =>      'estagio',
                'label'     =>      'Estágio na Área do Curso',
                'rules'     =>      'trim|xss_clean'
                ),
                array(
                'field'     =>      'ecc',
                'label'     =>      'Eventos Científicos ou Congressos',
                'rules'     =>      'trim|xss_clean'
                ),
                array(
                'field'     =>      'justificativa',
                'label'     =>      'Justificativa',
                'rules'     =>      'trim|required|xss_clean'
                )
            );

            $this->form_validation->set_rules($config);

            if($this->form_validation->run() == FALSE) {

                $this->load->view('/headers/header_recebe_view', $data);
                $this->load->view('assessoria_indefere_candidatura_view', $this->view_data);
                $this->load->view('/footers/footer_view');

            } else {

                $id_ficha = $this->input->post('id_ficha');
                $nome = $this->input->post('nome');
                $cpf = $this->input->post('cpf');
                $justificativa = $this->input->post('justificativa');

                $classificacao = new Classificacao_to();
                $classificacao->setCandidato_id_candidato($this->ficha_candidatura_dao->getCandidatoId($id_ficha));
                $classificacao->setBic($this->input->post('bic'));
                $classificacao->setPvpp($this->input->post('pvpp'));
                $classificacao->setPo($this->input->post('po'));
                $classificacao->setEstagio($this->input->post('estagio'));
                $classificacao->setEcc($this->input->post('ecc'));

                $data['titulo'] = "Confirmar Dados do Indeferimento da Candidatura";

                $this->view_data['h1'] = "Confirmação dos dados";
                $this->view_data['paragrafo'] = "Por favor confira se os dados estão corretos";
                $this->view_data['url'] = "index.php/assessoria_recebe_candidatura_controller/indeferir";
                $this->view_data['dados'] = array(

                    'id_ficha'      =>  $id_ficha,
                    'candidato_id'  =>  $classificacao->getCandidato_id_candidato(),
                    'nome'          =>  $nome,
                    'cpf'           =>  $cpf,
                    'bic'           =>  $classificacao->getBic(),
                    'pvpp'          =>  $classificacao->getPvpp(),
                    'po'            =>  $classificacao->getPo(),
                    'estagio'       =>  $classificacao->getEstagio(),
                    'ecc'           =>  $classificacao->getEcc(),
                    'justificativa' =>  $justificativa

                );
                $this->view_data['label'] = array(

                    0   =>  'Nome',
                    1   =>  'CPF',
                    2   =>  'Bolsa de Iniciação Científica',
                    3   =>  'Participação Voluntária de Projeto de Pesquisa',
                    4   =>  'Participação em Olimpíadas de Conhecimento',
                    5   =>  'Estágio na Área do Curso',
                    6   =>  'Eventos Científicos ou Congressos',
                    7   =>  'Justificativa'

                );

                $this->load->view('/headers/header_confirm_view', $data);
                $this->load->view('assessoria_indefere_confirm_view', $this->view_data);
                $this->load->view('/footers/footer_view');

            }
            
        } else {
            
            redirect('main_controller');
            
        }
        
    }

    public function formreceber() {
        
        if($this->login_model->isLogado() === TRUE) {
            
            $id_ficha = $this->input->get('id');

            $dados = $this->ficha_candidatura_dao->getDadosReceber($id_ficha);

            $this->view_data['nome'] = array(
                'name'      =>  'nome',
                'id'        =>  'nome',
                'value'     =>  $dados[0]['nome'],
                'readonly'  =>  '0'
            );
            $this->view_data['cpf'] = array(
                'name'      =>  'cpf',
                'id'        =>  'cpf',
                'value'     =>  $dados[0]['cpf'],
                'readonly'  =>  '0'
            );
            $this->view_data['bic'] = array(
                'name'      =>  'bic',
                'id'        =>  'bic',
                'class'     =>  'regular-checkbox',
                'value'     =>  '1',
                'checked'   =>  $dados[0]['bic'],
                'style'     =>  'margin:10px'
            );
            $this->view_data['pvpp'] = array(
                'name'      =>  'pvpp',
                'id'        =>  'pvpp',
                'class'     =>  'regular-checkbox',
                'value'     =>  '1',
                'checked'   =>  $dados[0]['pvpp'],
                'style'     =>  'margin:10px'
            );
            $this->view_data['po'] = array(
                'name'      =>  'po',
                'id'        =>  'po',
                'class'     =>  'regular-checkbox',
                'value'     =>  '1',
                'checked'   =>  $dados[0]['po'],
                'style'     =>  'margin:10px'
            );
            $this->view_data['estagio'] = array(
                'name'      =>  'estagio',
                'id'        =>  'estagio',
                'class'     =>  'regular-checkbox',
                'value'     =>  '1',
                'checked'   =>  $dados[0]['estagio'],
                'style'     =>  'margin:10px'
            );
            $this->view_data['ecc'] = array(
                'name'      =>  'ecc',
                'id'        =>  'ecc',
                'class'     =>  'regular-checkbox',
                'value'     =>  '1',
                'checked'   =>  $dados[0]['ecc'],
                'style'     =>  'margin:10px'
            );
            $this->view_data['hidden'] = array(
                'id_ficha'  =>  $id_ficha
            );

            $data['titulo'] = "Receber Candidatura";

            $this->view_data['atributos'] = array(

                'name'      =>  'myform',
                'id'        =>  'myform'

            );
            $this->view_data['url'] = "index.php/assessoria_recebe_candidatura_controller/receber/?id=$id_ficha";
            $this->view_data['legend'] = "Receber Candidatura";

            $config = array(
                array(
                'field'     =>      'bic',
                'label'     =>      'Bolsa de Iniciação Científica',
                'rules'     =>      'trim|xss_clean'
                ),
                array(
                'field'     =>      'pvpp',
                'label'     =>      'Participação Voluntária de Projeto de Pesquisa',
                'rules'     =>      'trim|xss_clean'
                ),
                array(
                'field'     =>      'po',
                'label'     =>      'Participação em Olimpíadas de Conhecimento',
                'rules'     =>      'trim|xss_clean'
                ),
                array(
                'field'     =>      'estagio',
                'label'     =>      'Estágio na Área do Curso',
                'rules'     =>      'trim|xss_clean'
                ),
                array(
                'field'     =>      'ecc',
                'label'     =>      'Eventos Científicos ou Congressos',
                'rules'     =>      'trim|xss_clean'
                )
            );

            $this->form_validation->set_rules($config);

            if($this->form_validation->run() == FALSE) {

                $this->load->view('/headers/header_recebe_view', $data);
                $this->load->view('assessoria_recebe_candidatura_view', $this->view_data);
                $this->load->view('/footers/footer_view');

            } else {

                $id_ficha = $this->input->post('id_ficha');
                $nome = $this->input->post('nome');
                $cpf = $this->input->post('cpf');

                $classificacao = new Classificacao_to();
                $classificacao->setCandidato_id_candidato($this->ficha_candidatura_dao->getCandidatoId($id_ficha));
                $classificacao->setBic($this->input->post('bic'));
                $classificacao->setPvpp($this->input->post('pvpp'));
                $classificacao->setPo($this->input->post('po'));
                $classificacao->setEstagio($this->input->post('estagio'));
                $classificacao->setEcc($this->input->post('ecc'));

                $data['titulo'] = "Confirmar Dados do Indeferimento da Candidatura";

                $this->view_data['h1'] = "Confirmação dos dados";
                $this->view_data['paragrafo'] = "Por favor confira se os dados estão corretos";
                $this->view_data['url'] = "index.php/assessoria_recebe_candidatura_controller/indeferir";
                $this->view_data['dados'] = array(

                    'id_ficha'      =>  $id_ficha,
                    'candidato_id'  =>  $classificacao->getCandidato_id_candidato(),
                    'nome'          =>  $nome,
                    'cpf'           =>  $cpf,
                    'bic'           =>  $classificacao->getBic(),
                    'pvpp'          =>  $classificacao->getPvpp(),
                    'po'            =>  $classificacao->getPo(),
                    'estagio'       =>  $classificacao->getEstagio(),
                    'ecc'           =>  $classificacao->getEcc(),

                );
                $this->view_data['label'] = array(

                    0   =>  'Nome',
                    1   =>  'CPF',
                    2   =>  'Bolsa de Iniciação Científica',
                    3   =>  'Participação Voluntária de Projeto de Pesquisa',
                    4   =>  'Participação em Olimpíadas de Conhecimento',
                    5   =>  'Estágio na Área do Curso',
                    6   =>  'Eventos Científicos ou Congressos',

                );

                $this->load->view('/headers/header_confirm_view', $data);
                $this->load->view('assessoria_recebe_confirm_view', $this->view_data);
                $this->load->view('/footers/footer_view');

            }
            
        } else {
            
            redirect('main_controller');
            
        }
        
    }
    
    public function indeferir() {
        
        $id_ficha = $this->input->post('id_ficha');
        $justificativa = $this->input->post('justificativa');
        
        $classificacao = new Classificacao_to();
        $classificacao->setCandidato_id_candidato($this->input->post('candidato_id'));
        if($this->input->post('bic') == 1) {
            
            $classificacao->setBic($this->input->post('bic'));
            
        } else {
            
            $classificacao->setBic(0);
            
        }
        if($this->input->post('pvpp') == 1) {
            
            $classificacao->setPvpp($this->input->post('pvpp'));
            
        } else {
            
            $classificacao->setPvpp(0);
            
        }
        if($this->input->post('po') == 1) {
            
            $classificacao->setPo($this->input->post('po'));
            
        } else {
            
            $classificacao->setPo(0);
            
        }
        if($this->input->post('estagio') == 1) {
            
            $classificacao->setEstagio($this->input->post('estagio'));
            
        } else {
            
            $classificacao->setEstagio(0);
            
        }
        if($this->input->post('ecc') == 1) {
            
            $classificacao->setEcc($this->input->post('ecc'));
            
        } else {
            
            $classificacao->setEcc(0);
            
        }
        
        if($this->ficha_candidatura_dao->indefere($id_ficha, $justificativa, $classificacao) && $this->classificacao_dao->update($classificacao)) {
                
                $data['titulo'] = "Sucesso!!!";

                $this->view_data['mensagem_h3'] = "A cadidatura foi indeferida com sucesso!!";
                $this->view_data['mensagem_h4'] = "Para indeferir outra candidatura ou realizar um aceite, <a href=\"". base_url() . "index.php/assessoria_recebe_candidatura_controller/index\">clique aqui.</a>";

                $this->load->view('/headers/header_logged_view', $data);
                $this->load->view('assessoria_sucesso_view', $this->view_data);
                $this->load->view('/footers/footer_view');
                
            } else {
                
                $data['titulo'] = "Falha!!!";

                $this->view_data['mensagem_h3'] = "O indeferimento Falhou!! Verifique se os dados foram informados de forma correta e <a href=\"" . base_url() . "index.php/assessoria_recebe_candidatura_controller/index\">tente novamente.</a>";

                $this->load->view('/headers/header_logged_view', $data);
                $this->load->view('assessoria_falha_view', $this->view_data);
                $this->load->view('/footers/footer_view');
                
            }
        
    }
    
    public function receber() {
        
        $id_ficha = $this->input->post('id_ficha');
        
        $classificacao = new Classificacao_to();
        $classificacao->setCandidato_id_candidato($this->input->post('candidato_id'));
        if($this->input->post('bic') == 1) {
            
            $classificacao->setBic($this->input->post('bic'));
            
        } else {
            
            $classificacao->setBic(0);
            
        }
        if($this->input->post('pvpp') == 1) {
            
            $classificacao->setPvpp($this->input->post('pvpp'));
            
        } else {
            
            $classificacao->setPvpp(0);
            
        }
        if($this->input->post('po') == 1) {
            
            $classificacao->setPo($this->input->post('po'));
            
        } else {
            
            $classificacao->setPo(0);
            
        }
        if($this->input->post('estagio') == 1) {
            
            $classificacao->setEstagio($this->input->post('estagio'));
            
        } else {
            
            $classificacao->setEstagio(0);
            
        }
        if($this->input->post('ecc') == 1) {
            
            $classificacao->setEcc($this->input->post('ecc'));
            
        } else {
            
            $classificacao->setEcc(0);
            
        }
        
        if($this->ficha_candidatura_dao->recebee($id_ficha, $classificacao) && $this->classificacao_dao->update($classificacao)) {

            $data['titulo'] = "Sucesso!!!";

            $this->view_data['mensagem_h3'] = "O aceite foi realizado com sucesso!!";
            $this->view_data['mensagem_h4'] = "Para realizar outro  aceite, <a href=\"". base_url() . "index.php/assessoria_recebe_candidatura_controller/index\">clique aqui.</a>";

            $this->load->view('/headers/header_logged_view', $data);
            $this->load->view('assessoria_sucesso_view', $this->view_data);
            $this->load->view('/footers/footer_view');

        } else {

            $data['titulo'] = "Falha!!!";

            $this->view_data['mensagem_h3'] = "O aceite falhou!! Verifique se os dados foram informados de forma correta e <a href=\"" . base_url() . "index.php/assessoria_recebe_candidatura_controller/index\">tente novamente.</a>";

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
    
}

?>
