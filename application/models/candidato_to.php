<?php

class Candidato_to extends CI_Model {
    
    function __construct() {
        
        parent::__construct();
        
    }
    
    private $id_candidato;
    private $nome;
    private $sexo;
    private $endereco;
    private $numero;
    private $complemento;
    private $bairro;
    private $cidade;
    private $cep;
    private $estado;
    private $pais;
    private $telefone;
    private $celular;
    private $rg;
    private $data_expedicao;
    private $orgao_emissor;
    private $cpf;
    private $passaporte;
    private $nacionalidade;
    private $email;
    private $data_nascimento;
    private $codigo_acesso;
    
    public function getId_candidato() {
        return $this->id_candidato;
    }

    public function setId_candidato($id_candidato) {
        $this->id_candidato = $id_candidato;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getSexo() {
        return $this->sexo;
    }

    public function setSexo($sexo) {
        $this->sexo = $sexo;
    }

    public function getEndereco() {
        return $this->endereco;
    }

    public function setEndereco($endereco) {
        $this->endereco = $endereco;
    }

    public function getNumero() {
        return $this->numero;
    }

    public function setNumero($numero) {
        $this->numero = $numero;
    }

    public function getComplemento() {
        return $this->complemento;
    }

    public function setComplemento($complemento) {
        $this->complemento = $complemento;
    }

    public function getBairro() {
        return $this->bairro;
    }

    public function setBairro($bairro) {
        $this->bairro = $bairro;
    }

    public function getCidade() {
        return $this->cidade;
    }

    public function setCidade($cidade) {
        $this->cidade = $cidade;
    }

    public function getCep() {
        return $this->cep;
    }

    public function setCep($cep) {
        $this->cep = $cep;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    public function getPais() {
        return $this->pais;
    }

    public function setPais($pais) {
        $this->pais = $pais;
    }

    public function getTelefone() {
        return $this->telefone;
    }

    public function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    public function getCelular() {
        return $this->celular;
    }

    public function setCelular($celular) {
        $this->celular = $celular;
    }

    public function getRg() {
        return $this->rg;
    }

    public function setRg($rg) {
        $this->rg = $rg;
    }

    public function getData_expedicao() {
        return $this->data_expedicao;
    }

    public function setData_expedicao($data_expedicao) {
        $this->data_expedicao = $data_expedicao;
    }

    public function getOrgao_emissor() {
        return $this->orgao_emissor;
    }

    public function setOrgao_emissor($orgao_emissor) {
        $this->orgao_emissor = $orgao_emissor;
    }

    public function getCpf() {
        return $this->cpf;
    }

    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    public function getPassaporte() {
        return $this->passaporte;
    }

    public function setPassaporte($passaporte) {
        $this->passaporte = $passaporte;
    }

    public function getNacionalidade() {
        return $this->nacionalidade;
    }

    public function setNacionalidade($nacionalidade) {
        $this->nacionalidade = $nacionalidade;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getData_nascimento() {
        return $this->data_nascimento;
    }

    public function setData_nascimento($data_nascimento) {
        $this->data_nascimento = $data_nascimento;
    }

    public function getCodigo_acesso() {
        return $this->codigo_acesso;
    }

    public function setCodigo_acesso($senha) {
        $this->codigo_acesso = $senha;
    }

}

?>
