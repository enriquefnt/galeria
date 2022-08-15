<?php
include __DIR__ . '/../include/conect.php';
include __DIR__ . '/../include/funciones.php';




$sql='call fotosActividad(133);';

$imagenesActividad = $pdo->query($sql);
$totalImagenes = $imagenesActividad->rowCount();



		include  __DIR__ . '/../templates/verImagenes4.html.php';


