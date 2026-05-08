<?php
include("conexion.php");

if(isset($_POST['nombre'])){

    $nombre = $_POST['nombre'];
    $nacionalidad = $_POST['nacionalidad'];
    $fecha = $_POST['fecha'];

    $sql = "INSERT INTO autores(nombre,nacionalidad,fecha_nacimiento)
            VALUES('$nombre','$nacionalidad','$fecha')";

    mysqli_query($conn,$sql);
}

if(isset($_GET['delete'])){

    $id = $_GET['delete'];

    mysqli_query($conn,"DELETE FROM autores WHERE id_autor=$id");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Autores</title>
<link href="./wwwroot/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

<h1>Autores</h1>

<form method="POST" class="mb-4">

<input type="text" name="nombre" placeholder="Nombre" class="form-control mb-2" required>

<input type="text" name="nacionalidad" placeholder="Nacionalidad" class="form-control mb-2" required>

<input type="date" name="fecha" class="form-control mb-2" required>

<button class="btn btn-primary">
Agregar autor
</button>

</form>

<table class="table table-bordered">

<tr>
<th>ID</th>
<th>Nombre</th>
<th>Nacionalidad</th>
<th>Fecha</th>
<th>Eliminar</th>
</tr>

<?php

$sql = "SELECT * FROM autores";
$res = mysqli_query($conn,$sql);

while($fila = mysqli_fetch_assoc($res)){
?>

<tr>
<td><?php echo $fila['id_autor']; ?></td>
<td><?php echo $fila['nombre']; ?></td>
<td><?php echo $fila['nacionalidad']; ?></td>
<td><?php echo $fila['fecha_nacimiento']; ?></td>
<td>
<a href="autores.php?delete=<?php echo $fila['id_autor']; ?>" class="btn btn-danger btn-sm">
Eliminar
</a>
</td>
</tr>

<?php } ?>

</table>

</body>
</html>