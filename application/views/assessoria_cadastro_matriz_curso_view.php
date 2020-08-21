                <p>Por favor preencha os campos abaixo em todos os seus detalhes</p>

                <?php
                
                    $this->output->set_header("Content-Type: text/html; charset=UTF-8");
                    
                    $hidden = array(
                        
                        'id_curso'    =>  ''
                        
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
                                    <?php echo form_dropdown('edital_id_edital', $options_edital, set_value('0'), 'id="edital_id_edital" required'); ?>
                                </div>
                            </li>
                            <li>
                                <label>Universidade</label>
                                <div class="styled-select">
                                    <span class="carregando" style="display: none;">Aguarde, carregando...</span>
                                    <?php echo form_dropdown('universidade_id_universidade', $options_universidade, set_value('universidade_id_universidade'), 'id="universidade_id_universidade" required'); ?>
                                </div>
                            </li>
                            <li>
                                <label for="campus_id">Câmpus</label>
                                <div class="styled-select">
                                    <span class="carregando1" style="display: none;">Aguarde, carregando...</span>
                                    <?php echo form_dropdown('campus_id_campus', $options_campus, set_value('campus_id_campus'), 'id="campus_id_campus" required'); ?>
                                </div>
                            </li>
                            <li>
                                <label>Curso</label>
                                <div>
                                    <?php echo form_input($input, '', 'readonly'); ?>
                                </div><br />
                                <?php echo form_button(array('type' => 'button', 'onclick' => 'buscar(1,0)' , 'content' => 'Buscar Curso')); ?>
                            </li>
                        </ol>
                    </fieldset>
                    <fieldset>
                        <?php echo form_button(array('type' => 'submit', 'content' => 'Avançar')); ?>
                    </fieldset>
                
                <?php
                    echo form_close();
                ?>
