<?php
require_once 'db.php';

// Obtener los usuarios y sus membresías
$query = "
    SELECT usuarios.id, usuarios.nombre, usuarios.apellidos, usuarios.correo, usuarios.telefono, 
           usuarios.direccion, usuarios.fecha_nacimiento, membresias.nombre_c AS membresia
    FROM usuarios
    LEFT JOIN membresias ON usuarios.id = membresias.usuario_id
    ORDER BY usuarios.id
";
$usuarios = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Clientes</title>
    <link rel="icon" href="assets/logo.png">
    <link rel="stylesheet" href="css/clases.css"> 
</head>
<body>
    <header>
        <div class="logo">
            <img src='assets/logo.png' alt='Logo'>
            <a href="index.php">EliteFitness</a>
        </div>
        <nav class="navbar">
            <ul>
                <li><a href="crearcuenta.php">Crear Cuenta</a></li>
                <li><a href="horarioclases.php">Clases</a></li>
                <li><a href="inventario.php">Inventario</a></li>
                <li><a href="clientes.php">Clientes</a></li>
            </ul>
        </nav>
    </header>

    <div class="table-container">
        <h1>Gestión de Clientes</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Correo</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>Fecha de Nacimiento</th>
                    <th>Membresía</th> <!-- Nueva columna de Membresía -->
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td><?= htmlspecialchars($usuario['id']) ?></td>
                        <td><?= htmlspecialchars($usuario['nombre']) ?></td>
                        <td><?= htmlspecialchars($usuario['apellidos']) ?></td>
                        <td><?= htmlspecialchars($usuario['correo']) ?></td>
                        <td><?= htmlspecialchars($usuario['telefono']) ?></td>
                        <td><?= htmlspecialchars($usuario['direccion']) ?></td>
                        <td><?= htmlspecialchars($usuario['fecha_nacimiento']) ?></td>
                        <td><?= $usuario['membresia'] ? htmlspecialchars($usuario['membresia']) : 'Sin Membresía' ?></td> <!-- Mostrar Membresía -->
                        <td>
                           <div class="button-container">
                                <form action="editar.php" method="GET">
                                    <input type="hidden" name="id" value="<?= $usuario['id'] ?>"style="display:inline;">
                                    <button type="submit">Editar</button>
                                </form>
                                <form action="borrar.php" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este cliente?');"style="display:inline;">
                                    <input type="hidden" name="id" value="<?= $usuario['id'] ?>">
                                    <button type="submit">Eliminar</button>
                                </form>                                
                                <form action="cambioplan.php" method="POST">
                                    <input type="hidden" name="id" value="<?= $usuario['id'] ?>"style="display:inline;">
                                    <button type="submit">Cambiar Membresía</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
