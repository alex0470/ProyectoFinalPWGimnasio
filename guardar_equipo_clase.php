<?php
require_once 'db.php';

// Verificar que los datos necesarios están presentes en la solicitud
$clase_id = filter_input(INPUT_POST, 'clase_id', FILTER_VALIDATE_INT);
$equipo_id = filter_input(INPUT_POST, 'equipo_id', FILTER_VALIDATE_INT);

if (!$clase_id || !$equipo_id) {
    die("Faltan datos necesarios. No se ha proporcionado el ID de clase o equipo.");
}

// Verificar si el equipo ya está asignado a la clase
$query_check = "
    SELECT * 
    FROM clase_equipos 
    WHERE clase_id = :clase_id AND equipo_id = :equipo_id
";
$stmt_check = $pdo->prepare($query_check);
$stmt_check->bindParam(':clase_id', $clase_id, PDO::PARAM_INT);
$stmt_check->bindParam(':equipo_id', $equipo_id, PDO::PARAM_INT);
$stmt_check->execute();

if ($stmt_check->rowCount() > 0) {
    die("Este equipo ya ha sido asignado a la clase.");
}

// Insertar el equipo en la tabla clase_equipos
$query_insert = "
    INSERT INTO clase_equipos (clase_id, equipo_id)
    VALUES (:clase_id, :equipo_id)
";
$stmt_insert = $pdo->prepare($query_insert);
$stmt_insert->bindParam(':clase_id', $clase_id, PDO::PARAM_INT);
$stmt_insert->bindParam(':equipo_id', $equipo_id, PDO::PARAM_INT);
$stmt_insert->execute();

// Verificar si la inserción fue exitosa
if ($stmt_insert->rowCount() > 0) {
         header("Location: horarioclases.php");
    // Puedes redirigir a otra página después de insertar los datos si es necesario
} else {
    die("Hubo un error al añadir el equipo a la clase.");
}
?>
