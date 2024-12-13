<?php
require 'db.php'; // Archivo separado para la conexión a la base de datos

try {
    // Consultar los equipos
    $sql = "SELECT * FROM equipos";
    $stmt = $pdo->query($sql); // Ejecutar consulta

    // Obtener resultados
    $equipos = $stmt->fetchAll();
    
    $query_disponible = "
UPDATE equipos
SET estatus = 'disponible'
WHERE id IN (
    SELECT equipo_id
    FROM clase_equipos
    WHERE clase_id IN (
        SELECT clase_id
        FROM clases
        WHERE horario < CURRENT_TIME
    )
) AND estatus = 'ocupado';
";

// Ejecutar la consulta para marcar como "disponible" (si la clase ha terminado)
$result_disponible = pg_query($dbconn, $query_disponible);
if ($result_disponible) {
    echo "Estatus de equipos actualizado a 'disponible'.<br>";
} else {
    echo "Error al actualizar el estatus a 'disponible'.<br>";
}

// 3. Mostrar los equipos en el inventario con su estatus actualizado
$query_inventory = "SELECT * FROM equipos";
$inventory_result = pg_query($dbconn, $query_inventory);

if ($inventory_result) {
    echo "<h3>Inventario de equipos</h3><table border='1'><tr><th>Nombre</th><th>Estatus</th></tr>";
    while ($row = pg_fetch_assoc($inventory_result)) {
        echo "<tr><td>" . $row['nombre'] . "</td><td>" . $row['estatus'] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "Error al obtener inventario.<br>";
}

    
} catch (PDOException $e) {
    die("Error al realizar la consulta: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipos del Gimnasio</title>
    <link rel="stylesheet" href="css/clases.css">
    <link rel="icon" href="assets/logo.png">
<body>
<header>
    <div class="logo">
        <img src="assets/logo.png" alt="Logo">
        <a href="index.php">Elite Fitness</a>
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
    <h1>Inventario de Equipos</h1>
      <form action="add_equipo.php" method="GET">
                            <input type="hidden" name="equipo_id" value="<?= $equipo['equipo_id'] ?>">
                            <button type="submit">Agregar</button>
                        </form>
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Estatus</th>
            <th>Opciones</th> <!-- Columna de opciones (editar, eliminar) -->
        </tr>
        <?php foreach ($equipos as $equipo): ?>
            <tr>
                <td><?= htmlspecialchars($equipo['equipo_id']) ?></td>
                <td><?= htmlspecialchars($equipo['nombre']) ?></td>
                <td><?= htmlspecialchars($equipo['marca']) ?></td>
                <td><?= htmlspecialchars($equipo['modelo']) ?></td>
                <td><?= htmlspecialchars($equipo['estatus']) ?></td>
                <td>
                    
                    <div class="button-container">
                        <!-- Formulario para editar equipo -->
                        <form action="editar_equipo.php" method="GET">
                            <input type="hidden" name="equipo_id" value="<?= $equipo['equipo_id'] ?>">
                            <button type="submit">Editar</button>
                        </form>

                        <!-- Formulario para eliminar equipo -->
                        <form action="eliminar_equipo.php" method="POST" onsubmit="return confirm('¿Estas seguro de eliminar este equipo?');">
                            <input type="hidden" name="equipo_id" value="<?= $equipo['equipo_id'] ?>">
                            <button type="submit">Eliminar</button>
                        </form>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

</body>
</html>

