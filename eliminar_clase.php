<?php
require_once 'db.php'; // Incluir la conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['clase_id'])) {
    $clase_id = $_POST['clase_id'];
    if (!is_numeric($clase_id)) {
        die("ID de clase inválido.");
    }
    try {
        $stmt = $pdo->prepare("DELETE FROM clases WHERE clase_id = :clase_id");
        $stmt->bindParam(':clase_id', $clase_id, PDO::PARAM_INT);
        if ($stmt->execute()) {
             header("Location: horarioclases.php");
        } else {
            echo "Error al eliminar la clase.";
        }
    } catch (PDOException $e) {
        echo "Error en la consulta: " . $e->getMessage();
    }
} else {
    echo "No se recibió ningún ID de clase.";
}
?>