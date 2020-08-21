                <p>Por favor preencha os campos abaixo em todos os seus detalhes</p>

                <?php
                
                    $this->output->set_header("Content-Type: text/html; charset=UTF-8");
                    
                    echo form_open($base_url . $url, $atributos);
                    
                ?>
                    <div class="error">
                        <?php echo validation_errors(); ?>
                    </div>
                    <fieldset>
                        <legend><?php echo $legend; ?></legend>
                        <ol>
                            <li>
                                <label>Número do Edital</label>
                                <div class="styled-select">
                                    <?php echo form_dropdown('edital_id_edital', $options_edital, set_value('edital_id_edital'), 'id="edital_id_edital" required'); ?>
                                </div>
                            </li>
                        </ol>
                    </fieldset>
                    <fieldset>
                        <?php echo form_button(array('type' => 'submit', 'content' => 'Listar')); ?>
                    </fieldset>
                    <table>
                        <tr>
                            <th width="12%">&nbsp;</th>
                            <th width="12%">&nbsp;</th>
                            <?php //TODO: Colocar opção para não aceite e justificativa do não aceite e salvar em banco ?>
                            <th width="6%" style="text-align: center;">Cód.</th>
                            <th width="50%">Nome</th>
                            <th width="20%">CPF</th>
                        </tr>
                        <?php 
                            if(!empty($lista)) {

                                $i = 0;

                                foreach($lista as $conteudo) {

                                    $id = $conteudo['id_ficha_candidatura'];
                                    $nome = $conteudo['nome'];
                                    $cpf = $conteudo['cpf'];
                                    $href = "<a href=\"" . $base_url . $url_receber . "/?id=$id\" ><img src=\"". $base_url ."css/images/select.png\" title='Fazer aceite de $nome' border=0></a>";
                                    $href1 = "<a href=\"" . $base_url . $url_indeferir . "/?id=$id\" ><img src=\"". $base_url ."css/images/indeferir.png\" title='Indeferir $nome' border=0></a>";
                                    //TODO: Ao receber a candidatura preencher os requisitos da classificacao do aluno
                                    //TODO: Colocar opção para não aceite e justificativa do não aceite e salvar em banco

                                    echo '<tr>
                                        <td>'. $href .'</td>
                                        <td>'. $href1 .'</td>
                                        <td style="text-align: center;">' . $id . '</td>
                                        <td>' . $nome . '</td>
                                        <td>' . $cpf . '</td>    
                                    </tr>';

                                    $i++;

                                }

                            }
                        ?>
                    </table>
                
                <?php
                    echo form_close();
                ?>
