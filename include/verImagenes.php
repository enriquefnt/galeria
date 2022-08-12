<?php
include __DIR__ . '/../include/conect.php';
include __DIR__ . '/../include/funciones.php';




$sql='call fotosActividad(152);';

$imagenesActividad = $pdo->query($sql);
$totalImagenes = $imagenesActividad->rowCount();



		include  __DIR__ . '/../templates/verImagenes1.html.php';


