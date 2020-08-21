<?php

class Conhecimentos_linguisticos_dao extends CI_Model {
    
    function __construct() {
        
        parent::__construct();
        
    }
    
    public function insereConhecimentos(Conhecimentos_linguisticos_to $conhecimentos_linguisticos) {
        
        $query_str = "INSERT INTO conhecimentos_linguisticos (candidato_id_candidato, linguas_id_linguas_materna, lingua_alternativa_id_lingua_alternativa) VALUES (?, ?, ?)";
        
        $this->db->query($query_str, array($conhecimentos_linguisticos->getCandidato_id_candidato(), $conhecimentos_linguisticos->getLinguas_id_linguas_materna(), $conhecimentos_linguisticos->getLingua_alternativa_id_lingua_alternativa()));
        
        if($this->db->affected_rows()) {
            
            return $this->db->insert_id();
            
        } else {
            
            return false;
            
        }
        
    }
    
}

?>
