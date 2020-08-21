<?php

class Classificacao_dao extends CI_Model {
    
    function __construct() {
        
        parent::__construct();
        
    }
    
    public function insert(Classificacao_to $classificacao) {
        
        $query_str = "INSERT INTO classificacao (candidato_id_candidato, bic, pvpp, po, estagio, ecc) VALUES (?, ?, ?, ?, ?, ?)";
        
        $this->db->query($query_str, array($classificacao->getCandidato_id_candidato(), $classificacao->getBic(), $classificacao->getPvpp(), $classificacao->getPo(), $classificacao->getEstagio(), $classificacao->getEcc()));
        
        if($this->db->affected_rows()) {
            
            return $this->db->insert_id();
            
        }
        
        return FALSE;
        
    }
    
    public function update(Classificacao_to $classificacao) {
        
        $query_str = "UPDATE classificacao SET bic = ?, pvpp = ?, po = ?, estagio = ?, ecc = ? WHERE candidato_id_candidato = ?";
        
        $this->db->query($query_str, array($classificacao->getBic(), $classificacao->getPvpp(), $classificacao->getPo(), $classificacao->getEstagio(), $classificacao->getEcc(), $classificacao->getCandidato_id_candidato()));
        
        if($this->db->affected_rows()) {
            
            return TRUE;
            
        }
        
        return FALSE;
        
    }
    
}

?>
