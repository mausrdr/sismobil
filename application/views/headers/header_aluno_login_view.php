<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="pt-BR" class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?php echo $titulo; ?></title>
        <script src="<?php echo base_url(); ?>js/vendor/modernizr-2.6.2.min.js"></script>
        <script src="<?php echo base_url(); ?>js/jquery1.4.4.js"></script>
        <script src="<?php echo base_url(); ?>js/font_size.js"></script>
        <script src="<?php echo base_url(); ?>js/styleswitcher.js"></script>
        <link href="<?php echo base_url(); ?>css/estilo_aluno_login.css" rel="stylesheet" title="padrao" />
        <link href="<?php echo base_url(); ?>css/estilo_contraste.css" rel="alternate stylesheet" title="contraste"  />
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
                </div>

                <!--[if lt IE 7]>
                    <p class="chromeframe">Você está usando um navegador <strong>desatualizado</strong>. Por favor <a href="http://browsehappy.com/">atualize seu navegador</a> ou <a href="http://www.google.com/chromeframe/?redirect=true">ative o Google Chrome Frame</a> para melhorar sua navegação.</p>
                <![endif]-->
                <br /><br /><br />