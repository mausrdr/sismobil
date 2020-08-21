                <?php

                    $this->output->set_header("Content-Type: text/html; charset=UTF-8");

                    $atributos = array(

                    'id'    =>  'myform'

                );
                    echo form_open($base_url . $url, $atributos);
                ?>
                <fieldset>
                    <legend>Informe seu código de acesso</legend>
                    <ol>
                        <li>
                            <label>CPF</label>
                            <div>
                                <?php echo form_input($cpf); ?>
                            </div>
                        </li>
                        <li>
                            <label>Código de Acesso</label>
                            <div>
                                <?php echo form_password($codigo_acesso); ?>
                            </div>
                        </li>
                    </ol>
                </fieldset>  
                    <div class="error">
                        <?php 
                            
                            if(!empty($msg_erro)) {

                                echo $msg_erro;

                            }
                            
                            echo validation_errors();
                            
                        ?>
                    </div>
                <fieldset>
                    <?php echo form_button(array('type' => 'submit', 'content' => 'Avançar')); ?>
                </fieldset>
                <div>
                    <a href="<?php echo $base_url; ?>index.php/aluno_restaura_codigo_controller">Esqueceu seu código de acesso?</a>
                </div>

                <?php

                    echo form_close();

                ?>
