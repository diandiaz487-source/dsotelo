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

  <style>
    body{
      font-family:'Lato',sans-serif;
      background:#fdf2f8;
      margin:0;
    }

    /* HEADER */
    header{
      background:linear-gradient(90deg,#be185d,#ec4899);
      height:60px;
      padding:0 2rem;
      display:flex;
      align-items:center;
      justify-content:space-between;
      position:fixed;
      top:0;
      left:0;
      right:0;
      z-index:200;
      box-shadow:0 2px 12px rgba(190,24,93,0.25);
    }

    .header-logo{
      font-family:'Playfair Display',serif;
      color:#fff;
      font-size:20px;
      font-weight:600;
    }

    .header-nav a{
      color:rgba(255,255,255,0.9);
      text-decoration:none;
      margin-left:1.5rem;
      font-size:13px;
      font-weight:700;
      text-transform:uppercase;
      letter-spacing:1px;
      transition:.2s;
    }

    .header-nav a:hover{
      color:#fff;
    }

    /* TOPNAV */
    .topnav{
      position:fixed;
      top:60px;
      left:0;
      right:0;
      z-index:150;
      height:48px;
      background:#fff;
      border-bottom:2px solid #f9a8d4;
      display:flex;
      align-items:center;
      padding:0 1.5rem;
      box-shadow:0 2px 8px rgba(236,72,153,.08);
    }

    .topnav a{
      display:flex;
      align-items:center;
      gap:7px;
      padding:0 1.2rem;
      height:48px;
      text-decoration:none;
      color:#be185d;
      font-size:13px;
      font-weight:700;
      text-transform:uppercase;
      letter-spacing:.8px;
      border-bottom:3px solid transparent;
      transition:.2s;
    }

    .topnav a:hover,
    .topnav a.active{
      color:#ec4899;
      background:#fdf2f8;
      border-bottom-color:#ec4899;
    }

    .topnav i{
      font-size:16px;
    }

    .sep{
      width:1px;
      height:24px;
      background:#f9a8d4;
      margin:0 5px;
    }

    /* MAIN */
    main{
      margin-top:108px;
      padding:2rem;
    }

    .welcome-card{
      background:linear-gradient(135deg,#fce7f3,#fff);
      border:1px solid #f9a8d4;
      border-radius:14px;
      padding:2rem;
      margin-bottom:1.5rem;
    }

    .welcome-card h2{
      font-family:'Playfair Display',serif;
      color:#be185d;
      margin:0 0 5px;
      font-size:23px;
    }

    .welcome-card p{
      margin:0;
      color:#f472b6;
      font-size:14px;
    }

    /* STATS */
    .stat-grid{
      display:grid;
      grid-template-columns:repeat(auto-fit,minmax(170px,1fr));
      gap:1rem;
      margin-bottom:1.5rem;
    }

    .stat-card{
      background:#fff;
      border:1px solid #f9a8d4;
      border-radius:12px;
      padding:1.3rem;
      text-align:center;
      box-shadow:0 2px 8px rgba(236,72,153,.08);
    }

    .stat-card .num{
      font-family:'Playfair Display',serif;
      font-size:32px;
      color:#ec4899;
      font-weight:600;
    }

    .stat-card .lbl{
      font-size:12px;
      color:#f472b6;
      text-transform:uppercase;
      letter-spacing:1px;
      font-weight:700;
    }

    /* QUICK LINKS */
    .quick-links{
      display:grid;
      grid-template-columns:repeat(auto-fit,minmax(180px,1fr));
      gap:1rem;
    }

    .quick-link{
      background:linear-gradient(135deg,#ec4899,#be185d);
      color:#fff;
      border-radius:12px;
      padding:1.5rem;
      text-decoration:none;
      display:flex;
      flex-direction:column;
      align-items:center;
      gap:10px;
      font-size:13px;
      font-weight:700;
      text-transform:uppercase;
      letter-spacing:1px;
      transition:.2s;
      box-shadow:0 4px 14px rgba(190,24,93,.2);
    }

    .quick-link:hover{
      opacity:.88;
      color:#fff;
    }

    .quick-link i{
      font-size:28px;
    }
  </style>
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