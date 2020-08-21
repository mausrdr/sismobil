<?php

class Extracurricular_dao extends CI_Model {
    
    function __construct() {
        
        parent::__construct();
        
    }
    
    public function insereExtracurricular(Extracurricular_to $extracurricular) {
        
        $query_str = "INSERT INTO extracurricular (candidato_id_candidato, iniciacao_cientifica, extensao_cultural) VALUES (?, ?, ?)";
        
        $this->db->query($query_str, array($extracurricular->getCandidato_id_candidato(), $extracurricular->getIniciacao_cientifica(), $extracurricular->getExtensao_cultural()));
        
        if($this->db->affected_rows()) {
            
            return $this->db->insert_id();
            
        } else {
            
            return false;
            
        }
        
    }
    
}

?>
