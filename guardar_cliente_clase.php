<?php
require_once 'db.php';

// Validar los datos enviados
$clase_id = filter_input(INPUT_POST, 'clase_id', FILTER_VALIDATE_INT);
$usuario_id = filter_input(INPUT_POST, 'usuario_id', FILTER_VALIDATE_INT);

if (!$clase_id || !$usuario_id) {
    die("Faltan datos necesarios. Clase ID: $clase_id, Usuario ID: $usuario_id");
}

// Iniciar la transacción
try {
    $pdo->beginTransaction();
    
        $query_check_inscripcion = "
        SELECT COUNT(*) AS count
        FROM clase_clientes
        WHERE clase_id = :clase_id AND cliente_id = :usuario_id";
    $stmt_check_inscripcion = $pdo->prepare($query_check_inscripcion);
    $stmt_check_inscripcion->bindParam(':clase_id', $clase_id, PDO::PARAM_INT);
    $stmt_check_inscripcion->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
    $stmt_check_inscripcion->execute();
    $inscrito = $stmt_check_inscripcion->fetch(PDO::FETCH_ASSOC);
    
    if ($inscrito['count'] > 0) {
        die("El usuario ya está inscrito en esta clase.");
    }

    // Validar cupo disponible
    $query_check_cupo = "
        SELECT cupo_actual, cupo_maximo
        FROM clases
        WHERE clase_id = :clase_id
    ";
    $stmt_check_cupo = $pdo->prepare($query_check_cupo);
    $stmt_check_cupo->bindParam(':clase_id', $clase_id, PDO::PARAM_INT);
    $stmt_check_cupo->execute();
    $cupo = $stmt_check_cupo->fetch(PDO::FETCH_ASSOC);

    if ($cupo['cupo_actual'] >= $cupo['cupo_maximo']) {
        die("No se puede añadir más clientes. El cupo de la clase está lleno.");
    }

    // Insertar el cliente en la tabla clase_clientes
    $query_insert = "
        INSERT INTO clase_clientes (clase_id, cliente_id)
        VALUES (:clase_id, :usuario_id)
    ";
    $stmt_insert = $pdo->prepare($query_insert);
    $stmt_insert->bindParam(':clase_id', $clase_id, PDO::PARAM_INT);
    $stmt_insert->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
    $stmt_insert->execute();

    // Actualizar el cupo de la clase
    $query_update_cupo = "
        UPDATE clases
        SET cupo_actual = cupo_actual + 1
        WHERE clase_id = :clase_id
    ";
    $stmt_update_cupo = $pdo->prepare($query_update_cupo);
    $stmt_update_cupo->bindParam(':clase_id', $clase_id, PDO::PARAM_INT);
    $stmt_update_cupo->execute();

    // Confirmar la transacción
    $pdo->commit();

    // Redirigir a la página de clientes de la clase o mostrar mensaje de éxito
    header("Location: horarioclases.php");
    exit();
} catch (Exception $e) {
    // En caso de error, deshacer la transacción
    $pdo->rollBack();
    echo "Error: " . $e->getMessage();
}
