<?php
include_once("D:\Programmes\wamp64\www\sm\includes\db.php");
if($_POST['id'])
{
echo $_POST['id'].$_POST['nom'].$_POST['mail'].$_POST['tel'].$_POST['cp'];
$id=mysqli_real_escape_String($db, $_POST['id']);
$nom=mysqli_real_escape_String($db, $_POST['nom']);
$mail=mysqli_real_escape_String($db, $_POST['mail']);
$tel=mysqli_real_escape_String($db, $_POST['tel']);
$cp=mysqli_real_escape_String($db, $_POST['cp']);
$sql = "UPDATE client SET nom_Client='$nom',mail_client='$mail',numtel_client='$tel', CP='$cp' WHERE idClient='$id'";
mysqli_query($db, $sql);
}
?>