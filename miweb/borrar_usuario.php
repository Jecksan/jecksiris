<?php
$conn = new mysqli("localhost", "root", "", "registro");

if ($conn->connect_error) {
  die("Error de conexión: " . $conn->connect_error);
}

$id = $_GET['id'] ?? 0;
$id = intval($id);

if ($id > 0) {
  
  $sql = "DELETE FROM usuarios WHERE id = $id";
  if ($conn->query($sql) === TRUE) {
    echo "<h2>🗑️ Usuario eliminado correctamente.</h2>";
    echo "<a href='mostrar_usuarios.php'>Volver a la lista</a>";
  } else {
    echo "Error al eliminar: " . $conn->error;
  }
} else {
  echo "ID no válido.";
}

$conn->close();
?>