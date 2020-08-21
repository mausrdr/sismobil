<?php

class Vagas_campus_to extends CI_Model {
    
    function __construct() {
        
        parent::__construct();
        
    }
    
    private $id_vagas_campus;
    private $vagas;
    private $vagas_preenchidas;
    private $edital_id_edital;
    private $universidade_id_universidade;
    private $campus_universidade_id_campus_universidade;
    
    public function getId_vagas_campus() {
        return $this->id_vagas_campus;
    }

    public function setId_vagas_campus($id_vagas_campus) {
        $this->id_vagas_campus = $id_vagas_campus;
    }

    public function getVagas() {
        return $this->vagas;
    }

    public function setVagas($vagas) {
        $this->vagas = $vagas;
    }

    public function getVagas_preenchidas() {
        return $this->vagas_preenchidas;
    }

    public function setVagas_preenchidas($vagas_preenchidas) {
        $this->vagas_preenchidas = $vagas_preenchidas;
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

}

?>
