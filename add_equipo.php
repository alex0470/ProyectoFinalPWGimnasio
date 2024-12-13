<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Equipo</title>
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
    <h1>Crear Nuevo Equipo</h1>
    
    <!-- Mostrar mensaje de ¨¦xito o error -->
    <?php if (!empty($message)): ?>
        <p><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <form action="guardarequipo.php" method="POST" class="login-form">
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" required>

        <label for="marca">Marca</label>
        <input type="text" id="marca" name="marca" required>

        <label for="modelo">Modelo</label>
        <input type="text" id="modelo" name="modelo" required>

        <label for="estatus">Estatus</label>
        <select id="estatus" name="estatus" required>
            <option value="Activo">Activo</option>
            <option value="Inactivo">Inactivo</option>
        </select>

        <button type="submit" class="reg-button">Crear Equipo</button>
    </form>
</div>

</body>
</html>

