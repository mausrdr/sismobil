<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="pt-BR" class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <link rel="shortcut icon" href="<?php echo base_url(); ?>css/images/favicon.ico">
        <title><?php echo $titulo; ?></title>
        <script src="<?php echo base_url(); ?>js/modernizr-2.6.2.min.js"></script>
        <script src="<?php echo base_url(); ?>js/jquery1.4.4.js"></script>
        <script src="<?php echo base_url(); ?>js/font_size.js"></script>
        <script src="<?php echo base_url(); ?>js/styleswitcher.js"></script>
        <script>
            $(document).ready(function(){
                
                $("ul.subnav").parent().append("<span></span>"); //Somente mostra o trigger do drop down quando o js está habilitado (Adicionando uma tag span vazia depois de ul.subnav*)
                
                $("ul.topnav li span").click(function() { //Quando o trigger for clicado...
                    
                    //Os eventos a seguir são aplicados ao prórpio subnav(movendo o subnav para cima e para baixo)
                    $(this).parent().find("ul.subnav").slideDown('fast').show(); //Dá um drop down no subnav quando clicado
                    
                    $(this).parent().hover(function() {
                    }, function(){	
                        $(this).parent().find("ul.subnav").slideUp('slow'); //Quando o ponteiro do mouse sai de cima do subnav, ele se recolhe
                    });
                    
                    //Os eventos a seguir são aplicados ao trigger (Eventos hover pro trigger)
                }).hover(function() { 
                    $(this).addClass("subhover"); //Quando o ponteiro do mouse estiver em hover, adiciona a classe "subhover"
                }, function(){
                    $(this).removeClass("subhover"); //Quando o ponteiro do mouse não estiver em hover, remove a classe "subhover"
                });
            });
        
        </script>
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/estilo_assessoria_recebe.css" type="text/css" title="padrao" />
        <link href="<?php echo base_url(); ?>css/estilo_contraste.css" rel="alternate stylesheet" type="text/css" title="contraste"  />

    </head>
    <body>

        <div class="container">
            <div id="maincontent">
                <div id="header">
                    <div id="barra-brasil">
                        <div class="barra">
                            <ul>
                                <li><a href="http://www.acessoainformacao.gov.br/acessoainformacaogov/" class="ai" title="Acesso à informação" target="_blank">www.acessoainformacao.gov.br</a></li>
                                <li><a href="http://www.brasil.gov.br" class="brasilgov" title="Portal de Estado do Brasil" target="_blank">www.brasil.gov.br</a></li>
                            </ul>
                        </div>
                    </div>
                    <div id="banner_instituto">
                        <div id="acessibilidade"><img src="<?php echo base_url(); ?>css/images/acessibilidade2.jpg" alt="Acessibilidade" border="0" usemap="#Map" />
                            <map name="Map" id="Map">
                                <area shape="rect" coords="5,6,28,23" href="javascript:mudaTamanho('maincontent', 1)" alt="botao para aumentar a letra" title="Aumetar Fonte" />
                                <area shape="rect" coords="34,6,58,24" href="javascript:mudaTamanho('maincontent', -1);" alt="botao para diminuir a letra" title="Diminuir Fonte" />
                                <area shape="rect" coords="63,6,87,24" href="#" onclick="setActiveStyleSheet('contraste'); return false;" alt="botao para mudar contraste" title="Aumentar Contraste" />
                                <area shape="rect" coords="93,7,116,24" href="#" onclick="setActiveStyleSheet('padrao'); return false;" alt="botao para mudar contraste" title="Contraste Normal" />
                            </map>
                        </div> <!-- fim da DIV 'acessibilidade' -->
                    </div> <!-- fim da DIV 'banner_instituto' -->
                    <ul class="topnav">
                        <li><a href="<?php echo base_url(); ?>index.php/assessoria_inicio_controller">Início</a></li>
                        <li>
                            <a href="#">Editais</a>
                            <ul class="subnav">
                                <li><a href="<?php echo base_url(); ?>index.php/assessoria_cadastra_edital_controller">Cadastrar</a></li>
                                <li><a href="<?php echo base_url(); ?>index.php/assessoria_edita_edital_controller">Editar</a></li>
                                <li><a href="<?php echo base_url(); ?>index.php/assessoria_deleta_edital_controller">Remover</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">Universidades</a>
                            <ul class="subnav">
                                <li><a href="<?php echo base_url(); ?>index.php/assessoria_cadastra_universidade_controller">Cadastrar</a></li>
                                <li><a href="<?php echo base_url(); ?>index.php/assessoria_edita_universidade_controller">Editar</a></li>
                                <li><a href="<?php echo base_url(); ?>index.php/assessoria_deleta_universidade_controller">Remover</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">Campus</a>
                            <ul class="subnav">
                                <li><a href="<?php echo base_url(); ?>index.php/assessoria_cadastra_campus_controller">Cadastrar</a></li>
                                <li><a href="<?php echo base_url(); ?>index.php/assessoria_edita_campus_controller">Editar</a></li>
                                <li><a href="<?php echo base_url(); ?>index.php/assessoria_deleta_campus_controller">Remover</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">Cursos</a>
                            <ul class="subnav">
                                <li><a href="<?php echo base_url(); ?>index.php/assessoria_cadastra_curso_controller">Cadastrar</a></li>
                                <li><a href="<?php echo base_url(); ?>index.php/assessoria_edita_curso_controller">Editar</a></li>
                                <li><a href="<?php echo base_url(); ?>index.php/assessoria_deleta_curso_controller">Remover</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">Matriz</a>
                            <ul class="subnav">
                                <li><a href="<?php echo base_url(); ?>index.php/assessoria_cadastra_matriz_vagas_controller">Cadastrar Matriz de Vagas</a></li>
                                <li><a href="<?php echo base_url(); ?>index.php/assessoria_cadastra_matriz_curso_controller">Cadastrar Matriz dos Cursos Ofertados</a></li>
                                <li><a href="<?php echo base_url(); ?>index.php/assessoria_edita_matriz_vagas_controller">Editar Matriz de Vagas</a></li>
                                <li><a href="<?php echo base_url(); ?>index.php/assessoria_edita_matriz_curso_controller">Editar Matriz dos Cursos Ofertados</a></li>
                                <li><a href="<?php echo base_url(); ?>index.php/assessoria_deleta_matriz_vagas_controller">Remover Matriz de Vagas</a></li>
                                <li><a href="<?php echo base_url(); ?>index.php/assessoria_deleta_matriz_curso_controller">Remover Matriz dos Cursos Ofertados</a></li>
                                <li><a href="<?php echo base_url(); ?>index.php/assessoria_listar_matriz_controller">Listar Matriz do Edital</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">Mobilidade Estudantil</a>
                            <ul class="subnav">
                                <li><a href="<?php echo base_url(); ?>index.php/assessoria_recebe_candidatura_controller">Receber Candidatura</a></li>
                                <li><a href="<?php echo base_url(); ?>index.php/assessoria_classifica_candidatura_controller">Listar Classificação</a></li>
                                <li><a href="#">Selecionar o Curso</a></li>
                                <li><a href="#">Editar Seleção</a></li>
                            </ul>
                        </li>
                        <li><a href="<?php echo base_url(); ?>index.php/assessoria_inicio_controller/logoutSessao">Sair</a></li>
                    </ul>
                </div>

            <!--[if lt IE 7]>
                <p class="chromeframe">Você está usando um navegador <strong>desatualizado</strong>. Por favor <a href="http://browsehappy.com/">atualize seu navegador</a> ou <a href="http://www.google.com/chromeframe/?redirect=true">ative o Google Chrome Frame</a> para melhorar sua navegação.</p>
            <![endif]-->
            <br /><br /><br />