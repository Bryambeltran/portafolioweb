<?php
// =============================================
//  PROCESAR FORMULARIO DE CONTACTO
// =============================================
session_start();

// Solo usuarios logueados pueden enviar mensajes
if (!isset($_SESSION['usuario_id'])) {
    header('Location: ../../login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../index.php');
    exit;
}

require_once __DIR__ . '/conexion.php';

$mensaje = trim($_POST['mensaje'] ?? '');

if (empty($mensaje)) {
    header('Location: ../../index.php?contacto=campos');
    exit;
}

// Guardar mensaje en base de datos
$stmt = $pdo->prepare(
    'INSERT INTO mensajes (usuario_id, mensaje) VALUES (?, ?)'
);
$stmt->execute([$_SESSION['usuario_id'], $mensaje]);

header('Location: ../../index.php?contacto=ok');
exit;