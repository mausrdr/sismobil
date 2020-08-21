<?php

class Universidade_to extends CI_Model {
    
    function __construct() {
        
        parent::__construct();
        
    }
    
    private $id_universidade;
    private $descricao_universidade;
    
    public function getId_universidade() {
        return $this->id_universidade;
    }

    public function setId_universidade($id_universidade) {
        $this->id_universidade = $id_universidade;
    }

    public function getDescricao_universidade() {
        return $this->descricao_universidade;
    }

    public function setDescricao_universidade($descricao_universidade) {
        $this->descricao_universidade = $descricao_universidade;
    }

}

?>
