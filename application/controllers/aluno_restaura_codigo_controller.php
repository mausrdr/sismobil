<?php

class Aluno_restaura_codigo_controller extends MY_controller {
    
    function __construct() {
        
        parent::__construct();
        
        $this->view_data['base_url'] = base_url();
        
        
        
        $this->load->model('candidato_to');
        $this->load->model('candidato_dao');
        $this->load->model('captcha_to');
        $this->load->model('captcha_dao');
        $this->load->model('token_candidato_to');
        $this->load->model('token_candidato_dao');
        
    }
    
    public function index() {
        
        $this->load->helper('captcha');
        
        $data['titulo'] = "Restauração de Código de Acesso";
        
        $vals = array(
            'word'          =>  $this->geraWord(),
            'img_path'      =>  './captcha/',
            'img_url'       =>  'http://localhost/sismobil/captcha/',
            'expiration'    =>  300
            );

        $cap = create_captcha($vals);
        
        $captcha = new Captcha_to();
        $captcha->setCaptcha_time($cap['time']);
        $captcha->setIp_address($this->input->ip_address());
        $captcha->setWord($cap['word']);
        
        $this->captcha_dao->insertCaptcha($captcha);
        
        $this->view_data['imagem'] = $cap['image'];
        $this->view_data['url'] = "index.php/aluno_restaura_codigo_controller";
        $this->view_data['email'] = array(
            'name'      =>  'email',
            'id'        =>  'email',
            'value'     =>  set_value('email')
        );
        $this->view_data['captcha'] = array(
            'name'      =>  'captcha',
            'id'        =>  'captcha',
            'value'     =>  set_value('captcha')
        );
        
        $config = array(
            array(
                'field' =>  'email',
                'label' =>  'Email',
                'rules' =>  'trim|required|valid_email|xss_clean|callback_validaEmail'
            ),
            array(
                'field' =>  'captcha',
                'label' =>  'Captcha',
                'rules' =>  'trim|xss_clean|callback_validaCaptcha'
            )
        );
        
        $this->form_validation->set_rules($config);
        
        if($this->form_validation->run() == FALSE) {
            
            $this->load->view('/headers/header_restaura_view', $data);
            $this->load->view('aluno_restaura_codigo_view', $this->view_data);
            $this->load->view('/footers/footer_view');
            
        } else {
            
            $email = $this->input->post('email');
            
            $dados = $this->candidato_dao->getNomeIdRestaura($email);
            
            $token = new Token_candidato_to();
            $token->setToken_time(time());
            $token->setCodigo($this->geraToken());
            $token->setIp_address($this->input->ip_address());
            $token->setCandidato_id_candidato($dados['id_candidato']);
            
            if($this->token_candidato_dao->insertToken($token)) {
                
                $this->email->from('sismobil@ifsuldeminas.edu.br', 'Assessoria Internacional');
                $this->email->to($email);
                $this->email->subject('Restaurar código de acesso - IFSULDEMINAS');
                $corpo =   "<html>
                                <meta charset=\"utf-8\">
                                <body style=\"text-align: center; background-color: #e7efd1;\">
                                    <img src=\"http://www.ifsuldeminas.edu.br/templates/ifsuldeminas/images/banner_reitoria.jpg\" />
                                    <p style=\"color: #000000; text-align: justify; font-size: 12pt; font-family: ubuntu;\">
                                        Prezado(a) " . $dados['nome'] . ",<br/>
                                        Conforme solicitado resetamos seu código de acesso. Por medida de segurança, não enviamos o código de acesso por email. Você tem 24 horas para clicar no link abaixo para criar seu novo código de acesso: <br/>
                                        " . anchor('http://localhost/sismobil/index.php/aluno_novo_codigo_controller/index/' . $token->getCodigo(), 'Recuperar código de acesso.') . "<br/>
                                        Caso você ultrapasse as 24 horas, faça novamente a solicitação de restauração de seu código de acesso.<br/>
                                        Atenciosamente,
                                    </p>
                                    <p style=\"color: #000000; text-align: justify; font-size: 12pt; font-family: ubuntu;\">
                                        Este é um e-mail automático disparado pelo sistema. Favor não respondê-lo, pois esta conta não é monitorada.
                                    </p>
                                    <br /><br />
                                    <br />
                                    <div style=\"color: #395338;font-family:'Arial'; font-size:15px; font-weight:normal; font-style:italic;\">
                                        <span>Assessoria de Relações Internacionais</span>
                                    </div>
                                    <div style=\"color: #395338;font-family:'Arial'; font-size:15px; font-weight:normal; font-style:italic;\">
                                        <span>Rua Ciomara Amaral de Paula 167 - Medicina - CEP: 37550-000 - Pouso Alegre/MG - Fone: +55 (35) 3449 6170</span>
                                    </div>
                                    <div style=\"color: #395338;font-family:'Arial'; font-size:15px; font-weight:normal; font-style:italic;\">
                                        <span>Copyright &#169; 2013. All Rights Reserved.</span>
                                    </div>
                                    <br />
                                    <p style=\"text-align: justify; background-color: #ffffff; font-size: 10pt; font-family: ubuntu; color: orangered; font-style: italic;\">
                                        Esta mensagem é para uso exclusivo de seu destinatário e pode conter informações privilegiadas e confidenciais. Se você não é o destinatário não deve distribuir, copiar ou arquivar a mensagem. Neste caso, por favor, notifique o remetente da mesma e destrua imediatamente a mensagem.<br/>
                                        This message is intended solely for the use of its addressee and may contain privileged or confidential information. If you are not the addressee you should not distribute, copy or file this message. In this case, please notify the sender and destroy its contents immediately.
                                    </p>
                                </body>
                            </html>";
                $this->email->message($corpo);

                if($this->email->send()) {
                   
                    
                
                $data['titulo'] = "Sucesso!!!";

                $this->view_data['mensagem_h3'] = "O email foi enviado com sucesso!!";
                $this->view_data['mensagem_h4'] = "Acesse sua conta de email para restaurar seu código de acesso.<br/> <a href=\"". base_url() . "index.php/main_controller\">Clique aqui</a> para retornar a página principal." . $this->email->print_debugger();

                $this->load->view('/headers/header_restaura_view', $data);
                $this->load->view('aluno_sucesso_view', $this->view_data);
                $this->load->view('/footers/footer_view');
                } else {
                    echo 'Falhou';
                }
                
            } else {
                
                $data['titulo'] = "Falha!!!";

                $this->view_data['mensagem_h3'] = "Desculpe-nos o transtorno, o serviço que você requisitou não está disponível no momento.<br/>" . anchor('http://localhost/sismobil/index.php/main_controller', 'Clique aqui,') . " para retornar a página principal.";

                $this->load->view('/headers/header_restaura_view', $data);
                $this->load->view('aluno_falha_view', $this->view_data);
                $this->load->view('/footers/footer_view');
                
            }
            
        }
        
    }
    
