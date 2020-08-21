<?php

class Dados_pessoais_controller extends MY_controller {
    
    function __construct() {
        
        parent::__construct();
        
        $this->view_data['base_url'] = base_url();
        
        $this->load->model('candidato_to');
        $this->load->model('candidato_dao');
        $this->load->model('curso_origem_to');
        $this->load->model('curso_origem_dao');
        $this->load->model('curso_dao');
        $this->load->model('campus_to');
        $this->load->model('campus_dao');
        $this->load->model('origem_to');
        $this->load->model('origem_dao');
        $this->load->model('tipo_atividade_to');
        $this->load->model('tipo_atividade_dao');
        $this->load->model('atividade_has_tipo_atividade_to');
        $this->load->model('atividade_has_tipo_atividade_dao');
        $this->load->model('atividade_to');
        $this->load->model('atividade_dao');
        $this->load->model('mobilidade_to');
        $this->load->model('mobilidade_dao');
        $this->load->model('financiamento_to');
        $this->load->model('financiamento_dao');
        $this->load->model('tipo_financiamento_to');
        $this->load->model('tipo_financiamento_dao');
        $this->load->model('linguas_to');
        $this->load->model('linguas_dao');
        $this->load->model('lingua_alternativa_to');
        $this->load->model('lingua_alternativa_dao');
        $this->load->model('fluencia_linguistica_to');
        $this->load->model('fluencia_linguistica_dao');
        $this->load->model('carta_motivacao_to');
        $this->load->model('carta_motivacao_dao');
        $this->load->model('extracurricular_to');
        $this->load->model('extracurricular_dao');
        $this->load->model('conhecimentos_linguisticos_to');
        $this->load->model('conhecimentos_linguisticos_dao');
        $this->load->model('lingua_alternativa_has_linguas_to');
        $this->load->model('lingua_alternativa_has_linguas_dao');
        $this->load->model('edital_has_curso_to');
        $this->load->model('edital_has_curso_dao');
        $this->load->model('ficha_to');
        $this->load->model('ficha_dao');
        $this->load->model('ficha_candidatura_to');
        $this->load->model('ficha_candidatura_dao');
        $this->load->model('ficha_curso_to');
        $this->load->model('ficha_curso_dao');
        
    }
    
    /**
     * 
     * @param type $cpf
     */
    function index() {
        
        $cpf = $this->input->get('cpf');
        $id_edital = $this->input->get('id');
        $this->form($cpf, $id_edital);
        
    }
    
