<?php

class Ficha_curso_has_edital_curso_to extends CI_Model {
    
    function __construct() {
        
        parent::__construct();
        
    }
    
    private $id_ficha_curso_has_edital_curso;
    private $ficha_curso_id_ficha_curso;
    private $edital_has_curso_id_edital_has_curso;
    
    public function getId_ficha_curso_has_edital_curso() {
        return $this->id_ficha_curso_has_edital_curso;
    }

    public function setId_ficha_curso_has_edital_curso($id_ficha_curso_has_edital_curso) {
        $this->id_ficha_curso_has_edital_curso = $id_ficha_curso_has_edital_curso;
    }

    public function getFicha_curso_id_ficha_curso() {
        return $this->ficha_curso_id_ficha_curso;
    }

    public function setFicha_curso_id_ficha_curso($ficha_curso_id_ficha_curso) {
        $this->ficha_curso_id_ficha_curso = $ficha_curso_id_ficha_curso;
    }

    public function getEdital_has_curso_id_edital_has_curso() {
        return $this->edital_has_curso_id_edital_has_curso;
    }

    public function setEdital_has_curso_id_edital_has_curso($edital_has_curso_id_edital_has_curso) {
        $this->edital_has_curso_id_edital_has_curso = $edital_has_curso_id_edital_has_curso;
    }

}

?>
