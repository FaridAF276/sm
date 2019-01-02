<?php
/**
 * Created by PhpStorm.
 * User: farid
 * Date: 15-12-18
 * Time: 21:51
 */?>
<!DOCTYPE html>
<html lang="fr">
<?php include './includes/navbar.php';
include_once('./includes/db.php');?>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="32x32" href="http://localhost/sm/includes/favicon.png">
    <title>Sport Manager</title>

    <!-- Bootstrap core CSS -->
    <link href="includes/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

</head>

<body background = "http://localhost/sm/pics/Bg_workouthd.jpg">
<?php $test = "Hello"?>
<!-- Navigation -->
<?php
echo $navbar;
?>
<br>
<br>


<!-- Page Content -->
<!--TODO : Editer ce champ pour que quand le client reçoit un appel ça envoit toutes les requêtes correctement et que il n'aie qu'à faire ça-->
<div class = "jumbotron">
    <h1>Réception d'une demande client</h1>
    <form>
        Client :
        <!-- Liste des clients -->
        <select name="Client" id="select_client" class ="form-control">
            <!-- On va chercher les client dans la base de donnée -->
            <option selected = ""> Selectionnez un client</option>
            <?php
                include('./includes/db.php');
                $sql=mysqli_query($db,"select * from client");
                while($row=mysqli_fetch_assoc($sql))
                {
                $nom = $row['nom_Client'];
                $id = $row['idClient'];
            ?>
                
                <script type ="text/javascript">
                    var menuDeroulant = document.getElementById("select_client");
                    var element = document.createElement("option"); //On crée un élément de la liste
                    element.innerHTML = "<?php echo $nom;?>";
                    element.id= "<?php echo $id?>";
                    menuDeroulant.appendChild(element);
                </script>
                <?php } ?>

        </select>
        <hr>
        <input type="button" value="Ajouter" id = "addBtn" class ="btn btn-info">
        <br>
        <table id="tbClientEntry", class ="table">
            Préstation à effectuer : 
            <tr id = "seanceChamp">  
                <td>
                    <select name="Client" id="select_clientseance", class="form-control">
                        <!-- On va chercher les client dans la base de donnée -->
                        <option selected = "", id="select_0"> Selectionnez une séance</option>
                        <?php
                        include('./includes/db.php');
                        $sql=mysqli_query($db,"select * from seance");
                        while($row=mysqli_fetch_assoc($sql))
                        {
                            $nom = $row['typeSeance'];
                            ?>
                            
                            <script type ="text/javascript">
                            var menuDeroulant = document.getElementById("select_clientseance");
                            var element = document.createElement("option"); //On crée un élément de la liste
                            element.innerHTML = "<?php echo $nom;?>";
                            menuDeroulant.appendChild(element);
                            </script>
                            <?php } ?>
                            
                    </select>

                </td>
                <td><input type="time" name="hdeb" id="hdeb", class = "form-control"></td>
                <td><input type="time" name="hfin" id="hfin", class = "form-control"></td>
                <td><input type="date" name="datecmd" id="datecmd1", placeholder = "Date" , class = "form-control"></td>
                <td><button onclick="delrow(this)", id = del_button , class = "btn btn-danger">Supprimer</button></td>
            </tr>
                
        </table>
        
        <!-- <button onclick="valid()" id="valbtn", class = "btn btn-info">Valider</button> -->
        <input type="button" value="Valider", id="valbtn", class = "btn btn-info">
    </form>
</div>

<footer>
<script type ="text/javascript" src="includes/vendor/jquery/jquery.min.js"> </script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script> 
    <!-- Script pour l'ajout automatique de ligne pour commande et gestion d'information-->
    <script src="frontpageform.js"></script>

    <!-- Bootstrap core JavaScript -->
    <script src="includes/vendor/jquery/jquery.min.js"></script>
    <script src="includes/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</footer>


</body>

</html>

