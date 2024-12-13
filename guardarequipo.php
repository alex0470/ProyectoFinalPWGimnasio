<?php
require_once 'db.php';

// Procesar formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Filtrar y sanitizar los datos
    $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
    $marca = filter_input(INPUT_POST, 'marca', FILTER_SANITIZE_STRING);
    $modelo = filter_input(INPUT_POST, 'modelo', FILTER_SANITIZE_STRING);
    $estatus = filter_input(INPUT_POST, 'estatus', FILTER_SANITIZE_STRING);

    // Comprobar si todos los campos están correctamente llenados
    if ($nombre && $marca && $modelo && $estatus) {
        try {
            // Insertar nuevo equipo
            $query = "INSERT INTO equipos (nombre, marca, modelo, estatus) 
                      VALUES (:nombre, :marca, :modelo, :estatus)";
            $stmt = $pdo->prepare($query);
            $stmt->execute([
                'nombre' => $nombre,
                'marca' => $marca,
                'modelo' => $modelo,
                'estatus' => $estatus
            ]);

            // Redirigir a la página de inventario o la que prefieras
            header("Location: inventario.php");
            exit;
        } catch (PDOException $e) {
            // Mostrar error si la inserción falla
            echo "Error al insertar el equipo: " . $e->getMessage();
        }
    } else {
        echo "Por favor, completa todos los campos correctamente.";
    }
}
?>