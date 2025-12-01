<!DOCTYPE html>
<html lang="es">

<?php include __DIR__ . '/../layouts/panel/head.php'; ?>

<body>

<?php include __DIR__ . '/../layouts/panel/header.php'; ?>

<div class="flex-grow-1 d-flex flex-column flex-md-row" style="min-height: 0;">

    <?php include __DIR__ . '/../layouts/panel/aside_admin.php'; ?>

    <main class="flex-grow-1 overflow-auto p-4">
        <h4 class="text-center mb-5 fw-bold">TÉCNICOS</h4>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Correo Electrónico</th>
                        <th>Teléfono</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($usuarios)): ?>
                        <?php foreach ($usuarios as $user): ?>
                            <tr>
                                <td><?= htmlspecialchars($user['id']) ?></td>
                                <td><?= htmlspecialchars($user['nombre_completo']) ?></td>
                                <td><?= htmlspecialchars($user['email']) ?></td>
                                <td><?= htmlspecialchars($user['telefono'] ?? '-') ?></td>
                                <td>
                                    <?php if ($user['is_active']): ?>
                                        <span class="badge bg-success">Activo</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">Inactivo</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">No hay técnicos registrados.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>

</div>

<!-- Modal Agregar Técnico -->
<div class="modal fade" id="modalAgregarTecnico" tabindex="-1" aria-labelledby="modalAgregarTecnicoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAgregarTecnicoLabel">Agregar Técnico</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                <?php endif; ?>
                <?php if (!empty($success)): ?>
                    <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
                <?php endif; ?>

                <form method="POST" action="<?= BASE_URL ?>admin/tecnicos">
                    <div class="mb-3">
                        <label class="form-label">Nombre completo</label>
                        <input type="text" class="form-control" name="nombre_tecnico" placeholder="Ej: Juan Pérez" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Correo electrónico</label>
                        <input type="email" class="form-control" name="email_tecnico" placeholder="Ej: juan@mail.com" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Teléfono</label>
                        <input type="tel" class="form-control" name="telefono_tecnico" placeholder="Ej: 1234-5678">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">DUI (sin guiones)</label>
                        <input type="text" class="form-control" name="dui_tecnico" placeholder="Ej: 012345678" maxlength="10" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Dirección</label>
                        <textarea class="form-control" name="direccion_tecnico" rows="2" placeholder="Dirección del técnico"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Contraseña</label>
                        <input type="password" class="form-control" name="password_tecnico" required minlength="6">
                    </div>
                    <div class="text-end">
                        <button type="submit" name="agregar_tecnico" class="btn btn-primary">Agregar técnico</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Editar y Eliminar (puedes dejarlos deshabilitados por ahora o implementarlos después) -->
<div class="modal fade" id="confirmarEliminar" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmar eliminación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                ¿Está seguro que desea eliminar a este técnico?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger">Eliminar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEditarTecnico" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Técnico</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p class="text-center">Funcionalidad en desarrollo.</p>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>