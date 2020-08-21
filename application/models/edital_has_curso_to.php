<?php

class Edital_has_curso_to extends CI_Model {
    
    function __construct() {
        
        parent::__construct();
        
    }
    
    private $id_edital_has_curso;
    private $edital_id_edital;
    private $universidade_id_universidade;
    private $campus_universidade_id_campus_universidade;
    private $curso_universidade_id_curso_universidade;
    
    public function getId_edital_has_curso() {
        return $this->id_edital_has_curso;
    }

    public function setId_edital_has_curso($id_edital_has_curso) {
        $this->id_edital_has_curso = $id_edital_has_curso;
    }

    public function getEdital_id_edital() {
        return $this->edital_id_edital;
    }

    public function setEdital_id_edital($edital_id_edital) {
        $this->edital_id_edital = $edital_id_edital;
    }

    public function getUniversidade_id_universidade() {
        return $this->universidade_id_universidade;
    }

    public function setUniversidade_id_universidade($universidade_id_universidade) {
        $this->universidade_id_universidade = $universidade_id_universidade;
    }

    public function getCampus_universidade_id_campus_universidade() {
        return $this->campus_universidade_id_campus_universidade;
    }

    public function setCampus_universidade_id_campus_universidade($campus_universidade_id_campus_universidade) {
        $this->campus_universidade_id_campus_universidade = $campus_universidade_id_campus_universidade;
    }

    public function getCurso_universidade_id_curso_universidade() {
        return $this->curso_universidade_id_curso_universidade;
    }

    public function setCurso_universidade_id_curso_universidade($curso_universidade_id_curso_universidade) {
        $this->curso_universidade_id_curso_universidade = $curso_universidade_id_curso_universidade;
    }

}

?>
