<?php
require_once 'db.php';

// Validar el input
$clase_id = filter_input(INPUT_POST, 'clase_id', FILTER_VALIDATE_INT);
if (!$clase_id) {
    die("Clase no válida.");
}

// Obtener los IDs de los clientes de la clase
$query_clientes_ids = "
    SELECT cliente_id
    FROM clase_clientes
    WHERE clase_id = :clase_id
";
$stmt_clientes_ids = $pdo->prepare($query_clientes_ids);
$stmt_clientes_ids->bindParam(':clase_id', $clase_id, PDO::PARAM_INT);
$stmt_clientes_ids->execute();
$clientes_ids = $stmt_clientes_ids->fetchAll(PDO::FETCH_COLUMN);

// Obtener los detalles de los clientes solo si existen
$clientes = [];
if (!empty($clientes_ids)) {
    $query_clientes_details = "
        SELECT id, nombre, apellidos, correo, telefono, direccion, fecha_nacimiento, foto_perfil
        FROM usuarios
        WHERE id IN (" . implode(',', array_map('intval', $clientes_ids)) . ")
    ";
    $stmt_clientes_details = $pdo->prepare($query_clientes_details);
    $stmt_clientes_details->execute();
    $clientes = $stmt_clientes_details->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes de la Clase</title>
    <link rel="stylesheet" href="css/clases.css">
    <link rel="icon" href="assets/logo.png">
</head>
<body>
    <header>
        <div class="logo">
            <img src="assets/logo.png" alt="Logo">
            <a href="index.php">Elite Fitness</a>
        </div>
        <nav class="navbar">
            <ul>
                <li><a href="crearcuenta.php">Crear Cuenta</a></li>
                <li><a href="horarioclases.php">Clases</a></li>
                <li><a href="inventario.php">Inventario</a></li>
                <li><a href="clientes.php">Clientes</a></li>
            </ul>
        </nav>
    </header>

    <div class="table-container">
        
        <h1>Clientes de la Clase</h1>
                  <div class="add-client-button">
            <form action="addcliente.php" method="get">
                <input type="hidden" name="clase_id" value="<?= htmlspecialchars($clase_id) ?>">
                <button type="submit" class="btn">Añadir Cliente</button>
            </form>

        </div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Correo</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>Fecha de Nacimiento</th>
                    <th>Foto de Perfil</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($clientes)): ?>
                    <tr>
                        <td colspan="9">No hay clientes en esta clase.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($clientes as $cliente): ?>
                        <tr>
                            <td><?= htmlspecialchars($cliente['id']) ?></td>
                            <td><?= htmlspecialchars($cliente['nombre']) ?></td>
                            <td><?= htmlspecialchars($cliente['apellidos']) ?></td>
                            <td><?= htmlspecialchars($cliente['correo']) ?></td>
                            <td><?= htmlspecialchars($cliente['telefono']) ?></td>
                            <td><?= htmlspecialchars($cliente['direccion']) ?></td>
                            <td><?= htmlspecialchars($cliente['fecha_nacimiento']) ?></td>
                            <td>
                                <img src="<?= htmlspecialchars($cliente['foto_perfil']) ?>" alt="Foto de Perfil" width="50" height="50">
                            </td>
                            <td>
                                <form action="editar.php" method="GET" style="display:inline;">
                                    <input type="hidden" name="id" value="<?= $cliente['id'] ?>">
                                    <button type="submit" class="btn btn-edit">Editar datos</button>
                                </form>
                                
                            <form action="eliminar_cliente_clase.php" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de eliminar este usuario?');">
                                <input type="hidden" name="id" value="<?= $cliente['id'] ?>">
                                <input type="hidden" name="clase_id" value="<?= $clase_id ?>">
                                <button type="submit" class="btn btn-delete" style="color: red;">Eliminar</button>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>

    </div>
</body>
</html>

