<?php
require_once 'db.php'; // Incluye la conexión a la base de datos

try {
    // Query de inserción masiva
    $sql = "
    INSERT INTO equipos (nombre, marca, modelo, estatus) 
    VALUES 
        ('Bicicleta Estática', 'Life Fitness', 'IC7', 'disponible'),
        ('Cinta de Correr', 'NordicTrack', 'Commercial 1750', 'mantenimiento'),
        ('Pesas Libres', 'Rogue Fitness', 'Dumbbells', 'disponible'),
        ('Máquina de Remo', 'Concept2', 'Model D', 'disponible'),
        ('Colchonetas', 'Manduka', 'ProLite', 'disponible'),
        ('Saco de Boxeo', 'Everlast', 'PowerCore', 'no disponible'),
        ('Kettlebells', 'Rogue Fitness', 'Kettlebells', 'disponible'),
        ('Step Aeróbico', 'Reebok', 'Step', 'disponible'),
        ('Cuerda para Saltar', 'RPM Training', 'Session 4', 'disponible'),
        ('Barra Olímpica', 'Eleiko', 'XF Bar', 'disponible'),
        ('Máquina de Prensa de Piernas', 'Body-Solid', 'GLPH1100', 'disponible'),
        ('Máquina de Extensión de Piernas', 'Precor', 'Leg Extension', 'mantenimiento'),
        ('Elíptica', 'Bowflex', 'Max Trainer M6', 'disponible'),
        ('Banco Ajustable', 'Ironmaster', 'Super Bench', 'disponible'),
        ('Polea Alta', 'BodyCraft', 'HFT Functional Trainer', 'disponible'),
        ('Dumbbells (Juego Completo)', 'York Fitness', 'Hex Dumbbells', 'disponible'),
        ('Balón Medicinal', 'TRX', 'Medicine Ball', 'disponible'),
        ('Máquina de Pecho', 'Technogym', 'Chest Press', 'no disponible'),
        ('Bandas Elásticas', 'TheraBand', 'Resistance Bands', 'disponible'),
        ('Rueda para Abdomen', 'Perfect Fitness', 'Ab Carver Pro', 'disponible'),
        ('Máquina de Jalón de Espalda', 'Matrix Fitness', 'Lat Pulldown', 'mantenimiento'),
        ('TRX', 'TRX', 'Pro4 System', 'disponible'),
        ('Máquina Smith', 'Body-Solid', 'Series 7', 'disponible'),
        ('Discos Olímpicos (Juego Completo)', 'Eleiko', 'Olympic Plates', 'disponible'),
        ('Racks de Sentadilla', 'Rogue Fitness', 'Squat Rack', 'disponible'),
        ('Máquina de Glúteos', 'Nautilus', 'Glute Drive', 'disponible'),
        ('Máquina de Pantorrillas', 'Body-Solid', 'Calf Raise Machine', 'disponible'),
        ('Máquina de Abductores', 'Life Fitness', 'Hip Abductor', 'no disponible'),
        ('Piso de Caucho', 'Regupol', 'Aktiv Flooring', 'disponible');
    ";

    // Ejecutar la consulta
    $pdo->exec($sql);

    echo "Datos insertados correctamente.";
} catch (PDOException $e) {
    // Manejo de errores
    echo "Error al insertar datos: " . $e->getMessage();
}
