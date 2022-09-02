<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 <style>
      table, th, td {
        border: 1px solid blue;
        border-collapse: collapse;
      }
</style>
  <title>tabla </title>
</head>
<body>


  <?php
foreach ($actividad_mes as $acti): 
          echo  $acti['areaoperativa'];
endforeach
  ?>
   </body>
   </html>   
 
        