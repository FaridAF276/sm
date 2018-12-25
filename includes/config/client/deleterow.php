<?php
include_once("D:\Programmes\wamp64\www\sm\includes\db.php");
if($_POST['id'])
{
    echo $_POST['id'].$_POST['table'].$_POST['attribute'];
    $id=mysqli_real_escape_String($db, $_POST['id']);
    $table=mysqli_real_escape_String($db, $_POST['table']);
    $attribute=mysqli_real_escape_String($db, $_POST['attribute']);
    $sql = "DELETE FROM client WHERE idClient ='$id'";
    mysqli_query($db, $sql);
}
?>