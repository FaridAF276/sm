<?php
  $dbServername = "localhost";
  $dbUsername = "root";
  $dbPassword ="";
  $dbName = "sm";
  $dns="mysql:dbname=$dbName;host=$dbServername";
  $base = new PDO ($dns,$dbUsername,$dbPassword);
?>
