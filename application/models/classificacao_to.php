<?php

class Classificacao_to extends CI_Model {
    
    function __construct() {
        
        parent::__construct();
        
    }
    
    private $id_classificacao;
    private $candidato_id_candidato;
    private $bic;
    private $pvpp;
    private $po;
    private $estagio;
    private $ecc;
    
    public function getId_classificacao() {
        return $this->id_classificacao;
    }

    public function setId_classificacao($id_classificacao) {
        $this->id_classificacao = $id_classificacao;
    }

    public function getCandidato_id_candidato() {
        return $this->candidato_id_candidato;
    }

    public function setCandidato_id_candidato($candidato_id_candidato) {
        $this->candidato_id_candidato = $candidato_id_candidato;
    }

    public function getBic() {
        return $this->bic;
    }

    public function setBic($bic) {
        $this->bic = $bic;
    }

    public function getPvpp() {
        return $this->pvpp;
    }

    public function setPvpp($pvpp) {
        $this->pvpp = $pvpp;
    }

    public function getPo() {
        return $this->po;
    }

    public function setPo($po) {
        $this->po = $po;
    }

    public function getEstagio() {
        return $this->estagio;
    }

    public function setEstagio($estagio) {
        $this->estagio = $estagio;
    }

    public function getEcc() {
        return $this->ecc;
    }

    public function setEcc($ecc) {
        $this->ecc = $ecc;
    }

}

?>
