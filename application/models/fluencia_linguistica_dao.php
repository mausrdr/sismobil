<?php

class Fluencia_linguistica_dao extends CI_Model {
    
    function __construct() {
        
        parent::__construct();
        
    }
    
    public function pegaFluencia($id) {
        
        $query_str = "SELECT descricao_fluencia FROM fluencia_linguistica WHERE id_fluencia_linguistica = ?";
        
        $result = $this->db->query($query_str, $id);
        
        if($result->num_rows() == 1) {
            
            $descricao = $result->row();
            
            return $descricao->descricao_fluencia;
            
        }
        
        return false;
        
    }
    
}

?>
