<?php

class Curso_to extends CI_Model {
    
    function __construct() {
        
        parent::__construct();
        
    }
    
    private $id_curso;
    private $descricao_curso;
    private $grau;
    private $campus_id_campus;

    public function getId_curso() {
        return $this->id_curso;
    }

    public function setId_curso($id_curso) {
        $this->id_curso = $id_curso;
    }

    public function getDescricao_curso() {
        return $this->descricao_curso;
    }

    public function setDescricao_curso($descricao_curso) {
        $this->descricao_curso = $descricao_curso;
    }

    public function getGrau() {
        return $this->grau;
    }

    public function setGrau($grau) {
        $this->grau = $grau;
    }

    public function getCampus_id_campus() {
        return $this->campus_id_campus;
    }

    public function setCampus_id_campus($campus_id_campus) {
        $this->campus_id_campus = $campus_id_campus;
    }

}

?>
