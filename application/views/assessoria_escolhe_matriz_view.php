                <p><?php $paragrafo ?></p>

                <?php
                
                    $this->output->set_header("Content-Type: text/html; charset=UTF-8");
                    
                    echo form_open($base_url . $url, $atributos);
                    
                ?>
                    <div class="error">
                        <?php 
                            
                            if(!empty($msg_erro)) {
                                
                                echo $msg_erro;
                                
                            }
                            
                            echo validation_errors(); 
                        ?>
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
                            <?php
                                if($tabela) {
                                    echo '<th width="5%">&nbsp;</th>
                                    <th width="8%">Cód.</th>
                                    <th width="12%">Edital</th>
                                    <th width="48%">Universidade</th>
                                    <th width="20%">Câmpus</th>
                                    <th width="7%">Vagas</th>';
                                } else {
                                    echo '<th width="5%">&nbsp;</th>
                                    <th width="8%">Cód.</th>
                                    <th width="12%">Edital</th>
                                    <th width="30%">Universidade</th>
                                    <th width="20%">Câmpus</th>
                                    <th width="25%">Curso</th>';
                                }
                            ?>
                        </tr>
                        <?php 
                            if(!empty($lista)) {

                                $i = 0;

                                foreach($lista as $conteudo) {

                                    if($tabela) {
                                        $id = $conteudo['id'];
                                        $numero_edital = $conteudo['numero'];
                                        $descricao_universidade = $conteudo['descricao_universidade'];
                                        $descricao_campus = $conteudo['descricao_campus'];
                                        $vagas = $conteudo['vagas'];
                                        $href = "<a href=\"" . $base_url . $url_receber . "/?id=$id\" ><img src=\"". $base_url ."css/images/select_1.png\" title='Selecionar $descricao_campus' border=0></a>";

                                        echo '<tr>
                                            <td>'. $href .'</td>
                                            <td style="text-align:center;">' . $id . '</td>
                                            <td>' . $numero_edital . '</td>
                                            <td>' . $descricao_universidade . '</td>
                                            <td>' . $descricao_campus . '</td>
                                            <td style="text-align:center;">' . $vagas . '</td>
                                        </tr>';
                                    } else {
                                        $id = $conteudo['id'];
                                        $numero_edital = $conteudo['numero'];
                                        $descricao_universidade = $conteudo['descricao_universidade'];
                                        $descricao_campus = $conteudo['descricao_campus'];
                                        $descricao_curso = $conteudo['descricao_curso'];
                                        $href = "<a href=\"" . $base_url . $url_receber . "/?id=$id\" ><img src=\"". $base_url ."css/images/select.png\" title='Selecionar $descricao_curso' border=0></a>";

                                        echo '<tr>
                                            <td>'. $href .'</td>
                                            <td style="text-align:center;">' . $id . '</td>
                                            <td>' . $numero_edital . '</td>
                                            <td>' . $descricao_universidade . '</td>
                                            <td>' . $descricao_campus . '</td>
                                            <td>' . $descricao_curso . '</td>
                                        </tr>';
                                    }

                                    $i++;

                                }

                            }
                        ?>
                    </table>
                <?php
                    echo form_close();
                ?>
