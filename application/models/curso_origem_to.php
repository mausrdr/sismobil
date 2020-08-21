<?php

class Curso_origem_to extends CI_Model {
    
    function __construct() {
        
        parent::__construct();
        
    }
    
    private $id_curso_origem;
    private $curso_id_curso;
    private $semestre_total;
    private $media_geral;
    private $coordenador;
    
    public function getId_curso_origem() {
        return $this->id_curso_origem;
    }

    public function setId_curso_origem($id_curso_origem) {
        $this->id_curso_origem = $id_curso_origem;
    }

    public function getCurso_id_curso() {
        return $this->curso_id_curso;
    }

    public function setCurso_id_curso($curso_id_curso) {
        $this->curso_id_curso = $curso_id_curso;
    }

    public function getSemestre_total() {
        return $this->semestre_total;
    }

    public function setSemestre_total($semestre_total) {
        $this->semestre_total = $semestre_total;
    }

    public function getMedia_geral() {
        return $this->media_geral;
    }

    public function setMedia_geral($media_geral) {
        $this->media_geral = $media_geral;
    }

    public function getCoordenador() {
        return $this->coordenador;
    }

    public function setCoordenador($coordenador) {
        $this->coordenador = $coordenador;
    }

}

?>
