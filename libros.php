<?php
session_start();
if (!isset($_SESSION['id'])) { header("Location: index.php"); exit(); }
require_once 'db.php';
$db = conectarDB();
$msg = '';

<<<<<<< HEAD
=======
// Agregar libro
>>>>>>> ab6a88d4e98341e93dff5e849383da42e659c40c
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['titulo'])) {
    $titulo   = trim($_POST['titulo']);
    $autor_id = (int) $_POST['autor_id'];
    if ($titulo && $autor_id) {
        $db->prepare("INSERT INTO libros (titulo, autor_id) VALUES (?, ?)")->execute([$titulo, $autor_id]);
        $msg = 'success:Libro agregado correctamente.';
    }
}
<<<<<<< HEAD
=======

// Eliminar libro
>>>>>>> ab6a88d4e98341e93dff5e849383da42e659c40c
if (isset($_GET['delete'])) {
    try {
        $db->prepare("DELETE FROM libros WHERE id=?")->execute([$_GET['delete']]);
        $msg = 'success:Libro eliminado.';
    } catch (Exception $e) {
        $msg = 'error:No se puede eliminar, tiene préstamos asociados.';
    }
}
<<<<<<< HEAD
$autores = $db->query("SELECT * FROM autores ORDER BY nombre ASC")->fetchAll();
$libros  = $db->query("
    SELECT l.id, l.titulo, l.disponible, l.created_at, a.nombre AS autor
    FROM libros l JOIN autores a ON l.autor_id = a.id
=======

$autores = $db->query("SELECT * FROM autores ORDER BY nombre ASC")->fetchAll();
$libros  = $db->query("
    SELECT l.id, l.titulo, l.disponible, l.created_at, a.nombre AS autor
    FROM libros l
    JOIN autores a ON l.autor_id = a.id
>>>>>>> ab6a88d4e98341e93dff5e849383da42e659c40c
    ORDER BY l.titulo ASC
")->fetchAll();
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Libros — Biblioteca</title>
  <link href="./wwwroot/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="./wwwroot/css/bootstrap-icons.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
  <style>
<<<<<<< HEAD
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
    .bib-input, .bib-select { width: 100%; border: 1px solid #f9a8d4; border-radius: 7px; padding: 10px 14px; font-size: 14px; font-family: 'Lato', sans-serif; background: #fff7fb; color: #831843; outline: none; margin-bottom: 12px; }
    .bib-input:focus, .bib-select:focus { border-color: #ec4899; }
    .bib-btn { background: linear-gradient(90deg,#ec4899,#be185d); color: #fff; border: none; border-radius: 7px; padding: 10px 20px; font-size: 12px; font-family: 'Lato', sans-serif; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; cursor: pointer; }
    .bib-btn:hover { opacity: 0.88; }
    table { width: 100%; border-collapse: collapse; }
    th { font-size: 11px; font-weight: 700; color: #be185d; text-transform: uppercase; letter-spacing: 1px; padding: 10px 12px; border-bottom: 2px solid #f9a8d4; text-align: left; }
    td { padding: 10px 12px; border-bottom: 1px solid #fce7f3; font-size: 14px; color: #831843; }
    tr:hover td { background: #fff7fb; }
    .badge-disp { background: #f0fdf4; color: #166534; border: 1px solid #86efac; border-radius: 20px; padding: 2px 10px; font-size: 11px; font-weight: 700; }
    .badge-no { background: #fce7f3; color: #be185d; border: 1px solid #f9a8d4; border-radius: 20px; padding: 2px 10px; font-size: 11px; font-weight: 700; }
    .btn-del { background: none; border: 1px solid #f9a8d4; color: #be185d; border-radius: 5px; padding: 4px 10px; font-size: 12px; cursor: pointer; }
    .btn-del:hover { background: #fce7f3; }
    .alert-ok { background: #f0fdf4; border: 1px solid #86efac; border-radius: 7px; padding: 10px 14px; color: #166534; font-size: 13px; margin-bottom: 1rem; }
    .alert-err { background: #fce7f3; border: 1px solid #f9a8d4; border-radius: 7px; padding: 10px 14px; color: #be185d; font-size: 13px; margin-bottom: 1rem; }
=======
    body { font-family: 'Lato', sans-serif; background: #f5ede0; margin: 0; }
    header { background: #7a4f1e; padding: 0 2rem; height: 60px; display: flex; align-items: center; justify-content: space-between; position: fixed; top: 0; left: 0; right: 0; z-index: 100; box-shadow: 0 2px 8px rgba(0,0,0,0.15); }
    .header-logo { font-family: 'Playfair Display', serif; color: #f5d98a; font-size: 20px; font-weight: 600; }
    .header-nav a { color: #f5d98a; text-decoration: none; font-size: 13px; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; margin-left: 1.5rem; opacity: 0.85; }
    .header-nav a:hover { opacity: 1; }
    aside { position: fixed; top: 60px; left: 0; bottom: 0; width: 220px; background: #fffdf8; border-right: 1px solid #c9a96e; padding: 1.5rem 0; overflow-y: auto; }
    aside .section-label { font-size: 10px; font-weight: 700; color: #c9a96e; text-transform: uppercase; letter-spacing: 1.5px; padding: 0 1.2rem; margin-bottom: 6px; margin-top: 1rem; }
    aside a { display: flex; align-items: center; gap: 10px; padding: 9px 1.2rem; font-size: 14px; color: #4a2f0e; text-decoration: none; font-weight: 400; border-left: 3px solid transparent; transition: all 0.15s; }
    aside a:hover, aside a.active { background: #f5ede0; border-left-color: #7a4f1e; color: #7a4f1e; font-weight: 700; }
    aside i { font-size: 16px; }
    main { margin-left: 220px; margin-top: 60px; padding: 2rem; }
    .page-title { font-family: 'Playfair Display', serif; color: #4a2f0e; font-size: 24px; margin: 0 0 1.5rem; }
    .bib-card { background: #fffdf8; border: 1px solid #c9a96e; border-radius: 12px; padding: 1.5rem; margin-bottom: 1.5rem; }
    .bib-label { font-size: 11px; font-weight: 700; color: #7a4f1e; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 6px; display: block; }
    .bib-input, .bib-select { width: 100%; border: 1px solid #d4b483; border-radius: 7px; padding: 10px 14px; font-size: 14px; font-family: 'Lato', sans-serif; background: #fdf8f0; color: #4a2f0e; outline: none; margin-bottom: 12px; }
    .bib-input:focus, .bib-select:focus { border-color: #7a4f1e; }
    .bib-btn { background: #7a4f1e; color: #f5d98a; border: none; border-radius: 7px; padding: 10px 20px; font-size: 12px; font-family: 'Lato', sans-serif; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; cursor: pointer; }
    .bib-btn:hover { background: #5c3a14; }
    table { width: 100%; border-collapse: collapse; }
    th { font-size: 11px; font-weight: 700; color: #7a4f1e; text-transform: uppercase; letter-spacing: 1px; padding: 10px 12px; border-bottom: 2px solid #c9a96e; text-align: left; }
    td { padding: 10px 12px; border-bottom: 1px solid #f0e0c8; font-size: 14px; color: #4a2f0e; }
    tr:hover td { background: #fdf8f0; }
    .badge-disp { background: #f0f7ee; color: #2e5e1a; border: 1px solid #90c07a; border-radius: 20px; padding: 2px 10px; font-size: 11px; font-weight: 700; }
    .badge-no { background: #fdf0e8; color: #7a3010; border: 1px solid #e8a070; border-radius: 20px; padding: 2px 10px; font-size: 11px; font-weight: 700; }
    .btn-del { background: none; border: 1px solid #e8a070; color: #7a3010; border-radius: 5px; padding: 4px 10px; font-size: 12px; cursor: pointer; }
    .btn-del:hover { background: #fdf0e8; }
    .alert-ok { background: #f0f7ee; border: 1px solid #90c07a; border-radius: 7px; padding: 10px 14px; color: #2e5e1a; font-size: 13px; margin-bottom: 1rem; }
    .alert-err { background: #fdf0e8; border: 1px solid #e8a070; border-radius: 7px; padding: 10px 14px; color: #7a3010; font-size: 13px; margin-bottom: 1rem; }
>>>>>>> ab6a88d4e98341e93dff5e849383da42e659c40c
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

<<<<<<< HEAD
<nav class="topnav">
  <a href="dashboard.php"><i class="bi bi-house"></i> Inicio</a>
  <div class="sep"></div>
  <a href="autores.php"><i class="bi bi-person-lines-fill"></i> Autores</a>
  <a href="libros.php" class="active"><i class="bi bi-book"></i> Libros</a>
  <div class="sep"></div>
  <a href="prestamos.php"><i class="bi bi-bookmark-check"></i> Préstamos</a>
</nav>
=======
<aside>
  <div class="section-label">Menú</div>
  <a href="dashboard.php"><i class="bi bi-house"></i> Inicio</a>
  <div class="section-label">Catálogo</div>
  <a href="autores.php"><i class="bi bi-person-lines-fill"></i> Autores</a>
  <a href="libros.php" class="active"><i class="bi bi-book"></i> Libros</a>
  <div class="section-label">Préstamos</div>
  <a href="prestamos.php"><i class="bi bi-bookmark-check"></i> Mis préstamos</a>
</aside>
>>>>>>> ab6a88d4e98341e93dff5e849383da42e659c40c

<main>
  <h1 class="page-title">Libros</h1>

  <?php if ($msg): ?>
    <?php [$tipo, $texto] = explode(':', $msg, 2); ?>
    <div class="<?= $tipo === 'success' ? 'alert-ok' : 'alert-err' ?>"><?= $texto ?></div>
  <?php endif; ?>

  <div class="bib-card">
<<<<<<< HEAD
    <h5 style="color:#be185d;font-family:'Playfair Display',serif;margin:0 0 1rem;">Agregar libro</h5>
    <?php if (empty($autores)): ?>
      <p style="color:#f472b6;font-size:14px;">Primero debes <a href="autores.php" style="color:#be185d;font-weight:700;">agregar autores</a> antes de registrar libros.</p>
=======
    <h5 style="color:#4a2f0e;font-family:'Playfair Display',serif;margin:0 0 1rem;">Agregar libro</h5>
    <?php if (empty($autores)): ?>
      <p style="color:#9e7a50;font-size:14px;">Primero debes <a href="autores.php" style="color:#7a4f1e;font-weight:700;">agregar autores</a> antes de registrar libros.</p>
>>>>>>> ab6a88d4e98341e93dff5e849383da42e659c40c
    <?php else: ?>
    <form method="POST">
      <label class="bib-label">Título del libro</label>
      <input class="bib-input" type="text" name="titulo" placeholder="Ej: Cien años de soledad" required>
      <label class="bib-label">Autor</label>
      <select class="bib-select" name="autor_id" required>
        <option value="">— Selecciona un autor —</option>
        <?php foreach ($autores as $a): ?>
          <option value="<?= $a['id'] ?>"><?= htmlspecialchars($a['nombre']) ?></option>
        <?php endforeach; ?>
      </select>
      <button class="bib-btn" type="submit">+ Agregar</button>
    </form>
    <?php endif; ?>
  </div>

  <div class="bib-card">
<<<<<<< HEAD
    <h5 style="color:#be185d;font-family:'Playfair Display',serif;margin:0 0 1rem;">Lista de libros</h5>
    <?php if (empty($libros)): ?>
      <p style="color:#f472b6;font-size:14px;">Aún no hay libros registrados.</p>
=======
    <h5 style="color:#4a2f0e;font-family:'Playfair Display',serif;margin:0 0 1rem;">Lista de libros</h5>
    <?php if (empty($libros)): ?>
      <p style="color:#9e7a50;font-size:14px;">Aún no hay libros registrados.</p>
>>>>>>> ab6a88d4e98341e93dff5e849383da42e659c40c
    <?php else: ?>
      <table>
        <thead>
          <tr><th>#</th><th>Título</th><th>Autor</th><th>Estado</th><th>Acción</th></tr>
        </thead>
        <tbody>
          <?php foreach ($libros as $l): ?>
          <tr>
            <td><?= $l['id'] ?></td>
            <td><?= htmlspecialchars($l['titulo']) ?></td>
            <td><?= htmlspecialchars($l['autor']) ?></td>
            <td><span class="<?= $l['disponible'] ? 'badge-disp' : 'badge-no' ?>"><?= $l['disponible'] ? 'Disponible' : 'Prestado' ?></span></td>
            <td>
              <a href="libros.php?delete=<?= $l['id'] ?>" onclick="return confirm('¿Eliminar este libro?')">
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
<<<<<<< HEAD
</html>
=======
</html>
>>>>>>> ab6a88d4e98341e93dff5e849383da42e659c40c
