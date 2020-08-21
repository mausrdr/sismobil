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
                        <caption style="text-align: left; margin-left: 12em;">
                            <table>
                                <tr>
                                    <td>CoRA</td>
                                    <td>Coeficiente de Rendimento Acadêmico</td>
                                </tr>
                                <tr>
                                    <td>B.I.C.</td>
                                    <td>Bolsa de Iniciação Cientifica</td>
                                </tr>
                                <tr>
                                    <td>P.V.P.P&nbsp;&nbsp;&nbsp;</td>
                                    <td>Participação Voluntaria de Projeto de Pesquisa</td>
                                </tr>
                                <tr>
                                    <td>P.O.</td>
                                    <td>Participação em Olimpíadas de conhecimentos</td>
                                </tr>
                                <tr>
                                    <td>Estagio</td>
                                    <td>Estagio na área do curso</td>
                                </tr>
                                <tr>
                                    <td>E.C./C.</td>
                                    <td>Eventos Científicos ou Congressos</td>
                                </tr>
                            </table>
                        </caption>
                        <tr>
                            <?php
                                    
                                         echo '<th width="3%">Class.</th>
                                        <th width="38%">Nome</th>
                                        <th width="10%">CPF</th>
                                        <th width="4%" style="text-align:center;">CoRA</th>
                                        <th width="9%" style="text-align:center;">B.I.C</th>
                                        <th width="9%" style="text-align:center;">P.V.P.P</th>
                                        <th width="9%" style="text-align:center;">P.O.</th>
                                        <th width="9%" style="text-align:center;">Estagio</th>
                                        <th width="9%" style="text-align:center;">E.C./C.</th>';
                                        
                            ?>
                        </tr>
                        <?php 
                            if(!empty($lista)) {
                                
                                $j = 1;
                                
                                for ($i = 0; $i < count($lista['nome']); $i++) {

                                    $nome_candidato = $lista['nome'][$i];
                                    $cpf = $lista['cpf'][$i];
                                    $cora = $lista['cora'][$i];
                                    $binario = $lista['binario'][$i];
                                    if($binario[0] == 1) {
                                        $bic = 'Sim';
                                    }else {
                                        $bic = 'Não';
                                    }
                                    if($binario[1] == 1) {
                                        $pvpp = 'Sim';
                                    }else {
                                        $pvpp = 'Não';
                                    }
                                    if($binario[2] == 1) {
                                        $po = 'Sim';
                                    }else {
                                        $po = 'Não';
                                    }
                                    if($binario[3] == 1) {
                                        $estagio = 'Sim';
                                    }else {
                                        $estagio = 'Não';
                                    }
                                    if($binario[4] == 1) {
                                        $ecc = 'Sim';
                                    }else {
                                        $ecc = 'Não';
                                    }
                                    
                                    echo '<tr>
                                        <td style="text-align:center;">' . $j . '</td>
                                        <td>' . $nome_candidato . '</td>
                                        <td>' . $cpf . '</td>
                                        <td style="text-align:center;">' . $cora . '</td>
                                        <td style="text-align:center;">' . $bic . '</td>
                                        <td style="text-align:center;">' . $pvpp . '</td>
                                        <td style="text-align:center;">' . $po . '</td>
                                        <td style="text-align:center;">' . $estagio . '</td>
                                        <td style="text-align:center;">' . $ecc . '</td>
                                    </tr>';
                                    $j++;
                                    
                                }

                            }
                        ?>
                    </table>
                <?php
                    echo form_close();
                    
                    if(!empty($lista)) {
                        
                        echo form_open($base_url . $url_gera_pdf, $atributos1);

                        $hidden = array(
                            'lista'     =>  $lista,
                            'id_edital' =>  $id_edital
                        );
                        echo form_hidden($hidden);
                        echo form_button(array('type' => 'submit', 'content' => 'Gerar PDF'));
                        echo form_close();
                        
                    }
                ?>
