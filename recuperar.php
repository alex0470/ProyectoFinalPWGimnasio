<?php
require_once 'db.php';

// Asegúrate de que el formulario se ha enviado por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $correo = filter_input(INPUT_POST, 'correo', FILTER_SANITIZE_EMAIL);
    $nuevaContrasena = filter_input(INPUT_POST, 'nuevaContrasena', FILTER_SANITIZE_STRING);
    $confirmarContrasena = filter_input(INPUT_POST, 'confirmarContrasena', FILTER_SANITIZE_STRING);

    // Verificar que todos los datos fueron proporcionados
    if (!$correo || !$nuevaContrasena || !$confirmarContrasena) {
        echo "Por favor, completa todos los campos correctamente.";
        exit;
    }

    // Verificar que las contraseñas coincidan
    if ($nuevaContrasena !== $confirmarContrasena) {
        echo "Las contraseñas no coinciden. Por favor, verifica e intenta de nuevo.";
        exit;
    }

    try {
        // Verificar si el correo existe en la base de datos
        $query = "SELECT id FROM usuarios WHERE correo = :correo";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Si el correo no existe, terminar el proceso
        if (!$user) {
            echo "Correo no encontrado en nuestros registros.";
            exit;
        }

        // Hashear la nueva contraseña
        $hashedPassword = password_hash($nuevaContrasena, PASSWORD_DEFAULT);

        // Actualizar la contraseña en la base de datos
        $updateQuery = "UPDATE usuarios SET contra = :contra WHERE correo = :correo";
        $stmtUpdate = $pdo->prepare($updateQuery);
        $stmtUpdate->bindParam(':contra', $hashedPassword);
        $stmtUpdate->bindParam(':correo', $correo, PDO::PARAM_STR);
        $stmtUpdate->execute();
        header("Location: login.php");
    } catch (PDOException $e) {
        echo "Error al actualizar la contraseña: " . $e->getMessage();
    }
}
?>
