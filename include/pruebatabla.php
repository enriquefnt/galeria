<?php
include __DIR__ . '/../include/conect.php';
include __DIR__ . '/../include/funciones.php';





?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table, th, td {
            border: 1px solid black;
        }
    </style>
</head>
<body>
    <table style="width:100%;">
        <thead>
        <tr>
            <th>AOP</th>
            <th>Actividades</th>
          
            </tr>
        </thead>
        <tbody>
        <?php
        
        $sql = "call `saltaped_actividades-promo`.act_mes_aop(); ";
        $result = $pdo->prepare($sql);
        $result->execute();

        if($result->rowCount() > 0):
            $rows = $result->fetchAll();
            foreach($rows as $row):
        ?>
        <tr>
            <td><?php echo $row['areaoperativa'];  ?></td>
            <td><?php echo $row['n_actividades']; ?></td>
           
        </tr>
        </tbody>

        <?php
        endforeach;
    endif;
        ?>
    </table>
</body>
</html>