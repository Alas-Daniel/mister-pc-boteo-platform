<!DOCTYPE html>
<html lang="es">

<!-- Head -->
<?php include __DIR__ . '/../layouts/panel/head.php'; ?>

<body>

    <!-- Header -->
    <?php include __DIR__ . '/../layouts/panel/header.php'; ?>

    <div class="flex-grow-1 d-flex flex-column flex-md-row" style="min-height: 0;">

        <!-- Aside admin -->
        <?php include __DIR__ . '/../layouts/panel/aside_admin.php'; ?>

        <main class="flex-grow-1 p-4">
            <h4 class="text-center mb-4 fw-bold">EMPLEADOS REGISTRADOS</h4>

            <?php if (!empty($_SESSION['success'])): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= htmlspecialchars($_SESSION['success']) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>

            <?php if (!empty($_SESSION['error'])): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= htmlspecialchars($_SESSION['error']) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>

            <!-- Botón para agregar -->
            <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalAgregarEmpleado">
                <i class="bi bi-plus"></i> Agregar Empleado
            </button>

            <!-- Tabla -->
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>DUI</th>
                            <th>Teléfono</th>
                            <th>Cargo</th>
                            <th>Acceso al sistema</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($empleados as $emp): ?>
                            <tr>
                                <td><?= htmlspecialchars($emp['id']) ?></td>
                                <td><?= htmlspecialchars($emp['nombre']) ?></td>
                                <td><?= htmlspecialchars($emp['dui']) ?></td>
                                <td><?= htmlspecialchars($emp['telefono'] ?? '-') ?></td>
                                <td><?= htmlspecialchars($emp['cargo'] ?? '-') ?></td>
                                <td>
                                    <?php if ($emp['tiene_usuario']): ?>
                                        <span class="badge bg-success">Sí</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">No</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if (!$emp['tiene_usuario']): ?>
                                        <a href="#" class="text-primary"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalCrearUsuario<?= $emp['id'] ?>">
                                            Crear usuario
                                        </a> |
                                    <?php endif; ?>
                                    <a href="#" class="text-success"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalEditarEmpleado<?= $emp['id'] ?>">
                                        Editar
                                    </a> |
                                    <a href="#" class="text-danger"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalDesactivarEmpleado<?= $emp['id'] ?>">
                                        Desactivar
                                    </a>
                                </td>
                            </tr>

                            <!-- Modal Editar Empleado -->
                            <div class="modal fade" id="modalEditarEmpleado<?= $emp['id'] ?>" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Editar Empleado</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <form method="POST" action="<?= BASE_URL ?>admin/empleados/editar">
                                            <input type="hidden" name="id" value="<?= $emp['id'] ?>">
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label">Nombre completo *</label>
                                                    <input type="text" class="form-control" name="nombre"
                                                        value="<?= htmlspecialchars($emp['nombre']) ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">DUI (sin guiones) *</label>
                                                    <input type="text" class="form-control" name="dui"
                                                        value="<?= htmlspecialchars($emp['dui']) ?>"
                                                        maxlength="10" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Teléfono</label>
                                                    <input type="text" class="form-control" name="telefono"
                                                        value="<?= htmlspecialchars($emp['telefono'] ?? '') ?>">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Dirección</label>
                                                    <textarea class="form-control" name="direccion" rows="2"><?= htmlspecialchars($emp['direccion'] ?? '') ?></textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Cargo *</label>
                                                    <select class="form-select" name="cargo_id" required>
                                                        <option value="">Seleccione un cargo</option>
                                                        <?php foreach ($cargos as $cargo): ?>
                                                            <option value="<?= $cargo['id'] ?>"
                                                                <?= ($emp['cargo_id'] ?? '') == $cargo['id'] ? 'selected' : '' ?>>
                                                                <?= htmlspecialchars($cargo['nombre']) ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-success">Guardar cambios</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Desactivar Empleado -->
                            <div class="modal fade" id="modalDesactivarEmpleado<?= $emp['id'] ?>" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Desactivar Empleado</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            ¿Está seguro que desea desactivar al empleado
                                            <strong><?= htmlspecialchars($emp['nombre']) ?></strong>?
                                            <br>
                                            <small class="text-muted">Esta acción no elimina al empleado, solo lo marca como inactivo.</small>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                            <a href="<?= BASE_URL ?>empleados/desactivar/<?= $emp['id'] ?>" class="btn btn-danger">Desactivar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Crear Usuario -->
                            <?php if (!$emp['tiene_usuario']): ?>
                                <div class="modal fade" id="modalCrearUsuario<?= $emp['id'] ?>" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Crear Usuario para: <?= htmlspecialchars($emp['nombre']) ?></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <form method="POST" action="<?= BASE_URL ?>admin/empleados/crear_usuario"> <!-- ✅ CAMBIADO A _ -->
                                                <input type="hidden" name="empleado_id" value="<?= $emp['id'] ?>">
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">Correo electrónico *</label>
                                                        <input type="email" class="form-control" name="email" required>
                                                        <div class="form-text">Este será el usuario para iniciar sesión.</div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Contraseña *</label>
                                                        <input type="password" class="form-control" name="clave" minlength="6" required>
                                                        <div class="form-text">Mínimo 6 caracteres.</div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Rol *</label>
                                                        <select class="form-select" name="rol" required>
                                                            <option value="">Seleccione un rol</option>
                                                            <option value="tecnico">Técnico</option>
                                                            <option value="admin">Administrador</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                    <button type="submit" class="btn btn-primary">Crear usuario</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <!-- Modal Agregar Empleado -->
    <div class="modal fade" id="modalAgregarEmpleado" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar Nuevo Empleado</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form method="POST" action="<?= BASE_URL ?>admin/empleados/crear">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nombre completo *</label>
                            <input type="text" class="form-control" name="nombre" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">DUI (sin guiones) *</label>
                            <input type="text" class="form-control" name="dui" maxlength="10" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Teléfono</label>
                            <input type="text" class="form-control" name="telefono">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Dirección</label>
                            <textarea class="form-control" name="direccion" rows="2"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Cargo *</label>
                            <select class="form-select" name="cargo_id" required>
                                <option value="">Seleccione un cargo</option>
                                <?php foreach ($cargos as $cargo): ?>
                                    <option value="<?= $cargo['id'] ?>">
                                        <?= htmlspecialchars($cargo['nombre']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Agregar empleado</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>