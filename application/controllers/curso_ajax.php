<?php

    header( 'Cache-Control: no-cache' );
    header( 'Content-type: application/xml; charset="utf-8"', true );

    $con = mysql_connect( 'localhost', 'root', 'oruam2310' ) ;
    mysql_select_db( 'sismobil', $con );

    $request = $_REQUEST['dados'];

    $dados = explode(',', $request);

    $campus = array();

    $sql = "SELECT DISTINCT c.id_curso_universidade AS 'id', c.descricao_curso AS 'descricao' 
                FROM curso_universidade c, edital_has_curso e 
                WHERE e.edital_id_edital = $dados[0] 
                    AND e.universidade_id_universidade = $dados[1] 
                    AND e.campus_universidade_id_campus_universidade = $dados[2] 
                    AND c.id_curso_universidade = e.curso_universidade_id_curso_universidade";
    $res = mysql_query( $sql );
    while ( $row = mysql_fetch_assoc( $res ) ) {
        $campus[] = array(
            'id'            => $row['id'],
            'descricao'     => utf8_encode($row['descricao']),
        );
    }

    echo( json_encode( $campus ) );

?>
