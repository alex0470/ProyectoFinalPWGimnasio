<?php
require_once 'db.php';

// Consultar las clases desde la base de datos y ordenarlas alfabéticamente por nombre
$stmt = $pdo->prepare("SELECT * FROM clases ORDER BY LOWER(nombre) ASC");
$stmt->execute();
$clases = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clases del Gimnasio</title>
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
        <h1>Clases del Gimnasio</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Instructor</th>
                    <th>Cupo Actual</th>
                    <th>Cupo Máximo</th>
                    <th>Horario</th>
                    <th>Días de la Semana</th>
                    <th>Costo</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($clases as $clase): ?>
                    <tr>
                        <td><?= htmlspecialchars($clase['clase_id']) ?></td>
                        <td><?= htmlspecialchars($clase['nombre']) ?></td>
                        <td><?= htmlspecialchars($clase['instructor']) ?></td>
                        <td><?= htmlspecialchars($clase['cupo_actual']) ?></td>
                        <td><?= htmlspecialchars($clase['cupo_maximo']) ?></td>
                        <td><?= htmlspecialchars($clase['horario']) ?></td>
                        <td><?= htmlspecialchars($clase['dias_semana']) ?></td>
                        <td><?= htmlspecialchars($clase['costo']) ?></td>
                        <td>
                            <!-- Gestionar clientes -->
                            <form action="asistentes_clase.php" method="POST" style="display:inline;">
                                <input type="hidden" name="clase_id" value="<?= $clase['clase_id'] ?>">
                                <button type="submit">Gestionar Clientes</button>
                            </form> |
                            <!-- Gestionar equipo -->
                            <form action="equipos_en_clase.php" method="GET" style="display:inline;">
                                <input type="hidden" name="clase_id" value="<?= $clase['clase_id']; ?>">
                                <button type="submit">Gestionar equipo</button>
                            </form> |
                            <!-- Editar clase -->
                            <form action="editarclase.php" method="POST" style="display:inline;">
                                <input type="hidden" name="clase_id" value="<?= $clase['clase_id'] ?>">
                                <button type="submit">Editar</button>
                            </form> |
                            <!-- Eliminar clase -->
                            <form action="eliminar_clase.php" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de eliminar esta clase?');">
                                <input type="hidden" name="clase_id" value="<?= $clase['clase_id'] ?>">
                                <button type="submit" style="color: red;">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="create-class-btn">
            <form action="crearclase.php" method="POST">
                <button type="submit">Crear Nueva Clase</button>
            </form>
        </div>
    </div>
</body>
</html>
