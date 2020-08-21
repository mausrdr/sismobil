<?php

class Mobilidade_to extends CI_Model {
    
    function __construct() {
        
        parent::__construct();
        
    }
    
    private $id_mobilidade;
    private $candidato_id_candidato;
    private $periodo;
    private $atividade_id_atividade;
    private $informacoes;
    
    public function getId_mobilidade() {
        return $this->id_mobilidade;
    }

    public function setId_mobilidade($id_mobilidade) {
        $this->id_mobilidade = $id_mobilidade;
    }

    public function getCandidato_id_candidato() {
        return $this->candidato_id_candidato;
    }

    public function setCandidato_id_candidato($candidato_id_candidato) {
        $this->candidato_id_candidato = $candidato_id_candidato;
    }

    public function getPeriodo() {
        return $this->periodo;
    }

    public function setPeriodo($periodo) {
        $this->periodo = $periodo;
    }

    public function getAtividade_id_atividade() {
        return $this->atividade_id_atividade;
    }

    public function setAtividade_id_atividade($atividade_id_atividade) {
        $this->atividade_id_atividade = $atividade_id_atividade;
    }

    public function getInformacoes() {
        return $this->informacoes;
    }

    public function setInformacoes($informacoes) {
        $this->informacoes = $informacoes;
    }
    
}

?>
