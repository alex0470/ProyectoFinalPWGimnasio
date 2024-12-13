<?php
session_start();
// Verifica que la sesión y la variable 'usuario' estén definidas antes de acceder a sus valores
if (isset($_SESSION['usuario'])) {
    $usuario = $_SESSION['usuario'];
    $nombre = htmlspecialchars($usuario['nombre']);
    $apellidos = htmlspecialchars($usuario['apellidos']);
    $correo = htmlspecialchars($usuario['correo']);
    $role = isset($usuario['role']) ? $usuario['role'] : 'usuario';
} else {
    // Si no hay sesión activa, redirige al login
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Política de Privacidad</title>
    <link rel="stylesheet" href="css/general.css">
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
                        <?php if (isset($usuario)): ?>
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

    <main class="container">
        <h1>Política de Privacidad</h1>
        <p><strong>Última actualización:</strong> 1 de diciembre de 2024</p>
        <p>En EliteFitness respetamos tu privacidad. Esta política describe cómo manejamos y protegemos tu información al usar este sitio web.</p>
        
        <h2>1. Información recopilada</h2>
        <p>Como parte de este proyecto educativo, no recopilamos ni almacenamos datos personales reales. Todos los datos ingresados son ficticios y no se registran en bases de datos.</p>
        
        <h2>2. Uso de datos</h2>
        <p>Los datos proporcionados son únicamente utilizados para simulaciones relacionadas con las funcionalidades del proyecto. No existe ningún uso comercial ni distribución de esta información.</p>
        
        <h2>3. Seguridad</h2>
        <p>Implementamos medidas simuladas de seguridad para proteger la información ficticia ingresada. No obstante, dado que este proyecto es educativo, no garantizamos una protección real.</p>

        <h2>4. Cookies</h2>
        <p>Este sitio puede simular el uso de cookies para mejorar la experiencia del usuario. Estas cookies no recopilan información real ni son funcionales fuera del entorno educativo.</p>

        <h2>5. Cambios en la política</h2>
        <p>Nos reservamos el derecho de modificar esta política en cualquier momento. Publicaremos las actualizaciones en esta página.</p>

        <p>Si tienes preguntas sobre esta política, contáctanos en: <a href="mailto:elitefitness@fcb6c319ac5542447.temporary.link">elitefitness@fcb6c319ac5542447.temporary.link</a></p>
    </main>
    <footer>
        <p>&copy; 2024 EliteFitness - Proyecto educativo.</p>
    </footer>

    <script src="js/index.js" defer></script>
</body>
</html>
