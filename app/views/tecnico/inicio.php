<!DOCTYPE html>
<html lang="es">

<!-- Head -->
<?php include __DIR__ . '/../layouts/panel/head.php'; ?>

<body class="vh-100 d-flex flex-column">

    <!-- Header -->
    <?php include __DIR__ . '/../layouts/panel/header.php'; ?>

    <div class="flex-grow-1 d-flex flex-column flex-md-row" style="min-height: 0;">

        <!-- Aside Tecnico -->
        <?php include __DIR__ . '/../layouts/panel/aside_tecnico.php'; ?>

        <main class="flex-grow-1">
            <section class="container">
                <div>
                    <h4 class="text-center mt-4 mb-3 fw-bold">PANEL DE TÉCNICO</h4>
                    <div class="text-center mb-4">
                        <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#modalCambiarContrasena">
                            <i class="bi bi-gear me-1"></i> Editar información
                        </button>
                    </div>
                </div>

                <!-- Mensajes de éxito/error -->
                <?php if (isset($exito)): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        ¡Contraseña actualizada exitosamente!
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <?php if (isset($error)): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?php
                        switch ($error) {
                            case 'campos_vacios':
                                echo 'Todos los campos son obligatorios.';
                                break;
                            case 'contrasenas_no_coinciden':
                                echo 'Las contraseñas no coinciden.';
                                break;
                            case 'contrasena_corta':
                                echo 'La contraseña debe tener al menos 6 caracteres.';
                                break;
                            case 'contrasena_incorrecta':
                                echo 'La contraseña actual es incorrecta.';
                                break;
                        }
                        ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <div class="row align-items-center justify-content-center gy-4">
                    <div class="col-md-5">
                        <div class="bg-yellow rounded p-3 text-center text-white">
                            <h5 class="fw-bold">Equipos Asignados</h5>
                            <p class="number-size mb-4"><?= $equipos_asignados ?? 0 ?></p>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="bg-pink rounded p-3 text-center text-white">
                            <h5 class="fw-bold">Equipos Terminados</h5>
                            <p class="number-size mb-4"><?= $equipos_terminados ?? 0 ?></p>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="bg-green rounded p-3 text-center text-white">
                            <h5 class="fw-bold">Equipos Reparados</h5>
                            <p class="number-size mb-4"><?= $equipos_reparados ?? 0 ?></p>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="bg-light-blue rounded p-3 text-center text-white">
                            <h5 class="fw-bold">Productos en Almacén</h5>
                            <p class="number-size mb-4"><?= $productos_almacen ?? 0 ?></p>
                        </div>
                    </div>
                </div>
            </section>
        </main>

    </div>

    <!-- Modal Cambiar Contraseña -->
    <div class="modal fade" id="modalCambiarContrasena" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cambiar Contraseña</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form method="POST" action="<?= BASE_URL ?>tecnico/inicio">
                    <input type="hidden" name="action" value="change_password">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Contraseña actual *</label>
                            <input type="password" class="form-control" name="contrasena_actual" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nueva contraseña *</label>
                            <input type="password" class="form-control" name="nueva_contrasena" required minlength="6">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Confirmar nueva contraseña *</label>
                            <input type="password" class="form-control" name="confirmar_contrasena" required minlength="6">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Actualizar contraseña</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>