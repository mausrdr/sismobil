<?php

class Tipo_financiamento_to extends CI_Model {
    
    function __construct() {
        
        parent::__construct();
        
    }
    
    private $id_tipo_financiamento;
    private $descricao_financiamento;
    
    public function getId_tipo_financiamento() {
        return $this->id_tipo_financiamento;
    }

    public function setId_tipo_financiamento($id_tipo_financiamento) {
        $this->id_tipo_financiamento = $id_tipo_financiamento;
    }

    public function getDescricao_financiamento() {
        return $this->descricao_financiamento;
    }

    public function setDescricao_financiamento($descricao_financiamento) {
        $this->descricao_financiamento = $descricao_financiamento;
    }

}

?>
