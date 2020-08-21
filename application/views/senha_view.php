<!DOCTYPE html>
<html>
    <head>
        <title>Código de Acesso</title>
        
        <style type="text/css">

            form li {
                list-style: none;
            }
            
            form button {
                background: #384313;
                border: none;
                -moz-border-radius: 20px;
                -webkit-border-radius: 20px;
                -khtml-border-radius: 20px;
                border-radius: 20px;
                color: #ffffff;
                display: inline;
                font: 18px Georgia, "Times New Roman", Times, serif;
                letter-spacing: 1px;
                margin: auto;
                padding: 7px 25px;
                text-shadow: 0 1px 1px #000000;
                text-transform: uppercase;
            }

            form button:hover {
                background: #1e2506;
                cursor: pointer;
            }

            body {
                background: #e7efd1;
                color: #395338;
                font-family: Georgia, "Times New Roman", Times, serif;
                padding: 20px;
                counter-reset: fieldsets;
                text-align: center;
            }

        </style>
    </head>
    <body>
        <h1>Código de Acesso</h1>
        
        <p>Guarde este código de acesso, pois, o mesmo será requisitado nos próximos acessos. Este código de acesso também será enviado ao email cadastrado.</p>
        
        <?php
        
            $this->output->set_header("Content-Type: text/html; charset=UTF-8");
            
            $atributos = array(
                'target'    =>  '_blank'
            );
            
            echo form_open($base_url . $url, $atributos);
            
            $dados = array(
                
                'id'      =>      $id_ficha,
                
            );
            
            echo form_hidden($dados);
        
        ?>
        
        <ol>
            <li>
                <label>Código de acesso</label>
                <div>
                    <h2><?php echo $codigo_acesso; ?></h2>
                </div>
            </li>
            <li>
                <?php echo validation_errors(); ?>
            </li>
            <li>
                Clique em Avançar, para que seja gerado a sua ficha de candidatura em formato PDF.
            </li>
            <li>
                <div>
                    <?php echo form_button(array('type' => 'submit', 'content' => 'Avançar')); ?>
                </div>
            </li>
        </ol>
        
        <?php
        
            echo form_close();
        
        ?>
        
    </body>
</html>
