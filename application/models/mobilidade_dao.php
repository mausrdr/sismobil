<?php

class Mobilidade_dao extends CI_Model {
    
    function __construct() {
        
        parent::__construct();
        
    }
    
    public function insereMobilidade(Mobilidade_to $mobilidade) {
        
        $query_str = "INSERT INTO mobilidade (candidato_id_candidato, periodo, atividade_id_atividade, informacoes) VALUES (?, ?, ?, ?)";
        
        $this->db->query($query_str, array($mobilidade->getCandidato_id_candidato(), $mobilidade->getPeriodo(), $mobilidade->getAtividade_id_atividade(), $mobilidade->getInformacoes()));
        
        if($this->db->affected_rows()) {
            
            return $this->db->insert_id();
            
        } else {
            
            return false;
            
        }
        
    }
    
}

?>
