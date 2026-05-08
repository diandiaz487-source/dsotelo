<?php

include("db.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){

$nombre = $_POST['nombre'];
$nacionalidad = $_POST['nacionalidad'];

$sql = "INSERT INTO autores(nombre,nacionalidad)
VALUES('$nombre','$nacionalidad')";

mysqli_query($conn,$sql);

header("Location: dashboard.php");
exit();

}
?>
