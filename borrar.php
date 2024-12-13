<?php
require_once 'db.php';
$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    die("ID de usuario inválido.");
}
try {
    $query = "DELETE FROM usuarios WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);
    header("Location: clientes.php");
    exit;
} catch (PDOException $e) {
    die("Error al eliminar el usuario: " . $e->getMessage());
}
?>
