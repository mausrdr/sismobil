<?php

class Pessoas_dao extends CI_Model {
    
    function __construct() {
        
        parent::__construct();
        
    }
    
    public function insertPessoas(Pessoas_to $pessoas) {
        
        $sha256_password = hash('sha256', $pessoas->getSenha());
        
        $query_str = "INSERT INTO pessoas (nome, cargo, funcao, siape, portaria, email, username, senha, ativo, permissao_id_permissao) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $this->db->query($query_str, array($pessoas->getNome(), $pessoas->getCargo(), $pessoas->getFuncao(), $pessoas->getSiape(), $pessoas->getPortaria(), $pessoas->getEmail(), $pessoas->getUsername(), $sha256_password, $pessoas->getAtivo(), $pessoas->getPermissao_id_permissao()));
        
        if($this->db->affected_rows()) {
            
            return TRUE;
            
        }
        
        return FALSE;
        
    }
    
    public function getNomeIdRestaura($email) {
        
        $query_str = "SELECT id_pessoas, nome FROM pessoas WHERE email = ?";
        
        $result = $this->db->query($query_str, $email);
        
        if($result->num_rows() == 1) {
            
            $row = $result->row();
            
            $dados['id_pessoas'] = $row->id_pessoas;
            $dados['nome'] = $row->nome;
            
            return $dados;
            
        }
        
        return FALSE;
        
    }
    
    public function trocaSenha($id_pessoas, $senha) {
        
        $sha256_password = hash('sha256', $senha);
        
        $query_str = "UPDATE pessoas SET senha = ? WHERE id_pessoas = ?";
        
        $this->db->query($query_str, array($sha256_password, $id_pessoas));
        
        if($this->db->affected_rows()) {
            
            return TRUE;
            
        }
        
        return FALSE;
        
    }
    
    public function emailExiste($email) {
        
        $query_str = "SELECT email FROM pessoas WHERE email = ?";
        
        $result = $this->db->query($query_str, $email);
        
        if($result->num_rows() == 1) {
            
            return TRUE;
            
        }
        
        return FALSE;
        
    }
    
}

?>
