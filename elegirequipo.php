<?php
require_once 'db.php';

// Obtener los detalles de todos los usuarios para el navbar
$query_equipos = "
    SELECT equipo_id, nombre, marca, modelo
    FROM equipos
";
$stmt_equipos = $pdo->prepare($query_equipos);
$stmt_equipos->execute();
$equipos = $stmt_equipos->fetchAll(PDO::FETCH_ASSOC);

$clase_id = filter_input(INPUT_GET, 'clase_id', FILTER_VALIDATE_INT);
if (!$clase_id) {
    die("Faltan datos necesarios. No se ha proporcionado un ID de clase.");
}
// Validar que se haya pasado un ID de usuario
$equipo_id = filter_input(INPUT_GET, 'equipo_id', FILTER_VALIDATE_INT);
$equipo = null;

if ($equipo_id) {
    // Detalles del equipo seleccionado
    $query_equipo_details = "
        SELECT equipo_id, nombre, marca, modelo
        FROM equipos
        WHERE equipo_id = :equipo_id
    ";
    $stmt_equipo_details = $pdo->prepare($query_equipo_details);
    $stmt_equipo_details->bindParam(':equipo_id', $equipo_id, PDO::PARAM_INT);
    $stmt_equipo_details->execute();
    $equipo = $stmt_equipo_details->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Equipo a la Clase</title>
    <link rel="stylesheet" href="css/crearcuenta.css">
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

    <div class="crear-container">
        <button class="x" id="cerrar-btn">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
        <p>Añadir Equipo a la Clase</p>
        <!-- Navbar de equipos -->
        <div class="user-navbar">
            <form action="elegirequipo.php" method="GET">
                <!-- Campo oculto para clase_id -->
                <input type="hidden" name="clase_id" value="<?= htmlspecialchars($clase_id) ?>">
                <label for="equipo_id">Seleccionar Equipo</label>
                <select name="equipo_id" id="equipo_id" onchange="this.form.submit()">
                    <option value="">-- Seleccionar --</option>
                    <?php foreach ($equipos as $equipo_item): ?>
                        <option value="<?= $equipo_item['equipo_id'] ?>" <?= ($equipo_item['equipo_id'] == $equipo_id) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($equipo_item['nombre'] . ' (' . $equipo_item['marca'] . ' ' . $equipo_item['modelo'] . ')') ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </form>
        </div>

        <!-- Formulario de detalles del equipo -->
        <?php if ($equipo): ?>
            <form action="guardar_equipo_clase.php" method="POST" class="login-form">
                <!-- Campo oculto para clase_id -->
                <input type="hidden" name="clase_id" value="<?= htmlspecialchars($clase_id) ?>">

                <!-- Campo oculto para equipo_id -->
                <input type="hidden" name="equipo_id" value="<?= htmlspecialchars($equipo_id) ?>">

                <label for="nombre">Nombre del Equipo</label>
                <input type="text" name="nombre" id="nombre" value="<?= htmlspecialchars($equipo['nombre']) ?>" readonly>

                <label for="marca">Marca</label>
                <input type="text" name="marca" id="marca" value="<?= htmlspecialchars($equipo['marca']) ?>" readonly>

                <label for="modelo">Modelo</label>
                <input type="text" name="modelo" id="modelo" value="<?= htmlspecialchars($equipo['modelo']) ?>" readonly>

                <!-- Botón para enviar el formulario -->
                <button type="submit" class="reg-button">Añadir Equipo a la Clase</button>
            </form>
        <?php else: ?>
            <p>Por favor, seleccione un equipo para añadirlo a la clase.</p>
        <?php endif; ?>
    </div>
</body>
</html>