<!DOCTYPE html>
<html lang="es">

<?php include __DIR__ . '/../layouts/panel/head.php'; ?>

<body>

<?php include __DIR__ . '/../layouts/panel/header.php'; ?>

<div class="flex-grow-1 d-flex flex-column flex-md-row" style="min-height: 0;">

    <?php include __DIR__ . '/../layouts/panel/aside_admin.php'; ?>

    <main class="flex-grow-1 overflow-auto p-4">
        <h4 class="text-center mb-5 fw-bold">GESTIÓN DE USUARIOS</h4>

        <?php if (!empty($_SESSION['success'])): ?>
            <div class="alert alert-success alert-dismissible fade show">
                <?= htmlspecialchars($_SESSION['success']) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <?php if (!empty($_SESSION['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <?= htmlspecialchars($_SESSION['error']) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>DUI</th>
                        <th>Cargo</th>
                        <th>Correo Electrónico</th>
                        <th>Teléfono</th>
                        <th>Rol</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($usuarios)): ?>
                        <?php foreach ($usuarios as $user): ?>
                            <tr>
                                <td><?= htmlspecialchars($user['id']) ?></td>
                                <td><?= htmlspecialchars($user['nombre']) ?></td>
                                <td><?= htmlspecialchars($user['dui']) ?></td>
                                <td><?= htmlspecialchars($user['cargo'] ?? '-') ?></td>
                                <td><?= htmlspecialchars($user['email']) ?></td>
                                <td><?= htmlspecialchars($user['telefono'] ?? '-') ?></td>
                                <td>
                                    <?php if ($user['rol'] === 'admin'): ?>
                                        <span class="badge bg-danger">Admin</span>
                                    <?php else: ?>
                                        <span class="badge bg-info">Técnico</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($user['estado']): ?>
                                        <span class="badge bg-success">Activo</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">Inactivo</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <button type="button" class="text-success" data-bs-toggle="modal" data-bs-target="#modalEditarUsuario<?= $user['id'] ?>">Editar</button>
                                    |
                                    <?php if ($user['estado']): ?>
                                        <a href="<?= BASE_URL ?>admin/usuarios?toggle_usuario=<?= $user['id'] ?>&estado=0" class="text-danger" onclick="return confirm('¿Desactivar este usuario?')">Desactivar</a>
                                    <?php else: ?>
                                        <a href="<?= BASE_URL ?>admin/usuarios?toggle_usuario=<?= $user['id'] ?>&estado=1" class="text-success">Activar</a>
                                    <?php endif; ?>
                                </td>
                            </tr>

                            <!-- Modal Editar Usuario -->
                            <div class="modal fade" id="modalEditarUsuario<?= $user['id'] ?>" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5>Editar Usuario: <?= htmlspecialchars($user['nombre']) ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <form method="POST" action="<?= BASE_URL ?>admin/usuarios">
                                            <input type="hidden" name="id_usuario" value="<?= $user['id'] ?>">
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label">Correo electrónico *</label>
                                                    <input type="email" name="email_usuario" class="form-control" 
                                                           value="<?= htmlspecialchars($user['email']) ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Nueva contraseña (dejar vacío para no cambiar)</label>
                                                    <input type="password" name="clave_usuario" class="form-control" minlength="6">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                <button type="submit" name="editar_usuario" class="btn btn-success">Guardar cambios</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9" class="text-center">No hay usuarios registrados.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>