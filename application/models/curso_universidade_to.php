<?php

class Curso_Universidade_to extends CI_Model {
    
    function __construct() {
        
        parent::__construct();
        
    }
    
    private $id_curso_universidade;
    private $descricao_curso;
    
    public function getId_curso_universidade() {
        return $this->id_curso_universidade;
    }

    public function setId_curso_universidade($id_curso_universidade) {
        $this->id_curso_universidade = $id_curso_universidade;
    }

    public function getDescricao_curso() {
        return $this->descricao_curso;
    }

    public function setDescricao_curso($descricao_curso) {
        $this->descricao_curso = $descricao_curso;
    }

}

?>
