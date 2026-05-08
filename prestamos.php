<?php
include("conexion.php");

if(isset($_POST['id_usuario'])){

$id_usuario = $_POST['id_usuario'];
$id_libro = $_POST['id_libro'];
$fecha_prestamo = $_POST['fecha_prestamo'];
$fecha_devolucion = $_POST['fecha_devolucion'];
$estado = $_POST['estado'];

$sql = "INSERT INTO prestamos(id_usuario,id_libro,fecha_prestamo,fecha_devolucion,estado)
VALUES('$id_usuario','$id_libro','$fecha_prestamo','$fecha_devolucion','$estado')";

mysqli_query($conn,$sql);
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Prestamos</title>
<link href="./wwwroot/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

<h1>Préstamos</h1>

<form method="POST">

<input type="number" name="id_usuario" placeholder="ID Usuario" class="form-control mb-2" required>

<input type="number" name="id_libro" placeholder="ID Libro" class="form-control mb-2" required>

<input type="date" name="fecha_prestamo" class="form-control mb-2" required>

<input type="date" name="fecha_devolucion" class="form-control mb-2" required>

<input type="text" name="estado" placeholder="Estado" class="form-control mb-2" required>

<button class="btn btn-warning">
Registrar préstamo
</button>

</form>

<hr>

<table class="table table-bordered">

<tr>
<th>ID</th>
<th>Usuario</th>
<th>Libro</th>
<th>Fecha préstamo</th>
<th>Fecha devolución</th>
<th>Estado</th>
</tr>

<?php

$sql = "SELECT * FROM prestamos";
$res = mysqli_query($conn,$sql);

while($fila = mysqli_fetch_assoc($res)){
?>

<tr>
<td><?php echo $fila['id_prestamo']; ?></td>
<td><?php echo $fila['id_usuario']; ?></td>
<td><?php echo $fila['id_libro']; ?></td>
<td><?php echo $fila['fecha_prestamo']; ?></td>
<td><?php echo $fila['fecha_devolucion']; ?></td>
<td><?php echo $fila['estado']; ?></td>
</tr>

<?php } ?>

</table>

</body>
</html>