<?php
session_start(); 
$usuario = $_SESSION['usuario'];
$nombre = htmlspecialchars($usuario['nombre']);
$apellidos = htmlspecialchars($usuario['apellidos']);
$correo = htmlspecialchars($usuario['correo']);
$role = isset($usuario['role']) ? $usuario['role'] : 'usuario';

// Obtener el nombre de la membresía
$nombre_membresia = $membresia['nombre_c'] ?? 'Ninguna'; 

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&display=swap" rel="stylesheet">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EliteFitness</title>
  <link rel="stylesheet" href="css/index.css">
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
        <li><a href="#clases">Clases</a></li>
        <li><a href="#membresia">Membresías</a></li>
		<li><a href="conocenos.php">Conócenos</a></li>
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
                        <li><a href="clientes.php">Clientes</a></li>
                        <li><a href="horarioclases.php">Clases</a></li>
                        <li><a href="inventario.php">Inventario</a></li>
                        <li><a href="actualizarprecio.php">Actualizar precio</a></li>
                        <li><a href="crearcuenta.php">Crear Cuenta</a></li>
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

  <div class="img-container">
    <img class="img-inicio" src="https://media.gq.com.mx/photos/657a14cb018fcdc92224c4d8/16:9/w_2560%2Cc_limit/Ciclismo_en_grupo-1447561886.jpg" alt="Clase de ciclismo en grupo">
    <button class="inscribir-btn" id="inscribirBtn">
        <span class="shadow"></span>
        <span class="edge"></span>
        <div class="front">
          <span>¡Inscríbete ya!</span>
        </div>
      </button>
  </div><hr>

  <div class="pq-container">
	<h2 class="h2clases">¿Por que EliteFitness?</h2>
    <div class="pq-cont">
        <div class="descrip">
            <img class="img-descrip" src="https://cdn3d.iconscout.com/3d/premium/thumb/hombre-trabajando-en-el-gimnasio-7900647-6478385.png?f=webp&amp;h=700" alt="Hombre haciendo ejercicio en el gimnasio">
            <h3 class="h3-descrip">GRAN VARIEDAD DE ACTIVIDADES</h3><br>
            <p class="p-descrip">En EliteFitness no hay lugar para el aburrimiento</p>
        </div>
        <div class="descrip">
            <img class="img-descrip" src="https://cdn3d.iconscout.com/3d/premium/thumb/horario-5578999-4665720.png?f=webp&amp;h=700" alt="Grupo haciendo ejercicio">
            <h3 class="h3-descrip">AMPLIO HORARIO</h3><br>
            <p class="p-descrip">Trabajamos en el horario que más te conviene</p>
        </div>
        <div class="descrip">
            <img class="img-descrip" src="https://cdn3d.iconscout.com/3d/premium/thumb/mancuerna-7268668-5996679.png?f=webp&amp;h=700" alt="Monton de pesas">
            <h3 class="h3-descrip">VARIEDAD DE EQUIPO</h3><br>
            <p class="p-descrip">Nunca tendrás que esperar por máquinas</p>
        </div>
        <div class="descrip">
            <img class="img-descrip" src="https://cdn3d.iconscout.com/3d/premium/thumb/membresia-gimnasio-8507250-6740687.png" alt="tarjeta membresia">
            <h3 class="h3-descrip">MEMBRESÍAS SIN COMPROMISO</h3><br>
            <p class="p-descrip">Somos flexibles para ajustarnos a tus necesidades</p>
        </div>
        <div class="descrip">
            <img class="img-descrip" src="https://cdn3d.iconscout.com/3d/premium/thumb/personas-haciendo-ejercicio-en-el-gimnasio-7900645-6478383.png?f=webp&amp;h=700" alt="coach apoyando">
            <h3 class="h3-descrip">APOYO EN TU ENTRENAMIENTO</h3><br>
            <p class="p-descrip">Nuestros coaches siempre estan a tu disposición</p>
        </div>
      </div>
  </div>

  <h2 class="h2clases">Todas nuestras clases</h2>
  <div class="clases" id="clases">
    <div class="clase">
        <div class="overlay"></div>
        <img class="img-clases" src="https://media.gq.com.mx/photos/61d89745ed3f3306292cf419/master/w_2560%2Cc_limit/GettyImages-523352580.jpg" alt="personas haciendo cardio">
        <h2 class="texto-clase">CARDIO</h2>
        <h3 class="texto-claseb">CARDIO</h3>
        <h3 class="texto-claseb2">CARDIO</h3>
    </div>
  
    <div class="clase">
        <div class="overlay"></div>
        <img class="img-clases" src="https://p4.wallpaperbetter.com/wallpaper/62/261/107/pose-fitness-muscle-muscle-athlete-hd-wallpaper-preview.jpg" alt="hombre haciendo pesas">
        <h2 class="texto-clase">FUERZA</h2>
        <h3 class="texto-claseb">FUERZA</h3>
        <h3 class="texto-claseb2">FUERZA</h3>
    </div>
  
    <div class="clase">
        <div class="overlay"></div>
        <img class="img-clases" src="https://gymsaito.com/wp-content/uploads/2023/03/spinning-gymsaito.jpg" alt="personas haciendo spinning">
        <h2 class="texto-clase">SPINNING</h2>
        <h3 class="texto-claseb">SPINNING</h3>
        <h3 class="texto-claseb2">SPINNING</h3>
    </div>
  
    <div class="clase">
        <div class="overlay"></div>
        <img class="img-clases" src="https://pensamientoamplio.net/wp-content/uploads/comparacion-visual-de-gimnasio-y-pilates-scaled-1024x683.jpg" alt="mujer haciendo pilates">
        <h2 class="texto-clase">PILATES</h2>
        <h3 class="texto-claseb">PILATES</h3>
        <h3 class="texto-claseb2">PILATES</h3>
    </div>
  
    <div class="clase">
        <div class="overlay"></div>
        <img class="img-clases" src="https://go-fit.es/wp-content/uploads/2021/03/yoga-1024x684.jpg" alt="personas haciendo yoga">
        <h2 class="texto-clase">YOGA</h2>
        <h3 class="texto-claseb">YOGA</h3>
        <h3 class="texto-claseb2">YOGA</h3>
    </div>
  
    <div class="clase">
        <div class="overlay"></div>
        <img class="img-clases" src="https://s1.sportstatics.com/relevo/www/multimedia/202305/11/media/cortadas/viruzz-RHm4pEF5xtGJR42PAPxCJvJ-1200x648@Relevo.jpg?w=569&amp;h=320" alt="viruzz box">
        <h2 class="texto-clase">BOX</h2>
        <h3 class="texto-claseb">BOX</h3>
        <h3 class="texto-claseb2">BOX</h3>
    </div>

	<div class="clase">
        <div class="overlay"></div>
        <img class="img-clases" src="https://goodspaguide--live.s3.amazonaws.com/aerobics-class.jpg" alt="personas haciendo aerobics">
        <h2 class="texto-clase">AEROBICS</h2>
        <h3 class="texto-claseb">AEROBICS</h3>
        <h3 class="texto-claseb2">AEROBICS</h3>
    </div>

	<div class="clase">
        <div class="overlay"></div>
        <img class="img-clases" src="https://media.glamour.mx/photos/6190a842f5ed039ceea88515/master/w_1600,c_limit/173758.jpg" alt="personas practicando zumba">
        <h2 class="texto-clase">ZUMBA</h2>
        <h3 class="texto-claseb">ZUMBA</h3>
        <h3 class="texto-claseb2">ZUMBA</h3>
    </div>

	<div class="clase">
        <div class="overlay"></div>
        <img class="img-clases" src="https://workoutbrands.com/cdn/shop/articles/crossfit-together.png" alt="viruzz box">
        <h2 class="texto-clase">CROSSFIT</h2>
        <h3 class="texto-claseb">CROSSFIT</h3>
        <h3 class="texto-claseb2">CROSSFIT</h3>
    </div>
  </div>

  <div class="regist">
    <img class="img-regist" src="https://www.bestgym.com.mx/storage/carousels/August2023/zP57JEjBN0eGOz4xyTvO.jpg" alt="hombre sentado en el gimnasio">
    <div class="overlay"></div>
    
    <div>
    <h2 class="texto-regist">Registrate y cambia tu vida</h2>
    <p class="parrafo-regist">Unete a nuestro gimnasio y disfruta de nuestros beneficios. <br> Nuestras membresias se adaptan a ti.</p>
    <button class="btn-regist" id="registrarBtn">registrarse!</button>
    </div>
  </div>	

