<?php
 $servername = "172.18.0.2:3306";
 $username = "docker";
 $password = "docker";
 $dbname = "docker";

 $conn = new mysqli($servername, $username, $password, $dbname);
 if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
 }



return $conn;
?>