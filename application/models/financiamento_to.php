<?php

class Financiamento_to extends CI_Model {
    
    function __construct() {
        
        parent::__construct();
        
    }
    
    private $id_financiamento;
    private $candidato_id_candidato;
    private $tipo_financiamento_id_tipo_financiamento;
    
    public function getId_financiamento() {
        return $this->id_financiamento;
    }

    public function setId_financiamento($id_financiamento) {
        $this->id_financiamento = $id_financiamento;
    }

    public function getCandidato_id_candidato() {
        return $this->candidato_id_candidato;
    }

    public function setCandidato_id_candidato($candidato_id_candidato) {
        $this->candidato_id_candidato = $candidato_id_candidato;
    }

    public function getTipo_financiamento_id_tipo_financiamento() {
        return $this->tipo_financiamento_id_tipo_financiamento;
    }

    public function setTipo_financiamento_id_tipo_financiamento($tipo_financiamento_id_tipo_financiamento) {
        $this->tipo_financiamento_id_tipo_financiamento = $tipo_financiamento_id_tipo_financiamento;
    }

}

?>
