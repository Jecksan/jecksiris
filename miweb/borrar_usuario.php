<?php

$conexion = new mysqli("localhost", "root", "", "registro");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = intval($_POST["id"]); // Convertir a número por seguridad

    
    $sql = "DELETE FROM usuarios WHERE id = $id";

    if ($conexion->query($sql) === TRUE) {
        
        echo "<script>
                alert('Usuario eliminado correctamente');
                window.location.href='mostrar_usuarios.php';
              </script>";
    } else {
        echo "Error al eliminar el usuario: " . $conexion->error;
    }
}

$conexion->close();
?>
