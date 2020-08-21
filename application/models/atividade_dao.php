<?php

class Atividade_dao extends CI_Model {
    
    function __construct() {
        
        parent::__construct();
        
    }
    
    public function insereAtividade() {
        
        $query_str = "INSERT INTO atividade VALUES ()";
        
        $this->db->query($query_str);
        
        if($this->db->affected_rows()) {
            
            return $this->db->insert_id();
            
        } else {
            
            return false;
            
        }
        
    }
    
}

?>
