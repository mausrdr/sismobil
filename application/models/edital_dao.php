<?php

class Edital_dao extends CI_Model {
    
    function __construct() {
        
        parent::__construct();
        
    }
    
    public function insereEdital(Edital_to $edital) {
        
        $edital->setData_abertura($this->inverteData($edital->getData_abertura(), TRUE));
        $edital->setData_encerramento($this->inverteData($edital->getData_encerramento(), TRUE));
        
        $query_str = "INSERT INTO edital (numero_edital, total_vagas, data_abertura, data_encerramento, opcao_destino, assistencia) VALUES (?, ?, ?, ?, ?, ?)";
        
        $this->db->query($query_str, array($edital->getNumero_edital(), $edital->getTotal_vagas(), $edital->getData_abertura(), $edital->getData_encerramento(), $edital->getOpcao_destino(), $edital->getAssistencia()));
        
        if($this->db->affected_rows()) {
            
            return true;
            
        } else {
            
            return false;
            
        }
        
    }
    
    public function editalExiste($numero_edital) {
        
        $query_str = "SELECT numero_edital FROM edital WHERE numero_edital = ?";
        
        $result = $this->db->query($query_str, $numero_edital);
        
        if($result->num_rows() > 0) {
            
            return TRUE;
            
        } else {
            
            return FALSE;
            
        }
        
    }
    
    public function loadEdital($numero_edital) {
        
        $query_str = "SELECT * FROM edital WHERE id_edital = ?";
        
        $result = $this->db->query($query_str, $numero_edital);
        
        if($result->num_rows() == 1) {
            
            $data = $result->row();
            
            $edital = new Edital_to();
            $edital->setId_edital($data->id_edital);
            $edital->setNumero_edital($data->numero_edital);
            $edital->setTotal_vagas($data->total_vagas);
            $edital->setData_abertura($this->inverteData($data->data_abertura, FALSE));
            $edital->setData_encerramento($this->inverteData($data->data_encerramento, FALSE));
            $edital->setOpcao_destino($data->opcao_destino);
            $edital->setAssistencia($data->assistencia);
            
            return $edital;
            
        } else {
            
            return false;
            
        }
        
    }
    
    public function getNumeroEdital($id_edital) {
        
        $query_str = "SELECT numero_edital FROM edital WHERE id_edital = ?";
        
        $result = $this->db->query($query_str, $id_edital);
        
        if($result->num_rows() == 1) {
            
            $data = $result->row();
            
            return $data->numero_edital;
            
        } else {
            
            return FALSE;
            
        }
        
    }

    private function inverteData($data, $flag) {
        
        if($flag) {
            
            $inv_data = strftime('%Y-%m-%d', strtotime(str_replace('/', '-', $data)));
            return $inv_data;
            
        } else {
            
            $inv_data = strftime('%d/%m/%Y', strtotime($data));
            return $inv_data;
            
        }
        
    }
    
    public function getEditalMatriz($data) {
        
        $query_str = "SELECT id_edital AS 'id', numero_edital AS 'numero' FROM edital WHERE data_abertura > ?";
        
        $result = $this->db->query($query_str, $data);
        
        if($result->num_rows() > 0) {
            
            $row = $result->result_array();
            
            return $row;
            
        }
        
        return FALSE;
        
    }
    
    public function getEditalAberto($data) {
        
        $query_str = "SELECT id_edital AS 'id', numero_edital AS 'numero' FROM edital WHERE ? BETWEEN data_abertura AND data_encerramento";
        
        $result = $this->db->query($query_str, $data);
        
        if($result->num_rows() > 0) {
            
            $row = $result->result_array();
            
            return $row;
            
        }
        
        return FALSE;
        
    }
    
    public function getEdital() {
        
        $query_str = "SELECT id_edital AS 'id', numero_edital AS 'numero' FROM edital";
        
        $result = $this->db->query($query_str);
        
        if($result->num_rows() > 0) {
            
            $row = $result->result_array();
            
            return $row;
            
        }
        
        return FALSE;
        
    }
    
