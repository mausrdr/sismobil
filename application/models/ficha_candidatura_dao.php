<?php

class Ficha_candidatura_dao extends CI_Model {
    
    function __construct() {
        
        parent::__construct();
        
    }
    
    public function insereFichaCandidatura(Ficha_candidatura_to $fc) {
        
        $fc->setData_expedicao($this->inverteData($fc->getData_expedicao(), true));
        $fc->setData_nascimento($this->inverteData($fc->getData_nascimento(), true));
        
        $query_str = "INSERT INTO ficha_candidatura(ficha_id_ficha, candidato_id_candidato, edital_id_edital, nome, sexo, endereco, numero_endereco, complemento, bairro, cidade, cep, estado, pais, telefone, celular, rg, data_expedicao, orgao_emissor, cpf, passaporte, nacionalidade, email, data_nascimento, nome_campus, nome_curso, semestre_atual, semestre_total, media_geral, coordenador, diretor, telefone_campus, fax, universidade, campus, curso, periodo, descricao_atividade, informacoes, lingua_materna, lingua_alternativa, fluencia_linguistica, financiamento, carta, iniciacao_cientifica, extencao_cultural, aceite, data_aceite, aprovado, bic, pvpp, po, estagio, ecc) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        
        $this->db->query($query_str, array($fc->getFicha_id_ficha(), $fc->getCandidato_id_candidato(), $fc->getEdital_id_edital(), $fc->getNome(),$fc->getSexo(), $fc->getEndereco(), $fc->getNumero_endereco(), $fc->getComplemento(), $fc->getBairro(), $fc->getCidade(), $fc->getCep(), $fc->getEstado(), $fc->getPais(), $fc->getTelefone(), $fc->getCelular(), $fc->getRg(), $fc->getData_expedicao(), $fc->getOrgao_emissor(), $fc->getCpf(), $fc->getPassaporte(), $fc->getNacionalidade(), $fc->getEmail(), $fc->getData_nascimento(), $fc->getNome_campus(), $fc->getCurso_origem(), $fc->getSemestre_atual(), $fc->getSemestre_total(), $fc->getMedia_geral(), $fc->getCoordenador(), $fc->getDiretor(), $fc->getTelefone_campus(), $fc->getFax(), $fc->getUniversidade(), $fc->getCampus(), $fc->getCurso(), $fc->getPeriodo(), $fc->getDescricao_atividade(), $fc->getInformacoes(), $fc->getLingua_materna(), $fc->getLingua_alternativa(), $fc->getFluencia_linguistica(), $fc->getFinanciamento(), $fc->getCarta(), $fc->getIniciacao_cientifica(), $fc->getExtencao_cultural(), $fc->getAceite(), $fc->getData_aceite(), $fc->getAprovado(), $fc->getBic(), $fc->getPvpp(), $fc->getPo(), $fc->getEstagio(), $fc->getEcc()));
        
        if($this->db->affected_rows()) {
            
            return $this->db->insert_id();
            
        }
            
        return FALSE;
            
    }


    public function getIdCandidatoIdFicha($id_candidato) {
        
        $query_str = "SELECT id_ficha_candidatura, candidato_id_candidato FROM ficha_candidatura WHERE candidato_id_candidato = ? ORDER BY id_ficha_candidatura DESC LIMIT 1";
        
        $result = $this->db->query($query_str, $id_candidato);
        
        if($result->num_rows() == 1) {
            
            $row = $result->row();
            
            return $row;
            
        }
            
        return false;
        
    }

    public function getFichaCandidatura($id_ficha) {
        
        $query_str = "SELECT * FROM ficha_candidatura WHERE ficha_id_ficha = ?";
        
        $result = $this->db->query($query_str, $id_ficha);
        
        if($result->num_rows() == 1) {
            
            $row = $result->row();
            
            $fc = new Ficha_candidatura_to();
            $fc->setId_ficha_candidatura($row->id_ficha_candidatura);
            $fc->setFicha_id_ficha($row->ficha_id_ficha);
            $fc->setCandidato_id_candidato($row->candidato_id_candidato);
            $fc->setEdital_id_edital($row->edital_id_edital);
            $fc->setNome($row->nome);
            $fc->setSexo($row->sexo);
            $fc->setEndereco($row->endereco);
            $fc->setNumero_endereco($row->numero_endereco);
            $fc->setComplemento($row->complemento);
            $fc->setBairro($row->bairro);
            $fc->setCidade($row->cidade);
            $fc->setCep($row->cep);
            $fc->setEstado($row->estado);
            $fc->setPais($row->pais);
            $fc->setTelefone($row->telefone);
            $fc->setCelular($row->celular);
            $fc->setRg($row->rg);
            $fc->setData_expedicao($this->inverteData($row->data_expedicao, false));
            $fc->setOrgao_emissor($row->orgao_emissor);
            $fc->setCpf($row->cpf);
            $fc->setPassaporte($row->passaporte);
            $fc->setNacionalidade($row->nacionalidade);
            $fc->setEmail($row->email);
            $fc->setData_nascimento($this->inverteData($row->data_nascimento, false));
            $fc->setNome_campus($row->nome_campus);
            $fc->setCurso_origem($row->nome_curso);
            $fc->setSemestre_atual($row->semestre_atual);
            $fc->setSemestre_total($row->semestre_total);
            $fc->setMedia_geral($row->media_geral);
            $fc->setCoordenador($row->coordenador);
            $fc->setDiretor($row->diretor);
            $fc->setTelefone_campus($row->telefone_campus);
            $fc->setFax($row->fax);
            $fc->setUniversidade($row->universidade);
            $fc->setCampus($row->campus);
            $fc->setCurso($row->curso);
            $fc->setPeriodo($row->periodo);
            $fc->setDescricao_atividade($row->descricao_atividade);
            $fc->setInformacoes($row->informacoes);
            $fc->setLingua_materna($row->lingua_materna);
            $fc->setLingua_alternativa($row->lingua_alternativa);
            $fc->setFluencia_linguistica($row->fluencia_linguistica);
            $fc->setFinanciamento($row->financiamento);
            $fc->setCarta($row->carta);
            $fc->setIniciacao_cientifica($row->iniciacao_cientifica);
            $fc->setExtencao_cultural($row->extencao_cultural);
            $fc->setAceite($row->aceite);
            if(!empty($row->data_aceite)){
                
                $fc->setData_aceite($this->inverteData($row->data_aceite, false));
                
            } else {
                
                $fc->setData_aceite($row->data_aceite);
                
            }
            $fc->setAprovado($row->aprovado);
            $fc->setBic($row->bic);
            $fc->setPvpp($row->pvpp);
            $fc->setPo($row->po);
            $fc->setEstagio($row->estagio);
            $fc->setEcc($row->ecc);
            
            return $fc;
            
        }
            
        return false;
            
    }
    
