<?php

class Curso_universidade_dao extends CI_Model {
    
    function __construct() {
        
        parent::__construct();
        
    }
    
    public function insereCurso_universidade(Curso_Universidade_to $curso_universidade) {
        
        $query_str = "INSERT INTO curso_universidade (descricao_curso) VALUES (?)";
        
        $this->db->query($query_str, $curso_universidade->getDescricao_curso());
        
        if($this->db->affected_rows()) {
            
            return TRUE;
            
        } else {
            
            return FALSE;
            
        }
        
    }
    
    public function cursoExiste($descricao_curso) {
        
        $query_str = "SELECT descricao_curso FROM curso_universidade WHERE descricao_curso = ?";
        
        $result = $this->db->query($query_str, $descricao_curso);
        
        if($result->num_rows() > 0) {
            
            return TRUE;
            
        } else {
            
            return FALSE;
            
        }
        
    }
    
    public function getDescricaoCurso($curso_universidade) {
        
        $query_str = "SELECT descricao_curso FROM curso_universidade WHERE id_curso_universidade = ?";
        
        $result = $this->db->query($query_str, $curso_universidade);
        
        if($result->num_rows() == 1) {
            
            $data = $result->row();
            
            return $data->descricao_curso;
            
        } else {
            
            return FALSE;
            
        }
        
    }
    
    public function getCursoMatriz($descricao_curso) {
        
        $descricao_curso = '%' . $descricao_curso . '%';
        
        $query_str = "SELECT id_curso_universidade AS 'id', descricao_curso AS 'descricao' FROM curso_universidade WHERE descricao_curso LIKE ?";
        
        $result = $this->db->query($query_str, $descricao_curso);
        
        if($result->num_rows() > 0) {
            
            $row = $result->result_array();
            
            return $row;
            
        }
        
        return FALSE;
        
    }
    
    public function updateCursoUniversidade(Curso_Universidade_to $curso) {
        
        $query_str = "UPDATE curso_universidade SET descricao_curso = ? WHERE id_curso_universidade = ?";
        
        $this->db->query($query_str, array($curso->getDescricao_curso(), $curso->getId_curso_universidade()));
        
        if($this->db->affected_rows()) {
            
            return TRUE;
            
        }
        
        return FALSE;
        
    }
    
    public function getCursoMatrizDelete($descricao_curso) {
        
        $descricao_curso = '%' . $descricao_curso . '%';
        
        $query_str = "SELECT c.id_curso_universidade AS 'id', c.descricao_curso AS 'descricao' FROM curso_universidade c WHERE c.descricao_curso LIKE ? AND c.id_curso_universidade NOT IN (SELECT e.curso_universidade_id_curso_universidade FROM edital_has_curso e)";
        
        $result = $this->db->query($query_str, $descricao_curso);
        
        if($result->num_rows() > 0) {
            
            $row = $result->result_array();
            
            return $row;
            
        }
        
        return FALSE;
        
    }
    
}

?>
