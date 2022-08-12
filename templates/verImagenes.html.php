<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../estilos/estilo.css">
	<title>Imagenes
	</title>
</head>
<body>



<?php

 
foreach ($imagenesActividad as $imagen):  ?>
 <div >
 <img src="<?= htmlspecialchars($imagen['archivo'], ENT_QUOTES, 'UTF-8'); ?>"  >
 </div>
<?php endforeach; ?>


</body>
</html>