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
                                    
                                    if(@$links) {
                                        
                                        echo '<th width="3%">Cód.</th>
                                        <th width="12%">Edital</th>
                                        <th width="30%">Universidade</th>
                                        <th width="20%">Câmpus</th>
                                        <th width="22%">Curso</th>
                                        <th width="13%">&nbsp;</th>';
                                        
                                    } else {
                                        
                                        echo '<th width="3%">Cód.</th>
                                        <th width="12%">Edital</th>
                                        <th width="35%">Universidade</th>
                                        <th width="20%">Câmpus</th>
                                        <th width="30%">Curso</th>';
                                        
                                    }
                            
                            ?>
                        </tr>
                        <?php 
                            if(!empty($lista)) {
                                
                                foreach($lista as $conteudo) {

                                    $id = $conteudo['id'];
                                    $numero_edital = $conteudo['numero'];
                                    $descricao_universidade = $conteudo['descricao_universidade'];
                                    $descricao_campus = $conteudo['descricao_campus'];
                                    $descricao_curso = $conteudo['descricao_curso'];
                                    $href_editar = "<a href=\"" . $base_url . $url_editar . "/?id=$id\" ><img src=\"". $base_url ."css/images/editar.png\" title='Editar $descricao_curso' border=0></a>";
                                    $href_deletar = "<a href=\"" . $base_url . $url_deletar . "/?id=$id\" ><img src=\"". $base_url ."css/images/excluir.png\" title='Excluir $descricao_curso' border=0></a>";
                                    
                                    if(@$links) {
                                        
                                        echo '<tr>
                                            <td style="text-align:center;">' . $id . '</td>
                                            <td>' . $numero_edital . '</td>
                                            <td>' . $descricao_universidade . '</td>
                                            <td>' . $descricao_campus . '</td>
                                            <td>' . $descricao_curso . '</td>
                                            <td>'. $href_editar .' ' . $href_deletar . '</td>    
                                        </tr>';
                                        
                                    } else {
                                        
                                        echo '<tr>
                                            <td style="text-align:center;">' . $id . '</td>
                                            <td>' . $numero_edital . '</td>
                                            <td>' . $descricao_universidade . '</td>
                                            <td>' . $descricao_campus . '</td>
                                            <td>' . $descricao_curso . '</td>
                                        </tr>';
                                        
                                    }
                                    
                                }

                            }
                        ?>
                    </table>
                <?php
                    echo form_close();
                ?>
