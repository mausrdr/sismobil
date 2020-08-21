<?php

class Lingua_alternativa_to extends CI_Model {
    
    function __construct() {
        
        parent::__construct();
        
    }
    
    private $id_lingua_alternativa;
    
    public function getId_lingua_alternativa() {
        return $this->id_lingua_alternativa;
    }

    public function setId_lingua_alternativa($id_lingua_alternativa) {
        $this->id_lingua_alternativa = $id_lingua_alternativa;
    }

}

?>
