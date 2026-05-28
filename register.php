<?php
// =============================================
//  REGISTRO DE USUARIO
// =============================================
session_start();

// Si ya está logueado, redirigir al inicio
if (isset($_SESSION['usuario_id'])) {
    header('Location: index.php');
    exit;
}

require_once __DIR__ . '/assets/backend/conexion.php';

$error   = '';
$exito   = '';
$nombre  = '';
$correo  = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nombre    = trim($_POST['nombre']    ?? '');
    $correo    = trim($_POST['correo']    ?? '');
    $password  = trim($_POST['password']  ?? '');
    $confirmar = trim($_POST['confirmar'] ?? '');

    // --- Validaciones ---
    if (empty($nombre) || empty($correo) || empty($password) || empty($confirmar)) {
        $error = 'Todos los campos son obligatorios.';

    } elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $error = 'El correo electrónico no es válido.';

    } elseif (strlen($password) < 6) {
        $error = 'La contraseña debe tener al menos 6 caracteres.';

    } elseif ($password !== $confirmar) {
        $error = 'Las contraseñas no coinciden.';

    } else {
        // Verificar si el correo ya existe
        $stmt = $pdo->prepare('SELECT id FROM usuarios WHERE correo = ?');
        $stmt->execute([$correo]);

        if ($stmt->fetch()) {
            $error = 'Ese correo ya está registrado. ¿Quieres <a href="login.php">iniciar sesión</a>?';
        } else {
            // Guardar usuario con contraseña hasheada
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare('INSERT INTO usuarios (nombre, correo, password) VALUES (?, ?, ?)');
            $stmt->execute([$nombre, $correo, $hash]);

            $exito = '¡Cuenta creada correctamente! Ya puedes <a href="login.php">iniciar sesión</a>.';
            $nombre = $correo = ''; // Limpiar campos
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse | Portafolio Bryam Beltrán</title>
    <link rel="icon" type="image/webp" href="assets/img/icono.webp">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- CSS propio -->
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #16a34a 0%, #22c55e 50%, #15803d 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 15px;
        }
        .tarjeta-auth {
            background: white;
            border-radius: 20px;
            padding: 50px 45px;
            width: 100%;
            max-width: 480px;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.2);
        }
        .logo-auth {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid #16a34a;
        }
        .btn-auth {
            background-color: #16a34a;
            border-color: #16a34a;
            color: white;
            padding: 13px;
            border-radius: 10px;
            font-weight: 600;
            transition: 0.3s ease;
        }
        .btn-auth:hover {
            background-color: #15803d;
            border-color: #15803d;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(22, 163, 74, 0.35);
        }
        .form-control:focus {
            border-color: #16a34a;
            box-shadow: 0 0 0 0.2rem rgba(22, 163, 74, 0.2);
        }
        .link-auth {
            color: #16a34a;
            font-weight: 500;
            text-decoration: none;
        }
        .link-auth:hover {
            color: #15803d;
            text-decoration: underline;
        }
        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #9ca3af;
            font-size: 0.9rem;
            margin: 20px 0;
        }
        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background-color: #e5e7eb;
        }
    </style>
</head>
<body>

<article class="tarjeta-auth">

    <!-- ENCABEZADO -->
    <section class="text-center mb-4">
        <a href="index.php">
            <img src="assets/img/icono.webp" alt="Logo" class="logo-auth mb-3">
        </a>
        <h1 class="fs-3 fw-bold mb-1">Crear cuenta</h1>
        <p class="text-secondary mb-0">Regístrate para poder enviarme un mensaje</p>
    </section>

    <!-- ALERTAS -->
    <?php if ($error): ?>
        <div class="alert alert-danger d-flex align-items-center gap-2 rounded-3" role="alert">
            <i class="bi bi-exclamation-circle-fill"></i>
            <span><?= $error ?></span>
        </div>
    <?php endif; ?>

    <?php if ($exito): ?>
        <div class="alert alert-success d-flex align-items-center gap-2 rounded-3" role="alert">
            <i class="bi bi-check-circle-fill"></i>
            <span><?= $exito ?></span>
        </div>
    <?php endif; ?>

    <!-- FORMULARIO -->
    <form method="POST" action="register.php" novalidate>

        <!-- NOMBRE -->
        <div class="mb-3">
            <label for="nombre" class="form-label fw-semibold">Nombre</label>
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0">
                    <i class="bi bi-person text-secondary"></i>
                </span>
                <input
                    type="text"
                    id="nombre"
                    name="nombre"
                    class="form-control border-start-0 ps-0"
                    placeholder="Tu nombre completo"
                    value="<?= htmlspecialchars($nombre) ?>"
                    required
                >
            </div>
        </div>

        <!-- CORREO -->
        <div class="mb-3">
            <label for="correo" class="form-label fw-semibold">Correo electrónico</label>
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0">
                    <i class="bi bi-envelope text-secondary"></i>
                </span>
                <input
                    type="email"
                    id="correo"
                    name="correo"
                    class="form-control border-start-0 ps-0"
                    placeholder="correo@ejemplo.com"
                    value="<?= htmlspecialchars($correo) ?>"
                    required
                >
            </div>
        </div>

        <!-- CONTRASEÑA -->
        <div class="mb-3">
            <label for="password" class="form-label fw-semibold">Contraseña</label>
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0">
                    <i class="bi bi-lock text-secondary"></i>
                </span>
                <input
                    type="password"
                    id="password"
                    name="password"
                    class="form-control border-start-0 ps-0"
                    placeholder="Mínimo 6 caracteres"
                    required
                >
            </div>
        </div>

        <!-- CONFIRMAR CONTRASEÑA -->
        <div class="mb-4">
            <label for="confirmar" class="form-label fw-semibold">Confirmar contraseña</label>
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0">
                    <i class="bi bi-lock-fill text-secondary"></i>
                </span>
                <input
                    type="password"
                    id="confirmar"
                    name="confirmar"
                    class="form-control border-start-0 ps-0"
                    placeholder="Repite tu contraseña"
                    required
                >
            </div>
        </div>

        <!-- BOTÓN -->
        <button type="submit" class="btn btn-auth w-100 mb-3">
            <i class="bi bi-person-plus-fill me-2"></i>Crear cuenta
        </button>

    </form>

    <div class="divider">o</div>

    <!-- LINK A LOGIN -->
    <p class="text-center mb-0 text-secondary">
        ¿Ya tienes cuenta?
        <a href="login.php" class="link-auth">Iniciar sesión</a>
    </p>

    <div class="text-center mt-3">
        <a href="index.php" class="link-auth small">
            <i class="bi bi-arrow-left me-1"></i>Volver al portafolio
        </a>
    </div>

</article>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
