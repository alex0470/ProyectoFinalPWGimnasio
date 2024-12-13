<?php
session_start(); 
$usuario = $_SESSION['usuario'];
$nombre = htmlspecialchars($usuario['nombre']);
$apellidos = htmlspecialchars($usuario['apellidos']);
$correo = htmlspecialchars($usuario['correo']);
$role = isset($usuario['role']) ? $usuario['role'] : 'usuario';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Cuenta</title>
    <link rel="stylesheet" href="css/crearcuenta.css">
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

  <div class="crear-container">
    <button class="x" id="cerrar-btn"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
      </svg></button>
    <p>Crear Cuenta</p>
    <form action="guardar-usuario.php" method="POST" class="login-form">
        <label for="nombre">Nombre(s)</label>
        <input type="text" name="nombre" id="nombre" placeholder="Ingrese su nombre" required>

        <label for="apellidos">Apellidos</label>
        <input type="text" name="apellidos" id="apellidos" placeholder="Ingrese sus apellidos" required>

        <label for="correo">Correo</label>
        <input type="email" name="correo" id="correo" placeholder="Ingrese su correo" required>

        <label for="telefono">Teléfono</label>
        <input type="text" name="telefono" id="telefono" placeholder="Ingrese su teléfono" required>

        <label for="direccion">Dirección</label>
        <input type="text" name="direccion" id="direccion" placeholder="Ingrese su dirección" required>

        <label for="fecha_nacimiento">Fecha de nacimiento</label>
        <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" required>

        <label for="contra">Contraseña</label>
        <input type="password" name="contra" id="contra" placeholder="Ingrese su contraseña" required>
        
        <button type="submit" class="reg-button">Crear cuenta</button>
    </form>
  </div>
<script src="js/login.js" defer></script>
<script src="js/index.js" defer></script>
</body>
</html>