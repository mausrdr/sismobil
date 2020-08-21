<?php

class Assessoria_pesquisa_controller extends MY_controller {
    
    function __construct() {
        
        parent::__construct();
        
        $this->view_data['base_url'] = base_url();
        
        $this->load->model('assessoria_login_model', 'login_model');
        $this->load->model('campus_universidade_dao');
        $this->load->model('curso_universidade_dao');
        $this->load->model('universidade_dao');
        
    }
    
    function index($opcao, $deletar = NULL) {
        
        if($this->login_model->isLogado() === TRUE) {
            
            $this->form($opcao, $deletar);
            
        } else {
            
            redirect('main_controller');
            
        }
        
    }
    
    public function form($opcao, $deletar) {
        echo $deletar;
        
        switch ($opcao) {
            case 0:
                $this->view_data['titulo'] = "Buscar Campus";
                $this->view_data['h1'] = "Buscar Campus";

                $this->view_data['input'] = array(

                    'name'      =>  'descricao_campus_universidade',
                    'id'        =>  'descricao_campus_universidade',
                    'value'     =>  set_value('descricao_campus_universidade')

                );
                
                $this->view_data['label'] = "Nome do Câmpus";

                $config = array(
                    array(
                    
                        'field'     =>      'descricao_campus_universidade',
                        'label'     =>      'Câmpus',
                        'rules'     =>      'trim|xss_clean'    
                        
                    )
                );
                break;
            case 1:
                $this->view_data['titulo'] = "Buscar Curso";

                $this->view_data['h1'] = "Buscar Curso";

                $this->view_data['input'] = array(

                    'name'      =>  'descricao_curso_universidade',
                    'id'        =>  'descricao_curso_universidade',
                    'value'     =>  set_value('descricao_curso_universidade')

                );

                $this->view_data['label'] = "Nome do Curso";

                $config = array(
                    array(
                        
                        'field'     =>      'descricao_curso_universidade',
                        'label'     =>      'Curso',
                        'rules'     =>      'trim|xss_clean'
                        
                    )
                );
                break;
            case 2:
                $this->view_data['titulo'] = "Buscar Universidade";

                $this->view_data['h1'] = "Buscar Universidade";

                $this->view_data['input'] = array(

                    'name'      =>  'descricao_universidade',
                    'id'        =>  'descricao_universidade',
                    'value'     =>  set_value('descricao_universidade')

                );

                $this->view_data['label'] = "Nome da Universidade";

                $config = array(
                    array(
                        
                        'field'     =>      'descricao_universidade',
                        'label'     =>      'Universidade',
                        'rules'     =>      'trim|required|xss_clean'
                        
                    )
                );
                break;
            default:
                break;
        }
            
        $this->view_data['opcao'] = $opcao;
        $this->view_data['deletar'] = $deletar;

        $this->form_validation->set_rules($config);
        
        if($this->form_validation->run() == FALSE) {
            
            $this->load->view('assessoria_pesquisa_view', $this->view_data);
            
        } else {
            
            switch ($opcao){
            
                case 0:
                    if($deletar == NULL) {
                        $descricao_campus_universidade = $this->input->post('descricao_campus_universidade');

                        $lista = $this->campus_universidade_dao->getCampusMatriz($descricao_campus_universidade);
                        
                        $this->view_data['lista'] = $lista;
                        $this->view_data['opcao'] = $opcao;

                        $this->load->view('assessoria_pesquisa_view', $this->view_data);
                    } else {
                        $descricao_campus_universidade = $this->input->post('descricao_campus_universidade');

                        $lista = $this->campus_universidade_dao->getCampusMatrizDelete($descricao_campus_universidade);

                        $this->view_data['lista'] = $lista;
                        
                        if(empty($lista)) {
                            
                            $this->view_data['msg_erro'] = "Nenhum Câmpus poderá ser removido!\\nTalvez seja por não haver nenhum Câmpus cadastrado, ou todos os Câmpus podem estar vinculados a um edital.";
                            
                        }
                        
                        $this->view_data['opcao'] = $opcao;

                        $this->load->view('assessoria_pesquisa_view', $this->view_data);
                    }
                    break;
                case 1:
                    if($deletar == NULL) {
                        $descrcao_curso_universidade = $this->input->post('descricao_curso_universidade');

                        $lista = $this->curso_universidade_dao->getCursoMatriz($descrcao_curso_universidade);

                        $this->view_data['lista'] = $lista;
                        $this->view_data['opcao'] = $opcao;

                        $this->load->view('assessoria_pesquisa_view', $this->view_data);
                    } else {
                        $descrcao_curso_universidade = $this->input->post('descricao_curso_universidade');

                        $lista = $this->curso_universidade_dao->getCursoMatrizDelete($descrcao_curso_universidade);

                        $this->view_data['lista'] = $lista;
                        
                        if(empty($lista)) {
                            
                            $this->view_data['msg_erro'] = "Nenhum Curso poderá ser removido!\\nTalvez seja por não haver nenhum Curso cadastrado, ou todos os Cursos podem estar vinculados a um edital.";
                            
                        }
                        $this->view_data['opcao'] = $opcao;

                        $this->load->view('assessoria_pesquisa_view', $this->view_data);
                    }
                    break;
                case 2:
                    if($deletar == NULL) {
                        $descricao_universidade = $this->input->post('descricao_universidade');

                        $lista = $this->universidade_dao->getUniversidadePesquisa($descricao_universidade);

                        $this->view_data['lista'] = $lista;

                        $this->view_data['opcao'] = $opcao;

                        $this->load->view('assessoria_pesquisa_view', $this->view_data);
                    } else {
                        $descricao_universidade = $this->input->post('descricao_universidade');

                        $lista = $this->universidade_dao->getUniversidadePesquisaDelete($descricao_universidade);

                        $this->view_data['lista'] = $lista;
                        
                        if(empty($lista)) {
                            
                            $this->view_data['msg_erro'] = "Nenhuma Universidade poderá ser removida!\\nTalvez seja por não haver nenhuma Universidade cadastrada, ou todas as Universidades podem estar vinculadas a um edital.";
                            
                        }

                        $this->view_data['opcao'] = $opcao;

                        $this->load->view('assessoria_pesquisa_view', $this->view_data);
                    }
                    break;
                default :
                    break;
            
            }
            
            
        }
        
    }
    
}

?>
