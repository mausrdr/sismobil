<?php

class Campus_universidade_to extends CI_Model {
    
    function __construct() {
        
        parent::__construct();
        
    }
    
    private $id_campus_universidade;
    private $descricao_campus;
    
    public function getId_campus_universidade() {
        return $this->id_campus_universidade;
    }

    public function setId_campus_universidade($id_campus_universidade) {
        $this->id_campus_universidade = $id_campus_universidade;
    }

    public function getDescricao_campus() {
        return $this->descricao_campus;
    }

    public function setDescricao_campus($descricao_campus) {
        $this->descricao_campus = $descricao_campus;
    }

}

?>