    public function listaFichaReceber($id_edital) {
        
        $query_str = "SELECT id_ficha_candidatura, nome, cpf FROM ficha_candidatura WHERE aceite = 0 AND edital_id_edital = ?";
        
        $result = $this->db->query($query_str, $id_edital);
        
        if($result->num_rows() > 0) {
            
            $rows = $result->result_array();
            
            return $rows;
            
        }
        
        return FALSE;
        
    }
    
    public function listaFichaClassificar($id_edital) {
        
        $query_str = "SELECT nome, cpf, nome_campus AS 'campus', media_geral AS 'cora', CONCAT(bic, pvpp, po, estagio, ecc) AS 'binario' FROM ficha_candidatura WHERE aceite = 0 AND edital_id_edital = ?";
        
        $result = $this->db->query($query_str, $id_edital);
        
        if($result->num_rows() > 0) {
            
            $rows = $result->result_array();
            
            return $rows;
            
        }
        
        return FALSE;
        
    }
    
    public function aceite($id_ficha) {
        
        $data = date('Y-m-d');
        
        $query_str = "UPDATE ficha_candidatura SET aceite = 1, data_aceite = ? WHERE id_ficha_candidatura = ?";
        
        $this->db->query($query_str, array($data, $id_ficha));
        
        if($this->db->affected_rows()) {
            
            return true;
            
        }
            
        return false;
            
    }
    
    public function seleciona($id_ficha) {
        
        $query_str = "UPDATE ficha_candidatura SET aprovado = 1 WHERE id_ficha_candidatura = ?";
        
        $this->db->query($query_str, $id_ficha);
        
        if($this->db->affected_rows()) {
            
            return true;
            
        }
            
        return false;
        
    }
    
    public function getEditalCandidato($id_ficha) {
        
        $query_str = "SELECT edital_id_edital FROM ficha_candidatura WHERE id_ficha_candidatura = ?";
        
        $result = $this->db->query($query_str, $id_ficha);
        
        if($result->num_rows() == 1) {
            
            $row = $result->row();
            
            return $row->edital_id_edital;
            
        }
        
        return FALSE;
        
    }
    
    public function indefere($id_ficha, $justificativa, Classificacao_to $classificacao) {
        
        $query_str = "UPDATE ficha_candidatutra SET bic = ?, pvpp = ?, po = ?, estagio = ?, ecc = ?, justificativa = ? WHERE id_ficha_candidatura = ?";
        
        $this->db->query($query_str, array($classificacao->getBic(), $classificacao->getPvpp(), $classificacao->getPo(), $classificacao->getEstagio(), $classificacao->getEcc(), $justificativa, $id_ficha));
        
        if($this->db->affected_rows()) {
            
            return TRUE;
            
        }
        
        return FALSE;
        
    }
    
    public function getCandidatoId($id_ficha) {
        
        $query_str = "SELECT candidato_id_candidato FROM ficha_candidatura WHERE id_ficha_candidatura = ?";
        
        $result = $this->db->query($query_str, $id_ficha);
        
        if($result->num_rows() == 1) {
            
            $row = $result->row();
            
            return $row->candidato_id_candidato;
            
        }
        
        return FALSE;
        
    }
    
    public function getDadosReceber($id_ficha) {
        
        $query_str = "SELECT nome, cpf, bic, pvpp, po, estagio, ecc FROM ficha_candidatura WHERE id_ficha_candidatura = ?";
        
        $result = $this->db->query($query_str, $id_ficha);
        
        if($result->num_rows() == 1) {
            
            $row = $result->result_array();
            
            return $row;
            
        }
        
        return FALSE;
        
    }
    
    public function getAcompanhamento($candidato_id_candidato, $edital_id_edital) {
        
        $query_str = "SELECT aceite, data_aceite, justificativa, aprovado FROM ficha_candidatura WHERE candidato_id_candidato = ? AND edital_id_edital = ?";
        
        $result = $this->db->query($query_str, array($candidato_id_candidato, $edital_id_edital));
        
        if($result->num_rows() == 1) {
            
            $row = $result->result_array();
            
            return $row;
            
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
