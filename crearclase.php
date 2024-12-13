<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Nueva Clase</title>
    <link rel="stylesheet" href="css/crearcuenta.css">
    <link rel="icon" href="assets/logo.png">
</head>
<body>
    <div class="crear-container">
        <p>Crear Nueva Clase</p>
        <form action="guardarclase.php" method="POST" enctype="multipart/form-data" class="login-form">
            <label for="nombre">Nombre de la clase</label>
            <input type="text" name="nombre" id="nombre" required>

            <label for="instructor">Instructor</label>
            <input type="text" name="instructor" id="instructor" required>

            <label for="cupo_actual">Cupo actual</label>
            <input type="number" name="cupo_actual" id="cupo_actual" required>

            <label for="cupo_maximo">Cupo máximo</label>
            <input type="number" name="cupo_maximo" id="cupo_maximo" required>

            <label for="horario">Horario</label>
            <input type="time" name="horario" id="horario" required>

            <label for="dias_semana">Días de la semana</label>
            <input type="text" name="dias_semana" id="dias_semana" required>

            <label for="costo">Costo</label>
            <input type="number" step="0.01" name="costo" id="costo" required>

            <label for="imagen">Imagen</label>
            <input type="file" name="imagen" id="imagen">

            <!-- Botón para crear la clase -->
            <button type="submit" name="crear" class="reg-button">Crear Clase</button>
        </form>
    </div>
</body>
</html>