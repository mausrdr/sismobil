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
                    <br />
                    <table>
                        <?php 

                            if(!empty($acompanhamento)) {
                                
                                for($i = 0; $i < count($acompanhamento[0]); $i++) {

                                    switch ($acompanhamento[0][$index[$i]]) {
                                        case '0':
                                            echo '<tr>
                                                <td>' . $label[$i] . '</td>
                                                <td>Não</td>
                                            </tr>';
                                            break;
                                        case '':
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
                                        case '0000-00-00':
                                            echo '<tr>
                                                <td>' . $label[$i] . '</td>
                                                <td></td>
                                            </tr>';
                                            break;
                                        default:
                                            echo '<tr>
                                                <td>' . $label[$i] . '</td>
                                                <td>' . $acompanhamento[0][$index[$i]] . '</td>
                                            </tr>';
                                            break;
                                    }

                                }
                                
                            }

                        ?>
                    </table>
                <?php
                    echo form_close();
                ?>
