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

        <main class="flex-grow-1 overflow-auto p-4">
            <h4 class="text-center mb-5 fw-bold">CLIENTES REGISTRADOS</h4>

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
            <div class="mb-3">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAgregarCliente">
                    <i class="bi bi-plus"></i> Agregar Cliente
                </button>
            </div>

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Teléfono</th>
                            <th>Correo Electrónico</th>
                            <th>Dirección</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($clientes)): ?>
                            <?php foreach ($clientes as $cliente): ?>
                                <tr>
                                    <td><?= htmlspecialchars($cliente['id']) ?></td>
                                    <td><?= htmlspecialchars($cliente['nombre']) ?></td>
                                    <td><?= htmlspecialchars($cliente['telefono'] ?? '-') ?></td>
                                    <td><?= htmlspecialchars($cliente['email'] ?? '-') ?></td>
                                    <td><?= htmlspecialchars($cliente['direccion'] ?? '-') ?></td>
                                    <td>
                                        <a href="#" class="text-success"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalEditarCliente<?= $cliente['id'] ?>">
                                            Editar
                                        </a>
                                    </td>
                                </tr>

                                <!-- Modal Editar Cliente -->
                                <div class="modal fade" id="modalEditarCliente<?= $cliente['id'] ?>" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Editar Cliente</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <form method="POST" action="<?= BASE_URL ?>admin/clientes">
                                                <input type="hidden" name="accion" value="editar">
                                                <input type="hidden" name="id" value="<?= $cliente['id'] ?>">
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">Nombre completo *</label>
                                                        <input type="text" class="form-control" name="nombre"
                                                            value="<?= htmlspecialchars($cliente['nombre']) ?>" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Teléfono</label>
                                                        <input type="text" class="form-control" name="telefono"
                                                            value="<?= htmlspecialchars($cliente['telefono'] ?? '') ?>">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Correo electrónico</label>
                                                        <input type="email" class="form-control" name="email"
                                                            value="<?= htmlspecialchars($cliente['email'] ?? '') ?>">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Dirección</label>
                                                        <textarea class="form-control" name="direccion" rows="2"><?= htmlspecialchars($cliente['direccion'] ?? '') ?></textarea>
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
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center">No hay clientes registrados.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </main>

    </div>

    <!-- Modal Agregar Cliente -->
    <div class="modal fade" id="modalAgregarCliente" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar Nuevo Cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form method="POST" action="<?= BASE_URL ?>admin/clientes">
                    <input type="hidden" name="accion" value="crear">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nombre completo *</label>
                            <input type="text" class="form-control" name="nombre" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Teléfono</label>
                            <input type="text" class="form-control" name="telefono">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Correo electrónico</label>
                            <input type="email" class="form-control" name="email">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Dirección</label>
                            <textarea class="form-control" name="direccion" rows="2"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Agregar cliente</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>