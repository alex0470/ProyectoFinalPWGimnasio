<?php
require_once 'db.php';

// Validar el input
$clase_id = filter_input(INPUT_GET, 'clase_id', FILTER_VALIDATE_INT);
if (!$clase_id) {
    die("Clase no válida.");
}

// Obtener los IDs de los equipos de la clase
$query_equipos_ids = "
    SELECT equipo_id
    FROM clase_equipos
    WHERE clase_id = :clase_id
";
$stmt_equipos_ids = $pdo->prepare($query_equipos_ids);
$stmt_equipos_ids->bindParam(':clase_id', $clase_id, PDO::PARAM_INT);
$stmt_equipos_ids->execute();
$equipos_ids = $stmt_equipos_ids->fetchAll(PDO::FETCH_COLUMN);

// Obtener los detalles de los equipos solo si existen
$equipos = [];
if (!empty($equipos_ids)) {
    $query_equipos_details = "
        SELECT equipo_id, nombre, marca, modelo
        FROM equipos
        WHERE equipo_id IN (" . implode(',', array_map('intval', $equipos_ids)) . ")
    ";
    $stmt_equipos_details = $pdo->prepare($query_equipos_details);
    $stmt_equipos_details->execute();
    $equipos = $stmt_equipos_details->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipos de la Clase</title>
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
        <h1>Equipos de la Clase</h1>
        <div class="add-equipo-button">
            <form action="elegirequipo.php" method="get">
                <input type="hidden" name="clase_id" value="<?= htmlspecialchars($clase_id) ?>">
                <button type="submit" class="btn">Añadir Equipo</button>
            </form>
        </div>
        <table>
            <thead>
                <tr>
                    <th>ID del Equipo</th>
                    <th>Nombre</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($equipos)): ?>
                    <tr>
                        <td colspan="5">No hay equipos asignados a esta clase.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($equipos as $equipo): ?>
                        <tr>
                            <td><?= htmlspecialchars($equipo['equipo_id']) ?></td>
                            <td><?= htmlspecialchars($equipo['nombre']) ?></td>
                            <td><?= htmlspecialchars($equipo['marca']) ?></td>
                            <td><?= htmlspecialchars($equipo['modelo']) ?></td>
                            <td>
                                <form action="eliminar_equipo_clase.php" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de eliminar este equipo de la clase?');">
                                    <input type="hidden" name="equipo_id" value="<?= $equipo['equipo_id'] ?>">
                                    <input type="hidden" name="clase_id" value="<?= $clase_id ?>">
                                    <button type="submit" class="btn btn-delete" style="color: red;" >Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
