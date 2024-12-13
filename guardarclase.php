<?php
require_once 'db.php';

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['crear'])) {
    // Campos de texto
    $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
    $instructor = filter_input(INPUT_POST, 'instructor', FILTER_SANITIZE_STRING);
    $cupo_actual = filter_input(INPUT_POST, 'cupo_actual', FILTER_VALIDATE_INT);
    $cupo_maximo = filter_input(INPUT_POST, 'cupo_maximo', FILTER_VALIDATE_INT);
    $horario = filter_input(INPUT_POST, 'horario', FILTER_SANITIZE_STRING);
    $dias_semana = filter_input(INPUT_POST, 'dias_semana', FILTER_SANITIZE_STRING);
    $costo = filter_input(INPUT_POST, 'costo', FILTER_VALIDATE_FLOAT);

    // Manejo de imagen
    $errors = [];
    $rutaImagen = ''; // Inicializar vacío para nuevo archivo de imagen

    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $imagen = $_FILES['imagen'];
        $fileName = $imagen['name'];
        $fileTmpName = $imagen['tmp_name'];
        $fileSize = $imagen['size'];
        $fileError = $imagen['error'];
        $fileType = $imagen['type'];

        // Validar la extensión del archivo
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if (!in_array($fileExtension, $allowedExtensions)) {
            $errors[] = "Tipo de archivo no permitido. Solo se permiten imágenes JPG, JPEG, PNG y GIF.";
        }

        if ($fileSize > 5000000) { // Limitar el tamaño del archivo a 5MB
            $errors[] = "El archivo es demasiado grande. El tamaño máximo permitido es 5MB.";
        }

        if (empty($errors)) {
            // Crear un nombre único para el archivo
            $uniqueName = uniqid('', true) . "." . $fileExtension;
            $uploadPath = "assets/" . $uniqueName;

            // Mover el archivo a la carpeta assets/
            if (move_uploaded_file($fileTmpName, $uploadPath)) {
                $rutaImagen = $uploadPath; // Guardar la ruta para la base de datos
            } else {
                $errors[] = "No se pudo mover el archivo. Intenta de nuevo.";
            }
        }
    }

    if (empty($errors)) {
        // Insertar clase en la base de datos
        $query = "INSERT INTO clases (nombre, instructor, cupo_actual, cupo_maximo, horario, dias_semana, costo, imagen) 
                  VALUES (:nombre, :instructor, :cupo_actual, :cupo_maximo, :horario, :dias_semana, :costo, :imagen)";

        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->bindParam(':instructor', $instructor, PDO::PARAM_STR);
        $stmt->bindParam(':cupo_actual', $cupo_actual, PDO::PARAM_INT);
        $stmt->bindParam(':cupo_maximo', $cupo_maximo, PDO::PARAM_INT);
        $stmt->bindParam(':horario', $horario, PDO::PARAM_STR);
        $stmt->bindParam(':dias_semana', $dias_semana, PDO::PARAM_STR);
        $stmt->bindParam(':costo', $costo, PDO::PARAM_STR);
        $stmt->bindParam(':imagen', $rutaImagen, PDO::PARAM_STR);

        $stmt->execute();

        header("Location: horarioclases.php");
        exit;
    } else {
        foreach ($errors as $error) {
            echo "<script>alert('Error: $error');</script>";
        }
    }
}

?>