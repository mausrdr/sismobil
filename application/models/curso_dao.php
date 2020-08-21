<?php

class Curso_dao extends CI_Model {
    
    function __construct() {
        
        parent::__construct();
        
    }
    
    public function getDescricaoCurso($id_curso) {
        
        $query_str = "SELECT descricao_curso FROM curso WHERE id_curso = ?";
        
        $result = $this->db->query($query_str, $id_curso);
        
        if($result->num_rows() == 1) {
            
            $row = $result->row();
            
            return $row->descricao_curso;
            
        }
        
    }
    
}

?>
