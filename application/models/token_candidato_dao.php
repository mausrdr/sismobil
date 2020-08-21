<?php

class Token_candidato_dao extends CI_Model {
    
    function __construct() {
        
        parent::__construct();
        
    }
    
    public function insertToken(Token_candidato_to $token) {
        
        $query_str = "INSERT INTO token_candidato (candidato_id_candidato, codigo, token_time, ip_address) VALUES (?, ?, ?, ?)";
        
        $this->db->query($query_str, array($token->getCandidato_id_candidato(), $token->getCodigo(), $token->getToken_time(), $token->getIp_address()));
        
        if($this->db->affected_rows()) {
            
            return TRUE;
            
        }
        
        return FALSE;
        
    }
    
    public function deleteToken($expiration) {
        
        $query_str = "DELETE FROM token_candidato WHERE token_time < ?";
        
        $this->db->query($query_str, $expiration);
        
        return TRUE;
        
    }
    
    public function tokenExiste(Token_candidato_to $token) {
        
        $query_str = "SELECT COUNT(*) AS 'count' FROM token_candidato WHERE codigo = ? AND token_time > ?";
        
        $result = $this->db->query($query_str, array($token->getCodigo(), $token->getToken_time()));
        
        if($result->num_rows() == 1) {
            
            $row = $result->row();
            if($row->count == 1) {
                
                return TRUE;
                
            }
            
        }
        
        return FALSE;
        
    }
    
    public function getIdCandidato(Token_candidato_to $token) {
        
        $query_str = "SELECT candidato_id_candidato FROM token_candidato WHERE codigo = ? AND token_time > ?";
        
        $result = $this->db->query($query_str, array($token->getCodigo(), $token->getToken_time()));
        
        if($result->num_rows() == 1) {
            
            $row = $result->row();
            
            return $row->candidato_id_candidato;
            
        }
        
        return FALSE;
        
    }
    
}

?>
