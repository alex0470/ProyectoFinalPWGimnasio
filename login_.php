<?php
session_start();
require 'db.php'; // Archivo con la conexi��n a la base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = filter_input(INPUT_POST, 'correo', FILTER_SANITIZE_EMAIL);
    $contra = $_POST['contra']; // Contrase�0�9a ingresada por el usuario

    if ($correo && $contra) {
        try {
            // Consultar el usuario en la base de datos por correo
            $stmt = $pdo->prepare('SELECT * FROM Usuarios WHERE correo = :correo');
            $stmt->execute(['correo' => $correo]);
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($usuario && password_verify($contra, $usuario['contra'])) {
                // Asignar rol seg��n el correo
                $rol = ($correo === 'admin@gmail.com') ? 'personal' : 'cliente';
                $usuario['role'] = $rol; // Agregar el rol a los datos del usuario

                // Guardar todos los datos del usuario en la sesi��n
                $_SESSION['usuario'] = $usuario;

                // Redirigir a la p��gina principal
                echo "<script>window.location.href='index.php';</script>";
                exit;
            } else {
                // Contrase�0�9a o correo incorrectos, mostrar alerta
                echo "<script>alert('Datos incorrectos.'); window.location.href='login.php';</script>";
            }
        } catch (PDOException $e) {
            // Error al procesar el inicio de sesi��n, mostrar alerta
            echo "<script>alert('Error al procesar el inicio de sesi��n: " . $e->getMessage() . "'); window.location.href='login.php';</script>";
        }
    } else {
        // Campos vac��os, mostrar alerta
        echo "<script>alert('Por favor, completa todos los campos.'); window.location.href='login.php';</script>";
    }
}
?>

