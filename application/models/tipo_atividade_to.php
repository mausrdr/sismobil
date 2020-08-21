<?php

class Tipo_atividade_to extends CI_Model {
    
    function __construct() {
        
        parent::__construct();
        
    }
    
    private $id_tipo_atividade;
    private $descricao_atividade;
    
    public function getId_tipo_atividade() {
        return $this->id_tipo_atividade;
    }

    public function setId_tipo_atividade($id_tipo_atividade) {
        $this->id_tipo_atividade = $id_tipo_atividade;
    }

    public function getDescricao_atividade() {
        return $this->descricao_atividade;
    }

    public function setDescricao_atividade($descricao_atividade) {
        $this->descricao_atividade = $descricao_atividade;
    }
    
}

?>
