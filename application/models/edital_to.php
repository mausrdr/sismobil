<?php

class Edital_to extends CI_Model {
    
    function __construct() {
        
        parent::__construct();
        
    }
    
    private $id_edital;
    private $numero_edital;
    private $total_vagas;
    private $data_abertura;
    private $data_encerramento;
    private $opcao_destino;
    private $assistencia;


    public function getId_edital() {
        return $this->id_edital;
    }

    public function setId_edital($id_edital) {
        $this->id_edital = $id_edital;
    }

    public function getNumero_edital() {
        return $this->numero_edital;
    }

    public function setNumero_edital($numero_edital) {
        $this->numero_edital = $numero_edital;
    }

    public function getTotal_vagas() {
        return $this->total_vagas;
    }

    public function setTotal_vagas($total_vagas) {
        $this->total_vagas = $total_vagas;
    }

    public function getData_abertura() {
        return $this->data_abertura;
    }

    public function setData_abertura($data_abertura) {
        $this->data_abertura = $data_abertura;
    }

    public function getData_encerramento() {
        return $this->data_encerramento;
    }

    public function setData_encerramento($data_encerramento) {
        $this->data_encerramento = $data_encerramento;
    }
    
    public function getOpcao_destino() {
        return $this->opcao_destino;
    }

    public function setOpcao_destino($opcao_destino) {
        $this->opcao_destino = $opcao_destino;
    }
    
    public function getAssistencia() {
        return $this->assistencia;
    }

    public function setAssistencia($assistencia) {
        $this->assistencia = $assistencia;
    }

}

?>
