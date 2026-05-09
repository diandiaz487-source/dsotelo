<?php
session_start();
if (!isset($_SESSION['id'])) { header("Location: index.html"); exit(); }
require_once 'db.php';
$db = conectarDB();
$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nombre'])) {
    $nombre = trim($_POST['nombre']);
    if ($nombre) {
        $db->prepare("INSERT INTO autores (nombre) VALUES (?)")->execute([$nombre]);
        $msg = 'success:Autor agregado correctamente.';
    }
}
if (isset($_GET['delete'])) {
    try {
        $db->prepare("DELETE FROM autores WHERE id=?")->execute([$_GET['delete']]);
        $msg = 'success:Autor eliminado.';
    } catch (Exception $e) {
        $msg = 'error:No se puede eliminar, tiene libros asociados.';
    }
}
$autores = $db->query("SELECT * FROM autores ORDER BY nombre ASC")->fetchAll();
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Autores — Biblioteca</title>
  <link href="./wwwroot/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="./wwwroot/css/bootstrap-icons.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Lato', sans-serif; background: #fdf2f8; margin: 0; }
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
    .topnav a:hover, .topnav a.active { color: #ec4899; border-bottom-color: #ec4899; background: #fdf2f8; }
    .topnav i { font-size: 16px; }
    .topnav .sep { width: 1px; height: 24px; background: #f9a8d4; margin: 0 4px; }
    main { margin-top: 108px; padding: 2rem; }
    .page-title { font-family: 'Playfair Display', serif; color: #be185d; font-size: 24px; margin: 0 0 1.5rem; }
    .bib-card { background: #fff; border: 1px solid #f9a8d4; border-radius: 12px; padding: 1.5rem; margin-bottom: 1.5rem; box-shadow: 0 2px 8px rgba(236,72,153,0.07); }
    .bib-label { font-size: 11px; font-weight: 700; color: #be185d; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 6px; display: block; }
    .bib-input { width: 100%; border: 1px solid #f9a8d4; border-radius: 7px; padding: 10px 14px; font-size: 14px; font-family: 'Lato', sans-serif; background: #fff7fb; color: #831843; outline: none; }
    .bib-input:focus { border-color: #ec4899; }
    .bib-btn { background: linear-gradient(90deg,#ec4899,#be185d); color: #fff; border: none; border-radius: 7px; padding: 10px 20px; font-size: 12px; font-family: 'Lato', sans-serif; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; cursor: pointer; margin-top: 10px; }
    .bib-btn:hover { opacity: 0.88; }
    table { width: 100%; border-collapse: collapse; }
    th { font-size: 11px; font-weight: 700; color: #be185d; text-transform: uppercase; letter-spacing: 1px; padding: 10px 12px; border-bottom: 2px solid #f9a8d4; text-align: left; }
    td { padding: 10px 12px; border-bottom: 1px solid #fce7f3; font-size: 14px; color: #831843; }
    tr:hover td { background: #fff7fb; }
    .btn-del { background: none; border: 1px solid #f9a8d4; color: #be185d; border-radius: 5px; padding: 4px 10px; font-size: 12px; cursor: pointer; }
    .btn-del:hover { background: #fce7f3; }
    .alert-ok { background: #f0fdf4; border: 1px solid #86efac; border-radius: 7px; padding: 10px 14px; color: #166534; font-size: 13px; margin-bottom: 1rem; }
    .alert-err { background: #fce7f3; border: 1px solid #f9a8d4; border-radius: 7px; padding: 10px 14px; color: #be185d; font-size: 13px; margin-bottom: 1rem; }
  </style>
</head>
<body>

<header>
  <span class="header-logo">Biblioteca</span>
  <nav class="header-nav">
    <a href="dashboard.php"><i class="bi bi-house"></i> Inicio</a>
    <a href="logout.php"><i class="bi bi-box-arrow-right"></i> Salir</a>
  </nav>
</header>

<nav class="topnav">
  <a href="dashboard.php"><i class="bi bi-house"></i> Inicio</a>
  <div class="sep"></div>
  <a href="autores.php" class="active"><i class="bi bi-person-lines-fill"></i> Autores</a>
  <a href="libros.php"><i class="bi bi-book"></i> Libros</a>
  <div class="sep"></div>
  <a href="prestamos.php"><i class="bi bi-bookmark-check"></i> Préstamos</a>
</nav>

<main>
  <h1 class="page-title">Autores</h1>

  <?php if ($msg): ?>
    <?php [$tipo, $texto] = explode(':', $msg, 2); ?>
    <div class="<?= $tipo === 'success' ? 'alert-ok' : 'alert-err' ?>"><?= $texto ?></div>
  <?php endif; ?>

  <div class="bib-card">
    <h5 style="color:#be185d;font-family:'Playfair Display',serif;margin:0 0 1rem;">Agregar autor</h5>
    <form method="POST">
      <label class="bib-label">Nombre del autor</label>
      <input class="bib-input" type="text" name="nombre" placeholder="Autor:" required>
      <button class="bib-btn" type="submit">+ Agregar</button>
    </form>
  </div>

  <div class="bib-card">
    <h5 style="color:#be185d;font-family:'Playfair Display',serif;margin:0 0 1rem;">Lista de autores</h5>
    <?php if (empty($autores)): ?>
      <p style="color:#f472b6;font-size:14px;">Aún no hay autores registrados.</p>
    <?php else: ?>
      <table>
        <thead>
          <tr><th>#</th><th>Nombre</th><th>Registrado</th><th>Acción</th></tr>
        </thead>
        <tbody>
          <?php foreach ($autores as $a): ?>
          <tr>
            <td><?= $a['id'] ?></td>
            <td><?= htmlspecialchars($a['nombre']) ?></td>
            <td><?= date('d/m/Y', strtotime($a['created_at'])) ?></td>
            <td>
              <a href="autores.php?delete=<?= $a['id'] ?>" onclick="return confirm('¿Eliminar este autor?')">
                <button class="btn-del">🗑 Eliminar</button>
              </a>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php endif; ?>
  </div>
</main>

</body>
</html>