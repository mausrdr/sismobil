<?php

class Campus_dao extends CI_Model {
    
    function __construct() {
        
        parent::__construct();
        
    }
    
    public function dadoscampus($id) {
        
        $query_str = "SELECT diretor, telefone_campus, fax FROM campus WHERE id_campus = ?";
        
        $result = $this->db->query($query_str, $id);
        
        if($result->num_rows() == 1) {
            
            $row = $result->row();
            
            $data = json_encode($row);
            
            return $data;
            
        } else {
            
            return false;
            
        }
        
    }
    
    public function pegaCampus() {
        
        $query_str = "SELECT id_campus AS 'id', nome_campus AS 'campus' FROM campus ORDER BY id_campus";
        
        $result = $this->db->query($query_str);
        
        if($result->num_rows() > 1) {
            
            $data = $result->result_array();
            
            return $data;
            
        } else {
            
            return false;
            
        }
        
    }
    
    public function pegaNomeCampus($id) {
        
        $query_str = "SELECT nome_campus FROM campus WHERE id_campus = ?";
        
        $result = $this->db->query($query_str, $id);
        
        if($result->num_rows() == 1) {
            
            $row = $result->row();
            
            return $row->nome_campus;
            
        } else {
            
            return false;
            
        }
        
    }
    
    public function getDadosCampus($id) {
        
        $query_str = "SELECT * FROM campus WHERE id_campus = ?";
        
        $result = $this->db->query($query_str, $id);
        
        if($result->num_rows() == 1) {
            
            $data = $result->row();
            $c = new Campus_to();
            $c->setId_campus($data->id_campus);
            $c->setNome_campus($data->nome_campus);
            $c->setDiretor($data->diretor);
            $c->setTelefone_campus($data->telefone_campus);
            $c->setFax($data->fax);
            
            return $c;
            
        }
        
        return FALSE;
        
    }
    
}

?>