    public function getOpcaoDestino($id_edital) {
        
        $query_str = "SELECT opcao_destino FROM edital WHERE id_edital = ?";
        
        $result = $this->db->query($query_str, $id_edital);
        
        if($result->num_rows() == 1) {
            
            $row = $result->row();
            
            return $row->opcao_destino;
            
        }
        
        return FALSE;
        
    }
    
    public function getAssistencia($id_edital) {
        
        $query_str = "SELECT assistencia FROM edital WHERE id_edital = ?";
        
        $result = $this->db->query($query_str, $id_edital);
        
        if($result->num_rows() == 1) {
            
            $row = $result->row();
            
            return $row->assistencia;
            
        }
        
        return FALSE;
        
    }
    
    public function updateEdital(Edital_to $edital) {
        
        $edital->setData_abertura($this->inverteData($edital->getData_abertura(), TRUE));
        $edital->setData_encerramento($this->inverteData($edital->getData_encerramento(), TRUE));
        
        $query_str = "UPDATE edital SET numero_edital = ?, total_vagas = ?, data_abertura = ?, data_encerramento = ?, opcao_destino = ?, assistencia = ? WHERE id_edital = ?";
        
        $this->db->query($query_str, array($edital->getNumero_edital(), $edital->getTotal_vagas(), $edital->getData_abertura(), $edital->getData_encerramento(), $edital->getOpcao_destino(), $edital->getAssistencia(), $edital->getId_edital()));
        
        if($this->db->affected_rows()) {
            
            return TRUE;
            
        }
        
        return FALSE;
        
    }
    
    public function deleteEdital($id_edital) {
        
        $query_str = "DELETE FROM edital WHERE id_edital = ?";
        
        $this->db->query($query_str, $id_edital);
        
        if($this->db->affected_rows() > 0) {
            
            return TRUE;
            
        }
        
        return FALSE;
        
    }
    
    public function getUpdateEditalVagas($data) {
        
        $query_str = "SELECT DISTINCT e.id_edital AS 'id', e.numero_edital AS 'numero' FROM edital e, vagas_campus v WHERE e.data_abertura > ? AND v.edital_id_edital = e.id_edital";
        
        $result = $this->db->query($query_str, $data);
        
        if($result->num_rows() > 0) {
            
            $row = $result->result_array();
            
            return $row;
            
        }
        
        return FALSE;
        
    }
    
    public function getEditalDelete($data) {
        
        $query_str = "SELECT e.id_edital AS 'id', e.numero_edital AS 'numero' FROM edital e WHERE e.data_abertura > ? AND e.id_edital NOT IN (SELECT v.edital_id_edital FROM vagas_campus v WHERE v.edital_id_edital = e.id_edital)";
        
        $result = $this->db->query($query_str, $data);
        
        if($result->num_rows() > 0) {
            
            $row = $result->result_array();
            
            return $row;
            
        }
        
        return FALSE;
        
    }
    
    public function listEdital() {
        
        $query_str = "SELECT id_edital AS 'id', numero_edital AS 'numero' FROM edital";
        
        $result = $this->db->query($query_str);
        
        if($result->num_rows() > 0) {
            
            $row = $result->result_array();
            
            return $row;
            
        }
        
        return FALSE;
        
    }
    
    public function verificaData($id_edital, $data) {
        
        $query_str = "SELECT id_edital FROM edital WHERE id_edital = ? AND data_abertura > ?";
        
        $result = $this->db->query($query_str, array($id_edital, $data));
        
        if($result->num_rows() == 1) {
            
            return TRUE;
            
        }
        
        return FALSE;
        
    }
    
    public function getEditalAcompanhamento($candidato_id_candidato) {
        
        $query_str = "SELECT e.id_edital AS 'id', e.numero_edital AS 'numero' FROM edital e, ficha_candidatura f WHERE f.candidato_id_candidato = ? AND e.id_edital = f.edital_id_edital";
        
        $result = $this->db->query($query_str, $candidato_id_candidato);
        
        if($result->num_rows() > 0) {
            
            $row = $result->result_array();
            
            return $row;
            
        }
        
        return FALSE;
        
    }
    
}

?>
