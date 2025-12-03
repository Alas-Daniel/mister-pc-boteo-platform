<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$loggedIn = isset($_SESSION['usuario_id']);
?>

<header id="mainHeader" class="py-2 bg-white shadow-sm sticky-top">
    <div class="container-lg d-flex align-items-center justify-content-between">

        <!-- Logo -->
        <a href="<?= BASE_URL ?>" class="navbar-brand d-flex align-items-center">
            <img
                src="https://res.cloudinary.com/drztldzvn/image/upload/v1753135279/logo-mr-pc_jsjwx1.png"
                alt="Logo Mister PC Boteo"
                width="70"
                class="img-fluid rounded"
            />
            <span class="ms-2 fw-bold text-primary">Mister PC Boteo</span>
        </a>

        <!-- Navegación desktop -->
        <nav class="d-none d-lg-flex align-items-center">
            <a href="<?= BASE_URL ?>" class="nav-link mx-2 link-dark">Inicio</a>
            <a href="<?= BASE_URL ?>servicios" class="nav-link mx-2 link-dark">Servicios</a>
            <a href="<?= BASE_URL ?>productos" class="nav-link mx-2 link-dark">Productos</a>
            <a href="<?= BASE_URL ?>nosotros" class="nav-link mx-2 link-dark">Sobre Nosotros</a>
            <a href="<?= BASE_URL ?>contacto" class="nav-link mx-2 link-dark">Contacto</a>
        </nav>

        <!-- Botón hamburguesa (visible solo en móvil/tablet) -->
        <button
            class="navbar-toggler d-lg-none btn btn-outline-dark"
            type="button"
            aria-label="Abrir menú de navegación"
            data-bs-toggle="offcanvas"
            data-bs-target="#menuLateral"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

    </div>
</header>

<!-- Offcanvas lateral -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="menuLateral" style="width: 250px;">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">Menú</h5>
        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="offcanvas"
            aria-label="Cerrar menú"
        ></button>
    </div>
    <div class="offcanvas-body">
        <nav class="nav flex-column">
            <a href="<?= BASE_URL ?>" class="nav-link">Inicio</a>
            <a href="<?= BASE_URL ?>servicios" class="nav-link">Servicios</a>
            <a href="<?= BASE_URL ?>productos" class="nav-link">Productos</a>
            <a href="<?= BASE_URL ?>nosotros" class="nav-link">Sobre Nosotros</a>
            <a href="<?= BASE_URL ?>contacto" class="nav-link">Contacto</a>
        </nav>
    </div>
</div>

<style>
        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%280, 0, 0, 0.75%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }
</style>

<!-- Bootstrap 5 JS (requerido para offcanvas, etc.) -->
<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"
></script>