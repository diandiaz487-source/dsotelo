<?php
session_start();

if(isset($_COOKIE["id_usuarios"])) {
  $_SESSION['id_usuarios'] = $_COOKIE["id_usuarios"];
    header("Location: dashboard.php");
    exit();
}
?>
<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Biblioteca — Iniciar sesión</title>
    <link href="./wwwroot/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./wwwroot/css/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
      * { box-sizing: border-box; }
      body {
        margin: 0;
        min-height: 100vh;
        background: linear-gradient(135deg, #f472b6 0%, #ec4899 50%, #be185d 100%);
        font-family: 'Lato', sans-serif;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem 1rem;
      }
      .bib-card {
        background: rgba(255,255,255,0.97);
        border: none;
        border-radius: 18px;
        padding: 2.5rem 2.5rem 2rem;
        width: 100%;
        max-width: 420px;
        box-shadow: 0 8px 40px rgba(190,24,93,0.25);
      }
      .bib-title {
        font-family: 'Playfair Display', serif;
        font-size: 28px;
        font-weight: 600;
        color: #be185d;
        margin: 0 0 6px;
        text-align: center;
      }
      .bib-subtitle {
        font-size: 13px;
        color: #f472b6;
        text-align: center;
        margin: 0 0 1.5rem;
        font-weight: 300;
      }
      .bib-ornament {
        text-align: center;
        color: #f9a8d4;
        font-size: 16px;
        letter-spacing: 8px;
        margin-bottom: 1.6rem;
      }
      .bib-label {
        font-size: 11px;
        font-weight: 700;
        color: #be185d;
        text-transform: uppercase;
        letter-spacing: 1.2px;
        margin-bottom: 6px;
        display: block;
      }
      .bib-input {
        width: 100%;
        border: 1px solid #f9a8d4;
        border-radius: 8px;
        padding: 11px 14px;
        font-size: 14px;
        font-family: 'Lato', sans-serif;
        background: #fff7fb;
        color: #831843;
        margin-bottom: 18px;
        outline: none;
        transition: border-color 0.2s;
      }
      .bib-input:focus { border-color: #ec4899; background: #fff; }
      .bib-input::placeholder { color: #f9a8d4; font-weight: 300; }
      .bib-remember {
        display: flex; align-items: center; gap: 8px;
        margin-bottom: 18px; margin-top: -8px;
      }
      .bib-remember input[type="checkbox"] { width: 16px; height: 16px; accent-color: #ec4899; cursor: pointer; }
      .bib-remember label { font-size: 13px; color: #f472b6; cursor: pointer; user-select: none; }
      .bib-btn {
        width: 100%;
        background: linear-gradient(90deg, #ec4899, #be185d);
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: 13px;
        font-size: 12px;
        font-family: 'Lato', sans-serif;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        cursor: pointer;
        transition: opacity 0.2s;
      }
      .bib-btn:hover { opacity: 0.88; }
      .bib-footer { text-align: center; margin-top: 18px; font-size: 13px; color: #f472b6; }
      .bib-footer a { color: #be185d; font-weight: 700; text-decoration: none; }
      .bib-footer a:hover { text-decoration: underline; }
      .bib-error {
        background: #fce7f3; border: 1px solid #f9a8d4;
        border-radius: 7px; padding: 10px 14px; font-size: 13px;
        color: #be185d; margin-bottom: 16px; text-align: center;
      }
    </style>
  </head>
  <body>
    <div class="bib-card">
      <h1 class="bib-title">Iniciar sesión</h1>
      <p class="bib-subtitle">Acceder</p>
      <div class="bib-ornament"></div>
      <form method="POST" action="login.php">
        <label class="bib-label" for="email">email</label>
        <input class="bib-input" type="email" id="email" name="email"
          placeholder="tu@correo.com"
          value="<?= isset($_COOKIE['recordar_email']) ? htmlspecialchars($_COOKIE['recordar_email']) : '' ?>"
          required>
        <label class="bib-label" for="pwd">Contraseña</label>
        <input class="bib-input" type="password" id="pwd" name="pwd" placeholder="••••••••" required>
        <div class="bib-remember">
          <input type="checkbox" id="recordar" name="recordar" value="1"
            <?= isset($_COOKIE['recordar_email']) ? 'checked' : '' ?>>
          <label for="recordar">Recórdame</label>
        </div>
        <button class="bib-btn" type="submit">Iniciar sesión</button>
      </form>
      <p class="bib-footer">
        ¿No tienes cuenta? <a href="registro.html">Crear cuenta</a>
      </p>
    </div>
  </body>
</html>