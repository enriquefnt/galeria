<?php
include __DIR__ . '/../include/conect.php';
include __DIR__ . '/../include/funciones.php';



$in_sql ="select distinct(DATE_FORMAT(inicio, '%Y_%m')) AS mes_año from act_actividad";
$an_meses = $pdo->query($in_sql, PDO::FETCH_COLUMN,0)->fetchAll();


$pdo->query("DROP TABLE IF EXISTS temp1; CREATE  TABLE temp1 select distinct(aop) ,areaoperativa, count(concat(year(inicio),'-', month(inicio))) as n_actividades ,date_format(inicio, '%Y_%m') AS mes_año from act_actividad inner join act_aop on aop=idaop group by mes_año,aop, areaoperativa order by inicio ;");


$templateSQL = "SUM(
        CASE
          WHEN mes_año = '|ENDPOINT|'
           THEN n_actividades
           ELSE 0
        END
    ) '|ENDPOINT|'";

 $anMesSQL = implode( ",", array_map( function( $endPoint ) use ( $templateSQL ) {
    
    return preg_replace( '/\|ENDPOINT\|/', $endPoint, $templateSQL ) ;
}, $an_meses ) );

    


$finalSQL = "
            SELECT areaoperativa,$anMesSQL   
                FROM temp1
                GROUP BY areaoperativa
                ;";

$actividadesAreas = $pdo->query($finalSQL);

foreach ($actividadesAreas as $area) :
    
      echo $area[0].' '.PHP_EOL . $area[1].' '.$area[2].' '.$area[3];
    
 endforeach;
echo $finalSQL;

?>