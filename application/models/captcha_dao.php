<?php

class Captcha_dao extends CI_Model {
    
    function __construct() {
        
        parent::__construct();
        
    }
    
    public function insertCaptcha(Captcha_to $captcha) {
        
        $query_str = "INSERT INTO captcha (captcha_time, ip_address, word) VALUES (?, ?, ?)";
        
        $this->db->query($query_str, array($captcha->getCaptcha_time(), $captcha->getIp_address(), $captcha->getWord()));
        
        if($this->db->affected_rows()) {
            
            return TRUE;
            
        }
        
        return FALSE;
        
    }
    
    public function deleteCaptcha($expiration) {
        
        $query_str = "DELETE FROM captcha WHERE captcha_time < ?";
        
        $this->db->query($query_str, $expiration);
        
        return TRUE;
        
    }
    
    public function captchaExiste(Captcha_to $captcha) {
        
        $query_str = "SELECT COUNT(*) AS 'count' FROM captcha WHERE word = ? AND ip_address = ? AND captcha_time > ?";
        
        $result = $this->db->query($query_str, array($captcha->getWord(), $captcha->getIp_address(), $captcha->getCaptcha_time()));
        
        if($result->num_rows() == 1) {
            
            $row = $result->row();
            if($row->count == 1) {
                
                return TRUE;
                
            }
            
        }
        
        return FALSE;
        
    }
    
}

?>
