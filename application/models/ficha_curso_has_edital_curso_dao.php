<?php

class Ficha_curso_has_edital_curso_dao extends CI_Model {
    
    function __construct() {
        
        parent::__construct();
        
    }
    
    public function insertFichaCursoHasEditalCurso(Ficha_curso_has_edital_curso_to $ficha_curso_has_edital_curso) {
        
        $query_str = "INSERT INTO ficha_curso_has_edital_curso (ficha_curso_id_ficha_curso, edital_has_curso_id_edital_has_curso) VALUES (?, ?)";
        
        $this->db->query($query_str, array($ficha_curso_has_edital_curso->getFicha_curso_id_ficha_curso(), $ficha_curso_has_edital_curso->getEdital_has_curso_id_edital_has_curso()));
        
        if($this->db->affected_rows()) {
            
            return TRUE;
            
        }
        
        return FALSE;
        
    }
    
    public function getIdsEditalHasCurso($ficha_curso_id_ficha_curso) {
        
        $query_str = "SELECT edital_has_curso_id_edital_has_curso FROM ficha_curso_has_edital_curso WHERE ficha_curso_id_ficha_curso = ?";
        
        $result = $this->db->query($query_str, $ficha_curso_id_ficha_curso);
        
        if($result->num_rows() > 0) {
            
            $rows = $result->result_array();
            
            return $rows;
            
        }
        
        return FALSE;
        
    }
    
}

?>
