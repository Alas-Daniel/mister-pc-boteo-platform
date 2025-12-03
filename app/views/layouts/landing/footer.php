<?php
// Iniciar sesión si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$loggedIn = isset($_SESSION['usuario']);
$usuario_rol = $loggedIn ? $_SESSION['usuario']['rol'] : null;
$usuario_nombre = $loggedIn ? $_SESSION['usuario']['nombre'] : null;
?>

<!-- Footer -->
<footer class="bg-light pt-5">
    <div class="container-lg">
        <div class="row gy-4 text-start">

            <!-- Logo y promoción -->
            <div class="col-6 col-md-3">
                <img src="https://res.cloudinary.com/drztldzvn/image/upload/v1753133485/logo-mr-pc_l1rh9t.png"
                    alt="Logo Mister PC Boteo" width="70" class="img-fluid rounded mb-2">
                <p class="small text-muted">Soluciones completas para hardware y software.</p>
                <div class="d-flex gap-2">
                    <a href="https://facebook.com" target="_blank" class="btn btn-primary btn-sm rounded-circle">
                        <i class="bi bi-facebook"></i>
                    </a>
                    <a href="https://whatsapp.com" target="_blank" class="btn btn-primary btn-sm rounded-circle">
                        <i class="bi bi-whatsapp"></i>
                    </a>
                </div>
            </div>

            <!-- Navegación -->
            <div class="col-6 col-md-3">
                <h6 class="fw-semibold text-primary">Navegación</h6>
                <ul class="list-unstyled mt-3">
                    <li><a href="<?= BASE_URL ?>" class="footer-link">Inicio</a></li>
                    <li><a href="<?= BASE_URL ?>servicios" class="footer-link">Servicios</a></li>
                    <li><a href="<?= BASE_URL ?>productos" class="footer-link">Productos</a></li>
                    <li><a href="<?= BASE_URL ?>nosotros" class="footer-link">Sobre Nosotros</a></li>
                    <li><a href="<?= BASE_URL ?>contacto" class="footer-link">Contacto</a></li>
                </ul>
            </div>

            <!-- Servicios -->
            <div class="col-6 col-md-3">
                <h6 class="fw-semibold text-primary">Servicios</h6>
                <ul class="list-unstyled mt-3">
                    <li><a href="<?= BASE_URL ?>servicios" class="footer-link">Mantenimiento</a></li>
                    <li><a href="<?= BASE_URL ?>servicios" class="footer-link">Reparación de equipos</a></li>
                    <li><a href="<?= BASE_URL ?>servicios" class="footer-link">Venta de repuestos</a></li>
                </ul>
            </div>

            <!-- Contacto -->
            <div class="col-6 col-md-3">
                <h6 class="fw-semibold text-primary">Contacto</h6>
                <ul class="list-unstyled mt-3 small">
                    <li class="mb-2">
                        <i class="bi bi-geo-alt-fill text-primary me-2"></i>
                        Sonzacate, Sonsonate, El Salvador
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-telephone-fill text-primary me-2"></i>
                        +503 7070 - 7070
                    </li>
                    <li>
                        <i class="bi bi-envelope-fill text-primary me-2"></i>
                        mrpcboteo@gmail.com
                    </li>
                </ul>
            </div>
        </div>

        <hr class="mt-5">

        <!-- Créditos y sesión -->
        <div class="text-center py-3 small text-muted d-flex flex-column flex-md-row justify-content-center align-items-center gap-2">
            <p class="me-md-3 mb-1 mb-md-0">© 2025 Mister PC Boteo - Todos los derechos reservados</p>

            <?php if ($loggedIn): ?>
                <?php
                $rutaPanel = ($usuario_rol === 'admin') ? 'admin/panel' : 'tecnico';
                ?>
                <a class="link" href="<?= BASE_URL . $rutaPanel ?>">
                    <i class="bi bi-gear me-2"></i>Gestionar
                </a>
            <?php else: ?>
                <a class="link" href="<?= BASE_URL ?>login">
                    <i class="bi bi-person me-2"></i>Acceder
                </a>
            <?php endif; ?>
        </div>

    </div>
</footer>

<!-- CSS footer -->
<style>
    .footer-link {
        color: #333;
        text-decoration: none;
        transition: color 0.3s ease, border-color 0.3s ease;
    }

    .footer-link:hover {
        color: var(--primary-color);
        border-bottom: 1px solid #1a73e8;
    }
</style>