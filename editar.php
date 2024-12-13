<?php
require_once 'db.php';

// Validar el id del cliente
$cliente_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$cliente_id) {
    die("Cliente no v芍lido.");
}

// Obtener los detalles del cliente
$query_cliente = "
    SELECT id, nombre, apellidos, correo, telefono, direccion, fecha_nacimiento, foto_perfil
    FROM usuarios
    WHERE id = :id
";
$stmt_cliente = $pdo->prepare($query_cliente);
$stmt_cliente->bindParam(':id', $cliente_id, PDO::PARAM_INT);
$stmt_cliente->execute();
$cliente = $stmt_cliente->fetch(PDO::FETCH_ASSOC);

// Si el cliente no existe
if (!$cliente) {
    die("Cliente no encontrado.");
}

// Si el formulario es enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del cliente
    $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
    $apellidos = filter_input(INPUT_POST, 'apellidos', FILTER_SANITIZE_STRING);
    $correo = filter_input(INPUT_POST, 'correo', FILTER_VALIDATE_EMAIL);
    $telefono = filter_input(INPUT_POST, 'telefono', FILTER_SANITIZE_STRING);
    $direccion = filter_input(INPUT_POST, 'direccion', FILTER_SANITIZE_STRING);
    $fecha_nacimiento = filter_input(INPUT_POST, 'fecha_nacimiento', FILTER_SANITIZE_STRING);
    $foto_perfil = filter_input(INPUT_POST, 'foto_perfil', FILTER_SANITIZE_URL);

    // Actualizar los datos del cliente
    $query_update_cliente = "
        UPDATE usuarios
        SET nombre = :nombre, apellidos = :apellidos, correo = :correo, telefono = :telefono,
            direccion = :direccion, fecha_nacimiento = :fecha_nacimiento, foto_perfil = :foto_perfil
        WHERE id = :id
    ";
    $stmt_update_cliente = $pdo->prepare($query_update_cliente);
    $stmt_update_cliente->bindParam(':nombre', $nombre);
    $stmt_update_cliente->bindParam(':apellidos', $apellidos);
    $stmt_update_cliente->bindParam(':correo', $correo);
    $stmt_update_cliente->bindParam(':telefono', $telefono);
    $stmt_update_cliente->bindParam(':direccion', $direccion);
    $stmt_update_cliente->bindParam(':fecha_nacimiento', $fecha_nacimiento);
    $stmt_update_cliente->bindParam(':foto_perfil', $foto_perfil);
    $stmt_update_cliente->bindParam(':id', $cliente_id);
    $stmt_update_cliente->execute();

    // Redirigir a la lista de clientes
    header("Location: clientes.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="css/crearcuenta.css">
    <link rel="icon" href="assets/logo.png">
</head>
<body>
    <div class="crear-container">
        <p>Editar Usuario</p>
        <form method="POST" class="login-form">
            <label for="nombre">Nombre(s)</label>
            <input type="text" name="nombre" id="nombre" value="<?= htmlspecialchars($cliente['nombre']) ?>" required>

            <label for="apellidos">Apellidos</label>
            <input type="text" name="apellidos" id="apellidos" value="<?= htmlspecialchars($cliente['apellidos']) ?>" required>

            <label for="correo">Correo</label>
            <input type="email" name="correo" id="correo" value="<?= htmlspecialchars($cliente['correo']) ?>" required>

            <label for="telefono">Teléfono</label>
            <input type="text" name="telefono" id="telefono" value="<?= htmlspecialchars($cliente['telefono']) ?>" required>

            <label for="direccion">Dirección</label>
            <input type="text" name="direccion" id="direccion" value="<?= htmlspecialchars($cliente['direccion']) ?>" required>

            <label for="fecha_nacimiento">Fecha de nacimiento</label>
            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" value="<?= htmlspecialchars($cliente['fecha_nacimiento']) ?>" required>
                
            <button type="submit" class="reg-button">Actualizar</button>
        </form>
    </div>
</body>
</html>
