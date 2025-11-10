<?php
$conn = new mysqli("localhost", "root", "", "registro");

if ($conn->connect_error) {
  die("Error de conexión: " . $conn->connect_error);
}

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];

// Si se sube nueva foto
$foto_nombre = $_FILES['foto']['name'] ?? '';
$foto_tmp = $_FILES['foto']['tmp_name'] ?? '';

if (!empty($foto_nombre)) {
  $ruta_destino = "img/" . $foto_nombre;
  move_uploaded_file($foto_tmp, $ruta_destino);
  $foto_sql = ", foto='$foto_nombre'";
} else {
  $foto_sql = "";
}

// Si se cambia la contraseña
if (!empty($contrasena)) {
  $contrasena_hash = password_hash($contrasena, PASSWORD_DEFAULT);
  $pass_sql = ", contraseña='$contrasena_hash'";
} else {
  $pass_sql = "";
}

// Ejecutar UPDATE
$sql = "UPDATE usuarios 
        SET nombre='$nombre', correo='$correo' 
        $pass_sql 
        $foto_sql
        WHERE id=$id";

if ($conn->query($sql) === TRUE) {
  echo "<h2>✅ Usuario actualizado correctamente.</h2>";
  echo "<a href='mostrar_usuarios.php'>Volver a la lista</a>";
} else {
  echo "Error al actualizar: " . $conn->error;
}

$conn->close();
?>

