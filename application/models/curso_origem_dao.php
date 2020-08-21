<?php

class Curso_origem_dao extends CI_Model {
    
    function __construct() {
        
        parent::__construct();
        
    }
    
    public function insereCursoOrigem(Curso_origem_to $curso_origem) {
        
        $query_str = "INSERT INTO curso_origem (curso_id_curso, semestre_total, media_geral, coordenador) VALUES (?, ?, ?, ?)";
        
        $this->db->query($query_str, array($curso_origem->getCurso_id_curso(), $curso_origem->getSemestre_total(), $curso_origem->getMedia_geral(), $curso_origem->getCoordenador()));
        
        if($this->db->affected_rows()) {
            
            return $this->db->insert_id();
            
        } else {
            
            return false;
            
        }
        
    }
    
}

?>
