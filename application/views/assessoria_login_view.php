                <h1>Login</h1>
                <?php
                    $this->output->set_header("Content-Type: text/html; charset=UTF-8");

                    $atributos = array(
                        'id' => 'myform'
                    );

                    echo form_open($base_url . "index.php/assessoria_login_controller/index", $atributos);

                    $username = array(
                        'name'      =>      'username',
                        'id'        =>      'username',
                        'value'     =>      set_value('username')
                    );

                    $senha = array(
                        'name'      =>      'senha',
                        'id'        =>      'senha',
                        'value'     =>      set_value('senha')
                    );
                ?>
                <fieldset>
                    <legend>Informe seu nome de usuário e senha</legend>
                    <ol>
                        <li>
                            <label>Usuário</label>
                            <div>
                                <?php echo form_input($username, '', 'autofocus'); ?>
                            </div>
                        </li>
                        <li>
                            <label>Senha</label>
                            <div>
                                <?php echo form_password($senha); ?>
                            </div>
                        </li>
                    </ol>
                </fieldset>  
                    <div class="error">
                        
                        <?php if(!empty($msg_erro)) {
                            
                            echo $msg_erro;
                            
                        } ?>
                        
                        <?php echo validation_errors(); ?>
                    </div>
                <fieldset>
                    <?php echo form_button(array('type' => 'submit', 'content' => 'Avançar')); ?>
                </fieldset>                            
                <?php
                    echo form_close();
                ?>
            </div>