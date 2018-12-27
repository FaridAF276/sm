<?php
/**
 * Created by PhpStorm.
 * User: farid
 * Date: 15-12-18
 * Time: 21:51
 */?>
include_once($db.php)
<!DOCTYPE html>
<html lang="fr">
<?php include './includes/navbar.php';?>
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

<!-- Navigation -->
<?php
echo $navbar;
?>

<!-- Page Content -->
<!--TODO : Editer ce champ pour que quand le client reçoit un appel ça envoit toutes les requêtes correctement et que il n'aie qu'à faire ça-->
<div class = "container">
    <form>
    Client :
    <!-- Liste des clients -->
    <select name="Client" id="select_client">
        <!-- On va chercher les client dans la base de donnée -->
        <option selected = ""> Selectionnez un client</option>
        <?php
            include('./includes/db.php');
            $sql=mysqli_query($db,"select * from client");
            while($row=mysqli_fetch_assoc($sql))
            {
            $nom = $row['nom_Client'];
            ?>
            
            <script type ="text/javascript">
                var menuDeroulant = document.getElementById("select_client");
                var element = document.createElement("option"); //On crée un élément de la liste
                element.innerHTML = "<?php echo $nom;?>";
                menuDeroulant.appendChild(element);
            </script>
            <?php } ?>

    </select>
    <hr>
    <table id="tbClientEntry">
    
        Commande : 
        <tr id = "seanceChamp1">   
            <td>
                <select name="Client" id="select_clientseance">
                    <!-- On va chercher les client dans la base de donnée -->
                    <option selected = ""> Selectionnez une séance</option>
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
            </tr>
            
        </table>
        <input type="button" value="Ajouter" id = "addBtn">
    </form>
</div>

<!-- Script pour l'ajout automatique de ligne pour commande -->
<script type="text/javascript">
    document.getElementById("addBtn").addEventListener("click", addrow);

    function addrow()
    {
        var tb = document.getElementById("tbClientEntry");
        var tr = document.getElementById("seanceChamp1");
        var newtr= tb.insertRow();
        newtr.innerHTML= tr.innerHTML;
        document

        // var data = tb.innerHTML;
        // tb.appendChild(data);
    }
</script>

<!-- Bootstrap core JavaScript -->
<script src="includes/vendor/jquery/jquery.min.js"></script>
<script src="includes/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>

