<?php

class Extracurricular_to extends CI_Model {
    
    function __construct() {
        
        parent::__construct();
        
    }
    
    private $id_extracurricular;
    private $candidato_id_candidato;
    private $iniciacao_cientifica;
    private $extensao_cultural;
    
    public function getId_extracurricular() {
        return $this->id_extracurricular;
    }

    public function setId_extracurricular($id_extracurricular) {
        $this->id_extracurricular = $id_extracurricular;
    }

    public function getCandidato_id_candidato() {
        return $this->candidato_id_candidato;
    }

    public function setCandidato_id_candidato($candidato_id_candidato) {
        $this->candidato_id_candidato = $candidato_id_candidato;
    }

    public function getIniciacao_cientifica() {
        return $this->iniciacao_cientifica;
    }

    public function setIniciacao_cientifica($iniciacao_cientifica) {
        $this->iniciacao_cientifica = $iniciacao_cientifica;
    }

    public function getExtensao_cultural() {
        return $this->extensao_cultural;
    }

    public function setExtensao_cultural($extensao_cultural) {
        $this->extensao_cultural = $extensao_cultural;
    }

}

?>
