<?php

include __DIR__ . '/../include/conect.php';

$pdo->query("DROP TABLE IF EXISTS temp1; CREATE  TABLE temp1 select distinct(aop) ,areaoperativa, count(concat(year(inicio),'-', month(inicio))) as n_actividades ,date_format(inicio, '%Y_%m_%M') AS mes_año from act_actividad inner join act_aop on aop=idaop group by mes_año,aop, areaoperativa  ;");


$sql="SELECT areaoperativa,mes_año,n_actividades from temp1" ;

$resultObject=$pdo->query($sql);


$grouped = [];
$columns = [];

foreach ($resultObject as $row) {
    $grouped[$row['areaoperativa']][$row['mes_año']] = $row['n_actividades'];
    $columns[$row['mes_año']] = $row['mes_año'];
}

sort($columns);
$defaults = array_fill_keys($columns, ' ');
array_unshift($columns, 'Area Operativa');

echo "<table>\n";
    printf(
        "<tr><th>%s</th></tr>\n",
        implode('</th><th>', $columns)
    );
    foreach ($grouped as $name => $records) {
        printf(
            "<tr><td>%s</td><td>%s</td></tr>",
            $name,
            implode('</td><td>', array_replace($defaults, $records))
        );
    }
echo "</table>";
print_r($defaults);
print_r($grouped);
print_r($columns);