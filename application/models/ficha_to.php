<?php

class Ficha_to extends CI_Model {
    
    function __construct() {
        
        parent::__construct();
        
    }
    
    private $id_ficha;
    private $candidato_id_candidato;
    private $origem_id_origem;
    private $mobilidade_id_mobilidade;
    private $conhecimentos_linguisticos_id_conhecimentos_linguisticos;
    private $financiamento_id_financiamento;
    private $carta_motivacao_id_carta_motivacao;
    private $extracurricular_id_extracurricular;
    private $data_candidatura;
    private $ficha_curso_id_ficha_curso;


    public function getId_ficha() {
        return $this->id_ficha;
    }

    public function setId_ficha($id_ficha) {
        $this->id_ficha = $id_ficha;
    }

    public function getCandidato_id_candidato() {
        return $this->candidato_id_candidato;
    }

    public function setCandidato_id_candidato($candidato_id_candidato) {
        $this->candidato_id_candidato = $candidato_id_candidato;
    }

    public function getOrigem_id_origem() {
        return $this->origem_id_origem;
    }

    public function setOrigem_id_origem($origem_id_origem) {
        $this->origem_id_origem = $origem_id_origem;
    }

    public function getMobilidade_id_mobilidade() {
        return $this->mobilidade_id_mobilidade;
    }

    public function setMobilidade_id_mobilidade($mobilidade_id_mobilidade) {
        $this->mobilidade_id_mobilidade = $mobilidade_id_mobilidade;
    }

    public function getConhecimentos_linguisticos_id_conhecimentos_linguisticos() {
        return $this->conhecimentos_linguisticos_id_conhecimentos_linguisticos;
    }

    public function setConhecimentos_linguisticos_id_conhecimentos_linguisticos($conhecimentos_linguisticos_id_conhecimentos_linguisticos) {
        $this->conhecimentos_linguisticos_id_conhecimentos_linguisticos = $conhecimentos_linguisticos_id_conhecimentos_linguisticos;
    }

    public function getFinanciamento_id_financiamento() {
        return $this->financiamento_id_financiamento;
    }

    public function setFinanciamento_id_financiamento($financiamento_id_financiamento) {
        $this->financiamento_id_financiamento = $financiamento_id_financiamento;
    }

    public function getCarta_motivacao_id_carta_motivacao() {
        return $this->carta_motivacao_id_carta_motivacao;
    }

    public function setCarta_motivacao_id_carta_motivacao($carta_motivacao_id_carta_motivacao) {
        $this->carta_motivacao_id_carta_motivacao = $carta_motivacao_id_carta_motivacao;
    }

    public function getExtracurricular_id_extracurricular() {
        return $this->extracurricular_id_extracurricular;
    }

    public function setExtracurricular_id_extracurricular($extracurricular_id_extracurricular) {
        $this->extracurricular_id_extracurricular = $extracurricular_id_extracurricular;
    }

    public function getData_candidatura() {
        return $this->data_candidatura;
    }

    public function setData_candidatura($data_candidatura) {
        $this->data_candidatura = $data_candidatura;
    }
    
    public function getFicha_curso_id_ficha_curso() {
        return $this->ficha_curso_id_ficha_curso;
    }

    public function setFicha_curso_id_ficha_curso($ficha_curso_id_ficha_curso) {
        $this->ficha_curso_id_ficha_curso = $ficha_curso_id_ficha_curso;
    }

}

?>
