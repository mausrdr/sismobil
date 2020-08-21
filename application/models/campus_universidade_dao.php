<?php

class Campus_universidade_dao extends CI_Model {
    
    function __construct() {
        
        parent::__construct();
        
    }
    
    public function insereCampus_universidade(Campus_universidade_to $campus_universidade) {
        
        $query_str = "INSERT INTO campus_universidade (descricao_campus) VALUES (?)";
        
        $this->db->query($query_str, $campus_universidade->getDescricao_campus());
        
        if($this->db->affected_rows()) {
            
            return TRUE;
            
        } else {
            
            return FALSE;
            
        }
        
    }
    
    public function campusExiste($descricao_campus) {
        
        $query_str = "SELECT descricao_campus FROM campus_universidade WHERE descricao_campus = ?";
        
        $result = $this->db->query($query_str, $descricao_campus);
        
        if($result->num_rows() > 0) {
            
            return TRUE;
            
        } else {
            
            return FALSE;
            
        }
        
    }
    
    public function getDescricaoCampus($id_campus_universidade) {
        
        $query_str = "SELECT descricao_campus FROM campus_universidade WHERE id_campus_universidade = ?";
        
        $result = $this->db->query($query_str, $id_campus_universidade);
        
        if($result->num_rows() == 1) {
            
            $data = $result->row();
            
            return $data->descricao_campus;
            
        }
            
        return FALSE;
            
    }
    
    public function getCampusMatriz($descricao_campus) {
        
        $descricao_campus = '%' . $descricao_campus . '%';
        
        $query_str = "SELECT id_campus_universidade AS 'id', descricao_campus AS 'descricao' FROM campus_universidade WHERE descricao_campus LIKE ?";
        
        $result = $this->db->query($query_str, $descricao_campus);
        
        if($result->num_rows() > 0) {
            
            $rows = $result->result_array();
            
            return $rows;
            
        }
        
        return FALSE;
        
    }
    
    public function updateCampusUniversidade(Campus_universidade_to $campus) {
        
        $query_str = "UPDATE campus_universidade SET descricao_campus = ? WHERE id_campus_universidade = ?";
        
        $this->db->query($query_str, array($campus->getDescricao_campus(), $campus->getId_campus_universidade()));
        
        if($this->db->affected_rows()) {
            
            return TRUE;
            
        }
        
        return FALSE;
        
    }
    
    public function getCampusMatrizDelete($descricao_campus) {
        
        $descricao_campus = '%' . $descricao_campus . '%';
        
        $query_str = "SELECT c.id_campus_universidade AS 'id', c.descricao_campus AS 'descricao' FROM campus_universidade c WHERE c.descricao_campus LIKE ? AND c.id_campus_universidade NOT IN (SELECT v.campus_universidade_id_campus_universidade FROM vagas_campus v)";
        
        $result = $this->db->query($query_str, $descricao_campus);
        
        if($result->num_rows() > 0) {
            
            $row = $result->result_array();
            
            return $row;
            
        }
        
        return FALSE;
        
    }
    
}

?>
