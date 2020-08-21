<?php

class Teste_email_controller extends MY_controller {
    
    function __construct() {
        
        parent::__construct();
        
        $this->load->model('candidato_to');
        
    }
    
    public function index() {
        
        $candidato = new Candidato_to();
        $candidato->setEmail("mausrdr@gmail.com");
        $candidato->setNome("Tião Carreiro");
        $candidato->setCodigo_acesso("HLcHYggE");
        
        $this->email->from('internacional@ifsuldeminas.edu.br', 'Assessoria Internacional');
        $this->email->to($candidato->getEmail());
        $this->email->subject('Cadidatura para intercâmbio IFSULDEMINAS');
        $corpo =   "<html>
                        <meta charset=\"utf-8\">
                        <body style=\"text-align: center; background-color: #e7efd1;\">
                            <img src=\"http://www.ifsuldeminas.edu.br/templates/ifsuldeminas/images/banner_reitoria.jpg\" />
                            <p style=\"color: #000000; text-align: justify; font-size: 12pt; font-family: ubuntu;\">
                                Prezado candidato,<br/>
                                Seu cadastro foi efetuado com sucesso!<br/>
                                Confira os dados abaixo e caso encontre algum erro, entre em contato pelo email suporte.intercambio@ifsuldeminas.edu.br<br/>
                                Nome =<span style=\"text-align: justify; font-size: 12pt; font-family: ubuntu; font-weight: bold;\"> " . $candidato->getNome() . "</span><br/>
                                Código de acesso =<span style=\"text-align: justify; font-size: 14pt; font-family: ubuntu; font-weight: bold;\"> " . $candidato->getCodigo_acesso() . "</span><br/>
                                Guarde este código de acesso, pois o mesmo será requisitado nos próximos acessos.
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

        $verif =  $this->email->send();
        
        if($verif) {
            
            echo "Enviou!<br />";
            echo $this->email->print_debugger();
            
        } else {
            
            echo "Falhou!<br />";
            echo $this->email->print_debugger();
            
        }
        
    }
    
}

?>
