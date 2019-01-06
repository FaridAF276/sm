<?php
include_once 'dbh.php'; 
include_once 'dbtool.php' ;
include 'navbar.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sport Manager : Facture</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="32x32" href="http://localhost/sm/includes/favicon.png">
</head>
<body style = "text-align : center">
    <!--Navbar / Enregistré dans le ficier navbar.php-->
    <?php echo $navbar ;?>



    <h1>Bienvenue sur Sport Manager - Gestion des factures</h1>
    <form action="inc.fact.php" method = "POST">
        <table>
            <tr>
                <td> <span class="dropdown">
                <?php $Selectedtri=""; ?>
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Trier par : <?php echo $Selectedtri?>
                </button>
                
                <?php $senstri ="fact_id" ?>
                
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#" id="Ddown_numfact">Numéro de facture </a>
                <a class="dropdown-item" href="#" id="Ddown_dateasc">Date (ascendant) </a>
                <a class="dropdown-item" href="#"" id="Ddown_datedesc">Date (descendant) </a>
                <a class="dropdown-item" href="#" id="Ddownnumclient">Numéro de Client </a>
                </div>
                </span>
                </td>
            </tr>
        </table>


    </form>
    
    <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        
        <caption>Liste des factures : </caption>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
            
            <th scope="col">Numéro de facture</th>
            <th scope="col">Date de la facture</th>
            <th scope="col">Identifiant du client</th>

            </tr>
        </thead>
        <tbody> <?php $factures = gettable ('facture', $base, $senstri, "ASC");?> 
               <?php foreach ($factures as $tab) {?>
               
              <tr>
                <?php $id = $tab["fact_id"]?>
                
                <th scope="row"><?php echo $tab["num_fact"] ?></th>
                <td><?php echo $tab["date_fact"] ?></td>
                <td><?php echo $tab["idclient"]?></td>
              </tr> 
               <?php } ?>

        </tbody>
               

    </table>
</body>
</html>