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
    <?php
        echo $navbar;
    ?>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <h1>Bienvenue sur Sport Manager - Gestion de Client</h1>
    <form action="inc.client.php" method = "POST", text-align : "center">
        <input class= "form-control-sm" type="char[50]" name="nomclient" placeholder = "Nom du client">
        <input class= "form-control-sm" type="char[50]" name="mailclient" placeholder = "Adresse e-mail du client">
        <input class= "form-control-sm" type="number" name="numtelclient" placeholder = "Numéro de téléphone du client">
        <input class= "form-control-sm" type="number" name="cpclient" placeholder = "Code postal du client">
        <input type= "submit" value = "Créer un nouveau client" class= "btn btn-primary">


        <span class="dropdown">
          <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Trier par :
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="#">Nom de client</a>
            <a class="dropdown-item" href="#">Adresse mail</a>
            <a class="dropdown-item" href="#">Code Postal</a>
          </div>
        </span>
    <?php
        if (isset ($_POST["nomclient"]) && isset ($_POST["mailclient"]) && isset ($_POST["numtelclient"]) && isset ($_POST["cpclient"]))
        {
            $nomclient = $_POST["nomclient"];
            $mailclient = $_POST["mailclient"];
            $numtelclient = $_POST["numtelclient"];
            $cpclient = $_POST["cpclient"];
            $valeurclient =  array ($nomclient, $mailclient, $numtelclient, $cpclient);
            $sql ="INSERT INTO client (nom_Client, mail_client, numtel_client, CP) VALUES (?,?,?,?)";
            insert ($sql, $valeurclient, $base);
        }
        
    ?>
    </form>


    <table class="table">
        <thead>
            <tr>
            <th scope ='col'>ID Client</th>
            <th scope ='col'>Nom du client</th>
            <th scope ='col'>Adresse mail</th>
            <th scope ='col'>Numéro de téléphone du client</th>
            <th scope ='col'>Code postal</th>
            <th scope = 'col'></th>
            <th scope = 'col'></th>

            </tr>
        </thead>
        <tbody> 
                <?php $client = gettable ('client', $base);?> 
               <?php foreach ($client as $tab) {?>
               
                 <tr>
                <th scope="row"><?php echo $tab["idClient"] ?> </th>
                <td><?php echo $tab["nom_Client"] ?></td>
                <td><?php echo $tab["mail_client"]?></td>
                <td> <?php echo $tab["numtel_client"]?> </td>
                <td> <?php echo $tab["CP"]?> </td>
                <td><button type ="button"> Modifier </button></td>
                <td><a href="http://localhost/sm/includes/dbtool.php/supp('facture','num_facture',$base)"> Supprimer</a></td>
              </tr> 
               <?php } ?>

        </tbody>
               

    </table>

</body>
</html>