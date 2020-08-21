<?php

    header( 'Cache-Control: no-cache' );
    header( 'Content-type: application/xml; charset="utf-8"', true );

    $con = mysql_connect( 'localhost', 'root', 'oruam2310' ) ;
    mysql_select_db( 'sismobil', $con );

    $dados = $_REQUEST['edital_id_edital'];

    $universidade = array();

    $sql = "SELECT DISTINCT u.id_universidade AS 'id', u.descricao_universidade AS 'descricao' 
                FROM sismobil.universidade u, sismobil.vagas_campus v 
                WHERE v.edital_id_edital = $dados AND u.id_universidade = v.universidade_id_universidade";
    $res = mysql_query( $sql );
    while ( $row = mysql_fetch_assoc( $res ) ) {
        $universidade[] = array(
            'id'            => $row['id'],
            'descricao'     => utf8_encode($row['descricao']),
        );
    }

    echo( json_encode( $universidade ) );

?>
