<?php
session_start();
<<<<<<< HEAD
if (!isset($_SESSION['id'])) { header("Location: index.html"); exit(); }
=======
if (!isset($_SESSION['id'])) {
    header("Location: index.html");
    exit();
}
>>>>>>> ab6a88d4e98341e93dff5e849383da42e659c40c
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Biblioteca — Dashboard</title>
<<<<<<< HEAD
  <link href="./wwwroot/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="./wwwroot/css/bootstrap-icons.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Lato', sans-serif; background: #fdf2f8; margin: 0; }

    /* ── HEADER ── */
    header {
      background: linear-gradient(90deg, #be185d, #ec4899);
      padding: 0 2rem; height: 60px;
      display: flex; align-items: center; justify-content: space-between;
      position: fixed; top: 0; left: 0; right: 0; z-index: 200;
      box-shadow: 0 2px 12px rgba(190,24,93,0.25);
    }
    .header-logo { font-family: 'Playfair Display', serif; color: #fff; font-size: 20px; font-weight: 600; }
    .header-nav a { color: rgba(255,255,255,0.85); text-decoration: none; font-size: 13px; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; margin-left: 1.5rem; transition: color 0.2s; }
    .header-nav a:hover { color: #fff; }

    /* ── TOPNAV (barra de módulos debajo del header) ── */
    .topnav {
      position: fixed; top: 60px; left: 0; right: 0; z-index: 150;
      background: #fff; border-bottom: 2px solid #f9a8d4;
      display: flex; align-items: center; gap: 0;
      height: 48px; padding: 0 1.5rem;
      box-shadow: 0 2px 8px rgba(236,72,153,0.08);
    }
    .topnav a {
      display: flex; align-items: center; gap: 7px;
      padding: 0 1.2rem; height: 48px;
      font-size: 13px; font-weight: 700; color: #be185d;
      text-decoration: none; text-transform: uppercase;
      letter-spacing: 0.8px; border-bottom: 3px solid transparent;
      transition: all 0.15s;
    }
    .topnav a:hover, .topnav a.active {
      color: #ec4899; border-bottom-color: #ec4899;
      background: #fdf2f8;
    }
    .topnav i { font-size: 16px; }
    .topnav .sep { width: 1px; height: 24px; background: #f9a8d4; margin: 0 4px; }

    /* ── MAIN ── */
    main { margin-top: 108px; padding: 2rem; }

    .welcome-card {
      background: linear-gradient(135deg, #fce7f3, #fff);
      border: 1px solid #f9a8d4;
      border-radius: 14px; padding: 2rem; margin-bottom: 1.5rem;
    }
    .welcome-card h2 { font-family: 'Playfair Display', serif; color: #be185d; font-size: 22px; margin: 0 0 4px; }
    .welcome-card p { color: #f472b6; margin: 0; font-size: 14px; }

    .stat-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
      gap: 1rem; margin-bottom: 1.5rem;
    }
    .stat-card {
      background: #fff; border: 1px solid #f9a8d4;
      border-radius: 12px; padding: 1.2rem 1.5rem; text-align: center;
      box-shadow: 0 2px 8px rgba(236,72,153,0.07);
    }
    .stat-card .num { font-family: 'Playfair Display', serif; font-size: 32px; color: #ec4899; font-weight: 600; }
    .stat-card .lbl { font-size: 12px; color: #f472b6; text-transform: uppercase; letter-spacing: 1px; font-weight: 700; }

    .quick-links { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 1rem; }
    .quick-link {
      background: linear-gradient(135deg, #ec4899, #be185d);
      color: #fff; border-radius: 12px; padding: 1.5rem;
      text-decoration: none; display: flex; flex-direction: column;
      align-items: center; gap: 10px; font-weight: 700;
      font-size: 13px; letter-spacing: 1px; text-transform: uppercase;
      transition: opacity 0.2s; box-shadow: 0 4px 14px rgba(190,24,93,0.2);
    }
    .quick-link:hover { opacity: 0.88; color: #fff; }
    .quick-link i { font-size: 28px; }
  </style>
</head>
=======

  <link href="./wwwroot/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="./wwwroot/css/bootstrap-icons.min.css">

  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="./wwwroot/style.css">
</head>

>>>>>>> ab6a88d4e98341e93dff5e849383da42e659c40c
<body>

<header>
  <span class="header-logo">Biblioteca</span>
<<<<<<< HEAD
  <nav class="header-nav">
    <a href="dashboard.php"><i class="bi bi-house"></i> Inicio</a>
    <a href="logout.php"><i class="bi bi-box-arrow-right"></i> Salir</a>
  </nav>
</header>

<!-- Navegación horizontal de módulos -->
<nav class="topnav">
  <a href="dashboard.php" class="active"><i class="bi bi-house"></i> Inicio</a>
  <div class="sep"></div>
  <a href="autores.php"><i class="bi bi-person-lines-fill"></i> Autores</a>
  <a href="libros.php"><i class="bi bi-book"></i> Libros</a>
  <div class="sep"></div>
  <a href="prestamos.php"><i class="bi bi-bookmark-check"></i> Préstamos</a>
</nav>

<main>
  <div class="welcome-card">
    <h2>Bienvenido, <?= htmlspecialchars($_SESSION['username']) ?> </h2>
    <p>¿Qué quieres hacer hoy?</p>
  </div>

  <?php
  require_once 'db.php';
  $db = conectarDB();
  $nAutores    = $db->query("SELECT COUNT(*) FROM autores")->fetchColumn();
  $nLibros     = $db->query("SELECT COUNT(*) FROM libros")->fetchColumn();
  $nDisponibles= $db->query("SELECT COUNT(*) FROM libros WHERE disponible=1")->fetchColumn();
  $nPrestamos  = $db->query("SELECT COUNT(*) FROM prestamos WHERE estado='activo'")->fetchColumn();
  ?>

  <div class="stat-grid">
    <div class="stat-card"><div class="num"><?= $nAutores ?></div><div class="lbl">Autores</div></div>
    <div class="stat-card"><div class="num"><?= $nLibros ?></div><div class="lbl">Libros</div></div>
    <div class="stat-card"><div class="num"><?= $nDisponibles ?></div><div class="lbl">Disponibles</div></div>
    <div class="stat-card"><div class="num"><?= $nPrestamos ?></div><div class="lbl">Préstamos activos</div></div>
  </div>

  <div class="quick-links">
    <a class="quick-link" href="autores.php"><i class="bi bi-person-plus"></i> Agregar autor</a>
    <a class="quick-link" href="libros.php"><i class="bi bi-book"></i> Agregar libro</a>
    <a class="quick-link" href="prestamos.php"><i class="bi bi-bookmark-plus"></i> Pedir libro</a>
  </div>
=======

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

>>>>>>> ab6a88d4e98341e93dff5e849383da42e659c40c
</main>

</body>
</html>