<?php

class Campus_to extends CI_Model {
    
    function __construct() {
        
        parent::__construct();
        
    }
    
    private $id_campus;
    private $nome_campus;
    private $diretor;
    private $telefone_campus;
    private $fax;
    
    public function getId_campus() {
        return $this->id_campus;
    }

    public function setId_campus($id_campus) {
        $this->id_campus = $id_campus;
    }

    public function getNome_campus() {
        return $this->nome_campus;
    }

    public function setNome_campus($nome_campus) {
        $this->nome_campus = $nome_campus;
    }

    public function getDiretor() {
        return $this->diretor;
    }

    public function setDiretor($diretor) {
        $this->diretor = $diretor;
    }

    public function getTelefone_campus() {
        return $this->telefone_campus;
    }

    public function setTelefone_campus($telefone_campus) {
        $this->telefone_campus = $telefone_campus;
    }

    public function getFax() {
        return $this->fax;
    }

    public function setFax($fax) {
        $this->fax = $fax;
    }

}

?>
