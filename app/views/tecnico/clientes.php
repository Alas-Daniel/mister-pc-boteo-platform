<!DOCTYPE html>
<html lang="es">

<?php include __DIR__ . '/../layouts/panel/head.php'; ?>

<body class="vh-100 d-flex flex-column">

    <?php include __DIR__ . '/../layouts/panel/header.php'; ?>
    <div class="flex-grow-1 d-flex flex-column flex-md-row" style="min-height: 0;">
        <?php include __DIR__ . '/../layouts/panel/aside_tecnico.php'; ?>

        <main class="flex-grow-1 overflow-auto p-4">
            <h4 class="text-center mb-4 fw-bold">CLIENTES REGISTRADOS</h4>

            <?php if (isset($_GET['exito']) && $_GET['exito'] === 'creado'): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Cliente registrado exitosamente.
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <?php if (isset($_GET['error'])): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?php 
                    switch($_GET['error']) {
                        case 'nombre_requerido':
                            echo 'El nombre del cliente es obligatorio.';
                            break;
                        case 'email_existe':
                            echo 'Ya existe un cliente con ese correo electrónico.';
                            break;
                        case 'guardar':
                            echo 'Error al guardar el cliente. Intente nuevamente.';
                            break;
                    }
                    ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
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
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center">No hay clientes registrados.</td>
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
                <form method="POST" action="<?= BASE_URL ?>tecnico/clientes/store">
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