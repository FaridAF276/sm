<?php
include_once("D:\Programmes\wamp64\www\sm\includes\db.php");
include_once("D:\Programmes\wamp64\www\sm\includes\dbh.php");
include_once("D:\Programmes\wamp64\www\sm\includes\dbtool.php");


$option = $_POST['option'];
if($option==1)
{       $numfact =$_POST['numfact'];
        $idClient = $_POST['id'];
        $datefact = date("Y-m-d");
        $valeurfact =  array ($numfact, $datefact, $idClient);
            
        $sql ="INSERT INTO facture (num_fact, date_fact, idclient) VALUES (?,?,?)";
        insert ($sql, $valeurfact, $base);
     
}
elseif ($option == 2) {
    $seance = $_POST['seance'];
    $hdeb = $_POST['hdeb'];
    $hfin = $_POST['hfin'];
    $datecmd = $_POST['datecmd'];
    $idClient = $_POST['id'];
    $numfact = $_POST['numfact'];
        // La seance on doit tj récupérer son id
        $sql2 = "SELECT * FROM seance WHERE typeSeance = '$seance';";
        $rep2= mysqli_query($db, $sql2);
        while($row=mysqli_fetch_assoc($rep2))
        {
            $idSeance = $row['idSeance'];
        }
    
    //On crée une nouvelle cmd dans la table commande.
    $param = array ($datecmd, $hdeb, $hfin, $idSeance , $numfact, $idClient);
    $sqlrq = "INSERT INTO commande (dateCmd, hdeb, hfin, idSeance, num_facture, idClient) VALUES (?,?,?,?,?,?);";
    insert($sqlrq,$param,$base);
}

?>