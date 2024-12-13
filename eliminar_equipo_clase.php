<?php
require_once 'db.php';

// Verificar que los datos necesarios están presentes en la solicitud
$equipo_id = filter_input(INPUT_POST, 'equipo_id', FILTER_VALIDATE_INT);
$clase_id = filter_input(INPUT_POST, 'clase_id', FILTER_VALIDATE_INT);

if (!$equipo_id || !$clase_id) {
    die("Faltan datos necesarios. Equipo ID: $equipo_id, Clase ID: $clase_id");
}

try {
    // Iniciar la transacción
    $pdo->beginTransaction();

    // Eliminar el equipo de la clase en la tabla clase_equipos
    $query_delete = "
        DELETE FROM clase_equipos
        WHERE equipo_id = :equipo_id AND clase_id = :clase_id
    ";
    $stmt_delete = $pdo->prepare($query_delete);
    $stmt_delete->bindParam(':equipo_id', $equipo_id, PDO::PARAM_INT);
    $stmt_delete->bindParam(':clase_id', $clase_id, PDO::PARAM_INT);
    $stmt_delete->execute();

    // Confirmar la transacción
    $pdo->commit();

    // Redirigir a la página de los equipos de la clase con un mensaje de éxito
    header("Location: equipos_en_clase.php?clase_id=$clase_id");
    exit();

} catch (Exception $e) {
    // En caso de error, deshacer la transacción
    $pdo->rollBack();
    echo "Error: " . $e->getMessage();
}
?>
