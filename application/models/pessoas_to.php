<?php

class Pessoas_to extends CI_Model {
    
    function __construct() {
        
        parent::__construct();
        
    }
    
    private $id_pessoas;
    private $nome;
    private $cargo;
    private $funcao;
    private $siape;
    private $portaria;
    private $email;
    private $username;
    private $senha;
    private $ativo;
    private $permissao_id_permissao;
    
    public function getId_pessoas() {
        return $this->id_pessoas;
    }

    public function setId_pessoas($id_pessoas) {
        $this->id_pessoas = $id_pessoas;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getCargo() {
        return $this->cargo;
    }

    public function setCargo($cargo) {
        $this->cargo = $cargo;
    }

    public function getFuncao() {
        return $this->funcao;
    }

    public function setFuncao($funcao) {
        $this->funcao = $funcao;
    }

    public function getSiape() {
        return $this->siape;
    }

    public function setSiape($siape) {
        $this->siape = $siape;
    }

    public function getPortaria() {
        return $this->portaria;
    }

    public function setPortaria($portaria) {
        $this->portaria = $portaria;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function getAtivo() {
        return $this->ativo;
    }

    public function setAtivo($ativo) {
        $this->ativo = $ativo;
    }

    public function getPermissao_id_permissao() {
        return $this->permissao_id_permissao;
    }

    public function setPermissao_id_permissao($permissao_id_permissao) {
        $this->permissao_id_permissao = $permissao_id_permissao;
    }

}

?>
