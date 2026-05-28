<?php
// =============================================
//  CONEXIÓN A BASE DE DATOS
// =============================================

$host    = 'localhost';
$dbname  = 'portafolio_db';
$usuario = 'root';
$clave   = '';          // En XAMPP la contraseña es vacía por defecto

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $usuario,
        $clave
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE,            PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,   false);

} catch (PDOException $e) {
    // En producción nunca mostrar el mensaje real
    die(json_encode(['error' => 'No se pudo conectar a la base de datos.']));
}
