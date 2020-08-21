                <h1>Restauração de Senha</h1>
                <?php
                    $this->output->set_header("Content-Type: text/html; charset=UTF-8");

                    $atributos = array(
                        'id' => 'myform'
                    );

                    echo form_open($base_url . $url, $atributos);

                ?>
                <fieldset>
                    <legend>Por favor informe os dados abaixo</legend>
                    <ol>
                        <li>
                            <label>Email</label>
                            <div>
                                <?php echo form_email($email, '', 'autofocus required'); ?>
                            </div>
                        </li>
                        <li>
                            <div>
                                <?php echo $imagem; ?> Se os caracteres da imagem estiverem ilegíveis, <a href="#" onClick="window.location.reload()"> gerar outra imagem</a>
                            </div>
                        </li>
                        <li>
                            <label>Digite os caracteres da imagem acima</label>
                            <div>
                                <?php echo form_input($captcha); ?>
                            </div>
                        </li>
                    </ol>
                </fieldset>  
                    <div class="error">
                        <?php echo validation_errors(); ?>
                    </div>
                <fieldset>
                    <?php echo form_button(array('type' => 'submit', 'content' => 'Avançar')); ?>
                </fieldset>                            
                <?php
                    echo form_close();
                ?>
            </div>