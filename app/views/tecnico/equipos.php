<!DOCTYPE html>
<html lang="es">

<?php include __DIR__ . '/../layouts/panel/head.php'; ?>

<body class="vh-100 d-flex flex-column">

    <?php include __DIR__ . '/../layouts/panel/header.php'; ?>

    <div class="flex-grow-1 d-flex flex-column flex-md-row" style="min-height: 0;">

        <?php include __DIR__ . '/../layouts/panel/aside_tecnico.php'; ?>

        <main class="flex-grow-1 overflow-auto p-4">
            <h4 class="text-center mb-4 fw-bold">EQUIPOS ASIGNADOS</h4>

            <div class="d-flex flex-column flex-md-row justify-content-end mb-3">
                <div class="mt-3 mt-md-0">
                    <a href="<?= BASE_URL ?>tecnico/equipos/create" class="btn btn-primary">
                        <i class="bi bi-plus"></i> Agregar
                    </a>
                    <a href="<?= BASE_URL ?>tecnico/equipos/reparado" class="btn btn-success">
                        <i class="bi bi-check2"></i> Reparados
                    </a>
                    <a href="<?= BASE_URL ?>tecnico/equipos/historial" class="btn btn-warning text-white">
                        <i class="bi bi-clock-history"></i> Historial
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
                            <th>Fecha</th>
                            <th>Tipo</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($equipos)): ?>
                            <tr>
                                <td colspan="8" class="text-center">No tienes equipos asignados</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($equipos as $eq): ?>
                                <tr>
                                    <td><?= htmlspecialchars($eq['id']) ?></td>
                                    <td><?= htmlspecialchars($eq['nombre_equipo']) ?></td>
                                    <td><?= htmlspecialchars($eq['propietario']) ?></td>
                                    <td><?= htmlspecialchars($eq['marca'] ?? '') ?></td>
                                    <td><?= htmlspecialchars(date('d/m/Y', strtotime($eq['fecha_ingreso']))) ?></td>
                                    <td><?= htmlspecialchars($eq['tipo_problema']) ?></td>
                                    <td><?= htmlspecialchars($eq['estado_actual']) ?></td>
                                    <td>
                                        <a href="<?= BASE_URL ?>tecnico/equipos/edit/<?= $eq['id'] ?>" class="text-primary">Actualizar</a>
                                        <a href="<?= BASE_URL ?>tecnico/equipos/download/<?= $eq['id'] ?>" class="text-success">
                                            <i class="bi bi-file-earmark-pdf"></i> PDF
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <!-- (Opcional) Si en el futuro necesitas modales, los agregas aquí -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>