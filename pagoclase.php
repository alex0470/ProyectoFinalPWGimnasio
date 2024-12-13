<?php
session_start(); 

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}
$usuario = $_SESSION['usuario'];
$nombre = htmlspecialchars($usuario['nombre']);
$apellidos = htmlspecialchars($usuario['apellidos']);
$correo = htmlspecialchars($usuario['correo']);
$role = isset($usuario['role']) ? $usuario['role'] : 'usuario'; 

require 'db.php'; 

$usuario_id = $usuario['id']; 

$stmt = $pdo->prepare("SELECT nombre_c FROM membresias WHERE usuario_id = :usuario_id");
$stmt->bindParam(':usuario_id', $usuario_id);
$stmt->execute();
$membresia = $stmt->fetch(PDO::FETCH_ASSOC);

$nombre_membresia = $membresia['nombre_c'] ?? 'Basic'; 

$descuentos = [
    'Basic' => 0,
    'Especial' => 0.5,
    'Gold' => 0.7,
    'Platinum' => 1
];

// Verificar si los parámetros id y precio están disponibles en la URL
if (isset($_GET['id']) && isset($_GET['precio'])) {
    // Escapar valores para evitar vulnerabilidades (ej. XSS)
    $clase_id = htmlspecialchars($_GET['id']);
    $precio = htmlspecialchars($_GET['precio']);
} else {
    // Depuración: Mostrar error si faltan los parámetros
    echo "<p style='color: red;'>Error: No se recibieron los parámetros 'id' y 'precio' en la URL.</p>";
    echo "<p>URL actual: " . htmlspecialchars($_SERVER['REQUEST_URI']) . "</p>";
    exit;
}
$descuento = $descuentos[$nombre_membresia] ?? 0;

$precio_final = $precio * (1 - $descuento);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagar Clase</title>
    <link rel="stylesheet" href="css/registclase.css">
</head>
<body>
    <header>
        <div class="logo">
          <img alt="Logo EliteFitness" src="assets/logo.png">   
          <a href="index.php">EliteFitness</a>
        </div>
        <nav class="navbar">
          <ul>
            <li><div><button class="usuario" id="btnUsuario">
                <svg
                  class="icon"
                  stroke="white"
                  fill="white"
                  stroke-width="0"
                  viewBox="0 0 24 24"
                  height="1em"
                  width="1em"
                  xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="M12 2.5a5.5 5.5 0 0 1 3.096 10.047 9.005 9.005 0 0 1 5.9 8.181.75.75 0 1 1-1.499.044 7.5 7.5 0 0 0-14.993 0 .75.75 0 0 1-1.5-.045 9.005 9.005 0 0 1 5.9-8.18A5.5 5.5 0 0 1 12 2.5ZM8 8a4 4 0 1 0 8 0 4 4 0 0 0-8 0Z"
                  ></path>
                </svg>
              </button>
              <div id="offcanvas-menu" class="menu">
                   <button id="close-menu" class="close-button">✖</button>
                   <nav>
                   <ul>
                       <?php if ($usuarioLogueado): ?>
                       <h2 class="usuario-nombre">Bienvenido, <?= htmlspecialchars($usuarioLogueado) ?></h2>
                       <?php if ($role == 'personal'): ?>
                         <h3><a href="personal_dashboard.php">Panel de Personal</a></h3> <!-- Menú solo para personal -->
                         <li><a href="crearcuenta.php">Crear Cuenta</a></li>
                         <li><a href="horarioclases.php">Clases</a></li>
                         <li><a href="inventario.php">Inventario</a></li>
                         <li><a href="clientes.php">Clientes</a></li>
                       <?php else: ?>
                         <!-- Otras opciones para usuarios no 'personal' -->
                         <li><a href="perfil.php">Mi Perfil</a></li>
                         <li><a href="mailto:info@tugimnasio.com?subject=Consulta%20sobre%20membresías&body=Hola,%20quisiera%20más%20información%20sobre%20las%20membresías.">Contáctanos</a></li>
                         <li><a href="logout.php">Cerrar Sesión</a></li>
                       <?php endif; ?>
                       <?php else: ?>
                       <li><a href="login.php">Iniciar Sesión</a></li>
                       <?php endif; ?>
                   </ul>
                   </nav>
              </div>
            </div></li>
          </ul>
        </nav>
    </header>
    
    <div class="payment-container">
        <h2>Confirmar Inscripción</h2>
        <p><strong>Precio:</strong> $<span id="price"><?= number_format($precio_final, 2) ?></span></p>
        <p><strong>Membresía:</strong> <?= htmlspecialchars($nombre_membresia) ?></p>
        <label for="coupon">Cupón:</label>
        <input type="text" id="coupon" placeholder="Ingresa tu cupón">
        <button id="apply-coupon">Aplicar Cupón</button>

        <h3>Formulario de Pago</h3>
    <form id="payment-form" class="payment-form" action="inscribirse.php" method="POST">
            <input type="hidden" name="clase_id" value="<?= $clase_id ?>">
            <label for="card-number">Número de Tarjeta:</label>
            <input type="text" id="card-number" required>
            <label for="card-expiry">Fecha de Expiración:</label>
            <input type="month" id="card-expiry" required>
            <label for="card-cvv">CVV:</label>
            <input type="text" id="card-cvv" required>
            <button type="submit">Pagar</button>
        </form>
    </div>

</body>
</html>
