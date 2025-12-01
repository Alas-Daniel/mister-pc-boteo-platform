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
            <img src="https://res.cloudinary.com/drztldzvn/image/upload/v1753133485/logo-mr-pc_l1rh9t.png"
                alt="Logo Mister Pc Boteo" width="70" class="img-fluid">
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

        <!-- Botón hamburguesa -->
        <button class="navbar-toggler d-lg-none btn btn-outline-dark" type="button" 
                data-bs-toggle="offcanvas" data-bs-target="#menuLateral">
            <span class="navbar-toggler-icon"></span>
        </button>

    </div>
</header>

<!-- Offcanvas -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="menuLateral" style="width: 250px;">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">Menú</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
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
