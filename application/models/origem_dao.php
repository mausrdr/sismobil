<?php

class Origem_dao extends CI_Model {
    
    function __construct() {
        
        parent::__construct();
        
    }
    
    public function insereOrigem(Origem_to $origem) {
        
        $query_str = "INSERT INTO origem (candidato_id_candidato, campus_id_campus, curso_origem_id_curso_origem, semestre_atual) VALUES (?, ?, ?, ?)";
        
        $this->db->query($query_str, array($origem->getCandidato_id_candidato(), $origem->getCampus_id_campus(), $origem->getCurso_origem_id_curso_origem(), $origem->getSemestre_atual()));
        
        if($this->db->affected_rows()) {
            
            return $this->db->insert_id();
            
        } else {
            
            return false;
            
        }
        
    }
    
}

?>
