<?php
include_once 'dbh.php';
function gettable ($table, $pdo)
{
  $sql = "SELECT * FROM $table";
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

