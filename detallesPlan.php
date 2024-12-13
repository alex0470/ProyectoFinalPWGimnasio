<?php
session_start(); // Reanudar la sesión

if (!isset($_SESSION['usuario'])) {
    // Si no hay sesión activa, redirigir al login
    header("Location: login.php");
    exit;
}

// Acceso a los datos del usuario
$usuario = $_SESSION['usuario'];
$nombre = htmlspecialchars($usuario['nombre']);
$apellidos = htmlspecialchars($usuario['apellidos']);
$correo = htmlspecialchars($usuario['correo']);
$role = isset($usuario['role']) ? $usuario['role'] : 'usuario'; // Ajusta esto según cómo manejes los roles
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de pago</title>
    <link rel="stylesheet" href="css/detallasPlan.css">
      <link rel="icon" href="assets/logo.png">

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
                  stroke="currentColor"
                  fill="currentColor"
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
                <?php if ($usuario): ?>
                    <h2 class="usuario-nombre">Bienvenido, <?= $nombre . ' ' . $apellidos ?></h2>
                    <?php if ($role == 'personal'): ?>
                        <h3>Panel de Personal</h3> <!-- Menú solo para personal -->
                        <li><a href="perfil.php">Mi Perfil</a></li>
                        <li><a href="crearcuenta.php">Crear Cuenta</a></li>
                        <li><a href="horarioclases.php">Clases</a></li>
                        <li><a href="inventario.php">Inventario</a></li>
                        <li><a href="clientes.php">Clientes</a></li>
                        <li><a href="logout.php">Cerrar Sesión</a></li>
                    <?php else: ?>
                        <!-- Otras opciones para usuarios no 'personal' -->
                        <li><a href="perfil.php">Mi Perfil</a></li>
                        <li><a href="elegirplan.php">Cambiar membresía</a></li>
                        <li><a href="registclase.php">Elegir clases</a></li>
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
    
    <div class="container">
        <h1>ELEGISTE EL PLAN <span id="name"></span></h1>
        <div><p class="price">Precio final: $<span id="price">0</span></p></div>
        <button class="confirmar" onclick="confirmSelection()">Confirmar Selección</button>
    </div>

    <div class="plan-options">
      <div class="plan-option">
          <input type="radio" name="payment-plan" value="day" data-multiplier="0.2" /> Por Día
      </div>
      <div class="plan-option">
          <input type="radio" name="payment-plan" value="week" data-multiplier="0.4" /> Por Semana
      </div>
      <div class="plan-option">
          <input type="radio" name="payment-plan" value="biweekly" data-multiplier="0.5" /> Por Quincena
      </div>
      <div class="plan-option">
          <input type="radio" name="payment-plan" value="month" data-multiplier="1" checked/> Por Mes
      </div>
      <div class="plan-option">
          <input type="radio" name="payment-plan" value="2months" data-multiplier="1.75" /> Por 2 Meses
      </div>
      <div class="plan-option">
          <input type="radio" name="payment-plan" value="halfyear" data-multiplier="5.75" /> Por Medio Año
      </div>
      <div class="plan-option">
          <input type="radio" name="payment-plan" value="year" data-multiplier="11.75" /> Por Año
      </div>
  </div>

<div id="payment-form" style="display: none;">
   <h2>Información de Pago</h2>
   <form action="procesapago.php" method="POST" id="card-payment-form" target="_blank">
      <!-- Información de pago -->
      <label for="card-holder">Nombre del titular:</label>
      <input type="text" id="card-holder" name="card-holder" required>
      
      <label for="card-number">Número de tarjeta:</label>
      <input type="text" id="card-number" name="card-number" maxlength="16" required>
      
      <label for="expiry-date">Fecha de expiración:</label>
      <input type="month" id="expiry-date" name="expiry-date" required>
      
      <label for="cvv">CVV:</label>
      <input type="text" id="cvv" name="cvv" maxlength="3" required>

      <!-- Campos ocultos -->
      <input type="hidden" name="usuario_id" value="<?= $usuario['id']; ?>">
      <input type="hidden" name="nombre_c" id="selected-plan-name">
      <input type="hidden" name="duracion" id="selected-plan-duration">

      <button type="submit">Procesar Pago</button>
   </form>
</div>


    <script src="js/index.js" defer></script>
    <script src="js/detallesplan.js" defer></script>
    <script src="js/planselec.js" defer></script>
</body>
</html>

