<?php

class Conhecimentos_linguisticos_to extends CI_Model {
    
    function __construct() {
        
        parent::__construct();
        
    }
    
    private $id_conhecimentos_linguisticos;
    private $candidato_id_candidato;
    private $linguas_id_linguas_materna;
    private $lingua_alternativa_id_lingua_alternativa;
    
    public function getId_conhecimentos_linguisticos() {
        return $this->id_conhecimentos_linguisticos;
    }

    public function setId_conhecimentos_linguisticos($id_conhecimentos_linguisticos) {
        $this->id_conhecimentos_linguisticos = $id_conhecimentos_linguisticos;
    }

    public function getCandidato_id_candidato() {
        return $this->candidato_id_candidato;
    }

    public function setCandidato_id_candidato($candidato_id_candidato) {
        $this->candidato_id_candidato = $candidato_id_candidato;
    }

    public function getLinguas_id_linguas_materna() {
        return $this->linguas_id_linguas_materna;
    }

    public function setLinguas_id_linguas_materna($linguas_id_linguas_materna) {
        $this->linguas_id_linguas_materna = $linguas_id_linguas_materna;
    }

    public function getLingua_alternativa_id_lingua_alternativa() {
        return $this->lingua_alternativa_id_lingua_alternativa;
    }

    public function setLingua_alternativa_id_lingua_alternativa($lingua_alternativa_id_lingua_alternativa) {
        $this->lingua_alternativa_id_lingua_alternativa = $lingua_alternativa_id_lingua_alternativa;
    }
    
}

?>
