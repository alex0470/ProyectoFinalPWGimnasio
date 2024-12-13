<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Iniciar Sesión</title>
  <link rel="stylesheet" href="css/login.css">
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
				<li><a href="conocenos.php">Conocenos</a></li>
				<li><a href="mailto:info@tugimnasio.com?subject=Consulta%20sobre%20membresías&body=Hola,%20quisiera%20más%20información%20sobre%20las%20membresías.">Contáctanos</a></li>
			  </ul>
			</nav>
		  </div>
		</div></li>
      </ul>
    </nav>
  </header>

    <div class="login-container">
        <button class="x" id="cerrar-btn"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
            </svg></button>
            <p>Iniciar Sesión</p>
 

        <form action="login_.php" method="POST" class="login-form">
        <label for="correo">Correo Electrónico:</label>
        <input type="email" name="correo" id="correo" required>
        <br>
        <label for="contra">Contraseña:</label>
        <input type="password" name="contra" id="contra" required>
        <br>
        <button type="submit" class="login-button">Ingresar</button>
          
          <div class="extra-actions">
            <a href="recuperacontra.php">¿Olvidaste tu contraseña?</a>
            <span> | </span>
            ¿No tienes cuenta?<a href="crearcuenta.php"> Crear una</a>
          </div>
        </form>
      </div>

    <script src="js/login.js" defer></script>
    <script src="js/index.js" defer></script>
     <script>
    document.getElementById('tab-usuario').addEventListener('click', function() {
      document.getElementById('role').value = 'usuario';
      document.getElementById('tab-usuario').classList.add('active');
      document.getElementById('tab-personal').classList.remove('active');
    });
    
    document.getElementById('tab-personal').addEventListener('click', function() {
      document.getElementById('role').value = 'personal';
      document.getElementById('tab-personal').classList.add('active');
      document.getElementById('tab-usuario').classList.remove('active');
    });
  </script>
</body>
</html>
