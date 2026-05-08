<?php

include 'conexion.php';

if(isset($_POST['guardar'])){

    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $anio = $_POST['anio'];

    $sql = "INSERT INTO libros(titulo,autor,anio)
    VALUES('$titulo','$autor','$anio')";

    $conn->query($sql);

}

$resultado = $conn->query("SELECT * FROM libros");

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Libros</title>

<link href="./wwwroot/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<h2 class="mb-4">Libros</h2>

<form method="POST">

<input
type="text"
name="titulo"
class="form-control mb-3"
placeholder="Título"
required>

<input
type="text"
name="autor"
class="form-control mb-3"
placeholder="Autor"
required>

<input
type="number"
name="anio"
class="form-control mb-3"
placeholder="Año"
required>

<button
type="submit"
name="guardar"
class="btn btn-primary">

Guardar Libro

</button>

</form>

<hr>

<table class="table table-bordered bg-white">

<tr>
<th>ID</th>
<th>Título</th>
<th>Autor</th>
<th>Año</th>
</tr>

<?php while($fila = $resultado->fetch_assoc()) { ?>

<tr>

<td><?php echo $fila['id']; ?></td>

<td><?php echo $fila['titulo']; ?></td>

<td><?php echo $fila['autor']; ?></td>

<td><?php echo $fila['anio']; ?></td>

</tr>

<?php } ?>

</table>

</div>

</body>
</html>