<section class="planes" id="membresia">
	<h2>Elije la mejor membresía</h2>
	<table class="planes-tabla">
	  <thead>
		<tr>
		  <th>Beneficios</th>
		  <th>Básico</th>
		  <th>Especial</th>
		  <th>Gold</th>
		  <th class="remarcar">Platinum</th>
		</tr>
	  </thead>
	  <tbody>
		<tr>
		<td>Acceso al gimnasio</td>
		<td>
			<svg class="palomita" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
				<path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
			</svg>			  
		</td>
		  <td><svg class="palomita" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
			<path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
		  </svg>
		</td>
		<td>
			<svg class="palomita" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
				<path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
			</svg>			  
		</td>
		  <td><svg class="palomita" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
			<path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
		  </svg>
		</td>
		</tr>
		<tr>
		  <td>Estacionamiento</td>
		  		<td>
			<svg class="palomita" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
				<path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
			</svg>			  
		</td>
		  <td><svg class="palomita" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
			<path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
		  </svg>
		</td>
		<td>
			<svg class="palomita" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
				<path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
			</svg>			  
		</td>
		  <td><svg class="palomita" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
			<path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
		  </svg>
		</td>
		</tr>
		<tr>
		<td>Clases grupales</td>
		<td><svg class="x" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
			<path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
			</svg>
		</td>
		<td><svg class="palomita" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
			<path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
		  	</svg>
		</td>
		<td><svg class="palomita" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
			<path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
		  	</svg>
		</td>
		<td><svg class="palomita" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
			<path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
		  	</svg>
		</td>
		</tr>
		<tr>
			<td>Acceso a piscinas</td>
			<td><svg class="x" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
				<path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
				</svg>
			</td>
			<td><svg class="x" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
				<path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
				</svg>
			</td>
			<td><svg class="palomita" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
				<path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
				</svg>
			</td>
			<td><svg class="palomita" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
				<path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
				</svg>
			</td>
		</tr>
		<tr>
			<td>Eventos exclusivos</td>
			<td><svg class="x" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
				<path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
				</svg>
			</td>
			<td><svg class="x" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
				<path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
				</svg>
			</td>
			<td><svg class="palomita" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
				<path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
				</svg>
			</td>
			<td><svg class="palomita" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
				<path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
				</svg>
			</td>
		</tr>
		<tr>
			<td>Entrenador personal</td>
			<td><svg class="x" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
				<path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
				</svg>
			</td>
			<td><svg class="x" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
				<path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
				</svg>
			</td>
			<td><svg class="palomita" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
				<path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
				</svg>
			</td>
			<td><svg class="palomita" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
				<path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
				</svg>
			</td>
		</tr>
		<tr>
			<td>Nutriologo</td>
			<td><svg class="x" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
				<path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
				</svg>
			</td>
			<td><svg class="x" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
				<path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
				</svg>
			</td>
			<td><svg class="x" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
				<path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
				</svg>
			</td>
			<td><svg class="palomita" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
				<path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
				</svg>
			</td>
		</tr>
		<tr>
			<td>Masajes</td>
			<td><svg class="x" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
				<path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
				</svg>
			</td>
			<td><svg class="x" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
				<path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
				</svg>
			</td>
			<td><svg class="x" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
				<path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
				</svg>
			</td>
			<td><svg class="palomita" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
				<path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
				</svg>
			</td>
		</tr>
		<tr>
			<td>Acceso a sauna</td>
			<td><svg class="x" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
				<path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
				</svg>
			</td>
			<td><svg class="x" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
				<path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
				</svg>
			</td>
			<td><svg class="x" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
				<path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
				</svg>
			</td>
			<td><svg class="palomita" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
				<path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
				</svg>
			</td>
		</tr>
		<tr>
			<td>*El precio puede variar segun el tiempo a pagar</td>
			<td>Desde $50 en el primer mes despues </td>
			<td>Desde $100 en el primer mes despues </td>
			<td>Desde $150 en el primer mes despues </td>
			<td>Desde $200 en el primer mes despues </td>
		</tr>
	  </tbody>
	</table>
  </section>

