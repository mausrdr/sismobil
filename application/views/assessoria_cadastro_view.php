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
                                    
                                    if($legend == "Cadastrar Edital") {
                                        
                                        echo form_checkbox($input[$i], '', FALSE). 'Sim';
                                        
                                    } else {
                                        
                                        echo form_input($input[$i]);
                                        
                                    }

                                } else {
                                    
                                    echo form_input($input[$i]);
                                    
                                }

                                echo '</div>
                                </li>';
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