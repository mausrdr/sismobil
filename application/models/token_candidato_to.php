<?php

class Token_candidato_to extends CI_Model {
    
    function __construct() {
        
        parent::__construct();
        
    }
    
    private $id_token_candidato;
    private $candidato_id_candidato;
    private $codigo;
    private $token_time;
    private $ip_address;
    
    public function getId_token_candidato() {
        return $this->id_token_candidato;
    }

    public function setId_token_candidato($id_token_candidato) {
        $this->id_token_candidato = $id_token_candidato;
    }

    public function getCandidato_id_candidato() {
        return $this->candidato_id_candidato;
    }

    public function setCandidato_id_candidato($candidato_id_candidato) {
        $this->candidato_id_candidato = $candidato_id_candidato;
    }

    public function getCodigo() {
        return $this->codigo;
    }

    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    public function getToken_time() {
        return $this->token_time;
    }

    public function setToken_time($token_time) {
        $this->token_time = $token_time;
    }

    public function getIp_address() {
        return $this->ip_address;
    }

    public function setIp_address($ip_address) {
        $this->ip_address = $ip_address;
    }

}

?>
