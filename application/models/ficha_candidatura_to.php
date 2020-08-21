<?php

class Ficha_candidatura_to extends CI_Model{
    
    function __construct() {
        
        parent::__construct();
        
    }
    
    private $id_ficha_candidatura;
    private $ficha_id_ficha;
    private $candidato_id_candidato;
    private $edital_id_edital;
    private $nome;
    private $sexo;
    private $endereco;
    private $numero_endereco;
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
    private $nome_campus;
    private $curso_origem;
    private $semestre_atual;
    private $semestre_total;
    private $media_geral;
    private $coordenador;
    private $diretor;
    private $telefone_campus;
    private $fax;
    private $universidade;
    private $campus;
    private $curso;
    private $periodo;
    private $descricao_atividade;
    private $informacoes;
    private $lingua_materna;
    private $lingua_alternativa;
    private $fluencia_linguistica;
    private $financiamento;
    private $carta;
    private $iniciacao_cientifica;
    private $extencao_cultural;
    private $aceite;
    private $data_aceite;
    private $aprovado;
    private $bic;
    private $pvpp;
    private $po;
    private $estagio;
    private $ecc;

    public function getId_ficha_candidatura() {
        return $this->id_ficha_candidatura;
    }
    
    public function setId_ficha_candidatura($id_ficha_candidatura) {
        $this->id_ficha_candidatura = $id_ficha_candidatura;
    }

    public function getFicha_id_ficha() {
        return $this->ficha_id_ficha;
    }

    public function setFicha_id_ficha($ficha_id_ficha) {
        $this->ficha_id_ficha = $ficha_id_ficha;
    }

    public function getCandidato_id_candidato() {
        return $this->candidato_id_candidato;
    }

    public function setCandidato_id_candidato($candidato_id_candidato) {
        $this->candidato_id_candidato = $candidato_id_candidato;
    }
    
    public function getEdital_id_edital() {
        return $this->edital_id_edital;
    }

    public function setEdital_id_edital($edital_id_edital) {
        $this->edital_id_edital = $edital_id_edital;
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

    public function getNumero_endereco() {
        return $this->numero_endereco;
    }

    public function setNumero_endereco($numero_endereco) {
        $this->numero_endereco = $numero_endereco;
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

    public function getNome_campus() {
        return $this->nome_campus;
    }

    public function setNome_campus($nome_campus) {
        $this->nome_campus = $nome_campus;
    }

    public function getCurso_origem() {
        return $this->curso_origem;
    }

    public function setCurso_origem($curso_origem) {
        $this->curso_origem = $curso_origem;
    }

    public function getSemestre_atual() {
        return $this->semestre_atual;
    }

    public function setSemestre_atual($semestre_atual) {
        $this->semestre_atual = $semestre_atual;
    }

    public function getSemestre_total() {
        return $this->semestre_total;
    }

    public function setSemestre_total($semestre_total) {
        $this->semestre_total = $semestre_total;
    }

    public function getMedia_geral() {
        return $this->media_geral;
    }

    public function setMedia_geral($media_geral) {
        $this->media_geral = $media_geral;
    }

    public function getCoordenador() {
        return $this->coordenador;
    }

    public function setCoordenador($coordenador) {
        $this->coordenador = $coordenador;
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

    public function getUniversidade() {
        return $this->universidade;
    }

    public function setUniversidade($universidade) {
        $this->universidade = $universidade;
    }
    
    public function getCampus() {
        return $this->campus;
    }

    public function setCampus($campus) {
        $this->campus = $campus;
    }

    public function getCurso() {
        return $this->curso;
    }

    public function setCurso($curso) {
        $this->curso = $curso;
    }

    public function getPeriodo() {
        return $this->periodo;
    }

    public function setPeriodo($periodo) {
        $this->periodo = $periodo;
    }

    public function getDescricao_atividade() {
        return $this->descricao_atividade;
    }

    public function setDescricao_atividade($descricao_atividade) {
        $this->descricao_atividade = $descricao_atividade;
    }

    public function getInformacoes() {
        return $this->informacoes;
    }

    public function setInformacoes($informacoes) {
        $this->informacoes = $informacoes;
    }

    public function getLingua_materna() {
        return $this->lingua_materna;
    }

    public function setLingua_materna($lingua_materna) {
        $this->lingua_materna = $lingua_materna;
    }

    public function getLingua_alternativa() {
        return $this->lingua_alternativa;
    }

    public function setLingua_alternativa($lingua_alternativa) {
        $this->lingua_alternativa = $lingua_alternativa;
    }

    public function getFluencia_linguistica() {
        return $this->fluencia_linguistica;
    }

    public function setFluencia_linguistica($fluencia_linguistica) {
        $this->fluencia_linguistica = $fluencia_linguistica;
    }

    public function getFinanciamento() {
        return $this->financiamento;
    }

    public function setFinanciamento($financiamento) {
        $this->financiamento = $financiamento;
    }

    public function getCarta() {
        return $this->carta;
    }

    public function setCarta($carta) {
        $this->carta = $carta;
    }

    public function getIniciacao_cientifica() {
        return $this->iniciacao_cientifica;
    }

    public function setIniciacao_cientifica($iniciacao_cientifica) {
        $this->iniciacao_cientifica = $iniciacao_cientifica;
    }

    public function getExtencao_cultural() {
        return $this->extencao_cultural;
    }

    public function setExtencao_cultural($extencao_cultural) {
        $this->extencao_cultural = $extencao_cultural;
    }

    public function getAceite() {
        return $this->aceite;
    }

    public function setAceite($aceite) {
        $this->aceite = $aceite;
    }

    public function getData_aceite() {
        return $this->data_aceite;
    }

    public function setData_aceite($data_aceite) {
        $this->data_aceite = $data_aceite;
    }

    public function getAprovado() {
        return $this->aprovado;
    }

    public function setAprovado($aprovado) {
        $this->aprovado = $aprovado;
    }
    
    public function getBic() {
        return $this->bic;
    }

    public function setBic($bic) {
        $this->bic = $bic;
    }

    public function getPvpp() {
        return $this->pvpp;
    }

    public function setPvpp($pvpp) {
        $this->pvpp = $pvpp;
    }

    public function getPo() {
        return $this->po;
    }

    public function setPo($po) {
        $this->po = $po;
    }

    public function getEstagio() {
        return $this->estagio;
    }

    public function setEstagio($estagio) {
        $this->estagio = $estagio;
    }

    public function getEcc() {
        return $this->ecc;
    }

    public function setEcc($ecc) {
        $this->ecc = $ecc;
    }

}

?>
