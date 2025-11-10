<?php
// Datos de conexión
$servername = "localhost";
$username = "root";       // usuario por defecto de XAMPP
$password = "";           // normalmente sin contraseña
$dbname = "registro";     // según tu base de datos en phpMyAdmin


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
  die("Error de conexión: " . $conn->connect_error);
}


$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];


$contrasena_segura = password_hash($contrasena, PASSWORD_DEFAULT);


$foto_nombre = $_FILES['foto']['name'];
$foto_tmp = $_FILES['foto']['tmp_name'];
$ruta_destino = "img/" . $foto_nombre;


if (move_uploaded_file($foto_tmp, $ruta_destino)) {
    // Insertar datos en la tabla 'usuarios'
    $sql = "INSERT INTO usuarios (nombre, correo, contraseña, foto)
            VALUES ('$nombre', '$correo', '$contrasena_segura', '$foto_nombre')";

    if ($conn->query($sql) === TRUE) {
        echo "<h2>✅ Usuario registrado correctamente.</h2>";
        echo "<a href='registrar_usuario.html'>Registrar otro usuario</a>";
    } else {
        echo "Error al insertar: " . $conn->error;
    }
} else {
    echo "Error al subir la imagen.";
}

$conn->close();
?>