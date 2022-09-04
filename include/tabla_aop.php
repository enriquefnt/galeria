<?php  
include __DIR__ . '/../include/conect.php';


	
setlocale(LC_ALL,"es_ES");
	$title = 'Tabla';
	
try {


$pdo->query("DROP TABLE IF EXISTS temp1; SET lc_time_names = 'es_ES';CREATE  TABLE temp1 select distinct(aop) ,areaoperativa, count(concat(year(inicio),'-', month(inicio))) as n_actividades ,date_format(inicio, '%y_%M') AS mes_año from act_actividad inner join act_aop on aop=idaop group by mes_año,aop, areaoperativa order by inicio ;");


$sql="SELECT areaoperativa,mes_año,n_actividades from temp1" ;

$resultObject=$pdo->query($sql);


$grouped = [];
$columns = [];

//ob_start();

	include __DIR__ . '/../templates/tabla_aop.html.php';

//$output = ob_get_clean() ;

}	

catch (PDOException $e) {
      $error = 'Error en la base:' . $e->getMessage() . ' en la linea ' .
      $e->getFile() . ':' . $e->getLine();
    }
   

//include  __DIR__ . '/../templates/layout.html.php';
?>