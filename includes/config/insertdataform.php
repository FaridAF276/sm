<?php
include_once("D:\Programmes\wamp64\www\sm\includes\db.php");
include_once("D:\Programmes\wamp64\www\sm\includes\dbh.php");
include_once("D:\Programmes\wamp64\www\sm\includes\dbtool.php");
$client =$_POST['client'];
$numfact =$_POST['numfact'];
$option = $_POST['option'];
$idClient=null;
if($option)
{
    //get client id
        $cli = gettable('client', $base);
        foreach ($cli as $tab)
        {
            $idClient = $tab['idClient'];
        }
        echo $idClient;
        $datefact = date("Y-m-d");
        $valeurfact =  array ($numfact, $datefact, $idClient);
            
        $sql ="INSERT INTO facture (num_fact, date_fact, idclient) VALUES (?,?,?)";
        insert ($sql, $valeurfact, $base);
    if ($option == 2) {
        $seance = $_POST['seance'];
        $hdeb = $_POST['hdeb'];
        $hfin = $_POST['hfin'];
        $datecmd = $_POST['datecmd'];
        $client = $_POST['client'];
        $numfact = $_POST['numfact'];
        // $id=null;
        // $idSeance = null;
            $sql = "SELECT * FROM client WHERE nom_Client = '$client';";
            $rep= mysqli_query($db, $sql);
            while($row=mysqli_fetch_assoc($rep))
            {
                $id = $row['idClient'];
            }
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
}

?>