    /**
     * 
     * @param type $cpf
     */
    public function form($cpf, $id_edital) {

        $this->view_data['ncpf'] = $cpf;
        $this->view_data['id_edital'] = $id_edital;
        $this->view_data['lista_campus'] = $this->campus_dao->pegaCampus();
        $this->view_data['lista_financiamento'] = $this->tipo_financiamento_dao->listaTipoFinanciamento();
        $this->view_data['lista_idioma'] = $this->linguas_dao->listaLinguas();
        
        $options_curso_origem = array('0' => '– Escolha um Câmpus –');
        
        $this->view_data['options_curso_origem'] = $options_curso_origem;

        $config = array(
            array(
                'field'     =>      'nome',
                'label'     =>      'Nome',
                'rules'     =>      'trim|required|xss_clean'
            ),
            array(
                'field'     =>      'sexo',
                'label'     =>      'Sexo',
                'rules'     =>      'required|xss_clean'
            ),
            array(
                'field'     =>      'endereco',
                'label'     =>      'Endereço',
                'rules'     =>      'trim|required|xss_clean'
            ),
            array(
                'field'     =>      'numero',
                'label'     =>      'Número',
                'rules'     =>      'trim|required|numeric|xss_clean'
            ),
            array(
                'field'     =>      'complemento',
                'label'     =>      'Complemento',
                'rules'     =>      'trim|xss_clean'
            ),
            array(
                'field'     =>      'bairro',
                'label'     =>      'Bairro',
                'rules'     =>      'trim|required|xss_clean'
            ),
            array(
                'field'     =>      'cidade',
                'label'     =>      'Cidade',
                'rules'     =>      'trim|required|xss_clean'
            ),
            array(
                'field'     =>      'cep',
                'label'     =>      'CEP',
                'rules'     =>      'trim|required|xss_clean'
            ),
            array(
                'field'     =>      'estado',
                'label'     =>      'Estado',
                'rules'     =>      'trim|required|xss_clean'
            ),
            array(
                'field'     =>      'pais',
                'label'     =>      'País',
                'rules'     =>      'trim|required|xss_clean'
            ),
            array(
                'field'     =>      'telefone',
                'label'     =>      'Telefone',
                'rules'     =>      'trim|required|xss_clean'
            ),
            array(
                'field'     =>      'celular',
                'label'     =>      'Celular',
                'rules'     =>      'trim|required|xss_clean'
            ),
            array(
                'field'     =>      'rg',
                'label'     =>      'RG',
                'rules'     =>      'trim|required|xss_clean'
            ),
            array(
                'field'     =>      'data_expedicao',
                'label'     =>      'Data de Expedição',
                'rules'     =>      'trim|required|exact_length[10]|xss_clean'
            ),
            array(
                'field'     =>      'orgao_emissor',
                'label'     =>      'Órgão Emissor',
                'rules'     =>      'trim|required|xss_clean'
            ),
            array(
                'field'     =>      'cpf',
                'label'     =>      'CPF',
                'rules'     =>      'trim|required|numeric|exact_length[11]|xss_clean'
            ),
            array(
                'field'     =>      'passaporte',
                'label'     =>      'Passaporte',
                'rules'     =>      'trim|required|alpha_numeric|exact_length[8]|xss_clean'
            ),
            array(
                'field'     =>      'nacionalidade',
                'label'     =>      'Nacionalidade',
                'rules'     =>      'trim|required|xss_clean'
            ),
            array(
                'field'     =>      'email',
                'label'     =>      'Email',
                'rules'     =>      'trim|required|valid_email|xss_clean'
            ),
            array(
                'field'     =>      'data_nascimento',
                'label'     =>      'Data de Nascimento',
                'rules'     =>      'required|xss_clean'
            ),
            array(
                'field'     =>      'campus',
                'label'     =>      'Câmpus',
                'rules'     =>      'trim|required|xss_clean|callback_validaCampus'
            ),
            array(
                'field'     =>      'curso_id_curso',
                'label'     =>      'Curso',
                'rules'     =>      'trim|required|xss_clean|callback_validaCurso'
            ),
            array(
                'field'     =>      'semestre_atual',
                'label'     =>      'Semestre Atual',
                'rules'     =>      'trim|required|xss_clean'
            ),
            array(
                'field'     =>      'semestre_total',
                'label'     =>      'Total de Semestres a Serem Cursados',
                'rules'     =>      'trim|required|xss_clean|callback_validaSemestre[semestre_atual]'
            ),
            array(
                'field'     =>      'media_geral',
                'label'     =>      'Média Geral das Disciplinas Cursadas',
                'rules'     =>      'trim|required|xss_clean'
            ),
            array(
                'field'     =>      'coordenador',
                'label'     =>      'Coordenador do Curso',
                'rules'     =>      'trim|required|xss_clean'
            ),
            array(
                'field'     =>      'diretor',
                'label'     =>      'Diretor do Câmpus de Origem',
                'rules'     =>      'trim|required|xss_clean'
            ),
            array(
                'field'     =>      'telefone_campus',
                'label'     =>      'Telefone do Câmpus',
                'rules'     =>      'trim|required|xss_clean'
            ),
            array(
                'field'     =>      'fax',
                'label'     =>      'Fax do Câmpus',
                'rules'     =>      'trim|required|xss_clean'
            ),
            array(
                'field'     =>      'periodo',
                'label'     =>      'Período de Estudos Pretendido no Exterior',
                'rules'     =>      'trim|required|xss_clean'
            ),
            array(
                'field'     =>      'tipo_atividade[]',
                'label'     =>      'Tipo de Atividade',
                'rules'     =>      'xss_clean|callback_validaCheck'
            ),
            array(
                'field'     =>      'informacoes',
                'label'     =>      'Informações',
                'rules'     =>      'required|xss_clean'
            ),
            array(
                'field'     =>      'materna',
                'label'     =>      'Língua Materna',
                'rules'     =>      'trim|required|xss_clean'
            ),
            array(
                'field'     =>      'lingua_alternativa1',
                'label'     =>      'Conhecimento de Outras Línguas',
                'rules'     =>      'trim|required|xss_clean'
            ),
            array(
                'field'     =>      'fluencia1',
                'label'     =>      'Conhecimento de Outras Línguas',
                'rules'     =>      'required|xss_clean'
            ),
            array(
                'field'     =>      'financiamento',
                'label'     =>      'Como Será Financiado as Despesas',
                'rules'     =>      'trim|required|xss_clean|callback_validaFinanciamento'
            ),
            array(
                'field'     =>      'carta',
                'label'     =>      'Carta',
                'rules'     =>      'trim|required|xss_clean'
            ),
            array(
                'field'     =>      'iniciacao',
                'label'     =>      'Atividade 1',
                'rules'     =>      'trim|xss_clean'
            ),
            array(
                'field'     =>      'extensao',
                'label'     =>      'Atividade 2',
                'rules'     =>      'trim|xss_clean'
            ),
        );
        
        $this->form_validation->set_rules($config);
        
        if ($this->form_validation->run() == FALSE) {
            // hasn't been run or there are validation errors
            $this->view_data['sexo'] = $this->input->post('sexo');
            
            $this->view_data['tipo_atividade'] = $this->input->post('tipo_atividade');
            
            $this->view_data['fluencia1'] = $this->input->post('fluencia1');
            
            $this->load->view('dados_pessoais_view', $this->view_data);
            
        } else {
                        
            $candidato = new Candidato_to();
            $candidato->setNome($this->input->post('nome'));
            $candidato->setSexo($this->input->post('sexo'));
            $candidato->setEndereco($this->input->post('endereco'));
            $candidato->setNumero($this->input->post('numero'));
            $candidato->setComplemento($this->input->post('complemento'));
            $candidato->setBairro($this->input->post('bairro'));
            $candidato->setCidade($this->input->post('cidade'));
            $candidato->setCep($this->input->post('cep'));
            $candidato->setEstado($this->input->post('estado'));
            $candidato->setPais($this->input->post('pais'));
            $candidato->setTelefone($this->input->post('telefone'));
            $candidato->setCelular($this->input->post('celular'));
            $candidato->setRg($this->input->post('rg'));
            $candidato->setData_expedicao($this->input->post('data_expedicao'));
            $candidato->setOrgao_emissor($this->input->post('orgao_emissor'));
            $candidato->setCpf($this->input->post('cpf'));
            $candidato->setPassaporte($this->input->post('passaporte'));
            $candidato->setNacionalidade($this->input->post('nacionalidade'));
            $candidato->setEmail($this->input->post('email'));
            $candidato->setData_nascimento($this->input->post('data_nascimento'));
            
            $this->view_data['candidato'] = $candidato;
            
            $curso_origem = new Curso_origem_to();
            $curso_origem->setCurso_id_curso($this->input->post('curso_id_curso'));
            $curso_origem->setSemestre_total($this->input->post('semestre_total'));
            $curso_origem->setMedia_geral($this->input->post('media_geral'));
            $curso_origem->setCoordenador($this->input->post('coordenador'));
            
            $this->view_data['curso_origem'] = $curso_origem;
            
            $descricao_curso_origem = $this->curso_dao->getDescricaoCurso($curso_origem->getCurso_id_curso());
            
            $this->view_data['descricao_curso_origem'] = $descricao_curso_origem;
            
            $campus = new Campus_to();
            $campus->setId_campus($this->input->post('campus'));
            $campus->setNome_campus($this->campus_dao->pegaNomeCampus($campus->getId_campus()));
            $campus->setDiretor($this->input->post('diretor'));
            $campus->setTelefone_campus($this->input->post('telefone_campus'));
            $campus->setFax($this->input->post('fax'));
            
            $this->view_data['campus'] = $campus;
            
            $origem = new Origem_to();
            $origem->setSemestre_atual($this->input->post('semestre_atual'));
            
            $this->view_data['origem'] = $origem;
            
            $tipo = $this->input->post('tipo_atividade');
            
            $tipo_atividade = array();
                
            for ($i = 0; $i < count($tipo); $i++) {
                    
                $tipo_atividade[$i] = new Tipo_atividade_to();
                $tipo_atividade[$i]->setId_tipo_atividade($tipo[$i]);
                $tipo_atividade[$i]->setDescricao_atividade($this->tipo_atividade_dao->pegaDescricao($tipo_atividade[$i]->getId_tipo_atividade()));
                
                $this->view_data['tipo_atividade'][$i] = $tipo_atividade[$i];
                    
            }
            
            $mobilidade = new Mobilidade_to();
            $mobilidade->setPeriodo($this->input->post('periodo'));
            $mobilidade->setInformacoes($this->input->post('informacoes'));
            
            $this->view_data['mobilidade'] = $mobilidade;
            
            $lingua_materna = new Linguas_to();
            $lingua_materna->setId_linguas($this->input->post('materna'));
            $lingua_materna->setDescricao_linguas($this->linguas_dao->pegaLingua($lingua_materna->getId_linguas()));
            
            $this->view_data['lingua_materna'] = $lingua_materna;
            
            $quantidade_idiomas = $this->input->post('quantidade_idiomas');
            
            for($i = 0; $i < $quantidade_idiomas; $i++) {
                
                $post_lingua_str = 'lingua_alternativa';
                $post_fluencia_str = 'fluencia';
                $post_lingua_str .= $i+1;
                $post_fluencia_str .= $i+1;
                $lingua_alternativa[$i] = new Linguas_to();
                $lingua_alternativa[$i]->setId_linguas($this->input->post($post_lingua_str));
                $lingua_alternativa[$i]->setDescricao_linguas($this->linguas_dao->pegaLingua($lingua_alternativa[$i]->getId_linguas()));
                $fluencia_linguistica[$i] = new Fluencia_linguistica_to();
                $fluencia_linguistica[$i]->setId_fluencia_linguistica($this->input->post($post_fluencia_str));
                $fluencia_linguistica[$i]->setDescricao_fluencia($this->fluencia_linguistica_dao->pegaFluencia($fluencia_linguistica[$i]->getId_fluencia_linguistica()));
                
                $this->view_data['lingua_alternativa'][$i] = $lingua_alternativa[$i];
                $this->view_data['fluencia_linguistica'][$i] = $fluencia_linguistica[$i];
                
                if($i + 1 == $quantidade_idiomas)
                    $this->view_data['quantidade_idiomas'] = $quantidade_idiomas;
                
            }
            
            $financiamento = new Tipo_financiamento_to();
            $financiamento->setId_tipo_financiamento($this->input->post('financiamento'));
            $financiamento->setDescricao_financiamento($this->tipo_financiamento_dao->pegaTipoFinanciamento($financiamento->getId_tipo_financiamento()));
            
            $this->view_data['financiamento'] = $financiamento;
            
            $carta_motivacao = new Carta_motivacao_to();
            $carta_motivacao->setCarta($this->input->post('carta'));
            /*$carta = "<pre>";
            $carta .= $this->input->post('carta');
            $carta .= "</pre>";*/
            $aux = nl2br($carta_motivacao->getCarta());
            //$carta = eregi_replace('<br[[:space:]]*/?'.'[[:space:]]*>',chr(13).chr(10),$carta);
            //$carta = nl2br($this->input->post('carta'));
            $carta = spliti("<br />", $aux);
            $carta_formatada = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
            $carta_formatada .= implode("<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;", $carta);
            
            $this->view_data['carta_motivacao'] = $carta_motivacao;
            
            $this->view_data['carta_formatada'] = $carta_formatada;
            
            $extracurricular = new Extracurricular_to();
            $extracurricular->setIniciacao_cientifica($this->input->post('iniciacao'));
            $extracurricular->setExtensao_cultural($this->input->post('extensao'));
            
            $this->view_data['extracurricular'] = $extracurricular;
            
            //echo $quantidade_idiomas;
            
            $this->load->view('dados_pessoais_confirm_view', $this->view_data);
            
            
            //
            
            
            //print_r($candidato);
            
        }
        
    }
    
