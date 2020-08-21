<?php

class Financiamento_dao extends CI_Model {
    
    function __construct() {
        
        parent::__construct();
        
    }
    
    public function insereFinanciamento(Financiamento_to $financiamento) {
        
        $query_str = "INSERT INTO financiamento (candidato_id_candidato, tipo_financiamento_id_tipo_financiamento) VALUES (?, ?)";
        
        $this->db->query($query_str, array($financiamento->getCandidato_id_candidato(), $financiamento->getTipo_financiamento_id_tipo_financiamento()));
        
        if($this->db->affected_rows()) {
            
            return $this->db->insert_id();
            
        } else {
            
            return false;
            
        }
        
    }
    
}

?>
