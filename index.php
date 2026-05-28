<?php
// =============================================
//  PÁGINA PRINCIPAL — PORTAFOLIO
// =============================================
session_start();

$logueado     = isset($_SESSION['usuario_id']);
$nombre_sesion = htmlspecialchars($_SESSION['nombre'] ?? '');

// Mensaje de resultado del formulario de contacto
$contacto_msg  = '';
$contacto_tipo = '';

$estado = $_GET['contacto'] ?? '';
if ($estado === 'ok') {
    $contacto_msg  = '¡Mensaje enviado correctamente! Te responderé pronto.';
    $contacto_tipo = 'success';
} elseif ($estado === 'campos') {
    $contacto_msg  = 'Completa todos los campos antes de enviar.';
    $contacto_tipo = 'danger';
} elseif ($estado === 'correo') {
    $contacto_msg  = 'El correo electrónico ingresado no es válido.';
    $contacto_tipo = 'danger';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portafolio | Bryam Beltrán</title>
    <link rel="icon" type="image/webp" href="assets/img/icono.webp">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        /* --- Sesión en navbar --- */
        .dropdown-toggle::after { display: none; }
        .btn-usuario {
            background-color: #16a34a;
            color: white;
            border: none;
            border-radius: 50px;
            padding: 8px 20px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: 0.3s ease;
        }
        .btn-usuario:hover {
            background-color: #15803d;
            color: white;
        }
        .avatar-letra {
            width: 28px;
            height: 28px;
            background-color: white;
            color: #16a34a;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.85rem;
        }
        /* --- Bloque "debes iniciar sesión" --- */
        .bloque-login {
            background: linear-gradient(135deg, #f0fdf4, #dcfce7);
            border: 2px dashed #86efac;
            border-radius: 20px;
            padding: 50px 30px;
            text-align: center;
        }
        .bloque-login i {
            font-size: 3rem;
            color: #16a34a;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>

<!-- HEADER -->
<header class="encabezado shadow-sm">
    <nav class="navbar navbar-expand-lg bg-white py-3">
        <section class="container">

            <!-- LOGO -->
            <a class="navbar-brand fw-bold fs-4 d-flex align-items-center gap-2" href="index.php">
                <img src="assets/img/icono.webp" alt="Logo" class="logo-navbar">
                Bryam Beltrán
            </a>

            <!-- BOTÓN RESPONSIVE -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuNavegacion">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- MENÚ -->
            <section class="collapse navbar-collapse" id="menuNavegacion">

                <!-- LINKS -->
                <ul class="navbar-nav mx-auto gap-2">
                    <li class="nav-item">
                        <a class="nav-link link-navbar" href="#biografia">Biografía</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link-navbar" href="#habilidades">Habilidades</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link-navbar" href="#tecnologias">Tecnologías</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link-navbar" href="#proyectos">Proyectos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link-navbar" href="#contacto">Contacto</a>
                    </li>
                </ul>

                <!-- SESIÓN -->
                <?php if ($logueado): ?>
                    <!-- Usuario logueado: menú desplegable -->
                    <div class="dropdown">
                        <button class="btn-usuario dropdown-toggle" data-bs-toggle="dropdown">
                            <span class="avatar-letra">
                                <?= strtoupper(mb_substr($_SESSION['nombre'] ?? 'U', 0, 1)) ?>
                            </span>
                            <?= $nombre_sesion ?>
                            <i class="bi bi-chevron-down small"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2">
                            <li>
                                <span class="dropdown-item-text text-secondary small">
                                    <?= htmlspecialchars($_SESSION['correo'] ?? '') ?>
                                </span>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item text-danger" href="logout.php">
                                    <i class="bi bi-box-arrow-right me-2"></i>Cerrar sesión
                                </a>
                            </li>
                        </ul>
                    </div>
                <?php else: ?>
                    <!-- No logueado: botones login/registro -->
                    <div class="d-flex gap-2">
                        <a href="login.php" class="btn px-4" style="background-color: #16a34a; border-color: #16a34a; color:white;">
                            Iniciar sesión
                        </a>
                        <a href="register.php" class="btn btn-outline-success px-4">
                            Registrarse
                        </a>
                    </div>
                <?php endif; ?>

            </section>
        </section>
    </nav>
</header>

<!-- BIOGRAFÍA -->
<main>
    <section id="biografia" class="biografia py-5">
        <section class="container">
            <section class="row align-items-center gy-5">
                <!-- FOTO -->
                <section class="col-lg-3 text-center">
                    <img
                        src="assets/img/yo.jpeg"
                        alt="Foto de Bryam Beltrán"
                        class="foto-perfil img-fluid"
                    >
                </section>
                <!-- INFORMACIÓN -->
                <section class="col-lg-9 text-white">
                    <h1 class="display-3 fw-bold">Bryam Beltrán Barrientos</h1>
                    <h2 class="fw-semibold mb-4">
                        Estudiante de Técnico en Informática en la Universidad Católica de Temuco.
                    </h2>
                    <p class="lead">
                        Actualmente poniendo en práctica mis conocimientos
                        en desarrollo web, bases de datos y programación,
                        creando proyectos modernos y funcionales para seguir
                        mejorando mis habilidades como desarrollador.
                    </p>
                </section>
            </section>
        </section>
    </section>
</main>

<!-- HABILIDADES -->
<section id="habilidades" class="habilidades py-5">
    <section class="container">
        <section class="text-center mb-5">
            <h2 class="display-4 fw-bold">Habilidades</h2>
            <p class="lead text-secondary">Áreas en las que he desarrollado experiencia durante mi formación.</p>
        </section>
        <section class="row g-4">
            <section class="col-lg-6">
                <article class="bloque-habilidad">
                    <section class="d-flex justify-content-between">
                        <h3>Frontend Development</h3><span>80 XP</span>
                    </section>
                    <section class="barra-minecraft" data-xp="8"></section>
                </article>
            </section>
            <section class="col-lg-6">
                <article class="bloque-habilidad">
                    <section class="d-flex justify-content-between">
                        <h3>Backend Development</h3><span>65 XP</span>
                    </section>
                    <section class="barra-minecraft" data-xp="6"></section>
                </article>
            </section>
            <section class="col-lg-6">
                <article class="bloque-habilidad">
                    <section class="d-flex justify-content-between">
                        <h3>Database Management</h3><span>70 XP</span>
                    </section>
                    <section class="barra-minecraft" data-xp="7"></section>
                </article>
            </section>
            <section class="col-lg-6">
                <article class="bloque-habilidad">
                    <section class="d-flex justify-content-between">
                        <h3>Mobile Development</h3><span>40 XP</span>
                    </section>
                    <section class="barra-minecraft" data-xp="4"></section>
                </article>
            </section>
        </section>
    </section>
</section>

<!-- TECNOLOGÍAS -->
<section id="tecnologias" class="tecnologias py-5">
    <section class="container">
        <section class="text-center mb-5">
            <h2 class="display-4 fw-bold">Tecnologías Dominadas</h2>
            <p class="lead text-secondary">Tecnologías y herramientas que utilizo durante mi formación y desarrollo de proyectos web.</p>
        </section>
        <section class="row g-4">
            <section class="col-md-6 col-lg-3">
                <article class="tarjeta-tecnologia text-center">
                    <i class="bi bi-filetype-py tecnologia-icono"></i>
                    <h3>Python</h3><p>Programación</p>
                </article>
            </section>
            <section class="col-md-6 col-lg-3">
                <article class="tarjeta-tecnologia text-center">
                    <i class="bi bi-filetype-html tecnologia-icono"></i>
                    <h3>HTML5</h3><p>Estructura Web</p>
                </article>
            </section>
            <section class="col-md-6 col-lg-3">
                <article class="tarjeta-tecnologia text-center">
                    <i class="bi bi-filetype-css tecnologia-icono"></i>
                    <h3>CSS3</h3><p>Diseño Web</p>
                </article>
            </section>
            <section class="col-md-6 col-lg-3">
                <article class="tarjeta-tecnologia text-center">
                    <i class="bi bi-cup-hot tecnologia-icono"></i>
                    <h3>Java</h3><p>Backend</p>
                </article>
            </section>
            <section class="col-md-6 col-lg-3">
                <article class="tarjeta-tecnologia text-center">
                    <i class="bi bi-filetype-js tecnologia-icono"></i>
                    <h3>JavaScript</h3><p>Interactividad</p>
                </article>
            </section>
            <section class="col-md-6 col-lg-3">
                <article class="tarjeta-tecnologia text-center">
                    <i class="bi bi-bootstrap tecnologia-icono"></i>
                    <h3>Bootstrap</h3><p>Framework CSS</p>
                </article>
            </section>
            <section class="col-md-6 col-lg-3">
                <article class="tarjeta-tecnologia text-center">
                    <i class="bi bi-filetype-php tecnologia-icono"></i>
                    <h3>PHP</h3><p>Backend</p>
                </article>
            </section>
            <section class="col-md-6 col-lg-3">
                <article class="tarjeta-tecnologia text-center">
                    <i class="bi bi-database tecnologia-icono"></i>
                    <h3>MySQL</h3><p>Base de Datos</p>
                </article>
            </section>
            <section class="col-md-6 col-lg-3">
                <article class="tarjeta-tecnologia text-center">
                    <i class="bi bi-server tecnologia-icono"></i>
                    <h3>MongoDB</h3><p>NoSQL</p>
                </article>
            </section>
            <section class="col-md-6 col-lg-3">
                <article class="tarjeta-tecnologia text-center">
                    <i class="bi bi-git tecnologia-icono"></i>
                    <h3>Git</h3><p>Control de versiones</p>
                </article>
            </section>
        </section>
    </section>

<!-- PROYECTOS -->
<section id="proyectos" class="proyectos py-5">
    <section class="container">
        <section class="text-center mb-5">
            <h2 class="display-4 fw-bold">Proyectos Destacados</h2>
            <p class="lead text-secondary">Algunos proyectos desarrollados durante mi formación.</p>
        </section>
        <section class="row g-4">
            <section class="col-lg-4">
                <a href="https://github.com/Bryambeltran/proyecto-tareas-gestor" class="text-decoration-none">
                    <article class="tarjeta-proyecto">
                        <img src="assets/img/gestortareas.jpg" alt="Proyecto 1" class="img-fluid imagen-proyecto">
                        <section class="contenido-proyecto">
                            <h3>Proyecto 1</h3>
                            <p>Gestor de tareas en HTML y JS para asignar tareas en una fecha indicada, así gestionarlas como importantes y menos importantes</p>
                        </section>
                    </article>
                </a>
            </section>
            <section class="col-lg-4">
                <a href="https://github.com/Bryambeltran/calculadora-con-python" class="text-decoration-none">
                    <article class="tarjeta-proyecto">
                        <img src="assets/img/calculadora.webp" alt="Proyecto 2" class="img-fluid imagen-proyecto">
                        <section class="contenido-proyecto">
                            <h3>Proyecto 2</h3>
                            <p>Calculadora hecha en python para resolver ecuaciones numericas</p>
                        </section>
                    </article>
                </a>
            </section>
            <section class="col-lg-4">
                <a href="https://github.com/Bryambeltran/sitiowebcasino" class="text-decoration-none">
                    <article class="tarjeta-proyecto">
                        <img src="assets/img/casino.png" alt="Proyecto 3" class="img-fluid imagen-proyecto">
                        <section class="contenido-proyecto">
                            <h3>Proyecto 3</h3>
                            <p>Sitio web del cacino de la Universidad Católica de Témuco</p>
                        </section>
                    </article>
                </a>
            </section>
        </section>
    </section>
</section>

<!-- CONTACTO -->
<section id="contacto" class="contacto py-5">
    <section class="container">
        <section class="text-center mb-5">
            <h2 class="display-4 fw-bold">Contacto</h2>
            <p class="lead text-secondary">
                Estoy disponible para colaborar en proyectos y seguir desarrollando experiencia.
            </p>
        </section>

        <section class="row g-5 align-items-start">

            <!-- INFORMACIÓN -->
            <section class="col-lg-5">
                <article class="informacion-contacto">
                    <h3 class="fw-bold mb-3">Información de contacto</h3>
                    <p class="text-secondary mb-4">
                        Estoy disponible para colaborar en proyectos y seguir
                        desarrollando experiencia en el área informática.
                    </p>
                    <article class="tarjeta-contacto">
                        <i class="bi bi-envelope-fill icono-contacto"></i>
                        <section>
                            <span class="titulo-contacto">Correo</span>
                            <p class="mb-0">bryam@email.com</p>
                        </section>
                    </article>
                    <article class="tarjeta-contacto">
                        <i class="bi bi-telephone-fill icono-contacto"></i>
                        <section>
                            <span class="titulo-contacto">Teléfono</span>
                            <p class="mb-0">+56 9 1234 5678</p>
                        </section>
                    </article>
                    <article class="tarjeta-contacto">
                        <i class="bi bi-geo-alt-fill icono-contacto"></i>
                        <section>
                            <span class="titulo-contacto">Ubicación</span>
                            <p class="mb-0">Santiago, Chile</p>
                        </section>
                    </article>
                    <section class="redes-sociales mt-4">
                        <h4 class="fw-semibold mb-3">Redes sociales</h4>
                        <section class="d-flex gap-3">
                            <a href="https://github.com/Bryambeltran" class="icono-red"><i class="bi bi-github"></i></a>
                            <a href="#" class="icono-red"><i class="bi bi-linkedin"></i></a>
                            <a href="https://www.instagram.com/b_beltrvn" class="icono-red"><i class="bi bi-instagram"></i></a>
                        </section>
                    </section>
                </article>
            </section>

            <!-- FORMULARIO / BLOQUE DE SESIÓN -->
            <section class="col-lg-7">
                <article class="formulario-contacto">

                    <?php if ($logueado): ?>

                        <h3 class="fw-bold mb-4">
                            Hola, <?= $nombre_sesion ?>  — envíame un mensaje
                        </h3>

                        <!-- Alerta de resultado -->
                        <?php if ($contacto_msg): ?>
                            <div class="alert alert-<?= $contacto_tipo ?> d-flex align-items-center gap-2 rounded-3 mb-4" role="alert">
                                <i class="bi bi-<?= $contacto_tipo === 'success' ? 'check-circle-fill' : 'exclamation-circle-fill' ?>"></i>
                                <span><?= htmlspecialchars($contacto_msg) ?></span>
                            </div>
                        <?php endif; ?>

                        <form method="POST" action="assets/backend/contacto.php">

                            <!-- NOMBRE -->
                            <section class="mb-4">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input
                                    type="text"
                                    id="nombre"
                                    name="nombre"
                                    class="form-control"
                                    placeholder="Tu nombre"
                                    value="<?= htmlspecialchars($_SESSION['nombre'] ?? '') ?>"
                                    required
                                >
                            </section>

                            <!-- CORREO -->
                            <section class="mb-4">
                                <label for="correo" class="form-label">Correo</label>
                                <input
                                    type="email"
                                    id="correo"
                                    name="correo"
                                    class="form-control"
                                    placeholder="correo@email.com"
                                    value="<?= htmlspecialchars($_SESSION['correo'] ?? '') ?>"
                                    required
                                >
                            </section>

                            <!-- MENSAJE -->
                            <section class="mb-4">
                                <label for="mensaje" class="form-label">Mensaje</label>
                                <textarea
                                    id="mensaje"
                                    name="mensaje"
                                    class="form-control"
                                    rows="6"
                                    placeholder="Escribe tu mensaje..."
                                    required
                                ></textarea>
                            </section>

                            <!-- BOTÓN -->
                            <button type="submit" class="btn text-white w-100 py-3" style="background-color: #16a34a; border-color: #16a34a;">
                                <i class="bi bi-send-fill me-2"></i>Enviar mensaje
                            </button>

                        </form>

                    <?php else: ?>

                        <!-- BLOQUE: Debe iniciar sesión -->
                        <div class="bloque-login">
                            <i class="bi bi-lock-fill d-block"></i>
                            <h4 class="fw-bold mb-2">Inicia sesión para escribirme</h4>
                            <p class="text-secondary mb-4">
                                Para enviarme un mensaje necesitas tener una cuenta y haber iniciado sesión.
                            </p>
                            <div class="d-flex gap-3 justify-content-center flex-wrap">
                                <a href="login.php" class="btn text-white px-4 py-2" style="background-color: #16a34a; border-color: #16a34a;">
                                    <i class="bi bi-box-arrow-in-right me-2"></i>Iniciar sesión
                                </a>
                                <a href="register.php" class="btn btn-outline-success px-4 py-2">
                                    <i class="bi bi-person-plus me-2"></i>Crear cuenta
                                </a>
                            </div>
                        </div>

                    <?php endif; ?>

                </article>
            </section>

        </section>
    </section>
</section>

<!-- FOOTER -->
<footer class="footer py-5">
    <section class="container">
        <section class="row g-5">
            <section class="col-lg-4">
                <h3 class="footer-titulo">Bryam Beltrán</h3>
                <p class="footer-texto">
                    Estudiante de Técnico en Informática enfocado en
                    desarrollo web, bases de datos y programación.
                </p>
            </section>
            <section class="col-lg-4">
                <h3 class="footer-titulo">Navegación</h3>
                <nav class="footer-links">
                    <a href="#biografia">Biografía</a>
                    <a href="#tecnologias">Tecnologías</a>
                    <a href="#proyectos">Proyectos</a>
                    <a href="#contacto">Contacto</a>
                </nav>
            </section>
            <section class="col-lg-4">
                <h3 class="footer-titulo">Contacto</h3>
                <section class="footer-contacto">
                    <p><i class="bi bi-envelope-fill"></i>bryam@email.com</p>
                    <p><i class="bi bi-telephone-fill"></i>+56 9 1234 5678</p>
                    <p><i class="bi bi-geo-alt-fill"></i>Santiago, Chile</p>
                </section>
                <section class="footer-redes mt-4">
                    <a href="https://github.com/Bryambeltran"><i class="bi bi-github"></i></a>
                    <a href="#"><i class="bi bi-linkedin"></i></a>
                    <a href="https://www.instagram.com/b_beltrvn"><i class="bi bi-instagram"></i></a>
                </section>
            </section>
        </section>
        <hr class="footer-linea">
        <section class="text-center">
            <p class="footer-copy mb-0">
                © 2026 Bryam Beltrán Barrientos — Todos los derechos reservados.
            </p>
        </section>
    </section>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<!-- JS propio -->
<script src="assets/js/app.js"></script>
</body>
</html>
