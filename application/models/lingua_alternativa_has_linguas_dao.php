<?php

class Lingua_alternativa_has_linguas_dao extends CI_Model {
    
    function __construct() {
        
        parent::__construct();
        
    }
    
    public function insereLinguaAlternativaHasLinguas(Lingua_alternativa_has_linguas_to $lingua_alternativa_has_linguas) {
        
        $query_str = "INSERT INTO lingua_alternativa_has_linguas (lingua_alternativa_id_lingua_alternativa, linguas_id_linguas, fluencia_linguistica_id_fluencia_linguistica) VALUES (?, ?, ?)";
        
        $this->db->query($query_str, array($lingua_alternativa_has_linguas->getLingua_alternativa_id_lingua_alternativa(),$lingua_alternativa_has_linguas->getLinguas_id_linguas(), $lingua_alternativa_has_linguas->getFluencia_linguistica_id_fluencia_linguistica()));
        
    }
    
}

?>
