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

        <main class="flex-grow-1 p-4 overflow-auto">

            <h4 class="text-center mb-4 fw-bold">EQUIPOS EN REPARACIÓN</h4>

            <!-- MENSAJES DE ÉXITO / ERROR -->
            <?php if (isset($_GET['exito'])): ?>
                <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                    <?php switch ($_GET['exito']):
                        case 'created':
                            echo "Equipo agregado exitosamente.";
                            break;
                        case 'repaired':
                            echo "Equipo reparado registrado.";
                            break;
                        case 'updated':
                            echo "Equipo actualizado correctamente.";
                            break;
                        case 'deleted':
                            echo "Equipo eliminado.";
                            break;
                        case 'asignado':
                            echo "Técnico asignado.";
                            break;
                    endswitch; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <?php if (isset($_GET['error'])): ?>
                <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                    <?php switch ($_GET['error']):
                        case 'required':
                            echo "Por favor, complete los campos obligatorios.";
                            break;
                        case 'save':
                            echo "Error al guardar el equipo. Intente nuevamente.";
                            break;
                        case 'not_found':
                            echo "Equipo no encontrado.";
                            break;
                        default:
                            echo "Ocurrió un error.";
                            break;
                    endswitch; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <!-- FILTRO Y BOTONES -->
            <div class="d-flex flex-column flex-md-row justify-content-between mb-3">
                <form method="get" action="<?= BASE_URL ?>admin/equipos">
                    <select name="tipo_filtro" class="form-select" onchange="this.form.submit()">
                        <option value="">-- Filtrar por tipo --</option>
                        <option value="hardware" <?= ($tipoFiltro === 'hardware') ? 'selected' : '' ?>>Hardware</option>
                        <option value="software" <?= ($tipoFiltro === 'software') ? 'selected' : '' ?>>Software</option>
                        <option value="ambos" <?= ($tipoFiltro === 'ambos') ? 'selected' : '' ?>>Ambos</option>
                    </select>
                </form>

                <div class="mt-3 mt-md-auto text-end">
                    <a href="<?= BASE_URL ?>admin/equipos/create" class="btn btn-primary">
                        <i class="bi bi-plus"></i> Agregar
                    </a>
                    <a href="<?= BASE_URL ?>admin/equipos/createRepaired" class="btn btn-success">
                        <i class="bi bi-check2"></i> Reparados
                    </a>
                    <a href="<?= BASE_URL ?>admin/equipos/history" class="btn btn-warning text-white">
                        <i class="bi bi-clock-history"></i> Historial
                    </a>
                </div>
            </div>

            <!-- TABLA -->
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Equipo</th>
                            <th>Propietario</th>
                            <th>Marca</th>
                            <th>Fecha</th>
                            <th>Técnico</th>
                            <th>Tipo</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($equipos)): ?>
                            <tr>
                                <td colspan="9" class="text-center">No hay equipos en reparación.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($equipos as $eq): ?>
                                <tr>
                                    <td><?= htmlspecialchars($eq['id']) ?></td>
                                    <td><?= htmlspecialchars($eq['nombre_equipo']) ?></td>
                                    <td><?= htmlspecialchars($eq['propietario']) ?></td>
                                    <td><?= htmlspecialchars($eq['marca']) ?></td>
                                    <td><?= date('d/m/Y', strtotime($eq['fecha_ingreso'])) ?></td>
                                    <td><?= htmlspecialchars($eq['tecnico'] ?? '-') ?></td>
                                    <td><?= htmlspecialchars($eq['tipo_problema']) ?></td>
                                    <td><?= htmlspecialchars($eq['estado_actual']) ?></td>
                                    <td>
                                        <a href="<?= BASE_URL ?>admin/equipos/edit/<?= $eq['id'] ?>" class="text-success">Editar</a>
                                        <a href="#" class="text-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $eq['id'] ?>">Eliminar</a>
                                        <a href="<?= BASE_URL ?>admin/equipos/download/<?= $eq['id'] ?>" class="text-primary">
                                            <i class="bi bi-file-earmark-pdf"></i> PDF
                                        </a>
                                    </td>
                                </tr>

                                <!-- MODAL ELIMINAR -->
                                <div class="modal fade" id="deleteModal<?= $eq['id'] ?>" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Eliminar equipo</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                ¿Está seguro que desea eliminar:
                                                <strong><?= htmlspecialchars($eq['nombre_equipo']) ?></strong>?
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                <a href="<?= BASE_URL ?>admin/equipos/delete/<?= $eq['id'] ?>" class="btn btn-danger">Eliminar</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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