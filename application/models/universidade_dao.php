<?php

class Universidade_dao extends CI_Model {
    
    function __construct() {
        
        parent::__construct();
        
    }
    
    public function insereUniversidade(Universidade_to $universidade) {
        
        $query_str = "INSERT INTO universidade (descricao_universidade) VALUES (?)";
        
        $this->db->query($query_str, $universidade->getDescricao_universidade());
        
        if($this->db->affected_rows()) {
            
            return TRUE;
            
        } else {
            
            return FALSE;
            
        }
        
    }
    
    public function universidadeExiste($descricao_universidade) {
        
        $query_str = "SELECT descricao_universidade FROM universidade WHERE descricao_universidade = ?";
        
        $result = $this->db->query($query_str, $descricao_universidade);
        
        if($result->num_rows() > 0) {
            
            return TRUE;
            
        } else {
            
            return FALSE;
            
        }
        
    }
    
    public function getDescricaoUniversidade($universidade) {
        
        $query_str = "SELECT descricao_universidade FROM universidade WHERE id_universidade = ?";
        
        $result = $this->db->query($query_str, $universidade);
        
        if($result->num_rows() == 1) {
            
            $data = $result->row();
            
            return $data->descricao_universidade;
            
        } else {
            
            return FALSE;
            
        }
        
    }
    
    public function getUniversidadeMatriz() {
        
        $query_str = "SELECT id_universidade AS 'id', descricao_universidade AS 'descricao' FROM universidade";
        
        $result = $this->db->query($query_str);
        
        if($result->num_rows() > 0) {
            
            $row = $result->result_array();
            
            return $row;
            
        }
        
        return FALSE;
        
    }
    
    public function getUniversidadePesquisa($descricao_universidade) {
        
        $descricao_universidade = '%' . $descricao_universidade . '%';
        
        $query_str = "SELECT id_universidade AS 'id', descricao_universidade AS 'descricao' FROM universidade WHERE descricao_universidade LIKE ?";
        
        $result = $this->db->query($query_str, $descricao_universidade);
        
        if($result->num_rows() > 0) {
            
            $row = $result->result_array();
            
            return $row;
            
        }
        
        return FALSE;
        
    }
    
    public function updateUniversidade(Universidade_to $universidade) {
        
        $query_str = "UPDATE universidade SET descricao_universidade = ? WHERE id_universidade = ?";
        
        $this->db->query($query_str, array($universidade->getDescricao_universidade(), $universidade->getId_universidade()));
        
        if($this->db->affected_rows()) {
            
            return TRUE;
            
        }
        
        return FALSE;
        
    }
    
    public function deleteUniversidade($id_universidade) {
        
        $query_str = "DELETE FROM universidade WHERE id_universidade = ?";
        
        $this->db->query($query_str, $id_universidade);
        
        if($this->db->affected_rows() > 0) {
            
            return TRUE;
            
        }
        
        return FALSE;
        
    }
    
    public function getUniversidadePesquisaDelete($descricao_universidade) {
        
        $descricao_universidade = '%' . $descricao_universidade . '%';
        
        $query_str = "SELECT u.id_universidade AS 'id', u.descricao_universidade AS 'descricao' FROM universidade u WHERE u.descricao_universidade LIKE ? AND u.id_universidade NOT IN (SELECT v.universidade_id_universidade FROM vagas_campus v)";
        
        $result = $this->db->query($query_str, $descricao_universidade);
        
        if($result->num_rows() > 0) {
            
            $row = $result->result_array();
            
            return $row;
            
        }
        
        return FALSE;
        
    }
    
}

?>
