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
                        <?php 
                            
                            $i = 0;
                        
                            foreach ($label as $rotulo) {
                                                
                                echo '<li>
                                    <label>'. $rotulo .'</label>
                                    <div>';
                                if($i == 0) {

                                    echo form_input($input[$i], '', 'autofocus');
                                    
                                } elseif($i == 4 || $i == 5) {
                                    
                                    if($rotulo == "Opção de Destino" || $rotulo == "Assistência Estudantil") {
                                        
                                        echo form_checkbox($input[$i]). 'Sim';
                                        
                                    } else {
                                        
                                        echo form_input($input[$i]);
                                        
                                    }

                                } else {
                                    
                                    echo form_input($input[$i]);
                                    
                                }

                                echo '</div>';
                                
                                if($i == 0 && !empty($pesquisar) && $pesquisar == TRUE) {

                                    $deleta = 0;
                                    echo '<br />';
                                    echo form_button(array('type' => 'button', 'onclick' => 'buscar('.$opcao.','.$deleta.')' , 'content' => $content));

                                }
                                    
                                echo '</li>';
                                $i++;
                                
                            } 
                        ?>    
                        </ol>
                    </fieldset>
                    <?php if(!empty($hidden)){echo form_hidden($hidden);} ?>
                    <fieldset style="text-align: center;">
                        <?php echo form_button('voltar', 'Voltar', 'onClick="javascript:history.back(1);" style="display: inline;"') . '    '; echo form_button(array('type' => 'submit', 'content' => 'Avançar', 'style' => 'display: inline;')); ?>
                    </fieldset>
                <?php
                    echo form_close();
                ?>