<?php

class Ficha_curso_to extends CI_Model {
    
    function __construct() {
        
        parent::__construct();
        
    }
    
    private $id_ficha_curso;
    
    public function getId_ficha_curso() {
        return $this->id_ficha_curso;
    }

    public function setId_ficha_curso($id_ficha_curso) {
        $this->id_ficha_curso = $id_ficha_curso;
    }

}

?>
