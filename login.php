<?php
// =============================================
//  INICIO DE SESIÓN
// =============================================
session_start();

// Si ya está logueado, redirigir al inicio
if (isset($_SESSION['usuario_id'])) {
    header('Location: index.php');
    exit;
}

require_once __DIR__ . '/assets/backend/conexion.php';

$error  = '';
$correo = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $correo   = trim($_POST['correo']   ?? '');
    $password = trim($_POST['password'] ?? '');

    // --- Validaciones básicas ---
    if (empty($correo) || empty($password)) {
        $error = 'Completa todos los campos.';

    } elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $error = 'El correo electrónico no es válido.';

    } else {
        // Buscar usuario
        $stmt = $pdo->prepare('SELECT id, nombre, correo, password FROM usuarios WHERE correo = ?');
        $stmt->execute([$correo]);
        $usuario = $stmt->fetch();

        if ($usuario && password_verify($password, $usuario['password'])) {
            // Login exitoso
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['nombre']     = $usuario['nombre'];
            $_SESSION['correo']     = $usuario['correo'];

            header('Location: index.php');
            exit;
        } else {
            $error = 'Correo o contraseña incorrectos.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión | Portafolio Bryam Beltrán</title>
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
            max-width: 450px;
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
        <h1 class="fs-3 fw-bold mb-1">Bienvenido de vuelta</h1>
        <p class="text-secondary mb-0">Inicia sesión para enviarme un mensaje</p>
    </section>

    <!-- ALERTA DE ERROR -->
    <?php if ($error): ?>
        <div class="alert alert-danger d-flex align-items-center gap-2 rounded-3" role="alert">
            <i class="bi bi-exclamation-circle-fill"></i>
            <span><?= htmlspecialchars($error) ?></span>
        </div>
    <?php endif; ?>

    <!-- FORMULARIO -->
    <form method="POST" action="login.php" novalidate>

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
        <div class="mb-4">
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
                    placeholder="Tu contraseña"
                    required
                >
            </div>
        </div>

        <!-- BOTÓN -->
        <button type="submit" class="btn btn-auth w-100 mb-3">
            <i class="bi bi-box-arrow-in-right me-2"></i>Iniciar sesión
        </button>

    </form>

    <div class="divider">o</div>

    <!-- LINK A REGISTRO -->
    <p class="text-center mb-0 text-secondary">
        ¿No tienes cuenta?
        <a href="register.php" class="link-auth">Crear cuenta gratis</a>
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
