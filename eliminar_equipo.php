<?php
require_once 'db.php'; // Incluir la conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['equipo_id'])) {
    $equipo_id = $_POST['equipo_id'];
    if (!is_numeric($equipo_id)) {
        die("ID de equipo inválido.");
    }
    try {
        $stmt = $pdo->prepare("DELETE FROM equipos WHERE equipo_id = :equipo_id");
        $stmt->bindParam(':equipo_id', $equipo_id, PDO::PARAM_INT);
        if ($stmt->execute()) {
             header("Location: inventario.php");
        } else {
            echo "Error al eliminar el equipo.";
        }
    } catch (PDOException $e) {
        echo "Error en la consulta: " . $e->getMessage();
    }
} else {
    echo "No se recibio ningun ID de de equipo.";
}
?>
