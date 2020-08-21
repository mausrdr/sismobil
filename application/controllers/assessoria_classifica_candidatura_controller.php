<?php

class Assessoria_classifica_candidatura_controller extends MY_controller {
    
    function __construct() {
        
        parent::__construct();
        
        $this->view_data['base_url'] = base_url();
        
        $this->load->model('assessoria_login_model', 'login_model');
        $this->load->model('ficha_candidatura_to');
        $this->load->model('ficha_candidatura_dao');
        $this->load->model('edital_dao');
        $this->load->model('universidade_dao');
        $this->load->model('campus_universidade_dao');
        $this->load->model('curso_universidade_dao');
        
    }
    
    public function index() {
        
        if($this->login_model->isLogado() === TRUE) {
            
            $this->form();
        
        } else {
            
            redirect('main_controller');
            
        }
        
    }
    
    public function form() {
        
        $data['titulo'] = "Selecionar Candidatura";
        
        $this->view_data['atributos'] = array(
            
            'name'      =>  'myform',
            'id'        =>  'myform'
            
        );
        
        $this->view_data['url'] = "index.php/assessoria_classifica_candidatura_controller/index";
        
        $this->view_data['legend'] = "Selecionar Candidatura";
        
        /* Carrega array para menu drop down do edital */
        $campo_edital = $this->edital_dao->getEdital();
        
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
            $this->load->view('assessoria_classifica_candidatura_view', $this->view_data);
            $this->load->view('/footers/footer_view');
            
        } else {
            
            $data['titulo'] = "Selecionar Candidatura";
            
            $this->view_data['url'] = "index.php/assessoria_classifica_candidatura_controller/index";
            $this->view_data['url_gera_pdf'] = "index.php/pdf_classificacao_controller";
            
            $id_edital = $this->input->post('edital_id_edital');
            
            $array = $this->ficha_candidatura_dao->listaFichaClassificar($id_edital);
            
            $i = 0;
            
            foreach ($array as $value) {
                
                $nome[$i] = $value['nome'];
                $cpf[$i] = $value['cpf'];
                $campus[$i] = $value['campus'];
                $cora[$i] = $value['cora'];
                $binario[$i] = $value['binario'];
                
                $i++;
                
            }
            
            for ($i = 0; $i < count($binario); $i++) {

                $binario[$i] = ltrim($binario[$i], '0');
                $binario[$i] = bindec($binario[$i]);
                
            }
            
            $lista = array(
                'nome'      =>      $nome,
                'cpf'       =>      $cpf,
                'campus'    =>      $campus,
                'cora'      =>      $cora,
                'binario'   =>      $binario
            );
            
            array_multisort($lista['campus'], SORT_ASC, $lista['cora'], SORT_DESC, $lista['binario'], SORT_DESC, $lista['nome'], $lista['cpf']);
            
            for ($i = 0; $i < count($lista['binario']); $i++) {

                $lista['binario'][$i] = decbin($lista['binario'][$i]);
                $lista['binario'][$i] = str_pad( $lista['binario'][$i], 5, '0', STR_PAD_LEFT );
                
            }
            
            $this->view_data['lista'] = $lista;
            $this->view_data['id_edital'] = $id_edital;
            $this->view_data['atributos1'] = array(
            
                'name'      =>  'myform1',
                'id'        =>  'myform1',
                'target'    =>  '_blank'

            );
            
            $this->load->view('/headers/header_matriz_view', $data);
            $this->load->view('assessoria_classifica_candidatura_view', $this->view_data);
            $this->load->view('/footers/footer_view');
            
        }
        
    }
    
    public function formCurso() {
        
        $id_ficha = $this->input->get('id');
        $id_edital = $this->ficha_candidatura_dao->getEditalCandidato($id_ficha);
        $nome_candidato = $this->ficha_candidatura_dao->getNomeCandidato($id_ficha);
        $numero_edital = $this->edital_dao->getNumeroEdital($id_edital);
        
        $verif = $this->edital_dao->getOpcaoDestino($id_edital);
        $verif .= $this->edital_dao->getAssistencia($id_edital);
        
        $this->view_data['id_ficha'] = $id_ficha;
        $this->view_data['id_edital'] = $id_edital;
        $this->view_data['nome_candidato'] = $nome_candidato;
        $this->view_data['numero_edital'] = $numero_edital;
        
        switch ($verif) {
            case 00:
            case 01:
                
                $data['titulo'] = "Vincular a Vaga ao aluno";
                
                /* Carrega array para menu drop down da universidade */
                $campo_universidade = $this->edital_has_curso_dao->pegaUniversidadeOpcao($id_edital);
        
                $options_universidade = array('0' => 'Selecione uma Universidade');

                foreach ($campo_universidade as $universidade) {

                    $options_universidade[$universidade['id']] = $universidade['descricao'];

                }

                /* Starta array para menu drop down do campus */
                $options_campus1 = array('0' => '– Escolha uma Universidade –');

                $this->view_data['options_campus1'] = $options_campus1;

                /* Starta array para menu drop down do curso */
                $options_curso = array('0' => '– Escolha um Câmpus –');

                $this->view_data['options_curso'] = $options_curso;
                
                $config = array(
                    array(
                        'field'     =>      'universidade',
                        'label'     =>      'Universidade',
                        'rules'     =>      'trim|required|xss_clean'
                    ),
                    array(
                        'field'     =>      'campus',
                        'label'     =>      'Câmpus',
                        'rules'     =>      'trim|required|xss_clean'
                    ),
                    array(
                        'field'     =>      'curso',
                        'label'     =>      'Curso',
                        'rules'     =>      'trim|required|xss_clean'
                    )
                );
                
                $this->form_validation->set_rules($config);
                
                if ($this->form_validation->run() == FALSE) {
                    
                    $this->load->view('/headers/header_matriz_view', $data);
                    $this->load->view('assessoria_seleciona_curso_view', $this->view_data);
                    $this->load->view('/footers/footer_view');
                    
                } else {
                    
                    $id_ficha = $this->input->post('id_ficha');
                    $id_edital = $this->input->post('id_edital');
                    $numero_edital = $this->input->post('numero_edital');
                    $nome_candidato = $this->input->post('nome_candidato');
                    $id_universidade = $this->input->post('universidade');
                    $id_campus = $this->input->post('campus');
                    $id_curso = $this->input->post('curso');
                    
                    $descricao_universidade = $this->universidade_dao->getDescricaoUniversidade($id_universidade);
                    $descricao_campus = $this->campus_universidade_dao->getDescricaoCampus($id_campus);
                    $descricao_curso = $this->curso_universidade_dao->getDescricaoCurso($id_curso);
                    
                    $this->view_data['id_ficha'] = $id_ficha;
                    $this->view_data['id_edital'] = $id_edital;
                    $this->view_data['nome_candidato'] = $nome_candidato;
                    $this->view_data['numero_edital'] = $numero_edital;
                    $this->view_data['descricao_universidade'] = $descricao_universidade;
                    $this->view_data['descricao_campus'] = $descricao_campus;
                    $this->view_data['descricao_curso'] = $descricao_curso;
                    
                    $this->load->view('/headers/header_matriz_view', $data);
                    $this->load->view('assessoria_candidatura_view', $this->view_data);
                    $this->load->view('/footers/footer_view');
                    
                }

                break;

            default:
                break;
        }
        
    }

    public function selecionar() {
        
        $id_ficha = $this->input->get('id');
        
        if($this->ficha_candidatura_dao->aceite($id_ficha)) {
            
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
