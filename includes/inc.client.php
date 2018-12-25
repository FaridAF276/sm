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
    <!-- On met en place la table ainsi que les input on en cachera un et on montrera l'autre 
    en fonction des événemets -->
    <table class="table table-striped table-hover">
        <thead>
            <tr>
            <th>Nom</th>
            <th>Adresse mail</th>
            <th>N°Tel</th>
            <th>Code Postale</th>
            <th></th>
            </tr>
        </thead>
            <?php
            include('db.php');
            $sql=mysqli_query($db,"select * from client");
            while($row=mysqli_fetch_assoc($sql))
            {
            $id=$row['idClient'];
            $nom = $row['nom_Client'];
            $mail=$row['mail_client'];
            $tel=$row['numtel_client'];
            $cp=$row['CP'];
            ?>
            
            
            <tr id="<?php echo $id; ?>" class="edit_tr">
                
                <td class="edit_td">
                <span id="nom_<?php echo $id;?>" class="text"> <?php echo $nom;?> </span>
                <input type="text" value="<?php echo $nom; ?>" class="editbox" id="nom_input_<?php echo $id; ?>" />
                </td>


                <td class="edit_td">
                <span id="mail_<?php echo $id; ?>" class="text"><?php echo $mail; ?></span>
                <input type="text" value="<?php echo $mail; ?>" class="editbox" id="mail_input_<?php echo $id; ?>"/>
                </td>

                <td class="edit_td">
                <span id="tel_<?php echo $id; ?>" class="text"><?php echo $tel; ?></span> 
                <input type="text" value="<?php echo $tel; ?>" class="editbox" id="tel_input_<?php echo $id; ?>"/>
                </td>


                <td class="edit_td">
                <span id="cp_<?php echo $id; ?>" class="text"><?php echo $cp; ?></span>
                <input type="text" value="<?php echo $cp; ?>" class="editbox" id="cp_input_<?php echo $id; ?>" />
                </td>
                <!-- Delete button -->
                <td>
                    <button id = "dlt_<?php echo $id;?>" type = "Button" class="btn btn-danger">Supprimer</button>
                </td>

            </tr>
            <?php
            }
            ?>
    </table>

    <!-- On commence à éditer le script -->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script> 
        <script src="vendor/jquery/jquery.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function()
            {
            $(".edit_tr").click(function()
            {
            var ID=$(this).attr('id');
            $("#nom_"+ID).hide();
            $("#mail_"+ID).hide();
            $("#tel_"+ID).hide();
            $("#cp_"+ID).hide();
            $("#nom_input_"+ID).show();
            $("#mail_input_"+ID).show();
            $("#tel_input_"+ID).show();
            $("#cp_input_"+ID).show();
            }).change(function()
            {
            var ID=$(this).attr('id');
            var nom=$("#nom_input_"+ID).val();
            var mail=$("#mail_input_"+ID).val();
            var tel=$("#tel_input_"+ID).val();
            var cp=$("#cp_input_"+ID).val();
            var dataString = 'id='+ ID +'&nom='+nom+'&mail='+mail+'&tel='+tel+'&cp=' +cp;
            $("#nom_"+ID).html('<img src="load.gif" />'); // Loading image

            if(nom.length>0 && mail.length>0 && tel.length>0 && cp.length>0)
            {

            $.ajax({
            type: "POST", //on fait une requête http de type POST
            url: "./config/client.tabledit.php", //on passe des données vers le fichier table edit ajax
            data: dataString, // la chaine de donnée qu'on passe
            cache: false, //j'en sais rien 
            success: function(html)
            {
            $("#nom_"+ID).html(nom); //on remplace par la valeur de nom etc par les nouvelles données
            $("#mail_"+ID).html(mail);
            $("#tel_"+ID).html(tel);
            $("#cp_"+ID).html(cp);
            }
            });
            }
            else
            {
            alert('Enter something.');
            }

            });

            // Edit input box click action || Si on clique sur le tableau pendant qu'on modifie ça fait rien
            $(".editbox").mouseup(function() 
            {
            return false
            });

            // Outside click action|| Si on clique dehors on affiche le texte et on cache le form
            $(document).mouseup(function()
            {
            $(".editbox").hide();
            $(".text").show();
            });

            });
    </script>
</body>
</html>