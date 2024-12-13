<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}
require 'db.php';

$usuario = $_SESSION['usuario'];
$nombre = htmlspecialchars($usuario['nombre']);
$apellidos = htmlspecialchars($usuario['apellidos']);
$correo = htmlspecialchars($usuario['correo']);
$telefono = htmlspecialchars($usuario['telefono']);
$direccion = htmlspecialchars($usuario['direccion']);
$role = isset($usuario['role']) ? $usuario['role'] : 'usuario';
$usuario_id = $usuario['id'];

// Obtener la membresía
$stmt = $pdo->prepare("SELECT nombre_c FROM membresias WHERE usuario_id = :usuario_id");
$stmt->bindParam(':usuario_id', $usuario_id);
$stmt->execute();
$membresia = $stmt->fetch(PDO::FETCH_ASSOC);
$nombre_membresia = $membresia['nombre_c'] ?? 'Ninguna'; 

// Manejo de la subida de imagen
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['foto_perfil'])) {
    $errors = [];
    $file = $_FILES['foto_perfil'];
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];
    $fileType = $file['type'];

    // Validar el archivo
    $allowedExtensions = ['jpg', 'jpeg', 'png'];
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    if (!in_array($fileExtension, $allowedExtensions)) {
        $errors[] = "Tipo de archivo no permitido. Solo se permiten JPG, JPEG y PNG.";
    }

    if ($fileError !== 0) {
        $errors[] = "Hubo un error al subir el archivo.";
    }

    if ($fileSize > 5000000) {
        $errors[] = "El archivo es demasiado grande. Máximo permitido: 5MB.";
    }

    if (empty($errors)) {
        $uniqueName = uniqid('', true) . "." . $fileExtension;
        $uploadPath = 'assets/' . $uniqueName;

        if (move_uploaded_file($fileTmpName, $uploadPath)) {
            $stmt = $pdo->prepare("UPDATE usuarios SET foto_perfil = :foto_perfil WHERE id = :usuario_id");
            $stmt->bindParam(':foto_perfil', $uploadPath);
            $stmt->bindParam(':usuario_id', $usuario_id);
            $stmt->execute();
        } else {
            $errors[] = "No se pudo mover el archivo. Intenta de nuevo.";
        }
    }

    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<script>alert('" . addslashes($error) . "');</script>";
        }
    }
}

// Obtener la foto de perfil
$stmt = $pdo->prepare("SELECT foto_perfil FROM usuarios WHERE id = :usuario_id");
$stmt->bindParam(':usuario_id', $usuario_id);
$stmt->execute();
$fotoPerfil = $stmt->fetchColumn();


// Manejo de eliminación de membresía
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eliminar_membresia'])) {
    $stmt = $pdo->prepare("DELETE FROM membresias WHERE usuario_id = :usuario_id");
    $stmt->bindParam(':usuario_id', $usuario_id);
    if ($stmt->execute()) {
        echo "<script>alert('Membresía eliminada exitosamente.');</script>";
        $nombre_membresia = 'Ninguna';
    } else {
        echo "<script>alert('Error al eliminar la membresía.');</script>";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eliminar_clase'])) {
    $stmt = $pdo->prepare("DELETE FROM clase_clientes WHERE cliente_id = :usuario_id");
    $stmt->bindParam(':usuario_id', $usuario_id);
    if ($stmt->execute()) {
        echo "<script>alert('clase eliminada exitosamente.');</script>";
        $nombre_clase = 'Ninguna';
    } else {
        echo "<script>alert('Error al eliminar la clase.');</script>";
    }
}
// Obtener los IDs de las clases
$stmt_clases_ids = $pdo->prepare("SELECT clase_id FROM clase_clientes WHERE cliente_id = :usuario_id");
$stmt_clases_ids->bindParam(':usuario_id', $usuario_id);
$stmt_clases_ids->execute();
$clase_ids = $stmt_clases_ids->fetchAll(PDO::FETCH_COLUMN);

// Obtener los detalles de las clases
$clases = [];
if (!empty($clase_ids)) {
    $placeholders = rtrim(str_repeat('?,', count($clase_ids)), ',');
    $stmt_clases = $pdo->prepare("SELECT nombre, horario, dias_semana FROM clases WHERE clase_id IN ($placeholders)");
    if ($stmt_clases->execute($clase_ids)) {
        $clases = $stmt_clases->fetchAll(PDO::FETCH_ASSOC);
    } else {
        echo "<script>alert('Error al obtener detalles de las clases.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil del Usuario</title>
    <link rel="stylesheet" href="css/perfil.css">
    <link rel="icon" href="assets/logo.png">
</head>
<body>
    <header>
        <div class="logo">
            <img src="assets/logo.png" alt="Logo">
            <a href="index.php">EliteFitness</a>
        </div>
        <nav class="navbar">
            <ul>
                <li><a href="perfil.php">Mi Perfil</a></li>
                <li><a href="elegirplan.php">Cambiar membresía</a></li>
                <li><a href="registclase.php">Elegir clases</a></li>
                <li><a href="mailto:info@tugimnasio.com?subject=Consulta%20sobre%20membresías&body=Hola,%20quisiera%20más%20información%20sobre%20las%20membresías.">Contáctanos</a></li>
                <li><a href="logout.php">Cerrar Sesión</a></li>
            </ul>
        </nav>
    </header>

    <section id="user-profile">
        <h1>Mi Perfil</h1>

        <form action="perfil.php" method="POST" enctype="multipart/form-data">
            <?php if ($fotoPerfil): ?>
                <li><strong>Foto de Perfil:</strong><br>
                    <img src="<?= htmlspecialchars($fotoPerfil) ?>" alt="Foto de Perfil">
                </li>
            <?php else: ?>
                <li><strong>Foto de Perfil:</strong> No definida.</li>
            <?php endif; ?>

            <label for="foto_perfil">Cambiar Foto de Perfil:</label>
            <input type="file" name="foto_perfil" id="foto_perfil" accept="image/*">
            <button type="submit">Subir Foto</button>
        </form>

        <ul>
            <li><strong>ID:</strong> <?= htmlspecialchars($usuario_id) ?></li>
            <li><strong>Nombre:</strong> <?= htmlspecialchars($nombre) ?></li>
            <li><strong>Apellidos:</strong> <?= htmlspecialchars($apellidos) ?></li>
            <li><strong>Correo:</strong> <?= htmlspecialchars($correo) ?></li>
            <li><strong>Teléfono:</strong> <?= htmlspecialchars($telefono ?: 'No especificado') ?></li>
            <li><strong>Dirección:</strong> <?= htmlspecialchars($direccion ?: 'No especificada') ?></li>
            <li><strong>Membresía:</strong> <?= htmlspecialchars($nombre_membresia) ?></li>

            <?php if ($nombre_membresia !== 'Ninguna'): ?>
                <li><strong>Clases Registradas:</strong></li>
                <?php if (empty($clases)): ?>
                    <li>No estás registrado en ninguna clase.</li>
                <?php else: ?>
                    <ul>
                        <?php foreach ($clases as $clase): ?>
                            <li><strong><?= htmlspecialchars($clase['nombre']) ?></strong> - <?= htmlspecialchars($clase['horario']) ?> - <?= htmlspecialchars($clase['dias_semana']) ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>

                <form action="perfil.php" method="POST">
                    <button type="submit" name="eliminar_clase" class="delete-button">Eliminar clase</button>
                    <button type="submit" name="eliminar_membresia" class="delete-button">Eliminar Membresía</button>
                </form>
            <?php endif; ?>
        </ul>
    </section>
</body>
</html>
