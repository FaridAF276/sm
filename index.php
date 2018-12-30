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
        <input type="button" value="Ajouter" id = "addBtn" class ="btn btn-info">
        <br>
        <table id="tbClientEntry", class ="table">
            Préstation à effectuer : 
            <tr id = "seanceChamp1">  
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
        
        
    </form>
</div>

<!-- Script pour l'ajout automatique de ligne pour commande -->
<script type="text/javascript" >
    document.getElementById("addBtn").addEventListener("click", addrow);
    // document.getElementsByClassName("del_Btn").addEventListener("click", delrow);
    var i=0;
    function addrow()
    {
        var tb = document.getElementById("tbClientEntry");
        var tr = document.getElementById("seanceChamp1");
        var newtr= tb.insertRow();
        var idx = newtr.rowIndex;
        newtr.innerHTML= tr.innerHTML;
        i++;
        // newtr.id="select_"+idx;
        // console.log(newtr.id);
        newtr.children[newtr.children.length -1].children.item(0).id="del_button_"+i;
        // console.log(newtr.children[3].children.item(0).id)
        // console.log(newtr.children[2].children.item(0).id);
    }
    function delrow(trg){
        document.getElementById("tbClientEntry").deleteRow(trg.parentElement.parentElement.rowIndex);
    }
    
</script>
<!-- Bootstrap core JavaScript -->
<script src="includes/vendor/jquery/jquery.min.js"></script>
<script src="includes/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>

