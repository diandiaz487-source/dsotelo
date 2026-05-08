<?php
session_start();
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $correo = $_POST['correo'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM usuarios 
            WHERE correo='$correo' 
            AND password='$password'";

    $resultado = mysqli_query($conn, $sql);

    if (mysqli_num_rows($resultado) > 0) {

        $usuario = mysqli_fetch_assoc($resultado);

        $_SESSION['usuario'] = $usuario['nombre'];

        header("Location: dashboard.php");
        exit();

    } else {
        echo "Correo o contraseña incorrectos";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Login</title>
</head>
<body>

<h2>Iniciar Sesión</h2>

<form method="POST">

    <input type="email" name="correo" placeholder="Correo" required>

    <br><br>

    <input type="password" name="password" placeholder="Contraseña" required>

    <br><br>

    <button type="submit">Entrar</button>

</form>

</body>
</html>
