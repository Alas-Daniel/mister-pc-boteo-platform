<?php
// Iniciar sesión solo si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verificar sesión activa
if (!isset($_SESSION['usuario'])) {
    header('Location: ' . BASE_URL . 'login');
    exit;
}

// Guardar datos del usuario de manera segura
$usuario_nombre = $_SESSION['usuario']['nombre'] ?? 'Invitado';
$usuario_rol    = $_SESSION['usuario']['rol'] ?? 'Desconocido';

?>

<!-- Header de Panel -->
<header class="bg-primary text-white py-2 px-4 d-flex justify-content-between align-items-center">
    <!-- Logo que apunta al inicio del panel según rol -->
    <a href="<?= BASE_URL ?>">
        <img src="https://res.cloudinary.com/drztldzvn/image/upload/v1757213272/Logo_Mister_PC_bhghmg.png"
            alt="Logo Mister PC Boteo" height="60">
    </a>

    <!-- Bienvenida al usuario -->
    <div>Bienvenido <?= htmlspecialchars($usuario_rol) ?>: <?= htmlspecialchars($usuario_nombre) ?></div>

    <!-- Botón de cerrar sesión -->
    <form action="<?= BASE_URL ?>logout" method="post" style="margin:0;">
        <button type="submit" class="btn btn-light btn-sm fw-semibold">Cerrar Sesión</button>
    </form>
</header>
