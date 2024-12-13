<?php
require 'db.php'; 

if (isset($_GET['equipo_id'])) {
    $equipo_id = $_GET['equipo_id'];
    
    // Obtener los datos del equipo
    $sql = "SELECT * FROM equipos WHERE equipo_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$equipo_id]);
    $equipo = $stmt->fetch();

    if (!$equipo) {
        die("No se encontr¨® el equipo.");
    }
}

// Procesar la actualizaci¨®n de datos
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $estatus = $_POST['estatus'];

    // Actualizar el equipo
    $sql = "UPDATE equipos SET nombre = ?, marca = ?, modelo = ?, estatus = ? WHERE equipo_id = ?";
    $stmt = $pdo->prepare($sql);
    
    if ($stmt->execute([$nombre, $marca, $modelo, $estatus, $equipo_id])) {
            header("Location: inventario.php");
    } else {
        echo "Error al actualizar el equipo.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Equipo</title>
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
    <h1>Editar Equipo</h1>
    <form action="editar_equipo.php?equipo_id=<?= $equipo['equipo_id'] ?>" method="POST" class="login-form">
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($equipo['nombre']) ?>" required>

        <label for="marca">Marca</label>
        <input type="text" id="marca" name="marca" value="<?= htmlspecialchars($equipo['marca']) ?>" required>

        <label for="modelo">Modelo</label>
        <input type="text" id="modelo" name="modelo" value="<?= htmlspecialchars($equipo['modelo']) ?>" required>

        <label for="estatus">Estatus</label>
        <select id="estatus" name="estatus" required>
            <option value="Activo" <?= $equipo['estatus'] === 'Activo' ? 'selected' : '' ?>>Activo</option>
            <option value="Inactivo" <?= $equipo['estatus'] === 'Inactivo' ? 'selected' : '' ?>>Inactivo</option>
        </select>

        <button type="submit" class="reg-button">Actualizar Equipo</button>
    </form>
</div>

</body>
</html>
