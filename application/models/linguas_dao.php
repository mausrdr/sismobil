<?php

class Linguas_dao extends CI_Model {
    
    function __construct() {
        
        parent::__construct();
        
    }
    
    public function listaLinguas() {
        
        $query_str = "SELECT id_linguas AS 'id', descricao_linguas AS 'descricao' FROM linguas ORDER BY id_linguas";
        
        $result = $this->db->query($query_str);
        
        if($result->num_rows() > 1) {
            
            $data = $result->result_array();
            
            return $data;
            
        } else {
            
            return false;
            
        }
        
    }
    
    public function pegaLingua($id) {
        
        $query_str = "SELECT descricao_linguas FROM linguas WHERE id_linguas = ?";
        
        $result = $this->db->query($query_str, $id);
        
        if($result->num_rows() == 1) {
            
            $lingua = $result->row();
            
            return $lingua->descricao_linguas;
            
        } else {
            
            return false;
            
        }
        
    }
    
}

?>
