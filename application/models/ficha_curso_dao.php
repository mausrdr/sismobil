<?php

class Ficha_curso_dao extends CI_Model {
    
    function __construct() {
        
        parent::__construct();
        
    }
    
    public function insereFichaCurso() {
        
        $query_str = "INSERT INTO ficha_curso VALUES ()";
        
        $this->db->query($query_str);
        
        if($this->db->affected_rows()) {
            
            return $this->db->insert_id();
            
        } else {
            
            return false;
            
        }
        
    }
    
}

?>
