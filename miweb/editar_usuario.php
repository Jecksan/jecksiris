<?php
// Conexión a la base de datos
$conn = new mysqli("localhost", "root", "", "registro");
if ($conn->connect_error) die("Error de conexión: " . $conn->connect_error);

// Obtener todos los usuarios
$result = $conn->query("SELECT * FROM usuarios");
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Lista de Usuarios</title>
<style>
    table {
        width: 80%;
        margin: 30px auto;
        border-collapse: collapse;
        font-family: 'Segoe UI', sans-serif;
    }
    th, td {
        padding: 12px;
        border: 1px solid #ccc;
        text-align: center;
    }
    th {
        background-color: #007BFF;
        color: white;
    }
    a.edit-btn {
        padding: 5px 10px;
        background-color: #28a745;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        transition: background 0.3s;
    }
    a.edit-btn:hover {
        background-color: #218838;
    }
</style>
</head>
<body>

<h2 style="text-align:center;">Usuarios Registrados</h2>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Rol</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php while($user = $result->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($user['id']) ?></td>
            <td><?= htmlspecialchars($user['nombre']) ?></td>
            <td><?= htmlspecialchars($user['correo']) ?></td>
            <td><?= htmlspecialchars($user['rol']) ?></td>
            <td>
                <!-- Aquí pasa el ID correctamente por GET -->
                <a class="edit-btn" href="editar.php?id=<?= $user['id'] ?>">Editar</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

</body>
</html>

<?php
$conn->close();
?>
