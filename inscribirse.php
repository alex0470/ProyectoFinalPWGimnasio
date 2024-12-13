<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}
require 'db.php';

$usuario = $_SESSION['usuario'];
$usuario_id = $usuario['id'];

// Recuperar el ID de la clase enviado por POST
$clase_id = filter_input(INPUT_POST, 'clase_id', FILTER_VALIDATE_INT);
if (!$clase_id) {
    die("Clase no válida.");
}

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

// Consultar la clase en la base de datos
$stmt = $pdo->prepare("SELECT costo, cupo_actual, cupo_maximo FROM clases WHERE clase_id = :clase_id");
$stmt->bindParam(':clase_id', $clase_id);
$stmt->execute();
$clase = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$clase || $clase['cupo_actual'] >= $clase['cupo_maximo']) {
    die("La clase ya está llena o no existe.");
}
// Si la clase es válida, se procede con la inscripción
$stmt = $pdo->prepare("UPDATE clases SET cupo_actual = cupo_actual + 1 WHERE clase_id = :clase_id");
$stmt->bindParam(':clase_id', $clase_id);
$stmt->execute();
try {
    $stmt = $pdo->prepare("INSERT INTO clase_clientes (clase_id, cliente_id) VALUES (:clase_id, :cliente_id)");
    $stmt->bindParam(':clase_id', $clase_id, PDO::PARAM_INT);
    $stmt->bindParam(':cliente_id', $usuario_id);
    $stmt->execute();
} catch (PDOException $e) {
    die("Error en la consulta: " . $e->getMessage());
}


header("Location: index.php");
exit;
