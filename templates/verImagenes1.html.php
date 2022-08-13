<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../estilos/estilo.css">


<!-- bootstrap -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css"/>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>


	<title>Imagenes
	</title>
</head>
<body>
	<div>
		<h4>Galeria
  <h5>    <?= htmlspecialchars($totalImagenes, ENT_QUOTES, 'UTF-8'); ?> </h5>
</h4>
    </div>



<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <?php

$num = 0;
 
foreach ($imagenesActividad as $imagen):  ?>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?= $num; ?>" class="active" aria-current="true" aria-label="Slide <?= $num; ?>"></button> <?php $num ++ ; ?>
    
<?php endforeach; ?>


  </div>
  <div class="carousel-inner">
    <?php
foreach ($imagenesActividad as $imagen):  ?>
  
    <div class="carousel-item active">
      <img src="<?= htmlspecialchars($imagen['archivo'], ENT_QUOTES, 'UTF-8'); ?>" class="d-block w-100" alt="...">
    </div>
    
<?php endforeach; ?>
  </div>
  




  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

</body>
</html>