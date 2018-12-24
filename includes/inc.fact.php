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
    <form action="inc.fact.php" method = "POST", text-align : "center">
        <input class= "form-control-sm" type="number" name="numfact" placeholder = "Numéro de facture">
        <input class= "form-control-sm" type="date" name="datefact" placeholder = "Date facture">
        <input class= "form-control-sm" type="number" name="numclient" placeholder = "Numéro TVA du Client">
        <input  type= "submit" value = "Créer une nouvelle facture" class = "btn btn-primary">

        <span class="dropdown">
          <?php $Selectedtri=""; ?>
          <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Trier par : <?php echo $Selectedtri?>
          </button>
          <?php $senstri ="fact_id" ?>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="#" id="Ddown_numfact">Numéro de facture </a>
            <a class="dropdown-item" href="#" id="Ddown_dateasc">Date (ascendant) </a>
            <a class="dropdown-item" href="#"" id="Ddown_datedesc"">Date (descendant) </a>
            <a class="dropdown-item" href="#" id="Ddownnumclient">Numéro de Client </a>
            </div>
          </span>
    <?php
        //Si la variable $_POST['truc'] existe, alors $truc = $_POST['truc']  sinon elle vaut NULL 
        $numfact = isset($_POST["numfact"]) ? $_POST["numfact"] : NULL;
        $datefact = isset($_POST["datefact"]) ? $_POST["datefact"] : NULL;
        $numclient = isset($_POST["numclient"]) ? $_POST["numclient"] : NULL;
        $valeurfact =  array ($numfact, $datefact, $numclient);
        
        $sql ="INSERT INTO facture (num_fact, date_fact, idclient) VALUES (?,?,?)";
        insert ($sql, $valeurfact, $base);
    ?>
    </form>
    <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        
        <caption>Liste des factures : </caption>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
            <th scope="col">Numéro de facture</th>
            <th scope="col">Date de la facture</th>
            <th scope="col">Numéro de TVA Client</th>
            <th scope="col"></th>
            <th scope="col"></th>

            </tr>
        </thead>
        <tbody> <?php $factures = gettable ('facture', $base, $senstri, "ASC");?> 
               <?php foreach ($factures as $tab) {?>
               
              <tr>
                <?php $id = $tab["fact_id"]?>
                
                <th scope="row"><?php echo $tab["num_fact"] ?></th>
                <td><?php echo $tab["date_fact"] ?></td>
                <td><?php echo $tab["idclient"]?></td>
                <td><button type ="button"> Modifier </button></td>
                <td> <button type = "button" onclick='delphp'> Supprimer</button></td>
              </tr> 
               <?php } ?>

        </tbody>
               

    </table>
</body>
</html>