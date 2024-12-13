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
    <title>Conócenos</title>
    <link rel="stylesheet" href="css/conocenos.css">
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
    
    <section class="about-section">
        <div class="about-text">
            <h2>¿Quiénes somos?</h2>
            <p>Somos un gimnasio dedicado a transformar vidas a través del deporte, la salud y la comunidad. Con más de 10 años de experiencia, hemos construido un espacio inclusivo donde personas de todas las edades y niveles de condición física pueden alcanzar sus metas.</p>
            <p>Nuestro equipo está formado por entrenadores certificados, nutriólogos y personal comprometido en brindarte la mejor experiencia. Nos apasiona verte alcanzar tus objetivos.</p>
        </div>
        <div class="about-image">
            <img src="https://gymfactory.net/wp-content/uploads/2023/09/Basic-Fit-800x600.jpg" alt="Interior del gimnasio">
        </div>
    </section>

    <section class="team-section">
        <h2>Conoce a nuestro equipo</h2>
        <div class="team-container">
            <div class="team-card">
                <img src="https://mercadofitness.com/wp-content/uploads/2021/09/Dos-certificaciones-norteamericanas-de-entrenadores-llegan-a-Centroamerica-1.jpg" alt="Entrenador 1">
                <h3>Juan Pérez</h3>
                <p>Entrenador personal</p>
            </div>
            <div class="team-card">
                <img src="https://img.freepik.com/fotos-premium/entrenador-personal-fitness-femenino-joven-bloc-notas-pie-gimnasio_146671-31576.jpg" alt="Entrenadora 2">
                <h3>María López</h3>
                <p>Especialista en nutrición</p>
            </div>
            <div class="team-card">
                <img src="https://media.licdn.com/dms/image/v2/D4E03AQFayr0G3k4f2w/profile-displayphoto-shrink_200_200/profile-displayphoto-shrink_200_200/0/1680573253951?e=2147483647&v=beta&t=qpLpn8pTGfvJPXwB2wdMyXH36wXt1x2Xew7HhPzn24A" alt="Entrenador 3">
                <h3>Carlos Ramírez</h3>
                <p>Coach de fuerza</p>
            </div>
        </div>
    </section>

    <section class="team-section">
      <h2>Sitio web elaborado por:</h2>
      <div class="team-container">
          <div class="team-card">
              <img src="https://media-mty2-1.cdn.whatsapp.net/v/t61.24694-24/445907807_1221062605615281_4892983253851406448_n.jpg?stp=dst-jpg_tt6&ccb=11-4&oh=01_Q5AaIE0jEzw1Jm0P4FGbiZ0ddF9TY11AbOl_6XQVexnK5El4&oe=675B4FE1&_nc_sid=5e03e0&_nc_cat=101" alt="zanella">
              <h3>Alfredo Enriquez Zanella</h3>
          </div>
          <div class="team-card">
            <img src="assets/evelyn.jpg" alt="Evelyn">
            <h3>Evelyn Magaly Garcia Azua</h3>
        </div>
        <div class="team-card">
          <img src="https://mercadofitness.com/wp-content/uploads/2021/09/Dos-certificaciones-norteamericanas-de-entrenadores-llegan-a-Centroamerica-1.jpg" alt="Entrenador 1">
          <h3>Angel Martinez Benjamin</h3>
      </div>
          <div class="team-card">
              <img src="assets/alex.jpg" alt="Alexander">
              <h3>Silvestre Alexander Olvera Rocha</h3>
          </div>
          <div class="team-card">
              <img src="assets/geova.jpg" alt="Geovani">
              <h3>Geovani Jael Torres Mata</h3>
          </div>
      </div>
  </section>

  <div class="footer">
    <div class="logo">
      <img alt="Logo EliteFitness" src="assets/logo.png">   
      <a href="index.html">EliteFitness</a>
    </div>
    <nav class="navbar">
      <ul>
        <li><a href="terminos.php">Términos y Condiciones</a></li>
        <li><a href="privacidad.php">Politica de Privacidad</a></li>
      </ul>
    </nav>
  </div>
  
  <div class="card">
    <a href="https://www.instagram.com/gym.elite.fitness/" target="_blank" class="socialContainer containerOne">
      <svg class="socialSvg instagramSvg" viewBox="0 0 16 16">
        <path
          d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"
        ></path>
      </svg>
    </a>
  
    <a href="https://www.tiktok.com/@elitefitness82" target="_blank" class="socialContainer containerTwo">
      <svg
        class="socialSvg tiktokSvg largeIcon"
        viewBox="0 0 48 48"
        version="1.1"
        xmlns="http://www.w3.org/2000/svg"
        xmlns:xlink="http://www.w3.org/1999/xlink"
      >
        <title>Tiktok</title>
        <g
          id="Icon/Social/tiktok-white"
          stroke="none"
          stroke-width="1"
          fill="none"
          fill-rule="evenodd"
        >
          <path
            d="M38.0766847,15.8542954 C36.0693906,15.7935177 34.2504839,14.8341149 32.8791434,13.5466056 C32.1316475,12.8317108 31.540171,11.9694126 31.1415066,11.0151329 C30.7426093,10.0603874 30.5453728,9.03391952 30.5619062,8 L24.9731521,8 L24.9731521,28.8295196 C24.9731521,32.3434487 22.8773693,34.4182737 20.2765028,34.4182737 C19.6505623,34.4320127 19.0283477,34.3209362 18.4461858,34.0908659 C17.8640239,33.8612612 17.3337909,33.5175528 16.8862248,33.0797671 C16.4386588,32.6422142 16.0833071,32.1196657 15.8404292,31.5426268 C15.5977841,30.9658208 15.4727358,30.3459348 15.4727358,29.7202272 C15.4727358,29.0940539 15.5977841,28.4746337 15.8404292,27.8978277 C16.0833071,27.3207888 16.4386588,26.7980074 16.8862248,26.3604545 C17.3337909,25.9229017 17.8640239,25.5791933 18.4461858,25.3491229 C19.0283477,25.1192854 19.6505623,25.0084418 20.2765028,25.0219479 C20.7939283,25.0263724 21.3069293,25.1167239 21.794781,25.2902081 L21.794781,19.5985278 C21.2957518,19.4900128 20.7869423,19.436221 20.2765028,19.4380839 C18.2431278,19.4392483 16.2560928,20.0426009 14.5659604,21.1729264 C12.875828,22.303019 11.5587449,23.9090873 10.7814424,25.7878401 C10.003907,27.666593 9.80084889,29.7339663 10.1981162,31.7275214 C10.5953834,33.7217752 11.5748126,35.5530237 13.0129853,36.9904978 C14.4509252,38.4277391 16.2828722,39.4064696 18.277126,39.8028054 C20.2711469,40.1991413 22.3382874,39.9951517 24.2163416,39.2169177 C26.0948616,38.4384508 27.7002312,37.1209021 28.8296253,35.4300711 C29.9592522,33.7397058 30.5619062,31.7522051 30.5619062,29.7188301 L30.5619062,18.8324027 C32.7275484,20.3418321 35.3149087,21.0404263 38.0766847,21.0867664 L38.0766847,15.8542954 Z"
            id="Fill-1"
            fill="#FFFFFF"
          ></path>
        </g>
      </svg>
    </a>
  
    <a href="https://www.facebook.com/profile.php?id=100094500117939&sk=about" target="_blank" class="socialContainer containerThree">
      <div>
        <svg
          class="socialSvg tiktokSvg largeIcon"
          width="44px"
          height="44px"
          viewBox="0 0 45 35"
          version="1.1"
          xmlns="http://www.w3.org/2000/svg"
          xmlns:xlink="http://www.w3.org/1999/xlink"
        >
          <title>Facebook</title>
          <g
            id="Icon/Social/facebook-black"
            stroke="none"
            stroke-width="1"
            fill="none"
            fill-rule="evenodd"
          >
            <path
              d="M30.0793333,40 L30.0793333,27.608 L34.239,27.608 L34.8616667,22.7783333 L30.0793333,22.7783333 L30.0793333,19.695 C30.0793333,18.2966667 30.4676667,17.344 32.4726667,17.344 L35.0303333,17.3426667 L35.0303333,13.0233333 C34.5876667,12.9646667 33.0696667,12.833 31.3036667,12.833 C27.6163333,12.833 25.0923333,15.0836667 25.0923333,19.2166667 L25.0923333,22.7783333 L20.922,22.7783333 L20.922,27.608 L25.0923333,27.608 L25.0923333,40 L30.0793333,40 Z M9.766,40 C8.79033333,40 8,39.209 8,38.234 L8,9.766 C8,8.79033333 8.79033333,8 9.766,8 L38.2336667,8 C39.209,8 40,8.79033333 40,9.766 L40,38.234 C40,39.209 39.209,40 38.2336667,40 L9.766,40 Z"
              id="Shape"
              fill="#FFFFFF"
            ></path>
          </g>
        </svg>
      </div>
    </a>
  
    <a href="#" class="socialContainer containerFour">
      <svg class="socialSvg whatsappSvg" viewBox="0 0 16 16">
        <path
          d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"
        ></path>
      </svg>
    </a>
  </div>
         
  </div>

    <script src="js/index.js" defer></script>
</body>
</html>
