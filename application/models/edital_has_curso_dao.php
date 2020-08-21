<?php

class Edital_has_curso_dao extends CI_Model {
    
    function __construct() {
        
        parent::__construct();
        
    }
    
    /**
     * 
     * @param Edital_has_curso_to $edital_has_curso
     * @return boolean
     */
    public function insertEditalHasCurso(Edital_has_curso_to $edital_has_curso) {
        
        $query_str = "INSERT INTO edital_has_curso (edital_id_edital, universidade_id_universidade, campus_universidade_id_campus_universidade, curso_universidade_id_curso_universidade) VALUES (?, ?, ?, ?)";
        
        $this->db->query($query_str, array($edital_has_curso->getEdital_id_edital(), $edital_has_curso->getUniversidade_id_universidade(), $edital_has_curso->getCampus_universidade_id_campus_universidade(), $edital_has_curso->getCurso_universidade_id_curso_universidade()));
        
        if($this->db->affected_rows()) {
            
            return TRUE;
            
        }
            
        return FALSE;
            
    }
    
    /**
     * 
     * @param Edital_has_curso_to $edital_has_curso
     * @return boolean
     */
    public function editalHasCursoExiste(Edital_has_curso_to $edital_has_curso) {
        
        $query_str = "SELECT id_edital_has_curso FROM edital_has_curso WHERE edital_id_edital = ? AND universidade_id_universidade = ? AND campus_universidade_id_campus_universidade = ? AND curso_universidade_id_curso_universidade = ?";
        
        $result = $this->db->query($query_str, array($edital_has_curso->getEdital_id_edital(), $edital_has_curso->getUniversidade_id_universidade(), $edital_has_curso->getCampus_universidade_id_campus_universidade(), $edital_has_curso->getCurso_universidade_id_curso_universidade()));
        
        if($result->num_rows() > 0) {
            
            return TRUE;
            
        }
            
        return FALSE;
        
    }
    
    public function getIdEditalHasCurso(Edital_has_curso_to $edital_has_curso) {
        
        $query_str = "SELECT id_edital_has_curso FROM edital_has_curso WHERE edital_id_edital = ? AND universidade_id_universidade = ? AND campus_universidade_id_campus_universidade = ? AND curso_universidade_id_curso_universidade = ?";
        
        $result = $this->db->query($query_str, array($edital_has_curso->getEdital_id_edital(), $edital_has_curso->getUniversidade_id_universidade(), $edital_has_curso->getCampus_universidade_id_campus_universidade(), $edital_has_curso->getCurso_universidade_id_curso_universidade()));
        
        if($result->num_rows() == 1) {
            
            $row = $result->row();
            
            return $row->id_edital_has_curso;
            
        }
            
        return FALSE;
        
    }
    
    public function pegaUniversidadeOpcao($id_edital) {
        
        $query_str = "SELECT u.id_universidade AS 'id', u.descricao_universidade AS 'descricao' FROM universidade u, vagas_campus v WHERE v.edital_id_edital = ? AND u.id_universidade = v.universidade_id_universidade";
        
        $result = $this->db->query($query_str, $id_edital);
        
        if($result->num_rows() > 0) {
            
            $row = $result->result_array();
            
            return $row;
            
        }
        
        return FALSE;
        
    }
    
    public function getEditalHasCurso($id_edital_has_curso) {
        
        $query_str = "SELECT * FROM edital_has_curso WHERE id_edital_has_curso = ?";
        
        $result = $this->db->query($query_str, $id_edital_has_curso);
        
        if($result->num_rows() == 1) {
            
            $row = $result->row();
            
            $ehc = new Edital_has_curso_to();
            $ehc->setId_edital_has_curso($row->id_edital_has_curso);
            $ehc->setEdital_id_edital($row->edital_id_edital);
            $ehc->setUniversidade_id_universidade($row->universidade_id_universidade);
            $ehc->setCampus_universidade_id_campus_universidade($row->campus_universidade_id_campus_universidade);
            $ehc->setCurso_universidade_id_curso_universidade($row->curso_universidade_id_curso_universidade);
            
            return $ehc;
            
        }
        
        return FALSE;
        
    }
    
    public function listMatrizCurso($id_edital) {
        
        $query_str = "SELECT ehc.id_edital_has_curso AS 'id', e.numero_edital AS 'numero', u.descricao_universidade AS 'descricao_universidade', c.descricao_campus AS 'descricao_campus', cu.descricao_curso AS 'descricao_curso' FROM universidade u, edital e, edital_has_curso ehc, campus_universidade c, curso_universidade cu WHERE e.id_edital = ? AND ehc.edital_id_edital = e.id_edital AND u.id_universidade = ehc.universidade_id_universidade AND c.id_campus_universidade = ehc.campus_universidade_id_campus_universidade AND cu.id_curso_universidade = ehc.curso_universidade_id_curso_universidade ORDER BY descricao_universidade, descricao_campus, descricao_curso";
        
        $result = $this->db->query($query_str, $id_edital);
        
        if($result->num_rows() > 0) {
            
            $row = $result->result_array();
            
            return $row;
            
        }
        
        return FALSE;
        
    }
    
    public function editalHasCursoUpdateVagasExiste(Vagas_campus_to $vagas_campus) {
        
        $query_str = "SELECT * FROM edital_has_curso WHERE edital_id_edital = ? AND universidade_id_universidade = ? AND campus_universidade_id_campus_universidade = ?";
        
        $result = $this->db->query($query_str, array($vagas_campus->getEdital_id_edital(), $vagas_campus->getUniversidade_id_universidade(), $vagas_campus->getCampus_universidade_id_campus_universidade()));
        
        if($result->num_rows() > 0) {
            
            return TRUE;
            
        }
        
        return FALSE;
        
    }
    
    public function editalHasCursoUpdateExiste(Edital_has_curso_to $edital_has_curso) {
        
        $query_str = "SELECT * FROM edital_has_curso WHERE edital_id_edital = ? AND universidade_id_universidade = ? AND campus_universidade_id_campus_universidade = ? AND curso_universidade_id_curso_universidade = ?";
        
        $result = $this->db->query($query_str, array($edital_has_curso->getEdital_id_edital(), $edital_has_curso->getUniversidade_id_universidade(), $edital_has_curso->getCampus_universidade_id_campus_universidade(), $edital_has_curso->getCurso_universidade_id_curso_universidade()));
        
        if($result->num_rows() > 0) {
            
            return TRUE;
            
        }
        
        return FALSE;
        
    }
    
    public function updateEditalHasCurso(Edital_has_curso_to $edital_has_curso) {
        
        $query_str = "UPDATE edital_has_curso SET edital_id_edital = ?, universidade_id_universidade = ?, campus_universidade_id_campus_universidade = ?, curso_universidade_id_curso_universidade = ? WHERE id_edital_has_curso = ?";
        
        $this->db->query($query_str, array($edital_has_curso->getEdital_id_edital(), $edital_has_curso->getUniversidade_id_universidade(), $edital_has_curso->getCampus_universidade_id_campus_universidade(), $edital_has_curso->getCurso_universidade_id_curso_universidade(), $edital_has_curso->getId_edital_has_curso()));
        
        if($this->db->affected_rows()) {
            
            return TRUE;
            
        }
        
        return FALSE;
        
    }
    
    public function deleteEditalHasCurso($id_edital_has_curso) {
        
        $query_str = "DELETE FROM edital_has_curso WHERE id_edital_has_curso";
        
        $this->db->query($query_str, $id_edital_has_curso);
        
        if($this->db->affected_rows()) {
            
            return TRUE;
            
        }
        
        return FALSE;
        
    }
    
}

?>
