<?php

class Origem_to extends CI_Model {
    
    function __construct() {
        
        parent::__construct();
        
    }
    
    private $id_origem;
    private $candidato_id_candidato;
    private $campus_id_campus;
    private $curso_origem_id_curso_origem;
    private $semestre_atual;
    
    public function getId_origem() {
        return $this->id_origem;
    }

    public function setId_origem($id_origem) {
        $this->id_origem = $id_origem;
    }

    public function getCandidato_id_candidato() {
        return $this->candidato_id_candidato;
    }

    public function setCandidato_id_candidato($candidato_id_candidato) {
        $this->candidato_id_candidato = $candidato_id_candidato;
    }

    public function getCampus_id_campus() {
        return $this->campus_id_campus;
    }

    public function setCampus_id_campus($campus_id_campus) {
        $this->campus_id_campus = $campus_id_campus;
    }

    public function getCurso_origem_id_curso_origem() {
        return $this->curso_origem_id_curso_origem;
    }

    public function setCurso_origem_id_curso_origem($curso_origem_id_curso_origem) {
        $this->curso_origem_id_curso_origem = $curso_origem_id_curso_origem;
    }

    public function getSemestre_atual() {
        return $this->semestre_atual;
    }

    public function setSemestre_atual($semestre_atual) {
        $this->semestre_atual = $semestre_atual;
    }

}

?>
