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
    <title>Sport Manager : Séance</title>
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
    // C'est une navbar qui vient du fichier navbar.php dans le dossier includes?>

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
        <th>Intutilé de la séance</th>
        <th>Description de la séance</th>
        <th>Prix horarire</th>
        <th></th>
        </thead>
        <tbody> 
       <?php $seance = gettable ('seance', $base);?> 
               <?php foreach ($seance as $tab) {
                $id=$tab["idSeance"] ;
                $type=$tab["typeSeance"] ;
                $desc = $tab["DescSeance"];
                $prix=$tab["prixHoraire"];?>
            <tr id="<?php echo $id; ?>" class="edit_tr">
                <td class="edit_td">
                    <span id="type_<?php echo $id;?>" class="text"> <?php echo $type;?> </span>
                    <input type="text" value="<?php echo $type;?>" class="editbox form-control" id="type_input_<?php echo $id; ?>" />
                </td>


                <td class="edit_td">
                    <span id="desc_<?php echo $id; ?>" class="text"><?php echo $desc; ?></span>
                    <input type="text" value="<?php echo $desc; ?>" class="editbox form-control" id="desc_input_<?php echo $id; ?>"/>
                </td>

                <td class="edit_td">
                    <span id="prix_<?php echo $id; ?>" class="text"><?php echo $prix; ?></span> 
                    <input type="text" value="<?php echo $prix; ?>" class="editbox form-control" id="prix_input_<?php echo $id; ?>"/>
                </td>  

                <td>
                    <button id = "dlt_<?php echo $id;?>" type = "Button" class="btn btn-danger">Supprimer</button>
                </td>
            </tr> 
               <?php } ?>
        </tbody>
               

    </table>



    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script> 
        <script src="vendor/jquery/jquery.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function()
            {
                $(".editbox").hide(); //Dès qu'on ouvre on cache les editbox
                $(".edit_tr").click(function()
                {
                    var ID=$(this).attr('id');
                    $("#type_"+ID).hide();
                    $("#desc_"+ID).hide();
                    $("#prix_"+ID).hide();
                    $("#type_input_"+ID).show();
                    $("#desc_input_"+ID).show();
                    $("#prix_input_"+ID).show();
                }).change(function()
                {
                    var ID=$(this).attr('id');
                    var type=$("#type_input_"+ID).val();
                    var desc=$("#desc_input_"+ID).val();
                    var prix=$("#prix_input_"+ID).val();
                    var dataString = 'id='+ ID +'&type='+type+'&desc='+desc+'&prix='+prix;
                    $("#type_"+ID).html('<img src="load.gif" />'); // Loading image
                    
                    if(type.length>0 && desc.length>0 && prix.length>0)
                    {

                        $.ajax({
                            type: "POST", //on fait une requête http de type POST
                            url: "./config/seance/client.tabledit.php", //on passe des données vers le fichier table edit ajax
                            data: dataString, // la chaine de donnée qu'on passe
                            cache: false, //j'en sais rien 
                            success: function(html)
                            {
                                $("#type_"+ID).html(type); //on remplace par la valeur de nom etc par les nouvelles données
                                $("desc_"+ID).html(desc);
                                $("#prix_"+ID).html(prix);
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
                $(".edit_tr").mouseover(function (){
                    var id = $(this).attr('id'); //On récup l'id sur lequel on supprime une ligne
                    $("#dlt_"+id).click(function(){
                        //on accède au bouton et on ecoute l'événement click sur le bouton
                        if(confirm("Voulez-vous vraiment supprimer cette ligne ?")){
                            //si l'utilisateur confirme
                            $("#"+id).hide(); //Ici on cache la ligne qu'on a supprimé et par la suite on va la supprimer dans la base de donnée
                            var dataString2 = 'id='+ id +'&table=seance&attribute=idSeance';
                            //On va passer l'ID dans le fichier deleterow.php.
                            $.ajax({
                                type : "POST",
                                url : "./config/seance/deleterow.php",
                                data : dataString2,
                                cache : false
                            });
                        }
                    })
                })

            });
    </script>

</body>
</html>