<?php
require_once 'db.php';

// Verificar que el formulario se haya enviado mediante POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar los datos de entrada (cliente_id y clase_id)
    $cliente_id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $clase_id = filter_input(INPUT_POST, 'clase_id', FILTER_VALIDATE_INT);

    if (!$cliente_id || !$clase_id) {
        die("Datos inválidos.");
    }

    // Eliminar la relación cliente-clase
    $query_eliminar_relacion = "
        DELETE FROM clase_clientes
        WHERE cliente_id = :cliente_id AND clase_id = :clase_id
    ";
    $stmt_eliminar_relacion = $pdo->prepare($query_eliminar_relacion);
    $stmt_eliminar_relacion->bindParam(':cliente_id', $cliente_id, PDO::PARAM_INT);
    $stmt_eliminar_relacion->bindParam(':clase_id', $clase_id, PDO::PARAM_INT);
    $stmt_eliminar_relacion->execute();

    // Redirigir de vuelta a la página de clientes
    header("Location: horarioclases.php");
    exit;
}
?>