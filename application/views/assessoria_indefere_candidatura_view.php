                <p>Por favor preencha os campos abaixo em todos os seus detalhes</p>

                <?php
                
                    $this->output->set_header("Content-Type: text/html; charset=UTF-8");

                    echo form_open($base_url . $url, $atributos);
                    
                    echo form_hidden($hidden);
                    
                ?>
                    <div class="error">
                        <?php echo validation_errors(); ?>
                    </div>
                    <fieldset>
                        <legend><?php echo $legend; ?></legend>
                        <ol>
                            <li>
                                <label>Nome</label>
                                <?php echo form_input($nome); ?>
                            </li>
                            <li>
                                <label>CPF</label>
                                <?php echo form_input($cpf); ?>
                            </li>
                            <li>
                                <label>Bolsa de Iniciação Científica</label>
                                <?php echo form_checkbox($bic) . 'Sim' ?>
                            </li>
                            <li>
                                <label>Participação Voluntária de Projeto de Pesquisa</label>
                                <?php echo form_checkbox($pvpp) . 'Sim' ?>
                            </li>
                            <li>
                                <label>Participação em Olimpíadas de Conhecimento</label>
                                <?php echo form_checkbox($po) . 'Sim' ?>
                            </li>
                            <li>
                                <label>Estágio na Área do Curso</label>
                                <?php echo form_checkbox($estagio) . 'Sim' ?>
                            </li>
                            <li>
                                <label>Eventos Científicos ou Congressos</label>
                                <?php echo form_checkbox($ecc) . 'Sim' ?>
                            </li>
                            <li>
                                <label>Justificativa</label>
                                <?php echo form_textarea($justificativa); ?>    
                            </li>
                        </ol>
                    </fieldset>
                    <fieldset>
                        <div style="text-align: center;">
                            <?php echo form_button('voltar', 'Voltar', 'style="display: inline;" onClick="javascript:history.back(1);"') . '    '; echo form_button(array('type' => 'submit', 'content' => 'Avançar', 'style' => 'display: inline;')); ?>
                        </div>    
                    </fieldset>
                <?php
                    echo form_close();
                ?>