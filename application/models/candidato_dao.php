<?php

class Candidato_dao extends CI_Model {
    
    function __construct() {
        
        parent::__construct();
        
    }
    
    public function insereCandidato(Candidato_to $candidato) {
        
        $candidato->setData_expedicao($this->inverteData($candidato->getData_expedicao(), TRUE));
        $candidato->setData_nascimento($this->inverteData($candidato->getData_nascimento(), TRUE));
        
        $sha256_password = hash('sha256', $candidato->getCodigo_acesso());
        
        $query_str = "INSERT INTO candidato (nome, sexo, endereco, numero, complemento, bairro, cidade, cep, estado, pais, telefone, celular, rg, data_expedicao, orgao_emissor, cpf, passaporte, nacionalidade, email, data_nascimento, codigo_acesso) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        
        $this->db->query($query_str, array($candidato->getNome(),$candidato->getSexo(),$candidato->getEndereco(),$candidato->getNumero(),$candidato->getComplemento(),$candidato->getBairro(),$candidato->getCidade(),$candidato->getCep(),$candidato->getEstado(),$candidato->getPais(),$candidato->getTelefone(),$candidato->getCelular(),$candidato->getRg(),$candidato->getData_expedicao(),$candidato->getOrgao_emissor(),$candidato->getCpf(),$candidato->getPassaporte(),$candidato->getNacionalidade(),$candidato->getEmail(),$candidato->getData_nascimento(),$sha256_password));
        
        if($this->db->affected_rows()) {
            
            return $this->db->insert_id();
            
        } else {
            
            return false;
            
        }
        
    }
    
    public function pegaId($cpf) {
        
        $query_str = "SELECT id_candidato FROM candidato WHERE cpf = ?";
        
        $result = $this->db->query($query_str, $cpf);
        
        if($result->num_rows() == 1) {
            
            $row = $result->row();
            
            return $row->id_candidato;
            
        }
        else {
            
            return false;
            
        }
        
    }
    
    public function candidatoExiste($cpf) {
        
        $query_str = "SELECT cpf FROM candidato WHERE cpf = ?";
        
        $result = $this->db->query($query_str, $cpf);
        
        if($result->num_rows() > 0) {
            
            return true;
            
        } else {
            
            return false;
            
        }
        
    }
    
    public function candidatoLogin($cpf, $senha) {
        
        $sha256_password = hash('sha256', $senha);
        
        $query_str = "SELECT nome FROM candidato WHERE cpf = ? AND codigo_acesso = ?";
        
        $result = $this->db->query($query_str, array($cpf, $sha256_password));
        
        if($result->num_rows() > 0) {
            
            return true;
            
        } else {
            
            return false;
            
        }
        
    }
    
    public function getNomeIdRestaura($email) {
        
        $query_str = "SELECT id_candidato, nome FROM candidato WHERE email = ?";
        
        $result = $this->db->query($query_str, $email);
        
        if($result->num_rows() == 1) {
            
            $row = $result->row();
            
            $dados['id_candidato'] = $row->id_candidato;
            $dados['nome'] = $row->nome;
            
            return $dados;
            
        }
        
        return FALSE;
        
    }
    
    public function trocaCodigoAcesso($id_candidato, $codigo_acesso) {
        
        $sha256_password = hash('sha256', $codigo_acesso);
        
        $query_str = "UPDATE candidato SET codigo_acesso = ? WHERE id_candidato = ?";
        
        $this->db->query($query_str, array($sha256_password, $id_candidato));
        
        if($this->db->affected_rows()) {
            
            return TRUE;
            
        }
        
        return FALSE;
        
    }
    
    public function emailExiste($email) {
        
        $query_str = "SELECT email FROM candidato WHERE email = ?";
        
        $result = $this->db->query($query_str, $email);
        
        if($result->num_rows() == 1) {
            
            return TRUE;
            
        }
        
        return FALSE;
        
    }
            
    public function inverteData($data, $flag) {
        
        if($flag) {
            
            $inv_data = strftime('%Y-%m-%d', strtotime(str_replace('/', '-', $data)));
            return $inv_data;
            
        } else {
            
            $inv_data = strftime('%d/%m/%Y', strtotime($data));
            return $inv_data;
            
        }
        
    }
    
}

?>
