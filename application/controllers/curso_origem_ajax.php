<?php

    header( 'Cache-Control: no-cache' );
    header( 'Content-type: application/xml; charset="utf-8"', true );

    $con = mysql_connect( 'localhost', 'root', 'oruam2310otsugua' ) ;
    mysql_select_db( 'sismobil', $con );

    $request = $_REQUEST['dados'];

    $curso = array();

    $sql = "SELECT id_curso AS 'id', descricao_curso AS 'descricao' FROM curso WHERE campus_id_campus = $request AND grau LIKE '%superior%' ORDER BY descricao";
    $res = mysql_query( $sql );
    while ( $row = mysql_fetch_assoc( $res ) ) {
        $curso[] = array(
            'id'            => $row['id'],
            'descricao'     => utf8_encode($row['descricao']),
        );
    }

    echo( json_encode( $curso ) );

?>
