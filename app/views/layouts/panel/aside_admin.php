<!-- Aside Admin Inicia -->
<aside class="d-flex flex-column flex-md-row">
    <div class="sidebar d-flex flex-row flex-md-column p-3 bg-primary justify-content-between align-items-center"
        style="min-width: 95px;">

        <div class="d-flex flex-row flex-md-column gap-3">
            <!-- En /app/views/layouts/panel/aside_admin.php -->

            <a href="<?= BASE_URL ?>admin/panel" class="nav-link text-center text-white rounded d-flex flex-column">
                <i class="bi bi-house-door-fill fs-3"></i>
                <span>Inicio</span>
            </a>
            
            <a href="<?= BASE_URL ?>admin/equipos" class="nav-link text-center text-white rounded d-flex flex-column">
                <i class="bi bi-laptop-fill fs-3"></i>
                <span>Equipos</span>
            </a>

            <!-- Técnicos (alternativa segura) -->
            <a href="<?= BASE_URL ?>admin/tecnicos" class="nav-link text-center text-white rounded d-flex flex-column">
                <i class="bi bi-gear-fill fs-3"></i>
                <span>Técnicos</span>
            </a>

            <a href="<?= BASE_URL ?>admin/usuarios" class="nav-link text-center text-white rounded d-flex flex-column">
                <i class="bi bi-shield-lock-fill fs-3"></i>
                <span>Usuarios</span>
            </a>

            <a href="<?= BASE_URL ?>admin/empleados" class="nav-link text-center text-white rounded d-flex flex-column">
                <i class="bi bi-person-badge-fill fs-3"></i>
                <span>Empleados</span>
            </a>

            <a href="<?= BASE_URL ?>admin/clientes" class="nav-link text-center text-white rounded d-flex flex-column">
                <i class="bi bi-person-circle fs-3"></i>
                <span>Clientes</span>
            </a>

            <a href="<?= BASE_URL ?>admin/gestion-productos" class="nav-link text-center text-white rounded d-flex flex-column">
                <i class="bi bi-box-seam-fill fs-3"></i>
                <span>Productos</span>
            </a>
        </div>

        <div class="ms-md-0 ms-auto mb-md-4">
            <a href="<?= BASE_URL ?>"
                class="nav-link text-center text-white d-flex flex-column mb-md-5">
                <i class="bi bi-box-arrow-left fs-2"></i>
                <span class="d-md-none">Salir</span>
            </a>
        </div>
    </div>
</aside>
<!-- Aside Admin Finaliza -->