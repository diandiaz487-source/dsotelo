<?php

$host = "localhost";
$user = "root";
$pass = "";
$db   = "biblioteca";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Error de conexión");
}
?>