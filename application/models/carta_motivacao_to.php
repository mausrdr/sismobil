<?php

class Carta_motivacao_to extends CI_Model {
    
    function __construct() {
        
        parent::__construct();
        
    }
    
    private $id_carta_motivacao;
    private $candidato_id_candidato;
    private $carta;
    
    public function getId_carta_motivacao() {
        return $this->id_carta_motivacao;
    }

    public function setId_carta_motivacao($id_carta_motivacao) {
        $this->id_carta_motivacao = $id_carta_motivacao;
    }

    public function getCandidato_id_candidato() {
        return $this->candidato_id_candidato;
    }

    public function setCandidato_id_candidato($candidato_id_candidato) {
        $this->candidato_id_candidato = $candidato_id_candidato;
    }

    public function getCarta() {
        return $this->carta;
    }

    public function setCarta($carta) {
        $this->carta = $carta;
    }

}

?>
