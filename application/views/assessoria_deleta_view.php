                <p><?php echo $paragrafo; ?></p>

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
                        <?php 
                            
                            $i = 0;
                        
                            foreach ($label as $rotulo) {
                                                
                                echo '<li>
                                    <label>'. $rotulo .'</label>
                                    <div>';
                                echo form_input($input[$i]);
                                echo '</div><br />';
                                echo form_button(array('type' => 'button', 'onclick' => 'buscar('.$opcao.', 1)' , 'content' => $content));
                                echo '</li>';
                                $i++;
                                
                            } 
                        ?>    
                        </ol>
                    </fieldset>
                    <fieldset>
                        <?php echo form_button(array('type' => 'submit', 'content' => 'Avançar')); ?>
                    </fieldset>
                <?php
                    echo form_close();
                ?>