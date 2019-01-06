<?php
include_once 'dbh.php';
function gettable ($table, $pdo)
{
  $sql = "SELECT * FROM $table";
  $resultat = $pdo->query($sql);
  return $resultat;
}
function customgettable($sql, $pdo){
  $resultat = $pdo->query($sql);
  return $resultat;
}
function insert ($sql, $arrayparam, $pdo)
{
  $sth=$pdo->prepare ($sql);
  $sth->execute ($arrayparam);
  return $sth;
} //$sql est la requête sql, $arrayparam est un tableau avec les valeurs des attributs à modifier $pdo est la variable qu'on a égalé à =new PDO([...])
function supp ($table, $id, $idval, $pdo)
{
  $sql = "DELETE * FROM $table WHERE $id = $idval";
  $resultat = $pdo->query($sql);
  return $resultat;
}
function checkexist ($pdo, $comparwith)
{
  $sql = "SELECT * FROM client WHERE nom_Client='$comparwith'";
  $resultat = $pdo->query($sql);
  $count = $resultat->rowCount();
  if($count > 0) return true;
  else return false;
}
function get_time_difference($time1, $time2)
{
	$time1 = strtotime("1/1/1980 $time1");
	$time2 = strtotime("1/1/1980 $time2");

  if ($time2 < $time1)
  {
    return 0;
  }
  else if($time2==$time1)
  {
    return 0;
  }
  else {
    return ($time2 - $time1) / 3600;
  }


}


