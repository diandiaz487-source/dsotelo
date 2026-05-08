<?php
include("conexion.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard — Biblioteca</title>

  <link href="./wwwroot/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="./wwwroot/css/bootstrap-icons.min.css">

  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Lato', sans-serif;
      background: #f5ede0;
      margin: 0;
    }

    header {
      background: #7a4f1e;
      padding: 0 2rem;
      height: 60px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      z-index: 100;
    }

    .header-logo {
      font-family: 'Playfair Display', serif;
      color: #f5d98a;
      font-size: 20px;
      font-weight: 600;
    }

    .header-nav a {
      color: #f5d98a;
      text-decoration: none;
      margin-left: 1.5rem;
      font-size: 13px;
      font-weight: bold;
    }

    aside {
      position: fixed;
      top: 60px;
      left: 0;
      bottom: 0;
      width: 220px;
      background: #fffdf8;
      border-right: 1px solid #c9a96e;
      padding: 1.5rem 0;
    }

    aside a {
      display: block;
      padding: 10px 20px;
      color: #4a2f0e;
      text-decoration: none;
      font-weight: bold;
    }

    aside a:hover {
      background: #f5ede0;
    }

    main {
      margin-left: 220px;
      margin-top: 60px;
      padding: 2rem;
    }

    .card-box {
      background: white;
      border-radius: 12px;
      padding: 1.5rem;
      border: 1px solid #c9a96e;
      margin-bottom: 20px;
    }
  </style>
</head>
<body>

<header>
  <span class="header-logo">Biblioteca</span>

  <nav class="header-nav">
    <a href="logout.php">
      <i class="bi bi-box-arrow-right"></i>
      Salir
    </a>
  </nav>
</header>

<aside>
  <a href="dashboard.php">🏠 Dashboard</a>
  <a href="autores.php">👤 Autores</a>
  <a href="libros.php">📚 Libros</a>
  <a href="prestamos.php">📖 Préstamos</a>
</aside>

<main>

<h1 style="font-family:'Playfair Display',serif;color:#4a2f0e;">
Dashboard
</h1>

<div class="row">

<?php
$sql = "SELECT COUNT(*) as total FROM autores";
$res = mysqli_query($conn, $sql);
$autores = mysqli_fetch_assoc($res);
?>

<div class="col-md-4">
  <div class="card-box">
    <h5>Total autores</h5>
    <h2><?php echo $autores['total']; ?></h2>
  </div>
</div>

<?php
$sql = "SELECT COUNT(*) as total FROM libros";
$res = mysqli_query($conn, $sql);
$libros = mysqli_fetch_assoc($res);
?>

<div class="col-md-4">
  <div class="card-box">
    <h5>Total libros</h5>
    <h2><?php echo $libros['total']; ?></h2>
  </div>
</div>

<?php
$sql = "SELECT COUNT(*) as total FROM prestamos";
$res = mysqli_query($conn, $sql);
$prestamos = mysqli_fetch_assoc($res);
?>

<div class="col-md-4">
  <div class="card-box">
    <h5>Total préstamos</h5>
    <h2><?php echo $prestamos['total']; ?></h2>
  </div>
</div>

</div>

</main>

</body>
</html>