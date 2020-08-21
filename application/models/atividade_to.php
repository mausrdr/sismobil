<?php

class Atividade_to extends CI_Model {
    
    function __construct() {
        
        parent::__construct();
        
    }
    
    private $id_atividade;
    
    public function getId_atividade() {
        return $this->id_atividade;
    }

    public function setId_atividade($id_atividade) {
        $this->id_atividade = $id_atividade;
    }

}

?>