    public function registrar() {
        
        $candidato = new Candidato_to();
        $candidato->setNome($this->input->post('nome'));
        $candidato->setSexo($this->input->post('sexo'));
        $candidato->setEndereco($this->input->post('endereco'));
        $candidato->setNumero($this->input->post('numero'));
        $candidato->setComplemento($this->input->post('complemento'));
        $candidato->setBairro($this->input->post('bairro'));
        $candidato->setCidade($this->input->post('cidade'));
        $candidato->setCep($this->input->post('cep'));
        $candidato->setEstado($this->input->post('estado'));
        $candidato->setPais($this->input->post('pais'));
        $candidato->setTelefone($this->input->post('telefone'));
        $candidato->setCelular($this->input->post('celular'));
        $candidato->setRg($this->input->post('rg'));
        $candidato->setData_expedicao($this->invData($this->input->post('data_expedicao')));
        $candidato->setOrgao_emissor($this->input->post('orgao_emissor'));
        $candidato->setCpf($this->input->post('cpf'));
        $candidato->setPassaporte($this->input->post('passaporte'));
        $candidato->setNacionalidade($this->input->post('nacionalidade'));
        $candidato->setEmail($this->input->post('email'));
        $candidato->setData_nascimento($this->invData($this->input->post('data_nascimento')));
        $candidato->setCodigo_acesso($this->geraCodigo_acesso());

        $candidato->setId_candidato($this->candidato_dao->insereCandidato($candidato));
        
        $curso_origem = new Curso_origem_to();
        $curso_origem->setCurso_id_curso($this->input->post('curso_id_curso'));
        $curso_origem->setSemestre_total($this->input->post('semestre_total'));
        $curso_origem->setMedia_geral(str_replace(',', '.', $this->input->post('media_geral')));
        $curso_origem->setCoordenador($this->input->post('coordenador'));
        
        $curso_origem->setId_curso_origem($this->curso_origem_dao->insereCursoOrigem($curso_origem));
        
        $campus = new Campus_to();
        $campus->setId_campus($this->input->post('id_campus'));
        $campus = $this->campus_dao->getDadosCampus($campus->getId_campus());
        
        $origem = new Origem_to();
        $origem->setCandidato_id_candidato($candidato->getId_candidato());
        $origem->setCampus_id_campus($campus->getId_campus());
        $origem->setCurso_origem_id_curso_origem($curso_origem->getId_curso_origem());
        $origem->setSemestre_atual($this->input->post('semestre_atual'));
        
        $origem->setId_origem($this->origem_dao->insereOrigem($origem));
        
        $mobilidade = new Mobilidade_to();
        $mobilidade->setCandidato_id_candidato($candidato->getId_candidato());
        $mobilidade->setPeriodo($this->input->post('periodo'));
        $mobilidade->setAtividade_id_atividade($this->atividade_dao->insereAtividade());
        $mobilidade->setInformacoes($this->input->post('informacoes'));
        
        $mobilidade->setId_mobilidade($this->mobilidade_dao->insereMobilidade($mobilidade));
        
        
        $tipo = $this->input->post('tipo_atividade');
        
        foreach ($tipo as $id_tipo) {
            
            $tipo_atividade = new Tipo_atividade_to();
            $tipo_atividade->setId_tipo_atividade($id_tipo);
            $atividade_has_tipo = new Atividade_has_tipo_atividade_to();
            $atividade_has_tipo->setAtividade_id_atividade($mobilidade->getAtividade_id_atividade());
            $atividade_has_tipo->setTipo_atividade_id_tipo_atividade($tipo_atividade->getId_tipo_atividade());
            
            $this->atividade_has_tipo_atividade_dao->insereAtividadeHasTipo($atividade_has_tipo);
            
        }
        
        $conhecimentos_linguisticos = new Conhecimentos_linguisticos_to();
        $conhecimentos_linguisticos->setCandidato_id_candidato($candidato->getId_candidato());
        $conhecimentos_linguisticos->setLinguas_id_linguas_materna($this->input->post('id_materna'));
        $conhecimentos_linguisticos->setLingua_alternativa_id_lingua_alternativa($this->lingua_alternativa_dao->insereLinguaAlternativa());
        
        $conhecimentos_linguisticos->setId_conhecimentos_linguisticos($this->conhecimentos_linguisticos_dao->insereConhecimentos($conhecimentos_linguisticos));
        
        $quantidade_idiomas = $this->input->post('quantidade_idiomas');
        
        for($i = 0; $i < $quantidade_idiomas; $i++) {
            
            $post_id_lingua_str = 'id_lingua_alternativa';
            $post_id_fluencia_str = 'id_fluencia_linguistica';
            $post_id_lingua_str .= $i+1;
            $post_id_fluencia_str .= $i+1;
            $lingua_alternativa_has_linguas = new Lingua_alternativa_has_linguas_to();
            $lingua_alternativa_has_linguas->setLingua_alternativa_id_lingua_alternativa($conhecimentos_linguisticos->getLingua_alternativa_id_lingua_alternativa());
            $lingua_alternativa_has_linguas->setLinguas_id_linguas($this->input->post($post_id_lingua_str));
            $lingua_alternativa_has_linguas->setFluencia_linguistica_id_fluencia_linguistica($this->input->post($post_id_fluencia_str));
            
            $this->lingua_alternativa_has_linguas_dao->insereLinguaAlternativaHasLinguas($lingua_alternativa_has_linguas);
            
        }
        
        $financiamento = new Financiamento_to();
        $financiamento->setCandidato_id_candidato($candidato->getId_candidato());
        $financiamento->setTipo_financiamento_id_tipo_financiamento((int)$this->input->post('id_financiamento'));
        $financiamento->setId_financiamento($this->financiamento_dao->insereFinanciamento($financiamento));
        
        $carta_motivacao = new Carta_motivacao_to();
        $carta_motivacao->setCandidato_id_candidato($candidato->getId_candidato());
        $carta_motivacao->setCarta($this->input->post('carta_motivacao'));
        $carta_motivacao->setId_carta_motivacao($this->carta_motivacao_dao->insereCarta($carta_motivacao));
        
        $extracurricular = new Extracurricular_to();
        $extracurricular->setCandidato_id_candidato($candidato->getId_candidato());
        $extracurricular->setIniciacao_cientifica($this->input->post('iniciacao_cientifica'));
        $extracurricular->setExtensao_cultural($this->input->post('extensao_cultural'));
        $extracurricular->setId_extracurricular($this->extracurricular_dao->insereExtracurricular($extracurricular));
        
        $ficha_curso = new Ficha_curso_to();
        $ficha_curso->setId_ficha_curso($this->ficha_curso_dao->insereFichaCurso());
        
        //implementar ficha
        $ficha = new Ficha_to();
        $ficha->setCandidato_id_candidato($candidato->getId_candidato());
        $ficha->setOrigem_id_origem($origem->getId_origem());
        $ficha->setMobilidade_id_mobilidade($mobilidade->getId_mobilidade());
        $ficha->setConhecimentos_linguisticos_id_conhecimentos_linguisticos($conhecimentos_linguisticos->getId_conhecimentos_linguisticos());
        $ficha->setFinanciamento_id_financiamento($financiamento->getId_financiamento());
        $ficha->setCarta_motivacao_id_carta_motivacao($carta_motivacao->getId_carta_motivacao());
        $ficha->setExtracurricular_id_extracurricular($extracurricular->getId_extracurricular());
        $ficha->setData_candidatura(date('d/m/Y'));
        $ficha->setFicha_curso_id_ficha_curso($ficha_curso->getId_ficha_curso());
        
        $ficha->setId_ficha($this->ficha_dao->insereFicha($ficha));
        
        $ficha_candidatura = new Ficha_candidatura_to();
        $ficha_candidatura->setFicha_id_ficha($ficha->getId_ficha());
        $ficha_candidatura->setCandidato_id_candidato($candidato->getId_candidato());
        $ficha_candidatura->setEdital_id_edital($this->input->post('id_edital'));
        $ficha_candidatura->setNome($candidato->getNome());
        $ficha_candidatura->setSexo($candidato->getSexo());
        $ficha_candidatura->setEndereco($candidato->getEndereco());
        $ficha_candidatura->setNumero_endereco($candidato->getNumero());
        $ficha_candidatura->setComplemento($candidato->getComplemento());
        $ficha_candidatura->setBairro($candidato->getBairro());
        $ficha_candidatura->setCidade($candidato->getCidade());
        $ficha_candidatura->setCep($candidato->getCep());
        $ficha_candidatura->setEstado($candidato->getEstado());
        $ficha_candidatura->setPais($candidato->getPais());
        $ficha_candidatura->setTelefone($candidato->getTelefone());
        $ficha_candidatura->setCelular($candidato->getCelular());
        $ficha_candidatura->setRg($candidato->getRg());
        $ficha_candidatura->setData_expedicao($candidato->getData_expedicao());
        $ficha_candidatura->setOrgao_emissor($candidato->getOrgao_emissor());
        $ficha_candidatura->setCpf($candidato->getCpf());
        $ficha_candidatura->setPassaporte($candidato->getPassaporte());
        $ficha_candidatura->setNacionalidade($candidato->getNacionalidade());
        $ficha_candidatura->setEmail($candidato->getEmail());
        $ficha_candidatura->setData_nascimento($candidato->getData_nascimento());
        $ficha_candidatura->setNome_campus($campus->getNome_campus());
        $ficha_candidatura->setCurso_origem($this->curso_dao->getDescricaoCurso($curso_origem->getCurso_id_curso()));
        $ficha_candidatura->setSemestre_atual($origem->getSemestre_atual());
        $ficha_candidatura->setSemestre_total($curso_origem->getSemestre_total());
        $ficha_candidatura->setMedia_geral($curso_origem->getMedia_geral());
        $ficha_candidatura->setCoordenador($curso_origem->getCoordenador());
        $ficha_candidatura->setDiretor($campus->getDiretor());
        $ficha_candidatura->setTelefone_campus($campus->getTelefone_campus());
        $ficha_candidatura->setFax($campus->getFax());
        $ficha_candidatura->setPeriodo($mobilidade->getPeriodo());
        
        $quantidade_atividade = count($tipo);
        $atividade = "";
        for($i = 0; $i < $quantidade_atividade; $i++) {
            
            if($quantidade_atividade - $i != 1) {
                
                if($quantidade_atividade - $i == 2) {
                    
                    $atividade .= $this->tipo_atividade_dao->pegaDescricao($tipo[$i]) . " e ";
                    
                } else {
                    
                    $atividade .= $this->tipo_atividade_dao->pegaDescricao($tipo[$i]) . ", ";
                    
                }
                
            } else {
                
                $atividade .= $this->tipo_atividade_dao->pegaDescricao($tipo[$i]);
                
            }
            
        }
        
        $ficha_candidatura->setDescricao_atividade($atividade);
        $ficha_candidatura->setInformacoes($mobilidade->getInformacoes());
        $ficha_candidatura->setLingua_materna($this->linguas_dao->pegaLingua($conhecimentos_linguisticos->getLinguas_id_linguas_materna()));
        
        $lingua_alternativa = "";
        $fluencia = "";
        for($i = 0; $i < $quantidade_idiomas; $i++) {
            
            $post_id_lingua_str = 'id_lingua_alternativa';
            $post_id_fluencia_str = 'id_fluencia_linguistica';
            $post_id_lingua_str .= $i+1;
            $post_id_fluencia_str .= $i+1;
            $lingua_alternativa_has_linguas->setLinguas_id_linguas($this->input->post($post_id_lingua_str));
            $lingua_alternativa_has_linguas->setFluencia_linguistica_id_fluencia_linguistica($this->input->post($post_id_fluencia_str));
            
            if($quantidade_idiomas - $i != 1) {
                
                $lingua_alternativa .= $this->linguas_dao->pegaLingua($lingua_alternativa_has_linguas->getLinguas_id_linguas()) . ',';
                $fluencia .= $this->fluencia_linguistica_dao->pegaFluencia($lingua_alternativa_has_linguas->getFluencia_linguistica_id_fluencia_linguistica()) . ',';
            
            } else {
                
                $lingua_alternativa .= $this->linguas_dao->pegaLingua($lingua_alternativa_has_linguas->getLinguas_id_linguas());
                $fluencia .= $this->fluencia_linguistica_dao->pegaFluencia($lingua_alternativa_has_linguas->getFluencia_linguistica_id_fluencia_linguistica());
                
            }
            
        }
        
        $ficha_candidatura->setLingua_alternativa($lingua_alternativa);
        $ficha_candidatura->setFluencia_linguistica($fluencia);
        $ficha_candidatura->setFinanciamento($this->tipo_financiamento_dao->pegaTipoFinanciamento($financiamento->getTipo_financiamento_id_tipo_financiamento()));
        $ficha_candidatura->setCarta($carta_motivacao->getCarta());
        $ficha_candidatura->setIniciacao_cientifica($extracurricular->getIniciacao_cientifica());
        $ficha_candidatura->setExtencao_cultural($extracurricular->getExtensao_cultural());
        $ficha_candidatura->setAceite(0);
        
        $ficha_candidatura->setId_ficha_candidatura($this->ficha_candidatura_dao->insereFichaCandidatura($ficha_candidatura));
        
        $this->view_data['id_ficha'] = $ficha_candidatura->getId_ficha_candidatura();
        
        $this->view_data['codigo_acesso'] = $candidato->getCodigo_acesso();
        
        $this->email->from('internacional@ifsuldeminas.edu.br', 'Assessoria Internacional');
        $this->email->to($candidato->getEmail());
        $this->email->subject('Cadidatura para intercâmbio IFSULDEMINAS');
        $corpo =   "<html>
                        <meta charset=\"utf-8\">
                        <body style=\"text-align: center; background-color: #e7efd1;\">
                            <img src=\"" . base_url() . "css/images/banner_reitoria_email.jpg\" />
                            <p style=\"color: #000000; text-align: justify; font-size: 12pt; font-family: ubuntu;\">
                                Prezado candidato,<br/>
                                Seu cadastro foi efetuado com sucesso!<br/>
                                Confira os dados abaixo e caso encontre algum erro, entre em contato pelo email suporte.intercambio@ifsuldeminas.edu.br<br/>
                                Nome =<span style=\"text-align: justify; font-size: 12pt; font-family: ubuntu; font-weight: bold;\"> " . $candidato->getNome() . "</span><br/>
                                Código de acesso =<span style=\"text-align: justify; font-size: 14pt; font-family: ubuntu; font-weight: bold;\"> " . $candidato->getCodigo_acesso() . "</span><br/>
                                Guarde este código de acesso, pois o mesmo será requisitado nos próximos acessos.
                            </p>
                            <br /><br />
                            <br />
                            <div style=\"color: #395338;font-family:'Arial'; font-size:15px; font-weight:normal; font-style:italic;\">
                                <span>Assessoria de Relações Internacionais</span>
                            </div>
                            <div style=\"color: #395338;font-family:'Arial'; font-size:15px; font-weight:normal; font-style:italic;\">
                                <span>Rua Ciomara Amaral de Paula 167 - Medicina - CEP: 37550-000 - Pouso Alegre/MG - Fone: +55 (35) 3449 6170</span>
                            </div>
                            <div style=\"color: #395338;font-family:'Arial'; font-size:15px; font-weight:normal; font-style:italic;\">
                                <span>Copyright &#169; 2013. All Rights Reserved.</span>
                            </div>
                            <br />
                            <p style=\"text-align: justify; background-color: #ffffff; font-size: 10pt; font-family: ubuntu; color: orangered; font-style: italic;\">
                                Esta mensagem é para uso exclusivo de seu destinatário e pode conter informações privilegiadas e confidenciais. Se você não é o destinatário não deve distribuir, copiar ou arquivar a mensagem. Neste caso, por favor, notifique o remetente da mesma e destrua imediatamente a mensagem.<br/>
                                This message is intended solely for the use of its addressee and may contain privileged or confidential information. If you are not the addressee you should not distribute, copy or file this message. In this case, please notify the sender and destroy its contents immediately.
                            </p>
                        </body>
                    </html>";
        $this->email->message($corpo);

        $this->email->send();
        
        $this->load->view('senha_view', $this->view_data);
        
    }
    
