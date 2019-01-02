<?php
include_once("D:\Programmes\wamp64\www\sm\includes\db.php");
$clientname = $_POST['client'];
$res = mysqli_query($db, "SELECT * FROM client WHERE nom_Client = '$clientname';");
while($row=mysqli_fetch_assoc($res))
        {
            $idClient = $row['idClient'];
        }
        
        echo $idClient;