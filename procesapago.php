<?php
session_start();
require_once 'db.php'; // Conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario_id = $_POST['usuario_id'];
    $nombre_c = $_POST['nombre_c'];
    $duracion = $_POST['duracion']; // Valor del tiempo seleccionado

    // Validar que los datos están completos
    if (!$usuario_id || !$nombre_c || !$duracion) {
        echo "Datos incompletos. Por favor, verifica la información.";
        exit;
    }

    // Calcular fecha de vencimiento
    $duraciones = [
        "day" => "+1 day",
        "week" => "+1 week",
        "biweekly" => "+2 weeks",
        "month" => "+1 month",
        "2months" => "+2 months",
        "halfyear" => "+6 months",
        "year" => "+1 year"
    ];

    $fecha_vencimiento = isset($duraciones[$duracion]) ? date("Y-m-d", strtotime($duraciones[$duracion])) : null;

    if (!$fecha_vencimiento) {
        echo "Duración inválida.";
        exit;
    }

    try {
        // Verificar si ya existe una membresía para el usuario
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM membresias WHERE usuario_id = :usuario_id");
        $stmt->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
        $stmt->execute();
        $existe = $stmt->fetchColumn();

        if ($existe) {
            // Actualizar membresía existente
            $stmt = $pdo->prepare("
                UPDATE membresias
                SET fecha_inscripcion = NOW(),
                    fecha_vencimiento = :fecha_vencimiento,
                    nombre_c = :nombre_c
                WHERE usuario_id = :usuario_id
            ");

            $stmt->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
            $stmt->bindParam(':fecha_vencimiento', $fecha_vencimiento, PDO::PARAM_STR);
            $stmt->bindParam(':nombre_c', $nombre_c, PDO::PARAM_STR);

            if ($stmt->execute()) {
                header("Location: perfil.php");
                exit;
            } else {
                echo "<script>alert('Error al actualizar la membresía.');</script>";
            }
        } else {
            // Insertar nueva membresía
            $stmt = $pdo->prepare("
                INSERT INTO membresias (usuario_id, fecha_inscripcion, fecha_vencimiento, nombre_c)
                VALUES (:usuario_id, NOW(), :fecha_vencimiento, :nombre_c)
            ");

            $stmt->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
            $stmt->bindParam(':fecha_vencimiento', $fecha_vencimiento, PDO::PARAM_STR);
            $stmt->bindParam(':nombre_c', $nombre_c, PDO::PARAM_STR);

            if ($stmt->execute()) {
                header("Location: perfil.php");
                exit;
            } else {
                echo "Error al registrar la membresía.";
            }
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Método no permitido.";
}
?>
