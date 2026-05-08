<?php

include 'conexion.php';

if(isset($_POST['guardar'])){

    $nombre = $_POST['nombre'];
    $nacionalidad = $_POST['nacionalidad'];

    $sql = "INSERT INTO autores(nombre,nacionalidad)
    VALUES('$nombre','$nacionalidad')";

    $conn->query($sql);

}

$resultado = $conn->query("SELECT * FROM autores");

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Autores</title>

<link href="./wwwroot/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<h2 class="mb-4">Autores</h2>

<form method="POST">

<input
type="text"
name="nombre"
class="form-control mb-3"
placeholder="Nombre"
required>

<input
type="text"
name="nacionalidad"
class="form-control mb-3"
placeholder="Nacionalidad"
required>

<button
type="submit"
name="guardar"
class="btn btn-primary">

Guardar Autor

</button>

</form>

<hr>

<table class="table table-bordered bg-white">

<tr>
<th>ID</th>
<th>Nombre</th>
<th>Nacionalidad</th>
</tr>

<?php while($fila = $resultado->fetch_assoc()) { ?>

<tr>

<td><?php echo $fila['id']; ?></td>

<td><?php echo $fila['nombre']; ?></td>

<td><?php echo $fila['nacionalidad']; ?></td>

</tr>

<?php } ?>

</table>

</div>

</body>
</html>
