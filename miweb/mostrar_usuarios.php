<?php

$conexion = new mysqli("localhost", "root", "", "registro");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}


$sql = "SELECT * FROM usuarios";
$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Usuarios registrados</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body style="background-color: cyan;">

    <h2 style="background-color: red; color: white; text-align: center;">Usuarios registrados en la BD</h2>

    <table border="1" width="100%" style="border-collapse: collapse;">
        <tr style="background-color: blue; color: white;">
            <th>ID</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Contraseña</th>
            <th>Foto</th>
            <th>Acción</th>
        </tr>

        <?php while ($fila = $resultado->fetch_assoc()) { ?>
            <tr style="background-color: #e6ccff; text-align: center;">
                <td><?php echo $fila['id']; ?></td>
                <td><?php echo $fila['nombre']; ?></td>
                <td><?php echo $fila['correo']; ?></td>
                <td><?php echo $fila['contraseña']; ?></td>
                <td>
                    <img src="img/<?php echo $fila['foto']; ?>" width="80" height="80" style="border-radius: 50%;">
                </td>
                <td>
                    <form action="borrar_usuario.php" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este usuario?');">
                        <input type="hidden" name="id" value="<?php echo $fila['id']; ?>">
                        <button type="submit" style="background-color: red; color: white; border: none; padding: 5px 10px; border-radius: 5px; cursor: pointer;">
                            Eliminar
                        </button>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>

</body>
</html>

<?php
$conexion->close();
?>
