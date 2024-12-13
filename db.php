<?php
$host = '127.0.0.200';
$port = '5432'; 
$dbname = 'fcb6c35_gimnasio';
$user = 'fcb6c35_geovani'; 
$password = 'geovani';

try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error al conectar con la base de datos: " . $e->getMessage());
}
?>