    function seguinte() {
        
        $id = $this->input->post('id');
        
        redirect("pdf_controller/index/$id");
        
    }
    
    /**
     * 
     * @return string
     */
    function geraCodigo_acesso() {
        
        $len = 8;
        $base = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz123456789!@#$%*-';
        $max = strlen($base) - 1;
        $activatecode = '';
        mt_srand((double)  microtime() * 1000000);
        while(strlen($activatecode) < $len)
            $activatecode .= $base{mt_rand(1, $max)};
            
        return $activatecode;
        
    }
    
    /**
     * 
     * @param type $data
     * @return string
     */
    function invData($data) {
        
        $data = str_replace('/', '-', "$data");
        //$dt = str_replace('.', '-', "$dt");

        $obj = explode('-', $data);

        $obj = $obj[2] . '-' . $obj[1] . '-' . $obj[0];
        
        return $obj;
        
    }
    
    /**
     * 
     * @param type $tipo_atividade
     * @return boolean
     */
    public function validaCheck($tipo_atividade) {
        
        $this->form_validation->set_message('validaCheck', 'O campo %s é obrigatório.');
        
        if(empty($tipo_atividade)) {
            
            return false;
            
        }
        
        return true;
        
    }
    
    /**
     * 
     * @param type $campus
     * @return boolean
     */
    public function validaCampus($campus) {
        
        $this->form_validation->set_message('validaCampus', 'O campo %s é obrigatório.');
        
        if($campus == 0) {
            
            return false;
            
        }
        
        return true;
        
    }
    
    public function validaCurso($curso) {
        
        $this->form_validation->set_message('validaCurso', 'O campo %s é obrigatório.');
        
        if($curso == 0) {
            
            return false;
            
        }
        
        return true;
        
    }
    
    /**
     * 
     * @param type $financiamento
     * @return boolean
     */
    public function validaFinanciamento($financiamento) {
        
        $this->form_validation->set_message('validaFinanciamento', 'O campo %s é obrigatório.');
        
        if($financiamento == 0) {
            
            return false;
            
        }
        
        return true;
        
    }
     
    public function preenche() {
        
        $id = $this->input->get('id');
        
        $data = $this->campus_dao->dadoscampus($id);
        
        print($data);
        
    }
    
    public function validaSemestre($semestre_total, $field) {
        
        $this->form_validation->set_message('validaSemestre', 'O candidato deverá estar, no máximo, no penúltimo semestre do curso, no momento do início previsto da viagem de estudos.');
        
        $semestre_atual = $this->input->post($field);
        
        if($semestre_atual == $semestre_total) {
            
            return FALSE;
            
        }
        
        return TRUE;
        
    }
    
}

?>
