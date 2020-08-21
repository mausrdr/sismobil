<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $titulo ?></title>
        
        <link href="<?php echo base_url(); ?>css/estilo1.css" rel="stylesheet" type="text/css" />
        
        <script>
        
            function _voltar(id, descricao, opcao) {
                
                window.opener.atualizar(id, descricao, opcao);
                window.close();
                
            }
    
        </script>
        
    </head>
    <body>
        <h1><?php echo $h1 ?></h1>
        
        <?php
        
            $this->output->set_header("Content-Type: text/html; charset=UTF-8");
            
            $atributos = array(
            
            'id'    =>  'myform'
            
        );
            
            if($deletar == NULL) {
                
                echo form_open($base_url . "index.php/assessoria_pesquisa_controller/index/$opcao", $atributos);
                
            } else {
                
                echo form_open($base_url . "index.php/assessoria_pesquisa_controller/index/$opcao/$deletar", $atributos);
                
            }
            
        ?>
        <fieldset>
            <legend>Informe alguma palavra-chave</legend>
            <ol>
                <li>
                    <label><?php echo $label ?></label>
                    <div>
                        <?php echo form_input($input, '', 'autofocus'); ?>
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
            <table>
                <tr>
                    <th width="15%">&nbsp;</th>
                    <th width="30%">Cód.</th>
                    <th width="55%">Descrição</th>
                </tr>
                <?php 
                    if(!empty($lista)) {
                        
                        $i = 0;

                        foreach($lista as $conteudo) {

                            $id = $conteudo['id'];
                            $descricao = $conteudo['descricao'];
                            $href = "<a href=\"javascript:void(0)\" onclick=\"_voltar($id,'$descricao', $opcao)\"><img src=\"". $base_url ."css/images/select.png\" title='Selecionar $descricao' border=0></a>";

                            echo '<tr>
                                <td>'. $href .'</td>
                                <td>' . $id . '</td>
                                <td>' . $descricao . '</td>
                            </tr>';

                            $i++;

                        }
                        
                    }
                ?>
            </table>
        <fieldset>
            <div class="centro">
                <?php echo form_button(array('type' => 'submit', 'content' => 'Buscar')); ?>
            </div>
        </fieldset>

        
        <?php
        
            echo form_close();
            
            
            echo "<script>";
            echo "function fechar() { alert('$msg_erro'); window.close(); }";
            
            if(!empty($msg_erro)) {

                echo 'fechar();';

            }
            
            echo "</script>";
        
        ?>
    </body>
</html>