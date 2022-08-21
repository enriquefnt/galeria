<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../estilos/estilo.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet">
    <title>galeria3</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="p-3 m-0 border-0 bd-example">

<div class="carousel-inner">

<?php

 
foreach ($imagenesActividad as $imagen):  ?>
 <div class="carousel-item active">
 <img src="<?= htmlspecialchars($imagen['archivo'], ENT_QUOTES, 'UTF-8'); ?>"  >
 </div>
<?php endforeach; ?>

</div>
</body>
</html>