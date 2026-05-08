<?php

include("db.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){

$titulo = $_POST['titulo'];
$autor = $_POST['autor'];
$anio = $_POST['anio'];

$sql = "INSERT INTO libros(titulo,autor,anio)
VALUES('$titulo','$autor','$anio')";

mysqli_query($conn,$sql);

header("Location: dashboard.php");
exit();

}
?>
