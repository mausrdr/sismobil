<?php

class Tipo_atividade_dao extends CI_Model {
    
    function __construct() {
        
        parent::__construct();
        
    }
    
    public function pegaDescricao($id) {
        
        $query_str = "SELECT descricao_atividade FROM tipo_atividade WHERE id_tipo_atividade = ?";
        
        $result = $this->db->query($query_str, $id);
        
        if($result->num_rows() == 1) {
            
            $descricao = $result->row();
            
            return $descricao->descricao_atividade;
            
        } else {
            
            return false;
            
        }
        
    }
    
}

?>
