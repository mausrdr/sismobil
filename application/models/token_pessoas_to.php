<?php

class Token_pessoas_to extends CI_Model {
    
    function __construct() {
        
        parent::__construct();
        
    }
    
    private $id_token_pessoas;
    private $pessoas_id_pessoas;
    private $codigo;
    private $token_time;
    private $ip_address;
    
    public function getId_token_pessoas() {
        return $this->id_token_pessoas;
    }

    public function setId_token_pessoas($id_token_pessoas) {
        $this->id_token_pessoas = $id_token_pessoas;
    }

    public function getPessoas_id_pessoas() {
        return $this->pessoas_id_pessoas;
    }

    public function setPessoas_id_pessoas($pessoas_id_pessoas) {
        $this->pessoas_id_pessoas = $pessoas_id_pessoas;
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
