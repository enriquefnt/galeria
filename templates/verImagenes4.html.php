<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet">
    <title>galeria3</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
  </head>
  <body class="p-3 m-0 border-0 bd-example">

    <!-- Example Code -->
    
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
      <div class="carousel-indicators">
       <?php
$num = 0;
 
foreach ($imagenesActividad as $imagen):  ?>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?= $num; ?>" 
<?php if ($num=0) {
 echo 'class="active"'; 
} ?>
       aria-current="true" aria-label="Slide <?= $num; ?>"></button> <?php $num ++ ; ?> 
<?php endforeach; ?>
      </div>
      <div>

 
      <div class="carousel-inner">
        <?php
$nume = 0;

foreach ($imagenesActividad as $imagen):  ?>
  
    <div class="carousel-item active">
      <img src="<?= htmlspecialchars($imagen['archivo'], ENT_QUOTES, 'UTF-8'); ?>" class="d-block w-100" >
    
    </div>
    
<?php endforeach; ?>
        </div>
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
    
    <!-- End Example Code -->
  </body>
</html>