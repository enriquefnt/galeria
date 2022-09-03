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
<table>
<thead>
      <tr class="w3-grey">
        <th>Areas Operativas</th>
       <?php
foreach ($meses as $mes): ?> 
    <th><?= htmlspecialchars($mes[0], ENT_QUOTES, 'UTF-8'); ?></th> 
  <?php endforeach;?>
</tr>
<tbody>
    <tr class="w3-hover-pale-green">
 <?php
  foreach ($actividadesAreas as $area) :   ?> 

      <td><?= htmlspecialchars($area['areaoperativa'], ENT_QUOTES, 'UTF-8'); ?>  </td>


<?php endforeach;?>

</tr>

  </table>
   </body>
   </html>   
 
        