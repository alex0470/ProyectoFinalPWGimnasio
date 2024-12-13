<?php
require_once 'db.php';

// Obtener el ID de la clase desde el formulario
$id_clase = filter_input(INPUT_POST, 'clase_id', FILTER_VALIDATE_INT);

if (!$id_clase) {
    die("ID de clase no válido.");
}

// Consultar los datos de la clase
$query = "SELECT * FROM clases WHERE clase_id = :id";
$stmt = $pdo->prepare($query);
$stmt->execute(['id' => $id_clase]);
$clase = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$clase) {
    die("Clase no encontrada.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['actualizar'])) {
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
    $rutaImagen = $clase['imagen']; // Conservar la imagen actual si no se sube una nueva

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
        // Actualizar clase en la base de datos
        $query = "UPDATE clases SET 
                  nombre = :nombre, 
                  instructor = :instructor, 
                  cupo_actual = :cupo_actual, 
                  cupo_maximo = :cupo_maximo, 
                  horario = :horario, 
                  dias_semana = :dias_semana, 
                  costo = :costo, 
                  imagen = :imagen 
                  WHERE clase_id = :id";

        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id', $id_clase, PDO::PARAM_INT);
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

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Clase</title>
    <link rel="stylesheet" href="css/crearcuenta.css">
    <link rel="icon" href="assets/logo.png">
</head>
<body>
    <div class="crear-container">
        <p>Editar Clase</p>
        <form method="POST" enctype="multipart/form-data" class="login-form">
            <!-- Campo oculto para enviar el ID de la clase -->
            <input type="hidden" name="clase_id" value="<?= htmlspecialchars($clase['clase_id']) ?>">

            <label for="nombre">Nombre de la clase</label>
            <input type="text" name="nombre" id="nombre" value="<?= htmlspecialchars($clase['nombre']) ?>" required>

            <label for="instructor">Instructor</label>
            <input type="text" name="instructor" id="instructor" value="<?= htmlspecialchars($clase['instructor']) ?>" required>

            <label for="cupo_actual">Cupo actual</label>
            <input type="number" name="cupo_actual" id="cupo_actual" value="<?= htmlspecialchars($clase['cupo_actual']) ?>" required>

            <label for="cupo_maximo">Cupo máximo</label>
            <input type="number" name="cupo_maximo" id="cupo_maximo" value="<?= htmlspecialchars($clase['cupo_maximo']) ?>" required>

            <label for="horario">Horario</label>
            <input type="time" name="horario" id="horario" value="<?= htmlspecialchars($clase['horario']) ?>" required>

            <label for="dias_semana">Días de la semana</label>
            <input type="text" name="dias_semana" id="dias_semana" value="<?= htmlspecialchars($clase['dias_semana']) ?>" required>

            <label for="costo">Costo</label>
            <input type="number" step="0.01" name="costo" id="costo" value="<?= htmlspecialchars($clase['costo']) ?>" required>

            <label for="imagen">Imagen</label>
            <input type="file" name="imagen" id="imagen">

            <!-- Botón de actualización -->
            <button type="submit" name="actualizar" class="reg-button">Actualizar</button>
        </form>
    </div>
</body>
</html>
