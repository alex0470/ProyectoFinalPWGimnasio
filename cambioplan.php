<?php
require_once 'db.php';

// Verificar si el ID del usuario fue pasado a través del formulario POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];

    // Obtener los datos del usuario
    $queryUsuario = "SELECT * FROM usuarios WHERE id = ?";
    $stmtUsuario = $pdo->prepare($queryUsuario);
    $stmtUsuario->execute([$id]);
    $usuario = $stmtUsuario->fetch(PDO::FETCH_ASSOC);

    // Obtener los datos actuales de la membresía, si existe
    $queryMembresia = "SELECT * FROM membresias WHERE usuario_id = ?";
    $stmtMembresia = $pdo->prepare($queryMembresia);
    $stmtMembresia->execute([$id]);
    $membresia = $stmtMembresia->fetch(PDO::FETCH_ASSOC);

    // Si se recibe el formulario de actualización (POST)
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nombre_c'])) {
        $nombre_c = $_POST['nombre_c'];
        $fecha_inscripcion = $_POST['fecha_inscripcion'];
        $fecha_vencimiento = $_POST['fecha_vencimiento'];

        try {
            // Iniciar transacción para actualizar la membresía
            $pdo->beginTransaction();

            // Si el usuario ya tiene membresía, actualizarla, si no, insertarla
            if ($membresia) {
                // Actualizar la membresía
                $queryUpdateMembresia = "UPDATE membresias SET nombre_c = ?, fecha_inscripcion = ?, fecha_vencimiento = ? WHERE usuario_id = ?";
                $stmtUpdateMembresia = $pdo->prepare($queryUpdateMembresia);
                $stmtUpdateMembresia->execute([$nombre_c, $fecha_inscripcion, $fecha_vencimiento, $id]);
            } else {
                // Insertar una nueva membresía
                $queryInsertMembresia = "INSERT INTO membresias (usuario_id, nombre_c, fecha_inscripcion, fecha_vencimiento) VALUES (?, ?, ?, ?)";
                $stmtInsertMembresia = $pdo->prepare($queryInsertMembresia);
                $stmtInsertMembresia->execute([$id, $nombre_c, $fecha_inscripcion, $fecha_vencimiento]);
            }

            // Confirmar transacción
            $pdo->commit();
            header("Location: clientes.php");
        } catch (Exception $e) {
            // Si ocurre un error, revertir los cambios
            $pdo->rollBack();
            echo "Error al actualizar la membresía: " . $e->getMessage();
        }
    }
} else {
    echo "ID de usuario no especificado.";
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Membresía</title>
    <link rel="stylesheet" href="css/crearcuenta.css"> <!-- Asegúrate de que el archivo CSS esté correctamente vinculado -->
</head>
<body>

    <div class="crear-container">
        <?php if ($usuario): ?>
            <h1><?= htmlspecialchars($usuario['nombre']) ?> <?= htmlspecialchars($usuario['apellidos']) ?></h1>
            <h2><?= $membresia ? 'Actualizar Membresía' : 'Asignar Nueva Membresía' ?></h2>
            
            <form action="cambioplan.php" method="POST" class="login-form">
                <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">

                <label for="nombre_c">Tipo de Membresía:</label>
                <select id="nombre_c" name="nombre_c" required>
                    <option value="Básico" <?= $membresia && $membresia['nombre_c'] === 'Básico' ? 'selected' : '' ?>>Básico</option>
                    <option value="Especial" <?= $membresia && $membresia['nombre_c'] === 'Especial' ? 'selected' : '' ?>>Especial</option>
                    <option value="Gold" <?= $membresia && $membresia['nombre_c'] === 'Gold' ? 'selected' : '' ?>>Gold</option>
                    <option value="Platinum" <?= $membresia && $membresia['nombre_c'] === 'Platinum' ? 'selected' : '' ?>>Platinum</option>
                </select>

                <label for="fecha_inscripcion">Fecha de Inscripción:</label>
                <input type="date" id="fecha_inscripcion" name="fecha_inscripcion" value="<?= $membresia ? htmlspecialchars($membresia['fecha_inscripcion']) : '' ?>" required>

                <label for="fecha_vencimiento">Fecha de Vencimiento:</label>
                <input type="date" id="fecha_vencimiento" name="fecha_vencimiento" value="<?= $membresia ? htmlspecialchars($membresia['fecha_vencimiento']) : '' ?>" required>

                <button type="submit" class="reg-button">Guardar Cambios</button>
            </form>
        <?php else: ?>
            <p>No se encontró un usuario con el ID proporcionado.</p>
        <?php endif; ?>
    </div>
</body>
</html>
