<?php

class Vagas_campus_dao extends CI_Model {
    
    function __construct() {
        
        parent::__construct();
        
    }
    
    /**
     * 
     * @param Vagas_campus_to $vagas_campus
     * @return boolean
     */
    public function insertVagasCampus(Vagas_campus_to $vagas_campus) {
        
        $query_str = "INSERT INTO vagas_campus (vagas, edital_id_edital, universidade_id_universidade, campus_universidade_id_campus_universidade) VALUES (?, ?, ?, ?)";
        
        $this->db->query($query_str, array($vagas_campus->getVagas(), $vagas_campus->getEdital_id_edital(), $vagas_campus->getUniversidade_id_universidade(), $vagas_campus->getCampus_universidade_id_campus_universidade()));
        
        if($this->db->affected_rows()) {
            
            return TRUE;
            
        } else {
            
            return FALSE;
            
        }
        
    }
    
    /**
     * 
     * @param Vagas_campus_to $vagas_campus
     * @return boolean
     */
    public function vagas_campusExiste(Vagas_campus_to $vagas_campus) {
        
        $query_str = "SELECT id_vagas_campus FROM vagas_campus WHERE edital_id_edital = ? AND universidade_id_universidade = ? AND campus_universidade_id_campus_universidade = ?";
        
        $result = $this->db->query($query_str, array($vagas_campus->getEdital_id_edital(), $vagas_campus->getUniversidade_id_universidade(), $vagas_campus->getCampus_universidade_id_campus_universidade()));
        
        if($result->num_rows() > 0) {
            
            return TRUE;
            
        } else {
            
            return FALSE;
            
        }
        
    }
    
    /**
     * 
     * @param type $id_edital
     * @return boolean
     */
    public function getCampusMatriz($id_edital) {
        
        $query_str = "SELECT c.id_campus_universidade AS 'id', c.descricao_campus AS 'descricao' FROM campus_universidade c, vagas_campus v WHERE v.edital_id_edital = ? AND c.id_campus_universidade = v.campus_universidade_id_campus_universidade";
        
        $result = $this->db->query($query_str, $id_edital);
        
        if($result->num_rows() > 0) {
            
            $row = $result->result_array();
            
            foreach ($row as $data) {
                
                $campus[] = array(
                    
                    'id'            =>  $data['id'],
                    'descricao'     =>  $data['descricao']
                    
                );
                
            }
            
            return json_encode($campus);
            
        }
        
        return FALSE;
        
    }
    
    public function listMatrizVagas($id_edital) {
        
        $query_str = "SELECT v.id_vagas_campus AS 'id', e.numero_edital AS 'numero', u.descricao_universidade AS 'descricao_universidade', c.descricao_campus AS 'descricao_campus', v.vagas AS 'vagas' FROM universidade u, edital e, vagas_campus v, campus_universidade c WHERE e.id_edital = ? AND v.edital_id_edital = e.id_edital AND u.id_universidade = v.universidade_id_universidade AND c.id_campus_universidade = v.campus_universidade_id_campus_universidade AND v.campus_universidade_id_campus_universidade NOT IN (SELECT ehc.campus_universidade_id_campus_universidade FROM edital_has_curso ehc	WHERE ehc.edital_id_edital = v.edital_id_edital AND ehc.universidade_id_universidade = v.universidade_id_universidade AND ehc.campus_universidade_id_campus_universidade = v.campus_universidade_id_campus_universidade)";
        
        $result = $this->db->query($query_str, $id_edital);
        
        if($result->num_rows() > 0) {
            
            $row = $result->result_array();
            
            return $row;
            
        }
        
        return FALSE;
        
    }
    
    public function getVagasCampus($id_vagas_campus) {
        
        $query_str = "SELECT * FROM vagas_campus WHERE id_vagas_campus = ?";
        
        $result = $this->db->query($query_str, $id_vagas_campus);
        
        if($result->num_rows() == 1) {
            
            $row = $result->row();
            
            $vc = new Vagas_campus_to();
            $vc->setId_vagas_campus($row->id_vagas_campus);
            $vc->setEdital_id_edital($row->edital_id_edital);
            $vc->setUniversidade_id_universidade($row->universidade_id_universidade);
            $vc->setCampus_universidade_id_campus_universidade($row->campus_universidade_id_campus_universidade);
            $vc->setVagas($row->vagas);
            $vc->setVagas_preenchidas($row->vagas_preenchidas);
            
            return $vc;
            
        }
        
        return FALSE;
        
    }
    
    public function vagasCampusUpdateExiste(Vagas_campus_to $vagas_campus) {
        
        $query_str = "SELECT id_vagas_campus FROM vagas_campus WHERE edital_id_edital = ? AND universidade_id_universidade = ? AND campus_universidade_id_campus_universidade = ? AND id_vagas_campus <> ?";
        
        $result = $this->db->query($query_str, array($vagas_campus->getEdital_id_edital(), $vagas_campus->getUniversidade_id_universidade(), $vagas_campus->getCampus_universidade_id_campus_universidade(), $vagas_campus->getId_vagas_campus()));
        
        if($result->num_rows() > 0) {
            
            return TRUE;
            
        }
            
        return FALSE;
            
    }
    
    public function updateVagasCampus(Vagas_campus_to $vagas_campus) {
        
        $query_str = "UPDATE vagas_campus SET vagas = ?, universidade_id_universidade = ?, campus_universidade_id_campus_universidade = ? WHERE id_vagas_campus = ?";
        
        $this->db->query($query_str, array($vagas_campus->getVagas(), $vagas_campus->getUniversidade_id_universidade(), $vagas_campus->getCampus_universidade_id_campus_universidade(), $vagas_campus->getId_vagas_campus()));
        
        if($this->db->affected_rows()) {
            
            return TRUE;
            
        }
        
        return FALSE;
        
    }
    
    public function getCampusMatrizVagas($id_edital) {
        
        $query_str = "SELECT c.id_campus_universidade AS 'id', c.descricao_campus AS 'descricao' FROM campus_universidade c, vagas_campus v WHERE v.edital_id_edital = ? AND c.id_campus_universidade = v.campus_universidade_id_campus_universidade";
        
        $result = $this->db->query($query_str, $id_edital);
        
        if($result->num_rows() > 0) {
            
            $row = $result->result_array();
            
            return $row;
            
        }
        
        return FALSE;
        
    }
    
    public function deleteVagasCampus($id_vagas_campus) {
        
        $query_str = "DELETE FROM vagas_campus WHERE id_vagas_campus = ?";
        
        $this->db->query($query_str, $id_vagas_campus);
        
        if($this->db->affected_rows()) {
            
            return TRUE;
            
        }
        
        return FALSE;
        
    }
    
}

?>
