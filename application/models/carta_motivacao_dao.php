<?php

class Carta_motivacao_dao extends CI_Model {
    
    function __construct() {
        
        parent::__construct();
        
    }
    
    public function insereCarta(Carta_motivacao_to $carta_motivacao) {
        
        $query_str = "INSERT INTO carta_motivacao (candidato_id_candidato, carta) VALUES (?, ?)";
        
        $this->db->query($query_str, array($carta_motivacao->getCandidato_id_candidato(), $carta_motivacao->getCarta()));
        
        if($this->db->affected_rows()) {
            
            return $this->db->insert_id();
            
        } else {
            
            return false;
            
        }
        
    }
    
}

?>
