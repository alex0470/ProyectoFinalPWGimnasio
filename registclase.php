<?php
session_start(); // Reanudar la sesión

if (!isset($_SESSION['usuario'])) {
    // Si no hay sesión activa, redirigir al login
    header("Location: login.php");
    exit;
}

// Acceso a los datos del usuario
$usuario = $_SESSION['usuario'];
$id = htmlspecialchars($usuario['id']);
$nombre = htmlspecialchars($usuario['nombre']);
$apellidos = htmlspecialchars($usuario['apellidos']);
$correo = htmlspecialchars($usuario['correo']);
$role = isset($usuario['role']) ? $usuario['role'] : 'usuario';

// Incluir el archivo de conexión a la base de datos
require 'db.php';

// Corregir la consulta SQL para usar la tabla clase_clientes
$stmt = $pdo->prepare("
    SELECT * 
    FROM clases 
    WHERE clase_id NOT IN (
        SELECT clase_id 
        FROM clase_clientes 
        WHERE cliente_id = :usuario_id
    ) 
    ORDER BY nombre ASC
");

// Asociar el parámetro correctamente y ejecutar la consulta
$stmt->bindParam(':usuario_id', $usuario['id'], PDO::PARAM_INT);
$stmt->execute();

// Obtener todas las clases disponibles
$clases = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Verifica si hay clases disponibles
if ($clases) {
    // Mostrar las clases disponibles (esto es solo un ejemplo)
    foreach ($clases as $clase) {
        echo "Clase: " . htmlspecialchars($clase['nombre']) . "<br>";
    }
} else {
    echo "No hay clases disponibles para este usuario.";
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clases</title>
    <link rel="stylesheet" href="css/registclase.css">
    <link rel="icon" href="assets/logo.png">
</head>
<body>
    <header>
        <!-- Cabecera -->
        <div class="logo">
            <img alt="Logo EliteFitness" src="assets/logo.png">   
            <a href="index.php">EliteFitness</a>
        </div>
        <nav class="navbar">
            <ul>
                <li>
                    <div><button class="usuario" id="btnUsuario">
                        <svg class="icon" stroke="white" fill="white" viewBox="0 0 24 24" height="1em" width="1em">
                            <path d="M12 2.5a5.5 5.5 0 0 1 3.096 10.047 9.005 9.005 0 0 1 5.9 8.181.75.75 0 1 1-1.499.044 7.5 7.5 0 0 0-14.993 0 .75.75 0 0 1-1.5-.045 9.005 9.005 0 0 1 5.9-8.18A5.5 5.5 0 0 1 12 2.5ZM8 8a4 4 0 1 0 8 0 4 4 0 0 0-8 0Z"></path>
                        </svg>
                    </button>
                    <div id="offcanvas-menu" class="menu">
                        <button id="close-menu" class="close-button">✖</button>
                        <nav>
                            <ul>
                                <h2 class="usuario-nombre">Bienvenido, <?= $nombre . ' ' . $apellidos ?></h2>
                                <?php if ($role == 'personal'): ?>
                                    <h3>Panel de Personal</h3>
                                    <li><a href="perfil.php">Mi Perfil</a></li>
                                    <li><a href="crearcuenta.php">Crear Cuenta</a></li>
                                    <li><a href="horarioclases.php">Clases</a></li>
                                    <li><a href="inventario.php">Inventario</a></li>
                                    <li><a href="clientes.php">Clientes</a></li>
                                    <li><a href="logout.php">Cerrar Sesión</a></li>
                                <?php else: ?>
                                    <li><a href="perfil.php">Mi Perfil</a></li>
                                    <li><a href="elegirplan.php">Cambiar membresía</a></li>
                                    <li><a href="mailto:info@tugimnasio.com">Contáctanos</a></li>
                                    <li><a href="logout.php">Cerrar Sesión</a></li>
                                <?php endif; ?>
                            </ul>
                        </nav>
                    </div>
                </li>
            </ul>
        </nav>
    </header>

    <div class="class-container">
        <?php foreach ($clases as $clase): ?>
            <div class="class">
                <h2><?= htmlspecialchars($clase['nombre']) ?></h2>
                <div class="class-content">
                    <?php if (!empty($clase['imagen'])): ?>
                        <img src="<?= htmlspecialchars($clase['imagen']) ?>" alt="Imagen de la clase" class="class-image">
                    <?php else: ?>
                        <img src="assets/default-class.jpg" alt="Imagen predeterminada de la clase" class="class-image">
                    <?php endif; ?>
                    <div class="class-details">
                        <p><strong>Instructor:</strong> <?= htmlspecialchars($clase['instructor']) ?></p>
                        <p><strong>Capacidad:</strong> <?= htmlspecialchars($clase['cupo_actual']) ?>/<?= htmlspecialchars($clase['cupo_maximo']) ?></p>
                        <p><strong>Horario:</strong> <?= htmlspecialchars($clase['horario']) ?></p>
                        <p><strong>Días:</strong> <?= htmlspecialchars($clase['dias_semana']) ?></p>
                        <p><strong>Costo:</strong> $<?= htmlspecialchars($clase['costo']) ?></p>
                    </div>
                </div>
                <button class="btn-inscribir" data-price="<?= $clase['costo'] ?>" data-id="<?= $clase['clase_id'] ?>">Inscribirse</button>
            </div>
        <?php endforeach; ?>
    </div>
    <script src="js/index.js" defer></script>
    <script src="js/registclase.js" defer></script>
</body>
</html>

