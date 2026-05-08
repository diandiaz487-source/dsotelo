<?php

include 'conexion.php';

if(isset($_POST['guardar'])){

    $libro = $_POST['libro'];
    $usuario = $_POST['usuario'];
    $fecha = $_POST['fecha'];

    $sql = "INSERT INTO prestamos(libro,usuario,fecha)
    VALUES('$libro','$usuario','$fecha')";

    $conn->query($sql);

}

$resultado = $conn->query("SELECT * FROM prestamos");

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Préstamos</title>

<link href="./wwwroot/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<h2 class="mb-4">Préstamos</h2>

<form method="POST">

<input
type="text"
name="libro"
class="form-control mb-3"
placeholder="Libro"
required>

<input
type="text"
name="usuario"
class="form-control mb-3"
placeholder="Usuario"
required>

<input
type="date"
name="fecha"
class="form-control mb-3"
required>

<button
type="submit"
name="guardar"
class="btn btn-primary">

Guardar Préstamo

</button>

</form>

<hr>

<table class="table table-bordered bg-white">

<tr>
<th>ID</th>
<th>Libro</th>
<th>Usuario</th>
<th>Fecha</th>
</tr>

<?php while($fila = $resultado->fetch_assoc()) { ?>

<tr>

<td><?php echo $fila['id']; ?></td>

<td><?php echo $fila['libro']; ?></td>

<td><?php echo $fila['usuario']; ?></td>

<td><?php echo $fila['fecha']; ?></td>

</tr>

<?php } ?>

</table>

</div>

</body>
</html>