<div class="containerInscBtn">
	<button class="btn-registf" id="registf">¡Inscríbete ya!</button>
</div>

<div class="dietas-container">
	<img class="img-dieta" src="https://cdn.static.aptavs.com/imagenes/interaccion-entre-los-diferentes-suplementos-deportivos-que-debemos-tener-en-cuenta_905x603.jpg" alt="">
	<div class="text-dieta">
        <h2>Acompañamiento de Dieta y Suplementos</h2>
        <p>Descubre cómo los suplementos pueden complementar tu dieta diaria para alcanzar tus objetivos de salud y rendimiento físico. <br>Aquí encontrarás consejos y recomendaciones para integrarlos de manera segura <br>y efectiva en tu rutina.</p>
    </div>
</div>
<div class="mapa">
	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3699.4885760290326!2d-99.00163442398363!3d21.9925830539773!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d613ec77caf295%3A0x8ad3459521c89a5f!2sELITE%20FITNESS!5e0!3m2!1ses-419!2smx!4v1732661230008!5m2!1ses-419!2smx"  
	style="border-radius:10px; margin-top: 20px; width:100%; height: 450px;;" 
	allowfullscreen="" 
	loading="lazy"
	referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>

<div class="footer">
	<div class="logo">
		<img alt="Logo EliteFitness" src="assets/logo.png">   
		<a href="#">EliteFitness</a>
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