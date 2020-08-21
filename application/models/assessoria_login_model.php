<?php

class Assessoria_login_model extends CI_Model {
    
    const TABELA = 'pessoas';

    function __construct() {
        
        parent::__construct();
        
    }
    
    function logar($username, $senha) {
        
        if ( $this->isLogado() === FALSE ) {
            
            $sha256_password = hash('sha256', $senha);
            $result = $this->db->get_where(self::TABELA, array ('username' => $username, 'senha' => $sha256_password));
            
            if ( $result->num_rows() == 1) {
                
                $this->session->sess_create();
                
                $usuario = $result->row();
                $userdata = array(
                    
                    'usuario_id'        =>      $usuario->id_pessoas,
                    'usuario_nome'      =>      $usuario->nome,
                    'usuario_username'  =>      $usuario->username,
                    'usuario_senha'     =>      $usuario->senha
                    
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
        $usuario_id = $this->session->userdata('usuario_id');
        $usuario_username = $this->session->userdata('usuario_username');
        $usuario_senha = $this->session->userdata('usuario_senha');

        if ( empty($usuario_id) || empty($usuario_username) || empty($usuario_senha) ) {
            $this->session->sess_destroy();
            return false;
        }

        // Verifico no banco de dados
        $result = $this->db->get_where(self::TABELA, array ('username' => $usuario_username, 'senha' => $usuario_senha));

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
