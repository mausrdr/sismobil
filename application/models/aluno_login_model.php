<?php

class Aluno_login_model extends CI_Model {
    
    const TABELA = 'candidato';
    
    function __construct() {
        
        parent::__construct();
        
    }
    
    function logar($cpf, $codigo_acesso) {
        
        if ( $this->isLogado() === FALSE ) {
            
            $sha256_codigo = hash('sha256', $codigo_acesso);
            $result = $this->db->get_where(self::TABELA, array ('cpf' => $cpf, 'codigo_acesso' => $sha256_codigo));
            
            if ( $result->num_rows() == 1) {
                
                $this->session->sess_create();
                
                $aluno = $result->row();
                $userdata = array(
                    
                    'aluno_id'        =>      $aluno->id_candidato,
                    'aluno_nome'      =>      $aluno->nome,
                    'aluno_cpf'       =>      $aluno->cpf,
                    'aluno_codigo'    =>      $aluno->codigo_acesso
                    
                );
                $this->session->set_userdata($userdata);
                
                //$this->session->sess_write();
                
                
                /*var_dump($this->session->userdata('usuario_id'));
                
                die;*/
                
                return true;
                
            }
            
            return false;
            
        }
    }

    function isLogado()
    {
        $aluno_id = $this->session->userdata('aluno_id');
        $aluno_cpf = $this->session->userdata('aluno_cpf');
        $aluno_codigo = $this->session->userdata('aluno_codigo');

        if ( empty($aluno_id) || empty($aluno_cpf) || empty($aluno_codigo) ) {
            $this->session->sess_destroy();
            return false;
        }

        // Verifico no banco de dados
        $result = $this->db->get_where(self::TABELA, array ('cpf' => $aluno_cpf, 'codigo_acesso' => $aluno_codigo));

        if ( $result->num_rows() == 1) {
            return true;
        }
        //$this->session->sess_destroy();
        //return FALSE;
    }

    function logout()
    {
        
        $this->session->sess_destroy();
        
        redirect('../index.php/main_controller');
        
    }
    
}

?>
