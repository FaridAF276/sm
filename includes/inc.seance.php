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

    <h1>Bienvenue sur Sport Manager - Gestion des séances</h1>
    <form action="inc.seance.php" method = "POST", text-align: "center">
        <input type="char[50]" name="typeseance" placeholder = "Intitulé de la séance">
        <input type="text" name="descseance" placeholder = "Description de la séance">
        <input type="number" name="prixhoraire" placeholder = "Prix horaire de la séance">
        <input type= "submit" value = "Créer une nouvelle séance" class = "btn btn-primary">
        <span class="dropdown">
          <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Trier par :
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="#">Type de Seance</a>
            <a class="dropdown-item" href="#">Prix horaire</a>
            </div>
          </span>
    <?php
        //on prend les valeurs entrée dans les champs une fois que l'utilisateur a entré des valeurs dans TOUS les champs d'où le test "isset"
        if (isset ($_POST["typeseance"]) && isset ($_POST["descseance"]) && isset ($_POST["prixhoraire"]))
        {
            $nomseance = $_POST["typeseance"];
            $descseance = $_POST["descseance"];
            $prixhoraire = $_POST["prixhoraire"];
            $valeurclient =  array ($nomseance, $descseance, $prixhoraire);
            $sql ="INSERT INTO seance (typeSeance, DescSeance, prixHoraire) VALUES (?,?,?)";
            insert ($sql, $valeurclient, $base);
        }
        
    ?>
    </form>



    <table class="table table-bordered">
        <caption></caption>
        <thead>
        <th>ID Seance</th>
        <th>Intutilé de la séance</th>
        <th>Description de la séance</th>
        <th>Prix horarire</th>
        <th></th>
        <th></th>
        </thead>
        
        <tbody> 
                <?php $seance = gettable ('seance', $base);?> 
               <?php foreach ($seance as $tab) {?>
               <tr>
                <td> <?php echo $tab["idSeance"] ?> </td>
                <td> <?php echo $tab["typeSeance"] ?> </td>
                <td> <?php echo $tab["DescSeance"]?> </td>
                <td> <?php echo $tab["prixHoraire"]?> </td>
                <td><a href="#">Modifier</a></td>
                <td><a href="#">Supprimer</a></td>
              </tr> 
               <?php } ?>
        </tbody>
               

    </table>
</body>
</html>