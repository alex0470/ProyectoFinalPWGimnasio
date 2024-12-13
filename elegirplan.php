<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    // Si no hay sesión activa, redirigir al login
    header("Location: login.php");
    exit;
}

// Datos del usuario desde la sesión

$usuario = $_SESSION['usuario'];
$id = $usuario['id'];
$nombre = $usuario['nombre'];
$apellidos = $usuario['apellidos'];
$correo = $usuario['correo'];
$telefono = $usuario['telefono'];
$direccion = $usuario['direccion'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleccionar membresia</title>
    <link rel="stylesheet" href="css/elegirplan.css">
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
      
      <div>
        <h1 class="h1-bajo">Elige tu plan</h1>
        <h1 class="h1">Elige tu plan</h1>
      </div>

      <div class="planes">
        <div class="planes-img">
            <img src="https://i0.wp.com/blog.smartfit.com.mx/wp-content/uploads/2021/05/gimnasios-definicion-e-historia-1.jpg?fit=1200%2C675&ssl=1" alt="">
            <div class="overlay"></div>
        </div>
        <div class="contenidoPlanes">
          <p class="titulo">Básico</p>
          <p class="beneficios"><ul>
            <li>Acceso al gimnasio</li>	
            <li>Estacionamiento</li>
            <li class="transp"></li>
            <li class="transp"></li>			
        </ul></p>
          <button class="planes-button" onclick="seleccionarPlan('Básico', 199)">$199</button>
        </div>
      </div>

      <div class="planes">
        <div class="planes-img">
            <img src="https://www.trainingforgold.es/images/easyblog_articles/88/b2ap3_large_cuantos-dias-entrenar-semana.jpg   " alt="">
            <div class="overlay"></div>
        </div>
        <div class="contenidoPlanes">
          <p class="titulo">Especial</p>
          <p class="beneficios">
            <ul>
                Plan Básico +
            <li>Clases grupales</li>	
            <li class="transp"></li>
            <li class="transp"></li>	
        </ul></p>
          <button class="planes-button" onclick="seleccionarPlan('Especial', 299)">$299</button>
        </div>
      </div>

      <div class="planes">
        <div class="planes-img">
            <img src="https://www.unir.net/wp-content/uploads/2023/08/monitordegimnasio2.webp" alt="">
            <div class="overlay"></div>
        </div>
        <div class="contenidoPlanes">
          <p class="titulo">Gold</p>
          <p class="beneficios">
            <ul>
                Plan Especial +
            <li>Acceso a piscinas</li>	
            <li>Eventos exclusivos</li>
            <li>Entrenador personal</li>			
        </ul></p>
          <button class="planes-button" onclick="seleccionarPlan('Gold', 399)">$399</button>
        </div>
      </div>

      <div class="planes">
        <div class="planes-img">
            <img src="https://phantom-marca.unidadeditorial.es/905ead84896d6a35de1bde51ccd89dc2/resize/660/f/webp/assets/multimedia/imagenes/2023/06/18/16871106421563.jpg" alt="">
            <div class="overlay"></div>
        </div>
        <div class="contenidoPlanes">
          <p class="titulo">Platinum</p>
          <p class="beneficios">
            <ul>
                Plan Gold +
            <li>Nutriologo</li>	
            <li>Masajes</li>
            <li>Acceso a sauna</li>			
        </ul></p>
          <button class="planes-button" onclick="seleccionarPlan('Platinum', 499)">$499</button>
        </div>
      </div>
    <script src="js/index.js" defer></script>
    <script src="js/elegirplan.js" defer></script>
</body>
</html>