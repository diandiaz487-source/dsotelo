<?php

include("db.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){

$libro = $_POST['libro'];
$usuario = $_POST['usuario'];
$fecha = $_POST['fecha'];

$sql = "INSERT INTO prestamos(libro,usuario,fecha)
VALUES('$libro','$usuario','$fecha')";

mysqli_query($conn,$sql);

header("Location: dashboard.php");
exit();

}
?>
