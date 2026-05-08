<?php
session_start();
if (!isset($_SESSION['id'])) { header("Location: index.php"); exit(); }
require_once 'db.php';
$db = conectarDB();
$msg = '';
$usuario_id = $_SESSION['id'];

// Pedir libro
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['libro_id'])) {
    $libro_id = (int) $_POST['libro_id'];
    $libro = $db->prepare("SELECT disponible FROM libros WHERE id=?");
    $libro->execute([$libro_id]);
    $lib = $libro->fetch();
    if ($lib && $lib['disponible']) {
        $db->prepare("INSERT INTO prestamos (usuario_id, libro_id) VALUES (?, ?)")->execute([$usuario_id, $libro_id]);
        $db->prepare("UPDATE libros SET disponible=0 WHERE id=?")->execute([$libro_id]);
        $msg = 'success:Libro solicitado correctamente.';
    } else {
        $msg = 'error:El libro no está disponible.';
    }
}

// Devolver libro
if (isset($_GET['devolver'])) {
    $prestamo_id = (int) $_GET['devolver'];
    $p = $db->prepare("SELECT libro_id FROM prestamos WHERE id=? AND usuario_id=?");
    $p->execute([$prestamo_id, $usuario_id]);
    $pr = $p->fetch();
    if ($pr) {
        $db->prepare("UPDATE prestamos SET estado='devuelto', fecha_devolucion=CURDATE() WHERE id=?")->execute([$prestamo_id]);
        $db->prepare("UPDATE libros SET disponible=1 WHERE id=?")->execute([$pr['libro_id']]);
        $msg = 'success:Libro devuelto. ¡Gracias!';
    }
}

