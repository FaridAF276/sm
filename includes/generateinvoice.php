<?php
include_once("D:\Programmes\wamp64\www\sm\includes\dbtool.php");
include_once ("D:\Programmes\wamp64\www\sm\includes\dbh.php");
require ("fpdf181/fpdf.php");
/*
On a besoin des infos clients : toutes
info facture : toute
liste des commandes : toute


*/
//requête pour prendre l'adresse
// $id =38;
$id = $_GET['id'];
// $numfact = 2019010519;
$numfact =$_GET['numfact'];
$sql= "SELECT * FROM (((client INNER JOIN lieu on client.idClient = lieu.idClient) INNER JOIN situation on lieu.CP = situation.CP)INNER JOIN adresse ON situation.rue = adresse.rue) WHERE client.idClient = 38 ";

//On va prendre toutes les infos du client

$cli = customgettable ($sql, $base);
foreach ($cli as $tab)
{
    $nom = $tab['nom_Client'];
    $rue = $tab['rue'];
    $numero = $tab['numero'];
    $CP = $tab['CP'];
    $numtva = $tab['numtvaclient'];
}
//On récupère les infos sur la facture

$sql = "SELECT * FROM facture WHERE num_fact = '$numfact'";
$fact = customgettable($sql, $base);
foreach ($fact as $table) {
    $datefact = $table['date_fact'];
}

$pdf = new FPDF('P','mm','A4');
//add new page
$pdf->AddPage();
//output the result

$pdf->SetFont('Arial','B',14);

//Cell(width , height , text , border , end line , [align] )

$pdf->Cell(130 ,5,'Prestataire',0,0);
$pdf->Cell(59 ,5,'Facture',0,1);//end of line

//set font to arial, regular, 12pt
$pdf->SetFont('Arial','',12);

$pdf->Cell(130 ,5,'Rue Lison 276',0,0);
$pdf->Cell(59 ,5,'',0,1);//end of line

$pdf->Cell(130 ,5,'6060 Gilly',0,0);
$pdf->Cell(25 ,5,'Date',0,0);
$pdf->Cell(34 ,5, $datefact ,0,1);//end of line

$pdf->Cell(130 ,5,'Telephone : 0494831251',0,0);
$pdf->Cell(25 ,5,'facture #',0,0);
$pdf->Cell(34 ,5,$numfact,0,1);//end of line

$pdf->Cell(130 ,5,'Fixe : 071405384',0,0);
$pdf->Cell(35 ,5,'Numero de client',0,0);
$pdf->Cell(34 ,5,$id,0,1);//end of line
$pdf->Cell(130 ,5,'TVA : BE0879895116',0,1);//eol

//make a dummy empty cell as a vertical spacer
$pdf->Cell(189 ,10,'',0,1);//end of line

//billing address
$pdf->Cell(100 ,5,'Facture pour',0,1);//end of line

//add dummy cell at beginning of each line for indentation
$pdf->Cell(10 ,5,'',0,0);
$pdf->Cell(90 ,5,$nom,0,1);


$pdf->Cell(10 ,5,'',0,0);
$pdf->Cell(90 ,5,$rue.$numero.$CP,0,1);

$pdf->Cell(10 ,5,'',0,0);
$pdf->Cell(90 ,5,$numtva,0,1);

//make a dummy empty cell as a vertical spacer
$pdf->Cell(189 ,10,'',0,1);//end of line

//invoice contents
$pdf->SetFont('Arial','B',12);

$pdf->Cell(130 ,5,'Description',1,0);
$pdf->Cell(25 ,5,'HEURES',1,0);
$pdf->Cell(34 ,5,'Montant',1,1);//end of line

$pdf->SetFont('Arial','',12);

//Numbers are right-aligned so we give 'R' after new line parameter
//Toute la partie commande

$sql = "SELECT * FROM (facture INNER JOIN commande ON facture.num_fact = commande.num_facture) WHERE facture.num_fact = '$numfact'";
$cmd = customgettable($sql, $base);
$sum=0;
foreach ($cmd as $table) {
    
    $hdeb = $table['hdeb'];
    $hfin = $table['hfin'];
    $nbheure = get_time_difference($hdeb, $hfin);
    $idSeance = $table['idSeance'];
    $sql2 = "SELECT * FROM seance WHERE idSeance = '$idSeance'";
    $seance = customgettable($sql2, $base);
    foreach ($seance as $x)
    {
        $typeSeance = $x["typeSeance"];
        $prixhoraire = $x["prixHoraire"];
    }
    //Partie génération de ligne dans la facture
    $pdf->Cell(130 ,5,$typeSeance,1,0);
    $pdf->Cell(25 ,5,$nbheure,1,0);
    $pdf->Cell(34 ,5,$prixhoraire,1,1,'R');//end of line
    $sum = $sum + ($nbheure*$prixhoraire);
}



//summary
$pdf->Cell(130 ,5,'',0,0);
$pdf->Cell(25 ,5,'Sous-total',0,0);
$pdf->Cell(4 ,5,'e',1,0);
$pdf->Cell(30 ,5,$sum,1,1,'R');//end of line

$pdf->Cell(130 ,5,'',0,0);
$pdf->Cell(25 ,5,'Imposable',0,0);
$pdf->Cell(4 ,5,'e',1,0);
$pdf->Cell(30 ,5,'0',1,1,'R');//end of line

$pdf->Cell(130 ,5,'',0,0);
$pdf->Cell(25 ,5,'Taux dimpot',0,0);
$pdf->Cell(4 ,5,'e',1,0);
$pdf->Cell(30 ,5,'Non applic.',1,1,'R');//end of line

$pdf->Cell(130 ,5,'',0,0);
$pdf->Cell(25 ,5,'Total',0,0);
$pdf->Cell(4 ,5,'e',1,0);
$pdf->Cell(30 ,5,$sum,1,1,'R');//end of line

$pdf->Output();