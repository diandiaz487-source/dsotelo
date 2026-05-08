<?php
include("conexion.php");

if(isset($_POST['titulo'])){

$titulo = $_POST['titulo'];
$isbn = $_POST['isbn'];
$categoria = $_POST['categoria'];
$anio = $_POST['anio'];
$stock = $_POST['stock'];
$id_autor = $_POST['id_autor'];

$sql = "INSERT INTO libros(titulo,isbn,categoria,anio_publicacion,stock,id_autor)
VALUES('$titulo','$isbn','$categoria','$anio','$stock','$id_autor')";

mysqli_query($conn,$sql);
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Libros</title>
<link href="./wwwroot/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

<h1>Libros</h1>

<form method="POST">

<input type="text" name="titulo" placeholder="Título" class="form-control mb-2" required>

<input type="text" name="isbn" placeholder="ISBN" class="form-control mb-2" required>

<input type="text" name="categoria" placeholder="Categoría" class="form-control mb-2" required>

<input type="number" name="anio" placeholder="Año" class="form-control mb-2" required>

<input type="number" name="stock" placeholder="Stock" class="form-control mb-2" required>

<input type="number" name="id_autor" placeholder="ID Autor" class="form-control mb-2" required>

<button class="btn btn-success">
Agregar libro
</button>

</form>

<hr>

<table class="table table-bordered">

<tr>
<th>ID</th>
<th>Título</th>
<th>ISBN</th>
<th>Categoría</th>
<th>Año</th>
<th>Stock</th>
</tr>

<?php

$sql = "SELECT * FROM libros";
$res = mysqli_query($conn,$sql);

while($fila = mysqli_fetch_assoc($res)){
?>

<tr>
<td><?php echo $fila['id_libro']; ?></td>
<td><?php echo $fila['titulo']; ?></td>
<td><?php echo $fila['isbn']; ?></td>
<td><?php echo $fila['categoria']; ?></td>
<td><?php echo $fila['anio_publicacion']; ?></td>
<td><?php echo $fila['stock']; ?></td>
</tr>

<?php } ?>

</table>

</body>
</html>