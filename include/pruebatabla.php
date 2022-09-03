<?php
include __DIR__ . '/../include/conect.php';
include __DIR__ . '/../include/funciones.php';


$sql ="select distinct(DATE_FORMAT(inicio, '%Y-%m')) AS mes_año from act_actividad";
$an_meses = $pdo->query($sql, PDO::FETCH_COLUMN,0)->fetchAll();


$templateSQL = "SUM(
        CASE
          WHEN DATE_FORMAT(inicio, '%Y-%m') = |ENDPOINT|
           THEN numero_actividades
           ELSE 0
        END
    ) as suma_actividades_ma|ENDPOINT|";

 $anMesSQL = implode( ",".PHP_EOL, array_map( function( $endPoint ) use ( $templateSQL ) {
    
    return preg_replace( '/\|ENDPOINT\|/', $endPoint, $templateSQL ) ;
}, $an_meses ) );

$finalSQL = "SELECT DATE_FORMAT(inicio, '%Y-%m') as anio_mes,
    $anMesSQL
    FROM act_actividad
    GROUP BY DATE_FORMAT(inicio, '%Y-%m')
    ;";
    
//echo $finalSQL.PHP_EOL;

$sql ="$finalSQL";
?>

