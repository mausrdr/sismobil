            <h1><?php echo $h1; ?></h1>

            <p><?php echo $paragrafo; ?></p>

            <?php
                $this->output->set_header("Content-Type: text/html; charset=UTF-8");
        
        

                echo form_open($base_url . $url);
        
                echo form_hidden($dados);
            ?>

            <table>
                <?php 
                
                    $i = 0;
                    
                    foreach($descricao as $conteudo) {
                        
                        echo '<tr>
                            <td>' . $label[$i] . '</td>
                            <td>' . $conteudo . '</td>
                        </tr>';
                        
                        $i++;
                        
                    }
                ?>
            </table>
            <br /><br />
                <div>
                     <?php 
                        if(!empty($deletar)) {
                            
                            switch ($deletar) {
                                case 1:
                                    echo form_button('voltar', 'Voltar', 'onClick="javascript:history.back(1);"') . '    '; echo form_button('avancar', 'Avançar', 'onClick="confirma(4,\''.$desc.'\')"');
                                    break;
                                case 2:
                                    echo form_button('voltar', 'Voltar', 'onClick="javascript:history.back(1);"') . '    '; echo form_button('avancar', 'Avançar', 'onClick="confirma(5,\''.$desc.'\')"');
                                    break;
                                default:
                                    break;
                            }
                            
                        } else {
                            
                            echo form_button('voltar', 'Voltar', 'onClick="javascript:history.back(1);"') . '    '; echo form_button(array('type' => 'submit', 'content' => 'Avançar'));
                            
                        }
                    ?>
                </div>

            <?php
                echo form_close();
            ?>