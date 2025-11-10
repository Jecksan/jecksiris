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
    <title>Usuarios Registrados</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(120deg, cyan, #8ab4f8);
            margin: 0;
            padding: 20px;
            overflow-x: hidden;
        }

        h2 {
            background-color: red;
            color: white;
            text-align: center;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.3);
            animation: fadeInDown 1s ease;
        }

        table {
            width: 90%;
            margin: 30px auto;
            border-collapse: collapse;
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0,0,0,0.2);
            animation: fadeIn 1.5s ease;
        }

        th {
            background-color: #007bff;
            color: white;
            padding: 12px;
        }

        td {
            text-align: center;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        tr:hover {
            background-color: #f1f1f1;
            transform: scale(1.01);
            transition: 0.2s ease;
        }

        img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            border: 2px solid #007bff;
            transition: transform 0.3s ease;
        }

        img:hover {
            transform: scale(1.2) rotate(5deg);
        }

        button {
            border: none;
            padding: 8px 12px;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: bold;
        }

        .eliminar {
            background-color: #ff4444;
            color: white;
        }

        .eliminar:hover {
            background-color: #cc0000;
            transform: scale(1.1);
        }

        .editar {
            background-color: #00c851;
            color: white;
            margin-right: 5px;
        }

        .editar:hover {
            background-color: #007e33;
            transform: scale(1.1);
        }

        .hidden-pass {
            letter-spacing: 3px;
            color: gray;
        }

        @keyframes fadeIn {
            from {opacity: 0; transform: translateY(20px);}
            to {opacity: 1; transform: translateY(0);}
        }

        @keyframes fadeInDown {
            from {opacity: 0; transform: translateY(-50px);}
            to {opacity: 1; transform: translateY(0);}
        }
    </style>
</head>
<body>

    <h2>Usuarios registrados en la base de datos</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Contraseña</th>
            <th>Foto</th>
            <th>Número de Control</th>
            <th>Rol</th>
            <th>Acciones</th>
        </tr>

        <?php while ($fila = $resultado->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $fila['id']; ?></td>
                <td><?php echo $fila['nombre']; ?></td>
                <td><?php echo $fila['correo']; ?></td>
                <td class="hidden-pass"><?php echo str_repeat("•", strlen($fila['contraseña'])); ?></td>
                <td><img src="img/<?php echo $fila['foto']; ?>" alt="Foto"></td>
                <td><?php echo $fila['nc']; ?></td>
                <td><?php echo $fila['rol']; ?></td>
                <td>
                    <form action="editar_usuario.php" method="POST" style="display:inline-block;">
                        <input type="hidden" name="id" value="<?php echo $fila['id']; ?>">
                        <button type="submit" class="editar">Editar</button>
                    </form>

                    <form action="borrar_usuario.php" method="POST" style="display:inline-block;" onsubmit="return confirm('¿Seguro que deseas eliminar este usuario?');">
                        <input type="hidden" name="id" value="<?php echo $fila['id']; ?>">
                        <button type="submit" class="eliminar">Eliminar</button>
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
