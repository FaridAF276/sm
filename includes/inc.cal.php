<?php include 'navbar.php';
    include_once "dbtool.php";
    include_once "dbh.php";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sport Manager : Calendrier</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="32x32" href="http://localhost/sm/includes/favicon.png">
</head>
<body>
    <?php echo $navbar;?>
    <!-- <h1 class = "text-center">Bienvenue... Cette page est en construction...</h1> -->
    <?php
    $todaydate = date("Y-m-d");
    // echo $todaydate;
    $sql = "SELECT * FROM commande WHERE dateCmd > '$todaydate'";
    ?>

    <table class = "table table-hover">
        <thead>
            <tr>
                <th>Date du rendez-vous</th>
                <th>Heure de début</th>
                <th>Heure de fin</th>
                <th>Séance concerncée</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $prest = customgettable ($sql, $base);
            foreach ($prest as $tab)
            {?>
            <tr class = "table-info">
                <td><?php echo $tab['dateCmd'] ?></td>
                <td><?php echo $tab['hdeb'] ?></td>
                <td><?php echo $tab['hfin'] ?></td>
                <td><?php echo $tab['idSeance'] ?></td>
            </tr>  
            <?php } ?>
            
        </tbody>
        
    </table>
</body>
</html>