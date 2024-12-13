<?php
require_once 'db.php';

// Obtener los detalles de todos los usuarios para el navbar
$query_usuarios = "
    SELECT id, nombre, apellidos
    FROM usuarios
";
$stmt_usuarios = $pdo->prepare($query_usuarios);
$stmt_usuarios->execute();
$usuarios = $stmt_usuarios->fetchAll(PDO::FETCH_ASSOC);

$clase_id = filter_input(INPUT_GET, 'clase_id', FILTER_VALIDATE_INT);
if (!$clase_id) {
    die("Faltan datos necesarios. No se ha proporcionado un ID de clase.");
}
// Validar que se haya pasado un ID de usuario
$usuario_id = filter_input(INPUT_GET, 'usuario_id', FILTER_VALIDATE_INT);
$usuario = null;

if ($usuario_id) {
    // Obtener los detalles del usuario seleccionado
    $query_usuario_details = "
        SELECT nombre, apellidos, correo, telefono, direccion, fecha_nacimiento, foto_perfil
        FROM usuarios
        WHERE id = :usuario_id
    ";
    $stmt_usuario_details = $pdo->prepare($query_usuario_details);
    $stmt_usuario_details->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
    $stmt_usuario_details->execute();
    $usuario = $stmt_usuario_details->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Cliente a la Clase</title>
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
        <p>Añadir Cliente a la Clase</p>
        <!-- Navbar de usuarios -->
        <div class="user-navbar">
          <form action="addcliente.php" method="GET">
             <!-- Campo oculto para clase_id -->
            <input type="hidden" name="clase_id" value="<?= htmlspecialchars($clase_id) ?>">
            <label for="usuario_id">Seleccionar Cliente</label>
            <select name="usuario_id" id="usuario_id" onchange="this.form.submit()">
                <option value="">-- Seleccionar --</option>
                <?php foreach ($usuarios as $usuario_item): ?>
                    <option value="<?= $usuario_item['id'] ?>" <?= ($usuario_item['id'] == $usuario_id) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($usuario_item['nombre'] . ' ' . $usuario_item['apellidos']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </form>
        </div>
        <!-- Formulario de detalles del cliente -->
        <?php if ($usuario): ?>
        <form action="guardar_cliente_clase.php" method="POST" class="login-form">
            <!-- Campo oculto para clase_id -->
            <input type="hidden" name="clase_id" value="<?= htmlspecialchars($clase_id) ?>">
        
            <!-- Campo oculto para usuario_id -->
            <input type="hidden" name="usuario_id" value="<?= htmlspecialchars($usuario_id) ?>">
        
            <label for="nombre">Nombre(s)</label>
            <input type="text" name="nombre" id="nombre" value="<?= htmlspecialchars($usuario['nombre']) ?>" readonly>
        
            <label for="apellidos">Apellidos</label>
            <input type="text" name="apellidos" id="apellidos" value="<?= htmlspecialchars($usuario['apellidos']) ?>" readonly>
        
            <label for="correo">Correo</label>
            <input type="email" name="correo" id="correo" value="<?= htmlspecialchars($usuario['correo']) ?>" readonly>
        
            <label for="telefono">Teléfono</label>
            <input type="text" name="telefono" id="telefono" value="<?= htmlspecialchars($usuario['telefono']) ?>" readonly>
        
            <label for="direccion">Dirección</label>
            <input type="text" name="direccion" id="direccion" value="<?= htmlspecialchars($usuario['direccion']) ?>" readonly>
        
            <label for="fecha_nacimiento">Fecha de nacimiento</label>
            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" value="<?= htmlspecialchars($usuario['fecha_nacimiento']) ?>" readonly>
        
            <!-- Botón para enviar el formulario -->
            <button type="submit" class="reg-button">Añadir Cliente a la Clase</button>
        </form>

        <?php else: ?>
            <p>Por favor, seleccione un cliente para añadirlo a la clase.</p>
        <?php endif; ?>
    </div>
</body>
</html>
