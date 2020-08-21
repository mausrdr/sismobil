<?php

class Fluencia_linguistica_to extends CI_Model {
    
    function __construct() {
        
        parent::__construct();
        
    }
    
    private $id_fluencia_linguistica;
    private $descricao_fluencia;
    
    public function getId_fluencia_linguistica() {
        return $this->id_fluencia_linguistica;
    }

    public function setId_fluencia_linguistica($id_fluencia_linguistica) {
        $this->id_fluencia_linguistica = $id_fluencia_linguistica;
    }

    public function getDescricao_fluencia() {
        return $this->descricao_fluencia;
    }

    public function setDescricao_fluencia($descricao_fluencia) {
        $this->descricao_fluencia = $descricao_fluencia;
    }

}

?>
