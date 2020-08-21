<!DOCTYPE html>
<html>
    <head>
        <title>Adicionar Financiamento</title>
        
        <link href="<?php echo base_url(); ?>css/estilo1.css" rel="stylesheet" type="text/css" />
        
        <script type="text/javascript">
        
            function voltar() {
                
                window.opener.atualizar();
                window.close();
                
            }
    
        </script>
        
    </head>
    <body>
        <h1>Adicionar Financiamento</h1>
        
        <?php
        
            $this->output->set_header("Content-Type: text/html; charset=UTF-8");
            
            $atributos = array(
            
            'id'    =>  'myform'
            
        );
            
            echo form_open($base_url . "index.php/adiciona_financiamento_controller/index", $atributos);
            
            $tipo_financiamento = array(
                'name'      =>      'tipo_financiamento',
                'id'        =>      'tipo_financiamento',
                'value'     =>      set_value('tipo_financiamento')
            );
            
        ?>
        <fieldset>
            <legend>Informe o novo tipo de financiamento</legend>
            <ol>
                <li>
                    <label>Tipo de Financiamento</label>
                    <div>
                        <?php echo form_input($tipo_financiamento, '', 'autofocus'); ?>
                    </div>
                </li>
            </ol>
        </fieldset>
        <div class="error">
            <?php echo validation_errors(); ?>
        </div>
            <?php if(isset($message)) { echo $message;} ?>
        <fieldset>
            <div class="centro">
                <?php echo form_button(array('type' => 'submit', 'content' => 'Adicionar')); ?>
                <?php echo form_button(array('type' => 'button', 'onclick' => 'voltar()' , 'content' => 'Voltar')); ?>
            </div>
        </fieldset>

        
        <?php
        
            echo form_close();
        
        ?>
        
    </body>
</html>