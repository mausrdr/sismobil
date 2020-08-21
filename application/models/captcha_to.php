<?php

class Captcha_to extends CI_Model {
    
    function __construct() {
        
        parent::__construct();
        
    }
    
    private $id_captcha;
    private $captcha_time;
    private $ip_address;
    private $word;
    
    public function getId_captcha() {
        return $this->id_captcha;
    }

    public function setId_captcha($id_captcha) {
        $this->id_captcha = $id_captcha;
    }

    public function getCaptcha_time() {
        return $this->captcha_time;
    }

    public function setCaptcha_time($captcha_time) {
        $this->captcha_time = $captcha_time;
    }

    public function getIp_address() {
        return $this->ip_address;
    }

    public function setIp_address($ip_address) {
        $this->ip_address = $ip_address;
    }

    public function getWord() {
        return $this->word;
    }

    public function setWord($word) {
        $this->word = $word;
    }

}

?>
