<?php
include("dbh.php");
if($_POST['id'])
{
$id=mysql_escape_String($_POST['id']);
$firstname=mysql_escape_String($_POST['firstname']);
$lastname=mysql_escape_String($_POST['lastname']);
$sql = "update fullnames set firstname='$firstname',lastname='$lastname' where id='$id'";
mysql_query($sql);
}
?>