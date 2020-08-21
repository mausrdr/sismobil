<?php

class Token_pessoas_dao extends CI_Model {
    
    function __construct() {
        
        parent::__construct();
        
    }
    
    public function insertToken(Token_pessoas_to $token) {
        
        $query_str = "INSERT INTO token_pessoas (pessoas_id_pessoas, codigo, token_time, ip_address) VALUES (?, ?, ?, ?)";
        
        $this->db->query($query_str, array($token->getPessoas_id_pessoas(), $token->getCodigo(), $token->getToken_time(), $token->getIp_address()));
        
        if($this->db->affected_rows()) {
            
            return TRUE;
            
        }
        
        return FALSE;
        
    }
    
    public function deleteToken($expiration) {
        
        $query_str = "DELETE FROM token_pessoas WHERE token_time < ?";
        
        $this->db->query($query_str, $expiration);
        
        return TRUE;
        
    }
    
    public function tokenExiste(Token_pessoas_to $token) {
        
        $query_str = "SELECT COUNT(*) AS 'count' FROM token_pessoas WHERE codigo = ? AND token_time > ?";
        
        $result = $this->db->query($query_str, array($token->getCodigo(), $token->getToken_time()));
        
        if($result->num_rows() == 1) {
            
            $row = $result->row();
            if($row->count == 1) {
                
                return TRUE;
                
            }
            
        }
        
        return FALSE;
        
    }
    
    public function getIdPessoas(Token_pessoas_to $token) {
        
        $query_str = "SELECT pessoas_id_pessoas FROM token_pessoas WHERE codigo = ? AND token_time > ?";
        
        $result = $this->db->query($query_str, array($token->getCodigo(), $token->getToken_time()));
        
        if($result->num_rows() == 1) {
            
            $row = $result->row();
            
            return $row->pessoas_id_pessoas;
            
        }
        
        return FALSE;
        
    }
    
}

?>
