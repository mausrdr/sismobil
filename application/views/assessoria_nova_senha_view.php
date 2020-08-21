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
                            <label>Senha</label>
                            <div>
                                <?php echo form_password($senha, '', 'autofocus required'); ?>
                            </div>
                        </li>
                        <li>
                            <label>Confirmação de Senha</label>
                            <div>
                                <?php echo form_password($confirma_senha); ?>
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