    public function validaCaptcha($word) {
        
        $this->form_validation->set_message('validaCaptcha', 'Os caracteres da imagem não foram preenchidos corretamente. Por favor, preencha os dados novamente.');
        
        $expiration = time() - 300;
        $this->captcha_dao->deleteCaptcha($expiration);
        
        $captcha = new Captcha_to();
        $captcha->setWord(strtoupper($word));
        $captcha->setIp_address($this->input->ip_address());
        $captcha->setCaptcha_time($expiration);
        
        $valid = $this->captcha_dao->captchaExiste($captcha);
        
        if($valid) {
            
            return TRUE;
            
        }
        
        return FALSE;
        
    }
    
    public function validaEmail($email) {
        
        $this->form_validation->set_message('validaEmail', 'Email inválido! Por favor, informe o email cadastrado no sistema.');
        
        if($this->candidato_dao->emailExiste($email)) {
            
            return TRUE;
            
        }
        
        return FALSE;
        
    }

    public function geraToken() {
        
        $len = 50;
        $base = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz123456789';
        $max = strlen($base) - 1;
        $token = '';
        mt_srand((double)  microtime() * 1000000);
        while(strlen($token) < $len)
            $token .= $base{mt_rand(1, $max)};
            
        return $token;
        
    }
    
    public function geraWord() {
        
        $len = 8;
        $base = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789';
        $max = strlen($base) - 1;
        $token = '';
        mt_srand((double)  microtime() * 1000000);
        while(strlen($token) < $len)
            $token .= $base{mt_rand(1, $max)};
            
        return $token;
        
    }
    
}

?>