$disponibles = $db->query("
    SELECT l.id, l.titulo, a.nombre AS autor
    FROM libros l JOIN autores a ON l.autor_id = a.id
    WHERE l.disponible = 1 ORDER BY l.titulo ASC
")->fetchAll();

$misprestamos = $db->prepare("
    SELECT p.id, l.titulo, a.nombre AS autor, p.fecha_prestamo, p.fecha_devolucion, p.estado
    FROM prestamos p
    JOIN libros l ON p.libro_id = l.id
    JOIN autores a ON l.autor_id = a.id
    WHERE p.usuario_id = ? ORDER BY p.fecha_prestamo DESC
");
$misprestamos->execute([$usuario_id]);
$misprestamos = $misprestamos->fetchAll();
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Préstamos — Biblioteca</title>
  <link href="./wwwroot/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="./wwwroot/css/bootstrap-icons.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
  <!-- <style>
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
      display: flex; align-items: center; height: 48px; padding: 0 1.5rem;
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
    .bib-select { width: 100%; border: 1px solid #f9a8d4; border-radius: 7px; padding: 10px 14px; font-size: 14px; font-family: 'Lato', sans-serif; background: #fff7fb; color: #831843; outline: none; margin-bottom: 12px; }
    .bib-select:focus { border-color: #ec4899; }
    .bib-btn { background: linear-gradient(90deg,#ec4899,#be185d); color: #fff; border: none; border-radius: 7px; padding: 10px 20px; font-size: 12px; font-family: 'Lato', sans-serif; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; cursor: pointer; }
    .bib-btn:hover { opacity: 0.88; }
    table { width: 100%; border-collapse: collapse; }
    th { font-size: 11px; font-weight: 700; color: #be185d; text-transform: uppercase; letter-spacing: 1px; padding: 10px 12px; border-bottom: 2px solid #f9a8d4; text-align: left; }
    td { padding: 10px 12px; border-bottom: 1px solid #fce7f3; font-size: 14px; color: #831843; }
    tr:hover td { background: #fff7fb; }
    .badge-activo { background: #fce7f3; color: #be185d; border: 1px solid #f9a8d4; border-radius: 20px; padding: 2px 10px; font-size: 11px; font-weight: 700; }
    .badge-devuelto { background: #f0fdf4; color: #166534; border: 1px solid #86efac; border-radius: 20px; padding: 2px 10px; font-size: 11px; font-weight: 700; }
    .btn-dev { background: none; border: 1px solid #f9a8d4; color: #be185d; border-radius: 5px; padding: 4px 10px; font-size: 12px; cursor: pointer; font-weight: 700; }
    .btn-dev:hover { background: #fce7f3; }
    .alert-ok { background: #f0fdf4; border: 1px solid #86efac; border-radius: 7px; padding: 10px 14px; color: #166534; font-size: 13px; margin-bottom: 1rem; }
    .alert-err { background: #fce7f3; border: 1px solid #f9a8d4; border-radius: 7px; padding: 10px 14px; color: #be185d; font-size: 13px; margin-bottom: 1rem; }
  </style> -->

  
  <link rel="stylesheet" href="./wwwroot/style.css">
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
  <a href="autores.php"><i class="bi bi-person-lines-fill"></i> Autores</a>
  <a href="libros.php"><i class="bi bi-book"></i> Libros</a>
  <div class="sep"></div>
  <a href="prestamos.php" class="active"><i class="bi bi-bookmark-check"></i> Préstamos</a>
</nav>

<main>
  <h1 class="page-title">Préstamos</h1>

  <?php if ($msg): ?>
    <?php [$tipo, $texto] = explode(':', $msg, 2); ?>
    <div class="<?= $tipo === 'success' ? 'alert-ok' : 'alert-err' ?>"><?= $texto ?></div>
  <?php endif; ?>

  <div class="bib-card">
    <h5 style="color:#be185d;font-family:'Playfair Display',serif;margin:0 0 1rem;">Pedir un libro</h5>
    <?php if (empty($disponibles)): ?>
      <p style="color:#f472b6;font-size:14px;">No hay libros disponibles en este momento.</p>
    <?php else: ?>
    <form method="POST">
      <label class="bib-label">Selecciona un libro disponible</label>
      <select class="bib-select" name="libro_id" required>
        <option value="">— Elige un libro —</option>
        <?php foreach ($disponibles as $l): ?>
          <option value="<?= $l['id'] ?>"><?= htmlspecialchars($l['titulo']) ?> — <?= htmlspecialchars($l['autor']) ?></option>
        <?php endforeach; ?>
      </select>
      <button class="bib-btn" type="submit">Pedir préstamo</button>
    </form>
    <?php endif; ?>
  </div>

  <div class="bib-card">
    <h5 style="color:#be185d;font-family:'Playfair Display',serif;margin:0 0 1rem;">Mis préstamos</h5>
    <?php if (empty($misprestamos)): ?>
      <p style="color:#f472b6;font-size:14px;">No has pedido ningún libro todavía.</p>
    <?php else: ?>
      <table>
        <thead>
          <tr><th>Libro</th><th>Autor</th><th>Fecha</th><th>Estado</th><th>Acción</th></tr>
        </thead>
        <tbody>
          <?php foreach ($misprestamos as $p): ?>
          <tr>
            <td><?= htmlspecialchars($p['titulo']) ?></td>
            <td><?= htmlspecialchars($p['autor']) ?></td>
            <td><?= date('d/m/Y', strtotime($p['fecha_prestamo'])) ?></td>
            <td><span class="<?= $p['estado'] === 'activo' ? 'badge-activo' : 'badge-devuelto' ?>"><?= ucfirst($p['estado']) ?></span></td>
            <td>
              <?php if ($p['estado'] === 'activo'): ?>
                <a href="prestamos.php?devolver=<?= $p['id'] ?>" onclick="return confirm('¿Devolver este libro?')">
                  <button class="btn-dev">↩️ Devolver</button>
                </a>
              <?php else: ?>
                <span style="color:#f472b6;font-size:12px;"><?= $p['fecha_devolucion'] ?></span>
              <?php endif; ?>
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