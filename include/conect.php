<?php



try {



$pdo = new PDO('mysql:host=212.1.210.51;dbname=saltaped_actividades-promo;charset=utf8', 'saltaped_descu', 'descu12#');

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



}

catch(PDOException $e) {

$title = 'Ocurrio un error';

$output = 'No se pudo conectar al servidor: '

. $e->getMessage() . ' en '

. $e->getFile() . ':' . $e->getLine();



}



/*





try {



$pdo = new PDO('mysql:host=172.17.0.25;dbname=c0bdnutricion;charset=utf8', 'c0nutricion', 'uqwoNINT_3');

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



}

catch(PDOException $e) {

$title = 'Ocurrio un error';

$output = 'No se pudo conectar al servidor: '

. $e->getMessage() . ' en '

. $e->getFile() . ':' . $e->getLine();



}


*/


















?>







