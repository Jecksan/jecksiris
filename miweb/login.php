<?php
include("conexion.php"); // conecta a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Encriptar la contraseña ingresada
    $password_md5 = md5($password);

    // Buscar al usuario en la tabla
    $query = "SELECT * FROM usuarios2_0 WHERE username='$username' AND password='$password_md5'";
    $result = mysqli_query($conn, $query);

    // Verificar si existe el usuario
    if (mysqli_num_rows($result) == 1) {
        // Redirigir al listado del equipo
        header("Location: mostrar_usuarios.php");
        exit();
    } else {
        echo "<h3 style='color:red;'>Usuario o contraseña incorrectos</h3>";
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
    <h2>Iniciar sesión</h2>
    <form method="POST" action="login.php">
        <label>Usuario:</label><br>
        <input type="text" name="username" required><br><br>

        <label>Contraseña:</label><br>
        <input type="password" name="password" required><br><br>

        <input type="submit" value="Ingresar">
    </form>
</body>
</html>