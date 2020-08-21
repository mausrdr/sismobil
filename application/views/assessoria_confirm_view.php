            <h1><?php echo $h1 ?></h1>

            <p><?php echo $paragrafo ?></p>

            <?php
                $this->output->set_header("Content-Type: text/html; charset=UTF-8");
                
                if(!empty($atributos)) {
                    
                    echo form_open($base_url . $url, $atributos);
                    
                } else {
                    
                    echo form_open($base_url . $url);
                    
                }
        
        
                echo form_hidden($dados);
                
                if(!empty($editar)) {
                    
                    array_shift($dados);
                    
                }
                
                if(!empty($deletar)) {
                    
                    array_shift($dados);
                    
                }
                
            ?>

            <table>
                <?php 
                
                    $i = 0;
                    
                    foreach($dados as $conteudo) {
                        
                        switch ($conteudo) {
                            case '0':
                                echo '<tr>
                                    <td>' . $label[$i] . '</td>
                                    <td>Não</td>
                                </tr>';
                                break;
                            case 1:
                                echo '<tr>
                                    <td>' . $label[$i] . '</td>
                                    <td>Sim</td>
                                </tr>';
                                break;
                            default:
                                echo '<tr>
                                    <td>' . $label[$i] . '</td>
                                    <td>' . $conteudo . '</td>
                                </tr>';
                                break;
                        }
                        
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
                                    echo form_button('voltar', 'Voltar', 'onClick="javascript:history.back(1);"') . '    '; echo form_button('avancar', 'Avançar', 'onClick="confirma(0,\''.$dados['numero_edital'].'\')"');
                                    break;
                                case 2:
                                    echo form_button('voltar', 'Voltar', 'onClick="javascript:history.back(1);"') . '    '; echo form_button('avancar', 'Avançar', 'onClick="confirma(1,\''.$dados['descricao_universidade'].'\')"');
                                    break;
                                case 3:
                                    echo form_button('voltar', 'Voltar', 'onClick="javascript:history.back(1);"') . '    '; echo form_button('avancar', 'Avançar', 'onClick="confirma(2,\''.$dados['descricao_campus'].'\')"');
                                    break;
                                case 4:
                                    echo form_button('voltar', 'Voltar', 'onClick="javascript:history.back(1);"') . '    '; echo form_button('avancar', 'Avançar', 'onClick="confirma(3,\''.$dados['descricao_curso'].'\')"');
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
