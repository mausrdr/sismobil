<?php

class Atividade_has_tipo_atividade_to extends CI_Model {
    
    function __construct() {
        
        parent::__construct();
        
    }
    
    private $id_atividade_has_tipo_atividade;
    private $atividade_id_atividade;
    private $tipo_atividade_id_tipo_atividade;
    
    public function getId_atividade_has_tipo_atividade() {
        return $this->id_atividade_has_tipo_atividade;
    }

    public function setId_atividade_has_tipo_atividade($id_atividade_has_tipo_atividade) {
        $this->id_atividade_has_tipo_atividade = $id_atividade_has_tipo_atividade;
    }

    public function getAtividade_id_atividade() {
        return $this->atividade_id_atividade;
    }

    public function setAtividade_id_atividade($atividade_id_atividade) {
        $this->atividade_id_atividade = $atividade_id_atividade;
    }

    public function getTipo_atividade_id_tipo_atividade() {
        return $this->tipo_atividade_id_tipo_atividade;
    }

    public function setTipo_atividade_id_tipo_atividade($tipo_atividade_id_tipo_atividade) {
        $this->tipo_atividade_id_tipo_atividade = $tipo_atividade_id_tipo_atividade;
    }

}

?>
