            <h1><?php echo $h1 ?></h1>

            <p><?php echo $paragrafo ?></p>

            <?php
                $this->output->set_header("Content-Type: text/html; charset=UTF-8");
                
                echo form_open($base_url . $url);
                    
                echo form_hidden($dados);
                
                array_shift($dados);
                array_shift($dados);
                    
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
                        echo form_button('voltar', 'Voltar', 'onClick="javascript:history.back(1);"') . '    '; echo form_button(array('type' => 'submit', 'content' => 'Avançar'));
                    ?>
                </div> 
            <?php
                echo form_close();
            ?>
