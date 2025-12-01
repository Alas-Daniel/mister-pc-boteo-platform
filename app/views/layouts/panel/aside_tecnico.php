<!-- Aside Tecnico Inicia -->
<aside class="d-flex flex-column flex-md-row">
    <div class="sidebar d-flex flex-row flex-md-column p-3 bg-primary justify-content-between align-items-center"
        style="min-width: 95px;">

        <div class="d-flex flex-row flex-md-column gap-3">
            <a href="<?= BASE_URL ?>tecnico/inicio" class="nav-link text-center text-white d-flex flex-column">
                <i class="bi bi-house-door-fill fs-3"></i>
                <span class="mt-1">Inicio</span>
            </a>

            <a href="<?= BASE_URL ?>tecnico/equipos" class="nav-link text-center text-white d-flex flex-column">
                <i class="bi bi-laptop-fill fs-3"></i>
                <span class="mt-1">Equipos<br>Asignados</span>
            </a>

            <!-- Opcional: ¿debería un técnico gestionar usuarios? Probablemente no. -->
            <!-- Si solo necesita ver su perfil, cambia la ruta a /tecnico/perfil -->
            <a href="<?= BASE_URL ?>tecnico/clientes" class="nav-link text-center text-white d-flex flex-column">
                <i class="bi bi-person-circle fs-3"></i>
                <span class="mt-1">Clientes</span>
            </a>

            <a href="<?= BASE_URL ?>tecnico/productos" class="nav-link text-center text-white d-flex flex-column">
                <i class="bi bi-box-seam-fill fs-3"></i>
                <span class="mt-1">Productos</span>
            </a>
        </div>

        <div class="ms-md-0 ms-auto mb-md-4">
            <a href="<?= BASE_URL ?>login?logout=1" class="nav-link text-center text-white d-flex flex-column mb-md-5" title="Cerrar sesión">
                <i class="bi bi-box-arrow-left fs-2"></i>
            </a>
        </div>
    </div>
</aside>
<!-- Aside Tecnico Finaliza -->