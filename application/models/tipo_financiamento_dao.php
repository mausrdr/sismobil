<?php

class Tipo_financiamento_dao extends CI_Model {
    
    function __construct() {
        
        parent::__construct();
        
    }
    
    public function tipoFinanciamentoExiste($financiamento) {
        
        $query_str = "SELECT descricao_tipo_financiamento FROM tipo_financiamento WHERE descricao_tipo_financiamento = ?";
        
        $result = $this->db->query($query_str, $financiamento);
        
        if($result->num_rows() > 0) {
            
            return true;
            
        } else {
            
            return false;
            
        }
        
    }
    
    public function insereTipoFinanciamento($financiamento) {
        
        $query_str = "INSERT INTO tipo_financiamento (descricao_tipo_financiamento) VALUES (?)";
        
        $this->db->query($query_str, $financiamento);
        
        if($this->db->affected_rows()) {
            
            return true;
            
        } else {
            
            return false;
            
        }
        
    }
    
    public function listaTipoFinanciamento() {
        
        $query_str = "SELECT id_tipo_financiamento AS 'id', descricao_tipo_financiamento AS 'descricao' FROM tipo_financiamento ORDER BY id_tipo_financiamento";
        
        $result = $this->db->query($query_str);
        
        if($result->num_rows() > 1) {
            
            $data = $result->result_array();
            
            return $data;
            
        } else {
            
            return false;
            
        }
        
    }
    
    public function pegaTipoFinanciamento($id) {
        
        $query_str = "SELECT descricao_tipo_financiamento FROM tipo_financiamento WHERE id_tipo_financiamento = ?";
        
        $result = $this->db->query($query_str, $id);
        
        if($result->num_rows() > 0) {
            
            $data = $result->row();
            
            return $data->descricao_tipo_financiamento;
            
        } else {
            
            return false;
            
        }
        
    }
    
    public function getAssistencia() {
        
        $query_str = "SELECT id_tipo_financiamento AS 'id', descricao_tipo_financiamento AS 'descricao' FROM tipo_financiamento WHERE id_tipo_financiamento = 1";
        
        $result = $this->db->query($query_str);
        
        if($result->num_rows() == 1) {
            
            $data = $result->result_array();
            
            return $data;
            
        } else {
            
            return false;
            
        }
        
    }
    
}

?>
