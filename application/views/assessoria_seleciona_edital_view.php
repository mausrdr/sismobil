        <p><?php echo $paragrafo; ?></p>
        
        <?php
        
            $this->output->set_header("Content-Type: text/html; charset=UTF-8");
            
            $atributos = array(
            
            'id'    =>  'myform'
            
        );
            
            echo form_open($base_url . $url, $atributos);
            
        ?>
        <fieldset>
            <legend><?php echo $legend; ?></legend>
            <ol>
                <li>
                    <label>Número do Edital</label>
                    <div class="styled-select">
                        <?php echo form_dropdown('id_edital', $options_edital, set_value('id_edital'), 'required'); ?>
                    </div>
                </li>
            </ol>
        </fieldset>  
            <?php echo validation_errors(); ?>
        <fieldset>
            <?php echo form_button(array('type' => 'submit', 'content' => 'Avançar')); ?>
        </fieldset>

        
        <?php
        
            echo form_close();
        
        ?>
        
    </body>
</html>
