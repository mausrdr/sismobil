                <?php

                    $this->output->set_header("Content-Type: text/html; charset=UTF-8");

                    $atributo_assessoria = array(

                        'id'    =>  'myform'

                    );
                    
                    $atributo_aluno = array(
                        
                        'id'    =>  'myform1'
                        
                    );
                    
                    $assessoria_hidden = array(
                        'aba'   =>  'assessoria'
                    );
                    
                    $aluno_hidden = array(
                        'edital_aberto' =>  $edital_aberto,
                        'aba'   =>  'aluno'
                    );
                    
                    if($aba) {
                        
                        if($edital_aberto) {                           
                        
                ?>
                <ul id="myTab" class="nav nav-tabs">
                    <li>
                        <a href="#aluno" data-toggle="tab">Aluno</a>
                    </li>
                    <li class="active">
                        <a href="#assessoria" data-toggle="tab">Assessoria Internacional</a>
                    </li>
                </ul>
                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane fade" id="aluno">
                        <h1>Início</h1>
                        <?php echo form_open($base_url . $url, $atributo_aluno); ?>
                            <fieldset>
                                <legend>Escolha um Edital e informe seu CPF</legend>
                                <ol>
                                    <li>
                                        <label>Número do Edital</label>
                                        <div class="styled-select">
                                            <?php echo form_dropdown('edital_id_edital', $options_edital, set_value('edital_id_edital'), 'id="edital_id_edital" required'); ?>
                                        </div>
                                    </li>
                                    <li>
                                        <label>CPF</label>
                                        <div>
                                            <?php echo form_input($cpf); ?>
                                        </div>
                                    </li>
                                </ol>
                            </fieldset>
                            <div class="error">
                                <?php echo validation_errors(); ?>
                            </div>
                            <fieldset>
                                <?php echo form_button(array('type' => 'submit', 'content' => 'Avançar')); ?>
                            </fieldset>
                            <div>
                                <a href="<?php echo $base_url; ?>index.php/assessoria_restaura_codigo_controller">Esqueceu seu código de acesso?</a>
                            </div>
                        <?php
                        
                            echo form_hidden($aluno_hidden);
                            
                            echo form_close();
                            
                        ?>
                    </div>
                    <div class="tab-pane fade in active" id="assessoria">
                        <h1>Login</h1>
                        <?php echo form_open($base_url . $url, $atributo_assessoria); ?>
                            <fieldset>
                                <legend>Informe seu nome de usuário e senha</legend>
                                <ol>
                                    <li>
                                        <label>Usuário</label>
                                        <div>
                                            <?php echo form_input($username, '', 'autofocus'); ?>
                                        </div>
                                    </li>
                                    <li>
                                        <label>Senha</label>
                                        <div>
                                            <?php echo form_password($senha); ?>
                                        </div>
                                    </li>
                                </ol>
                            </fieldset>  
                            <div class="error">
                                <?php if(!empty($msg_erro)) {

                                    echo $msg_erro;

                                } ?>

                                <?php echo validation_errors(); ?>
                            </div>
                            <fieldset>
                                <?php echo form_button(array('type' => 'submit', 'content' => 'Avançar')); ?>
                            </fieldset>  
                            <div>
                                <a href="<?php echo $base_url; ?>index.php/assessoria_restaura_senha_controller">Esqueceu sua senha?</a>
                            </div>                            
                        <?php
                        
                            echo form_hidden($assessoria_hidden);
                            
                            echo form_close();
                            
                        ?>
                    <?php
                    
                        } else {
                                                
                     ?> 
                 <ul id="myTab" class="nav nav-tabs">
                    <li>
                        <a href="#aluno" data-toggle="tab">Aluno</a>
                    </li>
                    <li class="active">
                        <a href="#assessoria" data-toggle="tab">Assessoria Internacional</a>
                    </li>
                </ul>
                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane fade in active" id="aluno">
                        <h1>Início</h1>
                        <?php echo form_open($base_url . $url, $atributo_aluno); ?>
                            <fieldset>
                                <legend>Informe seu CPF e seu Código de Acesso</legend>
                                <ol>
                                    <li>
                                        <label>CPF</label>
                                        <div class="cpf">
                                            <?php echo form_input($cpf); ?>
                                        </div>
                                    </li>
                                    <li>
                                        <label>Código de Acesso</label>
                                        <div class="codigo_acesso">
                                            <?php echo form_password($codigo_acesso); ?>
                                        </div>
                                    </li>
                                </ol>
                            </fieldset>
                            <div class="error">
                                <?php 

                                    if(!empty($msg_erro)) {

                                        echo $msg_erro;

                                    }

                                    echo validation_errors();

                                ?>
                            </div>
                            <fieldset>
                                <?php echo form_button(array('type' => 'submit', 'content' => 'Avançar')); ?>
                            </fieldset>
                            <div>
                                <a href="<?php echo $base_url; ?>index.php/aluno_restaura_codigo_controller">Esqueceu seu código de acesso?</a>
                            </div>
                        <?php
                        
                            echo form_hidden($aluno_hidden);
                            
                            echo form_close();
                            
                        ?>
                    </div>
                    <div class="tab-pane fade" id="assessoria">
                        <h1>Login</h1>
                        <?php echo form_open($base_url . $url, $atributo_assessoria); ?>
                            <fieldset>
                                <legend>Informe seu nome de usuário e senha</legend>
                                <ol>
                                    <li>
                                        <label>Usuário</label>
                                        <div>
                                            <?php echo form_input($username, '', 'autofocus'); ?>
                                        </div>
                                    </li>
                                    <li>
                                        <label>Senha</label>
                                        <div>
                                            <?php echo form_password($senha); ?>
                                        </div>
                                    </li>
                                </ol>
                            </fieldset>  
                            <div class="error">
                                <?php if(!empty($msg_erro)) {

                                    echo $msg_erro;

                                } ?>

                                <?php echo validation_errors(); ?>
                            </div>
                            <fieldset>
                                <?php echo form_button(array('type' => 'submit', 'content' => 'Avançar')); ?>
                            </fieldset>  
                            <div>
                                <a href="<?php echo $base_url; ?>index.php/assessoria_restaura_senha_controller">Esqueceu sua senha?</a>
                            </div>                            
                        <?php
                        
                            echo form_hidden($assessoria_hidden);
                            
                            echo form_close();
                            
                        ?>
                    <?php
                    
                        }
                        
                    ?>
                <?php 
                
                    } else {
                        
                        if($edital_aberto) {
                            
                ?>
                <ul id="myTab" class="nav nav-tabs">
                    <li class="active">
                        <a href="#aluno" data-toggle="tab">Aluno</a>
                    </li>
                    <li>
                        <a href="#assessoria" data-toggle="tab">Assessoria Internacional</a>
                    </li>
                </ul>
                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane fade in active" id="aluno">
                        <h1>Início</h1>
                        <?php echo form_open($base_url . $url, $atributo_aluno); ?>
                            <fieldset>
                                <legend>Escolha um Edital e informe seu CPF</legend>
                                <ol>
                                    <li>
                                        <label>Número do Edital</label>
                                        <div class="styled-select">
                                            <?php echo form_dropdown('edital_id_edital', $options_edital, set_value('edital_id_edital'), 'id="edital_id_edital" required'); ?>
                                        </div>
                                    </li>
                                    <li>
                                        <label>CPF</label>
                                        <div>
                                            <?php echo form_input($cpf); ?>
                                        </div>
                                    </li>
                                </ol>
                            </fieldset>
                            <div class="error">
                                <?php echo validation_errors(); ?>
                            </div>
                            <fieldset>
                                <?php echo form_button(array('type' => 'submit', 'content' => 'Avançar')); ?>
                            </fieldset>
                        <?php
                        
                            echo form_hidden($aluno_hidden);
                            
                            echo form_close();
                            
                        ?>
                    </div>
                    <div class="tab-pane fade" id="assessoria">
                        <h1>Login</h1>
                        <?php echo form_open($base_url . $url, $atributo_assessoria); ?>
                            <fieldset>
                                <legend>Informe seu nome de usuário e senha</legend>
                                <ol>
                                    <li>
                                        <label>Usuário</label>
                                        <div>
                                            <?php echo form_input($username, '', 'autofocus'); ?>
                                        </div>
                                    </li>
                                    <li>
                                        <label>Senha</label>
                                        <div>
                                            <?php echo form_password($senha); ?>
                                        </div>
                                    </li>
                                </ol>
                            </fieldset>  
                            <div class="error">
                                <?php if(!empty($msg_erro)) {

                                    echo $msg_erro;

                                } ?>

                                <?php echo validation_errors(); ?>
                            </div>
                            <fieldset>
                                <?php echo form_button(array('type' => 'submit', 'content' => 'Avançar')); ?>
                            </fieldset>  
                            <div>
                                <a href="<?php echo $base_url; ?>index.php/assessoria_restaura_senha_controller">Esqueceu sua senha?</a>
                            </div>                            
                        <?php
                        
                            echo form_hidden($assessoria_hidden);
                            
                            echo form_close();
                            
                        ?>
                <?php 
                
                        } else {
                            
                ?>
                        
                <ul id="myTab" class="nav nav-tabs">
                    <li class="active">
                        <a href="#aluno" data-toggle="tab">Aluno</a>
                    </li>
                    <li>
                        <a href="#assessoria" data-toggle="tab">Assessoria Internacional</a>
                    </li>
                </ul>
                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane fade in active" id="aluno">
                        <h1>Início</h1>
                        <?php echo form_open($base_url . $url, $atributo_aluno); ?>
                            <fieldset>
                                <legend>Informe seu CPF e seu Código de Acesso</legend>
                                <ol>
                                    <li>
                                        <label>CPF</label>
                                        <div class="cpf">
                                            <?php echo form_input($cpf); ?>
                                        </div>
                                    </li>
                                    <li>
                                        <label>Código de Acesso</label>
                                        <div class="codigo_acesso">
                                            <?php echo form_password($codigo_acesso); ?>
                                        </div>
                                    </li>
                                </ol>
                            </fieldset>
                            <div class="error">
                                <?php 

                                    if(!empty($msg_erro)) {

                                        echo $msg_erro;

                                    }

                                    echo validation_errors();

                                ?>
                            </div>
                            <fieldset>
                                <?php echo form_button(array('type' => 'submit', 'content' => 'Avançar')); ?>
                            </fieldset>
                            <div>
                                <a href="<?php echo $base_url; ?>index.php/aluno_restaura_codigo_controller">Esqueceu seu código de acesso?</a>
                            </div>
                        <?php
                        
                            echo form_hidden($aluno_hidden);
                            
                            echo form_close();
                            
                        ?>
                    </div>
                    <div class="tab-pane fade" id="assessoria">
                        <h1>Login</h1>
                        <?php echo form_open($base_url . $url, $atributo_assessoria); ?>
                            <fieldset>
                                <legend>Informe seu nome de usuário e senha</legend>
                                <ol>
                                    <li>
                                        <label>Usuário</label>
                                        <div>
                                            <?php echo form_input($username, '', 'autofocus'); ?>
                                        </div>
                                    </li>
                                    <li>
                                        <label>Senha</label>
                                        <div>
                                            <?php echo form_password($senha); ?>
                                        </div>
                                    </li>
                                </ol>
                            </fieldset>  
                            <div class="error">
                                <?php if(!empty($msg_erro)) {

                                    echo $msg_erro;

                                } ?>

                                <?php echo validation_errors(); ?>
                            </div>
                            <fieldset>
                                <?php echo form_button(array('type' => 'submit', 'content' => 'Avançar')); ?>
                            </fieldset>  
                            <div>
                                <a href="<?php echo $base_url; ?>index.php/assessoria_restaura_senha_controller">Esqueceu sua senha?</a>
                            </div>                            
                        <?php
                        
                            echo form_hidden($assessoria_hidden);
                            
                            echo form_close();
                            
                        ?>        
                        
                <?php
                            
                        }
                    
                    }
                
                ?>
                
                    
                </div>
