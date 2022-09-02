<?php  
include __DIR__ . '/../include/conect.php';
include __DIR__ . '/../include/funciones.php';


	
	$title = 'Tabla';
	$areas = findAll($pdo, 'act_aop' ,'areaoperativa');
try {

		


		$sql='call `saltaped_actividades-promo`.act_mes_aop(); ';			

		//$sql='call MSP_NUTRICION.nominal(8); ';	
		$actividad_mes = $pdo->query($sql);
		$cuenta = $actividad_mes->rowCount();
		

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