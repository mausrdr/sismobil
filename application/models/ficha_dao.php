<?php

class Ficha_dao extends CI_Model {
    
    function __construct() {
        
        parent::__construct();
        
    }
    
    public function insereFicha(Ficha_to $ficha) {
        
        $ficha->setData_candidatura($this->inverteData($ficha->getData_candidatura(), TRUE));
        
        $query_str = "INSERT INTO ficha (candidato_id_candidato, origem_id_origem, mobilidade_id_mobilidade, conhecimentos_linguisticos_id_conhecimentos_linguisticos, financiamento_id_financiamento, carta_motivacao_id_carta_motivacao, extracurricular_id_extracurricular, data_candidatura, ficha_curso_id_ficha_curso) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $this->db->query($query_str, array($ficha->getCandidato_id_candidato(), $ficha->getOrigem_id_origem(), $ficha->getMobilidade_id_mobilidade(), $ficha->getConhecimentos_linguisticos_id_conhecimentos_linguisticos(), $ficha->getFinanciamento_id_financiamento(), $ficha->getCarta_motivacao_id_carta_motivacao(), $ficha->getExtracurricular_id_extracurricular(), $ficha->getData_candidatura(), $ficha->getFicha_curso_id_ficha_curso()));
        
        if($this->db->affected_rows()) {
            
            return $this->db->insert_id();
            
        } else {
            
            return false;
            
        }
        
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
    
    public function getIdFichaCurso($id_ficha) {
        
        $query_str = "SELECT ficha_curso_id_ficha_curso FROM ficha WHERE id_ficha = ?";
        
        $result = $this->db->query($query_str, $id_ficha);
        
        if($result->num_rows() == 1) {
            
            $row = $result->row();
            
            return $row->ficha_curso_id_ficha_curso;
            
        }
        
        return FALSE;
        
    }
    
}

?>
