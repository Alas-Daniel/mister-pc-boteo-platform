<!DOCTYPE html>
<html lang="es">

<?php include __DIR__ . '/../../layouts/panel/head.php'; ?>

<body class="vh-100 d-flex flex-column">

    <?php include __DIR__ . '/../../layouts/panel/header.php'; ?>
    <div class="flex-grow-1 d-flex flex-column flex-md-row" style="min-height: 0;">
        <?php include __DIR__ . '/../../layouts/panel/aside_admin.php'; ?>

        <main class="flex-grow-1 overflow-auto p-4">
            <h4 class="text-center mb-4 fw-bold">HISTORIAL EQUIPOS REPARADOS</h4>

            <div class="d-flex flex-column flex-md-row justify-content-between mb-3">
                <form method="get" action="<?= BASE_URL ?>admin/equipos/history" class="mb-3 mb-md-0">
                    <select name="tipo_filtro" class="form-select" onchange="this.form.submit()">
                        <option value="">-- Filtrar por tipo --</option>
                        <option value="hardware" <?= (($_GET['tipo_filtro'] ?? '') === 'hardware') ? 'selected' : '' ?>>Hardware</option>
                        <option value="software" <?= (($_GET['tipo_filtro'] ?? '') === 'software') ? 'selected' : '' ?>>Software</option>
                        <option value="ambos" <?= (($_GET['tipo_filtro'] ?? '') === 'ambos') ? 'selected' : '' ?>>Ambos</option>
                    </select>
                </form>
                <div class="mt-3 mt-md-auto">
                    <a href="<?= BASE_URL ?>admin/equipos" class="btn btn-warning text-white">
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
                            <th>Técnico</th>
                            <th>Tipo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($equipos)): ?>
                            <tr>
                                <td colspan="9" class="text-center">No hay equipos en el historial.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($equipos as $equipo): ?>
                                <tr>
                                    <td><?= htmlspecialchars($equipo['id']) ?></td>
                                    <td><?= htmlspecialchars($equipo['nombre_equipo']) ?></td>
                                    <td><?= htmlspecialchars($equipo['propietario']) ?></td>
                                    <td><?= htmlspecialchars($equipo['marca']) ?></td>
                                    <td><?= date('d/m/Y', strtotime($equipo['fecha_ingreso'])) ?></td>
                                    <td><?= $equipo['fecha_finalizacion'] ? date('d/m/Y', strtotime($equipo['fecha_finalizacion'])) : '-' ?></td>
                                    <td><?= htmlspecialchars($equipo['tecnico'] ?? '-') ?></td>
                                    <td><?= htmlspecialchars($equipo['tipo_problema']) ?></td>
                                    <td>
                                        <a href="<?= BASE_URL ?>admin/equipos/download/<?= $equipo['id'] ?>" class="text-success">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>