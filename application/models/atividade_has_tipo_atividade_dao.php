<?php

class Atividade_has_tipo_atividade_dao extends CI_Model {
    
    function __construct() {
        
        parent::__construct();
        
    }
    
    public function insereAtividadeHasTipo(Atividade_has_tipo_atividade_to $atividade) {
        
        $query_str = "INSERT INTO atividade_has_tipo_atividade (atividade_id_atividade, tipo_atividade_id_tipo_atividade) VALUES (?, ?)";
        
        $this->db->query($query_str, array($atividade->getAtividade_id_atividade(), $atividade->getTipo_atividade_id_tipo_atividade()));
        
    }
    
}

?>
