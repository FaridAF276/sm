<?php
include_once("D:\Programmes\wamp64\www\sm\includes\db.php");
if($_POST['id'])
{
$id=mysqli_real_escape_String($db, $_POST['id']);
$type=mysqli_real_escape_String($db, $_POST['type']);
$desc=mysqli_real_escape_String($db, $_POST['desc']);
$prix=mysqli_real_escape_String($db, $_POST['prix']);
$sql = "UPDATE seance SET typeSeance='$type',DescSeance='$desc', prixHoraire='$prix' WHERE idSeance='$id'";
mysqli_query($db, $sql);
}
?>