<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="pt-BR" class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Formulário de Candidatura para Alunos de Intercâmbio</title>
        <script src="<?php echo base_url(); ?>js/modernizr-2.6.2.min.js"></script>
        
        <link href="<?php echo base_url(); ?>css/estilo.css" rel="stylesheet" type="text/css" />
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.3/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>js/script.js"></script>
        <script src="<?php echo base_url(); ?>js/jquery.js"></script>
        <script src="<?php echo base_url(); ?>js/ajax.js"></script>
        <script src="<?php echo base_url(); ?>js/jquery.limit-1.0.source.js"></script>
        <script>
                jQuery.noConflict();
                jQuery(document).ready(function($){
                    $('#informacoes').limit('150','#left');
                    $('#carta').limit('1957','#motivacao');
                    $('#iniciacao').limit('945','#cientifica');
                    $('#extensao').limit('945','#cultural');
                });
                
        </script>
        <script>
            jQuery.noConflict();
            function ajax_request(id) {
                var submitTo = '../preenche/?id=' + id;
                //location.href = submitTo; //uncomment if you need for debugging
 
                http('GET', submitTo, ajax_response, document.myform);
            }
            
            function ajax_response(data) {
                for(var key in data) {
                    document.myform[key].value = data[key];
                }
            }
        </script>
        <script>
            function adicionaFinanciamento()
            {
                //tipo_busca = 8;
                var url = "../../../index.php/adiciona_financiamento_controller/index";

                var wnd = window.open(url,'adiciona','toolbar=no,width=850,height=350,scrollbars=yes');
            }
            
            function atualizar() {
                
                window.location.reload();
                
            }
            
        </script>
        
        <script src="http://www.google.com/jsapi"></script>
        <script>
            google.load('jquery', '1.3');
        </script>
        <script>
            function drop_down() {
                jQuery.noConflict();
                jQuery(function($){
                    $('#universidade1').change(function(){
                        if( $(this).val() != 0 ) {
                                $('#campus1').hide();
                                $('.carregando').show();
                                var ids = $('#edital_id_edital').val() + "," + $(this).val();
                                //var submitTo = '../../../application/controllers/campus_ajax.php/?dados=' + ids;
                                //location.href = submitTo; //uncomment if you need for debugging
                                $.getJSON('../../../application/controllers/campus_ajax.php/?search=',{dados: ids, ajax: 'true'}, function(j){
                                        var options = '<option value="0">Selecione um Câmpus</option>';	
                                         
                                        for (var i = 0; i < j.length; i++) {
                                                options += '<option value="' + j[i].id + '">' + j[i].descricao + '</option>';
                                        }	
                                        $('#campus1').html(options).show();
                                        $('.carregando').hide();
                                });
                        } else {
                                $('#campus1').html('<option value="">– Escolha uma Universidade –</option>');
                        }
                    });
                });
                jQuery.noConflict();
                jQuery(function($){
                    $('#campus1').change(function(){
                        if( $(this).val() != 0 ) {
                                $('#curso1').hide();
                                $('.carregando2').show();
                                var ids = $('#edital_id_edital').val() + "," + $('#universidade1').val() + "," + $(this).val();
                                $.getJSON('../../../application/controllers/curso_ajax.php/?search=',{dados: ids, ajax: 'true'}, function(j){
                                        var options = '<option value="0">Selecione um Curso</option>';	

                                        for (var i = 0; i < j.length; i++) {
                                                options += '<option value="' + j[i].id + '">' + j[i].descricao + '</option>';
                                        }	
                                        $('#curso1').html(options).show();
                                        $('.carregando2').hide();
                                });
                        } else {
                                $('#curso1').html('<option value="">– Escolha um Câmpus –</option>');
                        }
                    });
                });
                jQuery.noConflict();
                jQuery(function($){
                    $('#universidade2').change(function(){
                        if( $(this).val() != 0 ) {
                                $('#campus2').hide();
                                $('.carregando3').show();
                                var ids = $('#edital_id_edital').val() + "," + $(this).val();
                                //var submitTo = '../../../application/controllers/campus_ajax.php/?dados=' + ids;
                                //location.href = submitTo; //uncomment if you need for debugging
                                $.getJSON('../../../application/controllers/campus_ajax.php/?search=',{dados: ids, ajax: 'true'}, function(j){
                                        var options = '<option value="0">Selecione um Câmpus</option>';	
                                         
                                        for (var i = 0; i < j.length; i++) {
                                                options += '<option value="' + j[i].id + '">' + j[i].descricao + '</option>';
                                        }	
                                        $('#campus2').html(options).show();
                                        $('.carregando3').hide();
                                });
                        } else {
                                $('#campus2').html('<option value="">– Escolha uma Universidade –</option>');
                        }
                    });
                });
                jQuery.noConflict();
                jQuery(function($){
                    $('#campus2').change(function(){
                        if( $(this).val() != 0 ) {
                                $('#curso2').hide();
                                $('.carregando4').show();
                                var ids = $('#edital_id_edital').val() + "," + $('#universidade2').val() + "," + $(this).val();
                                $.getJSON('../../../application/controllers/curso_ajax.php/?search=',{dados: ids, ajax: 'true'}, function(j){
                                        var options = '<option value="0">Selecione um Curso</option>';	

                                        for (var i = 0; i < j.length; i++) {
                                                options += '<option value="' + j[i].id + '">' + j[i].descricao + '</option>';
                                        }	
                                        $('#curso2').html(options).show();
                                        $('.carregando4').hide();
                                });
                        } else {
                                $('#curso2').html('<option value="">– Escolha um Câmpus –</option>');
                        }
                    });
                });
                jQuery.noConflict();
                jQuery(function($){
                    $('#universidade3').change(function(){
                        if( $(this).val() != 0 ) {
                                $('#campus3').hide();
                                $('.carregando5').show();
                                var ids = $('#edital_id_edital').val() + "," + $(this).val();
                                //var submitTo = '../../../application/controllers/campus_ajax.php/?dados=' + ids;
                                //location.href = submitTo; //uncomment if you need for debugging
                                $.getJSON('../../../application/controllers/campus_ajax.php/?search=',{dados: ids, ajax: 'true'}, function(j){
                                        var options = '<option value="0">Selecione um Câmpus</option>';	
                                         
                                        for (var i = 0; i < j.length; i++) {
                                                options += '<option value="' + j[i].id + '">' + j[i].descricao + '</option>';
                                        }	
                                        $('#campus3').html(options).show();
                                        $('.carregando5').hide();
                                });
                        } else {
                                $('#campus3').html('<option value="">– Escolha uma Universidade –</option>');
                        }
                    });
                });
                jQuery.noConflict();
                jQuery(function($){
                    $('#campus3').change(function(){
                        if( $(this).val() != 0 ) {
                                $('#curso3').hide();
                                $('.carregando6').show();
                                var ids = $('#edital_id_edital').val() + "," + $('#universidade3').val() + "," + $(this).val();
                                $.getJSON('../../../application/controllers/curso_ajax.php/?search=',{dados: ids, ajax: 'true'}, function(j){
                                        var options = '<option value="0">Selecione um Curso</option>';	

                                        for (var i = 0; i < j.length; i++) {
                                                options += '<option value="' + j[i].id + '">' + j[i].descricao + '</option>';
                                        }	
                                        $('#curso3').html(options).show();
                                        $('.carregando6').hide();
                                });
                        } else {
                                $('#curso3').html('<option value="">– Escolha um Câmpus –</option>');
                        }
                    });
                });
                jQuery.noConflict();
                jQuery(function($){
                    $('#campus').change(function(){
                        if( $(this).val() != 0 ) {
                                $('#curso_id_curso').hide();
                                $('.carregando_curso').show();
                                $.getJSON('../../../application/controllers/curso_origem_ajax.php/?search=',{dados: $(this).val(), ajax: 'true'}, function(j){
                                        var options = '<option value="0">Selecione um Curso</option>';	

                                        for (var i = 0; i < j.length; i++) {
                                                options += '<option value="' + j[i].id + '">' + j[i].descricao + '</option>';
                                        }	
                                        $('#curso_id_curso').html(options).show();
                                        $('.carregando_curso').hide();
                                });
                        } else {
                                $('#curso_id_curso').html('<option value="">– Escolha um Câmpus –</option>');
                        }
                    });
                });
            }
        </script>
        
    </head>
    <body onload="drop_down()">
        
            
        
        
        
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->
        <h1>Formulário de Candidatura para Alunos de Intercâmbio</h1>

        <p>Por favor preencha os campos abaixo em todos os seus detalhes</p>

        <?php
        $this->output->set_header("Content-Type: text/html; charset=UTF-8");
        
        $atributos = array(
            
            'name'      =>  'myform',
            'id'        =>  'myform'
            
        );
        
        echo form_open($base_url . "index.php/dados_pessoais_opcao_assistencia_controller/index/?cpf=$ncpf&id=$id_edital", $atributos);

        $nome = array(
            'name'      =>      'nome',
            'id'        =>      'nome',
            'value'     =>      set_value('nome')
        );

        $sexom = array(
            'name'      =>      'sexo',
            'id'        =>      'sexom',
            'value'     =>      'm',
            'style'     =>      'margin:5px'
        );

        $sexof = array(
            'name'      =>      'sexo',
            'id'        =>      'sexof',
            'value'     =>      'f',
            'style'     =>      'margin:5px'
        );

        $endereco = array(
            'name'      =>      'endereco',
            'id'        =>      'endereco',
            'value'     =>      set_value('endereco')
        );

        $numero = array(
            'name'      =>      'numero',
            'id'        =>      'numero',
            'value'     =>      set_value('numero')
        );

        $complemento = array(
            'name'      =>      'complemento',
            'id'        =>      'complemento',
            'value'     =>      set_value('complemento')
        );

        $bairro = array(
            'name'      =>      'bairro',
            'id'        =>      'bairro',
            'value'     =>      set_value('bairro')
        );

        $cidade = array(
            'name'      =>      'cidade',
            'id'        =>      'cidade',
            'value'     =>      set_value('cidade')
        );

        $cep = array(
            'name'          =>      'cep',
            'id'            =>      'cep',
            'placeholder'   =>      'Ex.: 99999-999',
            'value'         =>      set_value('cep'),
            'pattern'       =>      '\d{5}-\d{3}'
        );
        $options_estado = array(
            'AC' => 'Acre',
            'AL' => 'Alagoas',
            'AP' => 'Amapá',
            'AM' => 'Amazonas',
            'BA' => 'Bahia',
            'CE' => 'Ceará',
            'DF' => 'Distrito Federal',
            'ES' => 'Espírito Santo',
            'GO' => 'Goiás',
            'MA' => 'Maranhão',
            'MT' => 'Mato Grosso',
            'MS' => 'Mato Grosso do Sul',
            'MG' => 'Minas Gerais',
            'PA' => 'Pará',
            'PB' => 'Paraíba',
            'PR' => 'Paraná',
            'PE' => 'Pernambuco',
            'PI' => 'Piauí',
            'RJ' => 'Rio de Janeiro',
            'RN' => 'Rio Grande do Norte',
            'RS' => 'Rio Grande do Sul',
            'RO' => 'Rondônia',
            'RR' => 'Roraima',
            'SC' => 'Santa Catarina',
            'SP' => 'São Paulo',
            'SE' => 'Sergipe',
            'TO' => 'Tocantins'
        );

        $pais = array(
            'name'      =>      'pais',
            'id'        =>      'pais',
            'value'     =>      set_value('pais')
        );

        $telefone = array(
            'name'          =>      'telefone',
            'id'            =>      'telefone',
            'placeholder'   =>      'Ex.: +55(55)5555-5555',
            'title'         =>      'Incluir código do país e local',
            'value'         =>      set_value('telefone'),
            'pattern'       =>      '[\+]\d{1,3}[\(]\d{2}[\)]\d{4}[\-]\d{4}'
        );

        $celular = array(
            'name'          =>      'celular',
            'id'            =>      'celular',
            'placeholder'   =>      'Ex.: +55(55)5555-5555',
            'title'         =>      'Incluir código do país e local',
            'value'         =>      set_value('celular'),
            'pattern'       =>      '[\+]\d{1,3}[\(]\d{2}[\)]\d{4}[\-]\d{4}'
        );

        $rg = array(
            'name'      =>      'rg',
            'id'        =>      'rg',
            'value'     =>      set_value('rg')
        );

        $data_expedicao = array(
            'name'          =>      'data_expedicao',
            'id'            =>      'data_expedicao',
            'placeholder'   =>      'Ex.: dd/mm/aaaa',
            'value'         =>      set_value('data_expedicao'),
            'pattern'       =>      '(((0[1-9]|[12]\d|3[01])\/(0[13578]|1[02])\/((19|[2-9]\d)\d{2}))|((0[1-9]|[12]\d|30)\/(0[13456789]|1[012])\/((19|[2-9]\d)\d{2}))|((0[1-9]|1\d|2[0-8])\/02\/((19|[2-9]\d)\d{2}))|(29\/02\/((1[6-9]|[2-9]\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))))'
        );

        $orgao_emissor = array(
            'name'      =>      'orgao_emissor',
            'id'        =>      'orgao_emissor',
            'value'     =>      set_value('orgao_emissor')
        );

        $cpf = array(
            'name'      =>      'cpf',
            'id'        =>      'cpf',
            'value'     =>      $ncpf,
            'readonly'  =>      '0'
        );

        $passaporte = array(
            'name'      =>      'passaporte',
            'id'        =>      'passaporte',
            'value'     =>      set_value('passaporte'),
            'pattern'   =>      '[A-Z]{2}[0-9]{6}'
        );

        $nacionalidade = array(
            'name'      =>      'nacionalidade',
            'id'        =>      'nacionalidade',
            'value'     =>      set_value('nacionalidade')
        );

        $email = array(
            'name'      =>      'email',
            'id'        =>      'email',
            'value'     =>      set_value('email')
        );

        $data_nascimento = array(
            'name'          =>      'data_nascimento',
            'id'            =>      'data_nascimento',
            'placeholder'   =>      'Ex.: dd/mm/aaaa',
            'value'         =>      set_value('data_nascimento'),
            'pattern'       =>      '?:19|20)(?:(?:[13579][26]|[02468][048])-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))|(?:[0-9]{2}-(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-8])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:29|30))|(?:(?:0[13578]|1[02])-31))'
        );
        
        $options_campus = array('0'     =>      'Selecione um Câmpus');
        
        foreach($lista_campus as $campus) {
            
            $options_campus[$campus['id']] = $campus['campus'];
            
        }
        
        $semestre_atual = array(
            'name'      =>      'semestre_atual',
            'id'        =>      'semestre_atual',
            'value'     =>      set_value('semestre_atual')
        );
        
        $semestre_total = array(
            'name'      =>      'semestre_total',
            'id'        =>      'semestre_total',
            'value'     =>      set_value('semestre_total')
        );
        
        $media_geral = array(
            'name'          =>      'media_geral',
            'id'            =>      'media_geral',
            'placeholder'   =>      'Ex.: 7 até 10',
            'title'         =>      'Aceita até uma casa depois da vírgula. Números redondos não necessita da vírgula. Como mínimo 7 e máximo 10.',
            'value'         =>      set_value('media_geral'),
            'pattern'       =>      '(^(10)$)|(^([7-9]{1})(\,([1-9])){1}$)+|(^([7-9]{1})$)'
        );
        
        $coordenador = array(
            'name'      =>      'coordenador',
            'id'        =>      'coordenador',
            'value'     =>      set_value('coordenador')
        );
        
        $diretor = array(
            'name'      =>      'diretor',
            'id'        =>      'diretor',
            'value'     =>      set_value('diretor'),
            'readonly'  =>      '0'
        );
        
        $telefone_campus = array(
            'name'              =>      'telefone_campus',
            'id'                =>      'telefone_campus',
            'placeholder'       =>      'Ex.: +55(55)5555-5555',
            'title'             =>      'Incluir código do país e local',
            'value'             =>      set_value('telefone_campus'),
            'pattern'           =>      '[\+]\d{1,3}[\(]\d{2}[\)]\d{4}[\-]\d{4}',
            'readonly'          =>      '0'
        );
        
        $fax = array(
            'name'              =>      'fax',
            'id'                =>      'fax',
            'placeholder'       =>      'Ex.: +55(55)5555-5555',
            'title'             =>      'Incluir código do país e local',
            'value'             =>      set_value('fax'),
            'pattern'           =>      '[\+]\d{1,3}[\(]\d{2}[\)]\d{4}[\-]\d{4}',
            'readonly'          =>      '0'
        );

        $periodo = array(
            'name'      =>      'periodo',
            'id'        =>      'periodo',
            'value'     =>      set_value('periodo')
        );
        
        $disciplinas = array(
            'name'      =>      'tipo_atividade[]',
            'id'        =>      'disciplinas',
            'class'     =>      'regular-checkbox',
            'value'     =>      '1',
            'style'     =>      'margin:10px'
        );
        
        $projetos = array(
            'name'      =>      'tipo_atividade[]',
            'id'        =>      'projetos',
            'class'     =>      'regular-checkbox',
            'value'     =>      '2',
            'style'     =>      'margin:10px'
        );
        
        $estagio = array(
            'name'      =>      'tipo_atividade[]',
            'id'        =>      'estagio',
            'class'     =>      'regular-checkbox',
            'value'     =>      '3',
            'style'     =>      'margin:10px'
        );
        
        $outros = array(
            'name'      =>      'tipo_atividade[]',
            'id'        =>      'outros',
            'class'     =>      'regular-checkbox',
            'value'     =>      '4',
            'style'     =>      'margin:10px'
        );
        
        $informacoes = array(
            'name'      =>      'informacoes',
            'id'        =>      'informacoes',
            'rows'      =>      '8',
            'cols'      =>      '142',
            'value'     =>      set_value('informacoes')
        );
        
        $options_idioma = array('0' => 'Selecione um Idioma');
        
        foreach($lista_idioma as $idioma) {
            
            $options_idioma[$idioma['id']] = $idioma['descricao'];
            
        }
        
        $basico = array(
            'name'      =>      'fluencia1',
            'id'        =>      'basico',
            'value'     =>      '1',
            'style'     =>      'margin:5px'
        );
        
        $intermediario = array(
            'name'      =>      'fluencia1',
            'id'        =>      'intermediario',
            'value'     =>      '2',
            'style'     =>      'margin:5px'
        );
        
        $avancado = array(
            'name'      =>      'fluencia1',
            'id'        =>      'avancado',
            'value'     =>      '3',
            'style'     =>      'margin:5px'
        );
        
        $hidden = array(
            'quantidade_idiomas'    =>      '1'
        );
        
        $options_financiamento = array('0' => 'Selecione um Tipo de Financiamento');
        
        foreach($lista_financiamento as $financiamento) {
            
            $options_financiamento[$financiamento['id']] = $financiamento['descricao'];
            
        }
        
        $carta = array(
            'name'          =>      'carta',
            'id'            =>      'carta',
            'rows'          =>      '8',
            'cols'          =>      '142',
            'placeholder'   =>      'Carta de motivação dirigida à DRI justificando o interesse pelo intercâmbio.',
            'value'         =>      set_value('carta')
        );
        
        $iniciacao = array(
            'name'          =>      'iniciacao',
            'id'            =>      'iniciacao',
            'rows'          =>      '8',
            'cols'          =>      '142',
            'placeholder'   =>      'Envolvimento em programas, atividades, organizações, eventos e iniciação científica relacionados ao curso de graduação',
            'value'         =>      set_value('iniciacao')
        );
        
        $extensao = array(
            'name'          =>      'extensao',
            'id'            =>      'extensao',
            'rows'          =>      '8',
            'cols'          =>      '142',
            'placeholder'   =>      'Liste o seu envolvimento em programas/ atividades/ organizações/ eventos de extensão culturais e/ou internacionais (caso possua)',
            'value'         =>      set_value('extensao')
        );
        
        if (isset($this->view_data['sexo'])) {

            $sexo_set_value = $this->view_data['sexo'];
            
        }
        
        if(isset($this->view_data['tipo_atividade']) && !empty($this->view_data['tipo_atividade'])) {
            
            print_r($this->view_data['tipo_atividade']);
            
            $tipo = array();
            foreach($this->view_data['tipo_atividade'] as $atividade) {
                
                switch ($atividade) {
                    case 1:
                        $tipo[0] = $atividade;
                        break;
                    
                    case 2:
                        $tipo[1] = $atividade;
                        break;
                    
                    case 3:
                        $tipo[2] = $atividade;
                        break;
                    
                    case 4:
                        $tipo[3] = $atividade;
                        break;

                    default:
                        break;
                }
                
            }
            
        }
        
        if (isset($this->view_data['fluencia1'])) {

            $fluencia_set_value = $this->view_data['fluencia1'];
            
        }
        
        ?>
        <div class="error">
            <?php echo validation_errors(); ?>
        </div>
        <fieldset>
            <legend>Dados Pessoais</legend>
            <ol>
                <li>
                    <label>Nome</label>
                    <div>
                        <?php echo form_input($nome, '', 'autofocus required'); ?>
                    </div>
                </li>
                <li>
                    <fieldset>
                        <legend>Sexo</legend>
                        <ol>
                            <li>
                                <div>
                                    <?php if (!empty($sexo_set_value) && $sexo_set_value == 'm') { echo form_radio($sexom, '', 'set_radio(\'sexo\', \'m\')'); } else { echo form_radio($sexom, '', FALSE, 'required'); } ?>
                                    <label for="sexom">Masculino</label>
                                </div>
                            </li>

                            <li>
                                <div>
                                    <?php if (!empty($sexo_set_value) && $sexo_set_value == 'f') { echo form_radio($sexof, '', 'set_radio(\'sexo\', \'f\')'); } else { echo form_radio($sexof); } ?>
                                    <label for="sexof">Feminino</label>
                                </div>
                            </li>
                        </ol>
                    </fieldset>
                </li>

                <li>
                    <label>Endereço</label>
                    <div>
                        <?php echo form_input($endereco, '', 'required') ?>
                    </div>
                </li>

                <li>
                    <label>Número</label>
                    <div>
                        <?php echo form_input($numero, '', 'required') ?>
                    </div>
                </li>

                <li>
                    <label>Complemento</label>
                    <div>
                        <?php echo form_input($complemento) ?>
                    </div>
                </li>

                <li>
                    <label>Bairro</label>
                    <div>
                        <?php echo form_input($bairro, '', 'required') ?>
                    </div>
                </li>

                <li>
                    <label>Cidade</label>
                    <div>
                        <?php echo form_input($cidade, '', 'required') ?>
                    </div>
                </li>

                <li>
                    <label>Cep</label>
                    <div>
                        <?php echo form_input($cep, '', 'required') ?>
                    </div>
                </li>

                <li>
                    <label>Estado</label>
                    <div class="styled-select">
                        <?php echo form_dropdown('estado', $options_estado, set_value('estado'), 'required') ?>
                    </div>
                </li>

                <li>
                    <label>País</label>
                    <div>
                        <?php echo form_input($pais, '', 'required') ?>
                    </div>
                </li>

                <li>
                    <label>Telefone</label>
                    <div>
                        <?php echo form_input($telefone, '', 'required') ?>
                    </div>
                </li>

                <li>
                    <label>Celular</label>
                    <div>
                        <?php echo form_input($celular, '', 'required') ?>
                    </div>
                </li>

                <li>
                    <label>RG</label>
                    <div>
                        <?php echo form_input($rg, '', 'required') ?>
                    </div>
                </li>

                <li>
                    <label>Data de expedição</label>
                    <div>
                        <?php echo form_input($data_expedicao, '', 'required') ?>
                    </div>
                </li>

                <li>
                    <label>Órgão emissor</label>
                    <div>
                        <?php echo form_input($orgao_emissor, '', 'required') ?>
                    </div>
                </li>

                <li>
                    <label>CPF</label>
                    <div>
                        <?php echo form_input($cpf) ?>
                    </div>
                </li>

                <li>
                    <label>Passaporte</label>
                    <div>
                        <?php echo form_input($passaporte, '', 'required') ?>
                    </div>
                </li>

                <li>
                    <label>Nacionalidade</label>
                    <div>
                        <?php echo form_input($nacionalidade, '', 'required') ?>
                    </div>
                </li>

                <li>
                    <label>Email</label>
                    <div>
                        <?php echo form_email($email, '', 'required') ?>
                    </div>
                </li>

                <li>
                    <div>
                        <?php echo form_input($data_nascimento, '', 'required') ?>
                        <label for="data_nascimento">Data de nascimento</label>
                    </div>
                </li>

               
            </ol>
        </fieldset>
        <fieldset>
            <legend>Campus de Origem do Candidato</legend>
            <ol>
                <li>
                    <label>Câmpus</label>
                    <div class="styled-select">
                        <?php echo form_dropdown('campus', $options_campus, set_value(0), 'id="campus" onchange="ajax_request(campus.value)" required') ?>
                    </div>
                </li>
                <li>
                    <label>Curso</label>
                    <div class="styled-select">
                        <span class="carregando_curso" style="display: none;">Aguarde, carregando...</span>
                        <?php echo form_dropdown('curso_id_curso', $options_curso_origem, set_value('curso_id_curso'), 'id="curso_id_curso" required') ?>
                    </div>
                </li>
                <li>
                    <label>Semestre atual</label>
                    <?php echo form_input($semestre_atual, '', 'required'); ?>
                </li>
                <li>
                    <label>Total de semestres a serem cursados</label>
                    <?php echo form_input($semestre_total, '', 'required'); ?>
                </li>
                <li>
                    <label>Média geral das disciplinas cursadas</label>
                    <?php echo form_input($media_geral, '', 'required'); ?>
                </li>
                <li>
                    <label>Coordenaor do curso</label>
                    <?php echo form_input($coordenador, '', 'required'); ?>
                </li>
                <li>
                    <label>Diretor do Câmpus de origem</label>
                    <?php echo form_input($diretor, '', 'required'); ?>
                </li>
                <li>
                    <label>Telefone do Câmpus</label>
                    <?php echo form_input($telefone_campus, '', 'required'); ?>
                </li>
                <li>
                    <label>Fax do Câmpus</label>
                    <?php echo form_input($fax, '', 'required'); ?>
                </li>
            </ol>
        </fieldset>
        <fieldset>
            <legend>Informações sobre a mobilidade</legend>
            <ol>
                <li>
                    <fieldset>
                        <legend>Universidade de destino</legend>
                        <fieldset>
                            <legend>Opção 1</legend>
                            <ol>
                                <li>
                                    <label>Universidade</label>
                                    <div class="styled-select">
                                        <?php echo form_dropdown('universidade1', $options_universidade, set_value('universidade1'), 'id="universidade1" required') ?>
                                    </div>
                                </li>
                                <li>
                                    <label>Câmpus</label>
                                    <div class="styled-select">
                                        <span class="carregando" style="display: none;">Aguarde, carregando...</span>
                                        <?php echo form_dropdown('campus1', $options_campus1, set_value('campus1'), 'id="campus1" required') ?>
                                    </div>
                                </li>
                                <li>
                                    <label>Curso</label>
                                    <div class="styled-select">
                                        <span class="carregando2" style="display: none;">Aguarde, carregando...</span>
                                        <?php echo form_dropdown('curso1', $options_curso, set_value('curso1'), 'id="curso1" required') ?>
                                    </div>
                                </li>
                            </ol>
                        </fieldset>
                        <fieldset>
                            <legend>Opção 2</legend>
                            <ol>
                                <li>
                                    <label>Universidade</label>
                                    <div class="styled-select">
                                        <?php echo form_dropdown('universidade2', $options_universidade, set_value('universidade2'), 'id="universidade2" required') ?>
                                    </div>
                                </li>
                                <li>
                                    <label>Câmpus</label>
                                    <div class="styled-select">
                                        <span class="carregando3" style="display: none;">Aguarde, carregando...</span>
                                        <?php echo form_dropdown('campus2', $options_campus1, set_value('campus2'), 'id="campus2" required') ?>
                                    </div>
                                </li>
                                <li>
                                    <label>Curso</label>
                                    <div class="styled-select">
                                        <span class="carregando4" style="display: none;">Aguarde, carregando...</span>
                                        <?php echo form_dropdown('curso2', $options_curso, set_value('curso2'), 'id="curso2" required') ?>
                                    </div>
                                </li>
                            </ol>
                        </fieldset>
                        <fieldset>
                            <legend>Opção 2</legend>
                            <ol>
                                <li>
                                    <label>Universidade</label>
                                    <div class="styled-select">
                                        <?php echo form_dropdown('universidade3', $options_universidade, set_value('universidade3'), 'id="universidade3" required') ?>
                                    </div>
                                </li>
                                <li>
                                    <label>Câmpus</label>
                                    <div class="styled-select">
                                        <span class="carregando5" style="display: none;">Aguarde, carregando...</span>
                                        <?php echo form_dropdown('campus3', $options_campus1, set_value('campus3'), 'id="campus3" required') ?>
                                    </div>
                                </li>
                                <li>
                                    <label>Curso</label>
                                    <div class="styled-select">
                                        <span class="carregando6" style="display: none;">Aguarde, carregando...</span>
                                        <?php echo form_dropdown('curso3', $options_curso, set_value('curso3'), 'id="curso3" required') ?>
                                    </div>
                                </li>
                            </ol>
                        </fieldset>
                    </fieldset>
                </li>
                <li>
                    <label>Período de estudos pretendido no exterior</label>
                    <?php echo form_input($periodo, '', 'required'); ?>
                </li>
                <li>
                    <fieldset>
                        <legend>Tipo de atividade</legend>
                        <ol>
                            <li>
                                <div>
                                    <label for="disciplinas">
                                        <?php if (!empty($tipo[0]) && $tipo[0] == '1') { echo form_checkbox($disciplinas, '', 'set_checkbox(\'tipo_atividade\', \'1\')'); } else { echo form_checkbox($disciplinas, '', FALSE); } ?>Disciplinas
                                    </label>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <label for="projetos">
                                        <?php if (!empty($tipo[1]) && $tipo[1] == '2') { echo form_checkbox($projetos, '', 'set_checkbox(\'tipo_atividade\', \'2\')'); } else { echo form_checkbox($projetos, '', FALSE); } ?>Projetos
                                    </label>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <label for="estagio">
                                        <?php if (!empty($tipo[2]) && $tipo[2] == '3') { echo form_checkbox($estagio, '', 'set_checkbox(\'tipo_atividade\', \'3\')'); } else { echo form_checkbox($estagio, '', FALSE); } ?>Estágio
                                    </label>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <label for="outros">
                                        <?php if (!empty($tipo[3]) && $tipo[3] == '4') { echo form_checkbox($outros, '', 'set_checkbox(\'tipo_atividade\', \'4\')'); } else { echo form_checkbox($outros, '', FALSE); } ?>Outros
                                    </label>
                                </div>
                            </li>
                        </ol>
                    </fieldset>
                </li>
                <li>
                    <label>Informações adicionais</label>
                    <?php echo form_textarea($informacoes); ?>
                    <br />Restam: 
                    <span id="left"></span> caracteres.
                </li>
            </ol>
        </fieldset>
        <fieldset>
            <legend>Conhecimentos Lingüísticos</legend>
            <ol>
                <li>
                    <label>Língua materna</label>
                    <div class="styled-select">
                        <?php echo form_dropdown('materna', $options_idioma, set_value('materna'), 'required') ?>
                    </div>
                </li>
                <li>
                    <fieldset>
                        <legend>Conhecimento de outras línguas</legend>
                        <ol id="lista">
                            <li>
                                <label>Idioma</label>
                                <div class="styled-select-lista">
                                    <?php echo form_dropdown('lingua_alternativa1', $options_idioma, set_value('lingua_alternativa1'), 'required') ?>
                                </div>
                                <ol>
                                    <li>
                                        <div>
                                            <?php if (!empty($fluencia_set_value) && $fluencia_set_value == '1') { echo form_radio($basico, '', 'set_radio(\'fluencia\', \'b\')'); } else { echo form_radio($basico, '', FALSE, 'required'); } ?>
                                            <label for="basico">Básico</label>
                                        </div>
                                    </li>
                                        
                                    <li>
                                        <div>
                                            <?php if (!empty($fluencia_set_value) && $fluencia_set_value == '2') { echo form_radio($intermediario, '', 'set_radio(\'fluencia\', \'i\')'); } else { echo form_radio($intermediario); } ?>
                                            <label for="intermediario">Intermediário</label>
                                        </div>
                                    </li>
                                    
                                    <li>
                                        <div>
                                            <?php if (!empty($fluencia_set_value) && $fluencia_set_value == '3') { echo form_radio($avancado, '', 'set_radio(\'fluencia\', \'a\')'); } else { echo form_radio($avancado); } ?>
                                            <label for="avancado">Avançado</label>
                                        </div>
                                    </li>
                                </ol>
                            </li>
                        </ol>
                    </fieldset>
                    <a href="#" id="mais">Adicionar outro idioma</a>
                </li>
            </ol>
        </fieldset>
        <fieldset>
            <legend>Financiamento</legend>
            <ol>
                <li>
                    <label>Como será financiado as despesas</label>
                    <div class="styled-select">
                        <?php echo form_dropdown('financiamento', $options_financiamento, '1', 'disabled'); ?>
                    </div> 
                </li>
            </ol>
        </fieldset>
        <fieldset>
            <legend>Carta de Motivação</legend>
            <ol>
                <li>
                    <label>Carta</label>
                    <?php echo form_textarea($carta, '', 'required'); ?>
                    <br />Restam: 
                    <span id="motivacao"></span> caracteres.
                </li>
            </ol>
        </fieldset>
        <fieldset>
            <legend>Atividades Extracurriculares</legend>
            <ol>
                <li>
                    <label>Atividade 1</label>
                    <?php echo form_textarea($iniciacao); ?>
                    <br />Restam: 
                    <span id="cientifica"></span> caracteres.
                </li>
                <li>
                    <label>Atividade 2</label>
                    <?php echo form_textarea($extensao); ?>
                    <br />Restam: 
                    <span id="cultural"></span> caracteres.
                </li>
            </ol>
        </fieldset>
                    
        <fieldset>
                <?php echo form_button(array('type' => 'submit', 'content' => 'Avançar')); ?>
        </fieldset>
        <?php echo form_hidden($hidden); ?>
        <input type="hidden" name="edital_id_edital" value="<?php echo $id_edital; ?>" id="edital_id_edital" />
        <?php
            echo form_close();
        ?>

    </body>
</html>
