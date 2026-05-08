<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: index.html");
    exit();
}
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Biblioteca — Dashboard</title>

  <link href="./wwwroot/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="./wwwroot/css/bootstrap-icons.min.css">

  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="./wwwroot/style.css">
</head>

<body>

<header>
  <span class="header-logo">Biblioteca</span>

  <nav class="header-nav">
    <a href="dashboard.php">
      <i class="bi bi-house-door"></i> Inicio
    </a>

    <a href="logout.php">
      <i class="bi bi-box-arrow-right"></i> Salir
    </a>
  </nav>
</header>

<!-- MENÚ SUPERIOR -->
<nav class="topnav">

  <a href="dashboard.php" class="active">
    <i class="bi bi-speedometer2"></i> Dashboard
  </a>

  <div class="sep"></div>

  <a href="libros.php">
    <i class="bi bi-book-half"></i> Libros
  </a>

  <a href="prestamos.php">
    <i class="bi bi-arrow-left-right"></i> Préstamos
  </a>

  <a href="autores.php">
    <i class="bi bi-people-fill"></i> Autores
  </a>

</nav>

<main>

  <div class="welcome-card">
    <h2>
      Bienvenido,
      <?= htmlspecialchars($_SESSION['username']) ?>
    </h2>

    <p>Administra tu sistema bibliotecario desde aquí.</p>
  </div>

<?php
require_once 'db.php';

$db = conectarDB();

$nAutores = $db->query("SELECT COUNT(*) FROM autores")->fetchColumn();

$nLibros = $db->query("SELECT COUNT(*) FROM libros")->fetchColumn();

$nDisponibles = $db->query("SELECT COUNT(*) FROM libros WHERE disponible=1")->fetchColumn();

$nPrestamos = $db->query("SELECT COUNT(*) FROM prestamos WHERE estado='activo'")->fetchColumn();
?>

  <!-- TARJETAS -->
  <div class="stat-grid">

    <div class="stat-card">
      <div class="num"><?= $nAutores ?></div>
      <div class="lbl">Autores</div>
    </div>

    <div class="stat-card">
      <div class="num"><?= $nLibros ?></div>
      <div class="lbl">Libros</div>
    </div>

    <div class="stat-card">
      <div class="num"><?= $nDisponibles ?></div>
      <div class="lbl">Disponibles</div>
    </div>

    <div class="stat-card">
      <div class="num"><?= $nPrestamos ?></div>
      <div class="lbl">Activos</div>
    </div>

  </div>

  <!-- ACCESOS RÁPIDOS -->
  <div class="quick-links">

    <a class="quick-link" href="libros.php">
      <i class="bi bi-journal-plus"></i>
      Registrar libro
    </a>

    <a class="quick-link" href="autores.php">
      <i class="bi bi-person-vcard"></i>
      Nuevo autor
    </a>

    <a class="quick-link" href="prestamos.php">
      <i class="bi bi-bookmark-heart"></i>
      Gestionar préstamo
    </a>

  </div>

</main>

</body>
</html>