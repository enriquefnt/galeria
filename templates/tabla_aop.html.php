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
foreach ($resultObject as $row) {
    $grouped[$row['areaoperativa']][$row['mes_año']] = $row['n_actividades'];
    $columns[$row['mes_año']] = $row['mes_año'];
}

sort($columns);
$defaults = array_fill_keys($columns, ' ');
array_unshift($columns, 'Area Operativa');
echo "<style>
      table, th, td {
        border: 1px solid blue;
        border-collapse: collapse;
      }
</style>";
echo "<table>\n";
    printf(
        "<tr><th>%s</th></tr>\n",
        implode('</th><th>', $columns)
    );
    foreach ($grouped as $name => $records) {
        printf(
            "<tr><td>%s</td><td>%s</td></tr>",
            $name,
            implode('</td><td>', array_replace($defaults, $records))
        );
    }
echo "</table>";

  ?>
</body>
</html>