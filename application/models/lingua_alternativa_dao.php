<?php

class Lingua_alternativa_dao extends CI_Model {
    
    function __construct() {
        
        parent::__construct();
        
    }
    
    public function insereLinguaAlternativa() {
        
        $query_str = "INSERT INTO lingua_alternativa VALUES ()";
        
        $this->db->query($query_str);
        
        if($this->db->affected_rows()) {
            
            return $this->db->insert_id();
            
        } else {
            
            return false;
            
        }
        
    }
    
}

?>
