<?php
session_start();
session_unset();  // Elimina todas las variables de sesión
session_destroy();  // Destruye la sesión

// Redirigir al usuario al inicio de sesión
header("Location: index.php");
exit;