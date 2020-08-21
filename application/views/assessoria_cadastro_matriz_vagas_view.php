                <p>Por favor preencha os campos abaixo em todos os seus detalhes</p>

                <?php
                
                    $this->output->set_header("Content-Type: text/html; charset=UTF-8");
                    
                    $hidden = array(
                        
                        'id_campus'    =>  ''
                        
                    );

                    echo form_open($base_url . $url, $atributos, $hidden);
                    
                ?>
                    <div class="error">
                        
                        <?php if(!empty($msg_erro)) {
                            
                            echo $msg_erro;
                            
                        } ?>
                        
                        <?php echo validation_errors(); ?>
                    </div>
                    <fieldset>
                        <legend><?php echo $legend; ?></legend>
                        <ol>
                            <li>
                                <label>Número do Edital</label>
                                <div class="styled-select">
                                    <?php echo form_dropdown('edital_id_edital', $options_edital, set_value('edital_id_edital'), 'required'); ?>
                                </div>
                            </li>
                            <li>
                                <label>universidade</label>
                                <div class="styled-select">
                                    <?php echo form_dropdown('universidade_id_universidade', $options_universidade, set_value('universidade_id_universidade'), 'required'); ?>
                                </div>
                            </li>
                            <li>
                                <label>Câmpus</label>
                                <div>
                                    <?php echo form_input($input[1], '', 'readonly'); ?>
                                </div><br />
                                <?php echo form_button(array('type' => 'button', 'onclick' => 'buscar(0,0)' , 'content' => 'Buscar Câmpus')); ?>
                            </li>
                            <li>
                                <label>Vagas no Câmpus</label>
                                <div>
                                    <?php echo form_input($input[0]); ?>
                                </div>
                            </li>
                        </ol>
                    </fieldset>
                    <fieldset>
                        <?php echo form_button(array('type' => 'submit', 'content' => 'Avançar')); ?>
                    </fieldset>
                <?php
                    echo form_close();
                ?>
