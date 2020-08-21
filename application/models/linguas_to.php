<?php

class Linguas_to extends CI_Model {
    
    function __construct() {
        
        parent::__construct();
        
    }
    
    private $id_linguas;
    private $descricao_linguas;
    
    public function getId_linguas() {
        return $this->id_linguas;
    }

    public function setId_linguas($id_linguas) {
        $this->id_linguas = $id_linguas;
    }

    public function getDescricao_linguas() {
        return $this->descricao_linguas;
    }

    public function setDescricao_linguas($descricao_linguas) {
        $this->descricao_linguas = $descricao_linguas;
    }


    
}

?>
