<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
    $apellidos = filter_input(INPUT_POST, 'apellidos', FILTER_SANITIZE_STRING);
    $correo = filter_input(INPUT_POST, 'correo', FILTER_SANITIZE_EMAIL);
    $telefono = filter_input(INPUT_POST, 'telefono', FILTER_SANITIZE_STRING);
    $direccion = filter_input(INPUT_POST, 'direccion', FILTER_SANITIZE_STRING);
    $fecha_nacimiento = filter_input(INPUT_POST, 'fecha_nacimiento', FILTER_SANITIZE_STRING);
    $contra = $_POST['contra'];

    if ($nombre && $apellidos && $correo && $telefono && $direccion && $fecha_nacimiento && $contra) {
        try {
            // Encriptar la contrase«Ða
            $contra_encriptada = password_hash($contra, PASSWORD_BCRYPT);

            // Insertar el nuevo usuario en la base de datos
            $stmt = $pdo->prepare(
                'INSERT INTO Usuarios (nombre, apellidos, correo, telefono, direccion, fecha_nacimiento, contra) 
                VALUES (:nombre, :apellidos, :correo, :telefono, :direccion, :fecha_nacimiento, :contra)'
            );
            $stmt->execute([
                'nombre' => $nombre,
                'apellidos' => $apellidos,
                'correo' => $correo,
                'telefono' => $telefono,
                'direccion' => $direccion,
                'fecha_nacimiento' => $fecha_nacimiento,
                'contra' => $contra_encriptada
            ]);

            // Crear el nombre de usuario basado en el correo o en cualquier otro criterio
            $nombre_usuario = strtolower(explode('@', $correo)[0]);

            // Crear el usuario a nivel de PostgreSQL
         //   $sql_crear_usuario = "CREATE USER $nombre_usuario WITH PASSWORD //'$contra'";
            //$pdo->exec($sql_crear_usuario);

            // Asignar el rol de "cliente" al usuario creado (basado en el nombre de usuario)
            //$sql_grant_cliente = "GRANT clientes TO $nombre_usuario";
            //$pdo->exec($sql_grant_cliente);
 
                header("Location: index.php");
        } catch (PDOException $e) {
            echo "Error al registrar usuario: " . $e->getMessage();
        }
    } else {
        echo "Por favor, completa todos los campos.";
    }
}
?>
