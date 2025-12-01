<!DOCTYPE html>
<html lang="es">

<?php include __DIR__ . '/../../layouts/panel/head.php'; ?>

<body class="vh-100 d-flex flex-column">

    <?php include __DIR__ . '/../../layouts/panel/header.php'; ?>
    <div class="flex-grow-1 d-flex flex-column flex-md-row" style="min-height: 0;">
        <?php include __DIR__ . '/../../layouts/panel/aside_tecnico.php'; ?>
        
        <main class="flex-grow-1 overflow-auto p-4">
            <h4 class="text-center mb-4 fw-bold">HISTORIAL DE SUS EQUIPOS REPARADOS</h4>

            <div class="d-flex flex-column flex-md-row justify-content-end mb-3">
                <div class="mt-3 mt-md-auto">
                    <a href="<?= BASE_URL ?>tecnico/equipos" class="btn btn-warning text-white">
                        <i class="bi bi-box-arrow-left me-1"></i> Regresar
                    </a>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre de Equipo</th>
                            <th>Propietario</th>
                            <th>Marca</th>
                            <th>Fecha Ingreso</th>
                            <th>Fecha Entrega</th>
                            <th>Tipo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($equipos)): ?>
                            <?php foreach ($equipos as $eq): ?>
                                <tr>
                                    <td><?= htmlspecialchars($eq['id']) ?></td>
                                    <td><?= htmlspecialchars($eq['nombre_equipo']) ?></td>
                                    <td><?= htmlspecialchars($eq['propietario']) ?></td>
                                    <td><?= htmlspecialchars($eq['marca'] ?? '') ?></td>
                                    <td><?= htmlspecialchars(date('d/m/Y', strtotime($eq['fecha_ingreso']))) ?></td>
                                    <td><?= !empty($eq['fecha_finalizacion']) ? htmlspecialchars(date('d/m/Y', strtotime($eq['fecha_finalizacion']))) : 'N/A' ?></td>
                                    <td><?= htmlspecialchars($eq['tipo_problema']) ?></td>
                                    <td>
                                        <a href="<?= BASE_URL ?>tecnico/equipos/download/<?= $eq['id'] ?>">
                                            <i class="bi bi-file-earmark-pdf"></i> PDF
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="text-center text-muted">
                                    No tienes historial de equipos entregados.
                                </td>
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