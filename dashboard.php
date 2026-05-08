<?php
include("conexion.php");
?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Biblioteca Virtual</title>

<link href="./wwwroot/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="./wwwroot/css/bootstrap-icons.min.css">

<style>

body{
    background:#f4f6f9;
}

.sidebar{
    position:fixed;
    top:70px;
    left:0;
    bottom:0;
    width:250px;
    background:white;
    border-right:1px solid #ddd;
    padding:15px;
}

.sidebar .nav-link{
    color:#333;
    margin-bottom:5px;
    border-radius:8px;
}

.sidebar .nav-link:hover{
    background:#0d6efd;
    color:white;
}

.content{
    margin-left:260px;
    padding:20px;
}

.card{
    border:none;
    border-radius:12px;
    box-shadow:0 2px 10px rgba(0,0,0,0.05);
}

</style>

</head>

<body>

<!-- HEADER -->
<header>

<div class="px-3 py-2 text-bg-primary">

<div class="container-fluid d-flex justify-content-between">

<h4>
<i class="bi bi-book"></i>
Biblioteca Virtual
</h4>

<a href="logout.php" class="text-white text-decoration-none">
<i class="bi bi-box-arrow-right"></i>
Salir
</a>

</div>

</div>

</header>

<!-- SIDEBAR -->
<div class="sidebar">

<ul class="nav flex-column">

<li>
<a href="#" class="nav-link" onclick="showSection('dashboard')">
<i class="bi bi-speedometer2"></i>
Dashboard
</a>
</li>

<li>
<a href="#" class="nav-link" onclick="showSection('autores')">
<i class="bi bi-person"></i>
Autores
</a>
</li>

<li>
<a href="#" class="nav-link" onclick="showSection('libros')">
<i class="bi bi-book"></i>
Libros
</a>
</li>

<li>
<a href="#" class="nav-link" onclick="showSection('prestamos')">
<i class="bi bi-journal-check"></i>
Préstamos
</a>
</li>

</ul>

</div>

<!-- CONTENIDO -->
<div class="content">

<!-- DASHBOARD -->
<div id="dashboard">

<div class="row g-4">

<!-- LIBROS -->
<div class="col-md-4">

<div class="card p-3">

<h6>Total Libros</h6>

<?php

$sql = "SELECT COUNT(*) as total FROM libros";
$resultado = mysqli_query($conn,$sql);
$fila = mysqli_fetch_assoc($resultado);

?>

<h2><?php echo $fila['total']; ?></h2>

</div>

</div>

<!-- AUTORES -->
<div class="col-md-4">

<div class="card p-3">

<h6>Total Autores</h6>

<?php

$sql2 = "SELECT COUNT(*) as total FROM autores";
$resultado2 = mysqli_query($conn,$sql2);
$fila2 = mysqli_fetch_assoc($resultado2);

?>

<h2><?php echo $fila2['total']; ?></h2>

</div>

</div>

<!-- PRESTAMOS -->
<div class="col-md-4">

<div class="card p-3">

<h6>Total Préstamos</h6>

<?php

$sql3 = "SELECT COUNT(*) as total FROM prestamos";
$resultado3 = mysqli_query($conn,$sql3);
$fila3 = mysqli_fetch_assoc($resultado3);

?>

<h2><?php echo $fila3['total']; ?></h2>

</div>

</div>

</div>

</div>

<!-- AUTORES -->
<div id="autores" style="display:none;">

<h3 class="mb-3">Autores</h3>

<table class="table table-hover bg-white">

<thead>

<tr>
<th>ID</th>
<th>Nombre</th>
<th>Nacionalidad</th>
<th>Fecha Nacimiento</th>
</tr>

</thead>

<tbody>

<?php

$sql = "SELECT * FROM autores";
$resultado = mysqli_query($conn,$sql);

while($fila = mysqli_fetch_assoc($resultado)){

?>

<tr>

<td><?php echo $fila['id_autor']; ?></td>
<td><?php echo $fila['nombre']; ?></td>
<td><?php echo $fila['nacionalidad']; ?></td>
<td><?php echo $fila['fecha_nacimiento']; ?></td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

<!-- LIBROS -->
<div id="libros" style="display:none;">

<h3 class="mb-3">Libros</h3>

<table class="table table-hover bg-white">

<thead>

<tr>

<th>ID</th>
<th>Título</th>
<th>ISBN</th>
<th>Categoría</th>
<th>Año</th>
<th>Stock</th>
<th>Autor</th>

</tr>

</thead>

<tbody>

<?php

$sql = "SELECT * FROM libros";
$resultado = mysqli_query($conn,$sql);

while($fila = mysqli_fetch_assoc($resultado)){

?>

<tr>

<td><?php echo $fila['id_libro']; ?></td>
<td><?php echo $fila['titulo']; ?></td>
<td><?php echo $fila['isbn']; ?></td>
<td><?php echo $fila['categoria']; ?></td>
<td><?php echo $fila['anio_publicacion']; ?></td>
<td><?php echo $fila['stock']; ?></td>
<td><?php echo $fila['id_autor']; ?></td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

<!-- PRESTAMOS -->
<div id="prestamos" style="display:none;">

<h3 class="mb-3">Préstamos</h3>

<table class="table table-hover bg-white">

<thead>

<tr>

<th>ID</th>
<th>Usuario</th>
<th>Libro</th>
<th>Fecha préstamo</th>
<th>Fecha devolución</th>
<th>Estado</th>

</tr>

</thead>

<tbody>

<?php

$sql = "SELECT * FROM prestamos";
$resultado = mysqli_query($conn,$sql);

while($fila = mysqli_fetch_assoc($resultado)){

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

</tbody>

</table>

</div>

</div>

<script>

function showSection(section){

document.getElementById('dashboard').style.display='none';
document.getElementById('autores').style.display='none';
document.getElementById('libros').style.display='none';
document.getElementById('prestamos').style.display='none';

document.getElementById(section).style.display='block';

}

</script>

<script src="./wwwroot/js/bootstrap.bundle.min.js"></script>

</body>
</html>