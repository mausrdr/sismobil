<?php

class Lingua_alternativa_has_linguas_to extends CI_Model {
    
    function __construct() {
        
        parent::__construct();
        
    }
    
    private $id_lingua_alternativa_has_linguas;
    private $lingua_alternativa_id_lingua_alternativa;
    private $linguas_id_linguas;
    private $fluencia_linguistica_id_fluencia_linguistica;
    
    public function getId_lingua_alternativa_has_linguas() {
        return $this->id_lingua_alternativa_has_linguas;
    }

    public function setId_lingua_alternativa_has_linguas($id_lingua_alternativa_has_linguas) {
        $this->id_lingua_alternativa_has_linguas = $id_lingua_alternativa_has_linguas;
    }

    public function getLingua_alternativa_id_lingua_alternativa() {
        return $this->lingua_alternativa_id_lingua_alternativa;
    }

    public function setLingua_alternativa_id_lingua_alternativa($lingua_alternativa_id_lingua_alternativa) {
        $this->lingua_alternativa_id_lingua_alternativa = $lingua_alternativa_id_lingua_alternativa;
    }

    public function getLinguas_id_linguas() {
        return $this->linguas_id_linguas;
    }

    public function setLinguas_id_linguas($linguas_id_linguas) {
        $this->linguas_id_linguas = $linguas_id_linguas;
    }

    public function getFluencia_linguistica_id_fluencia_linguistica() {
        return $this->fluencia_linguistica_id_fluencia_linguistica;
    }

    public function setFluencia_linguistica_id_fluencia_linguistica($fluencia_linguistica_id_fluencia_linguistica) {
        $this->fluencia_linguistica_id_fluencia_linguistica = $fluencia_linguistica_id_fluencia_linguistica;
    }

}

?>
