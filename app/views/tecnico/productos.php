<!DOCTYPE html>
<html lang="es">

<?php include __DIR__ . '/../layouts/panel/head.php'; ?>

<body class="vh-100 d-flex flex-column">

    <?php include __DIR__ . '/../layouts/panel/header.php'; ?>
    <div class="flex-grow-1 d-flex flex-column flex-md-row" style="min-height: 0;">
        <?php include __DIR__ . '/../layouts/panel/aside_tecnico.php'; ?>

        <!-- Main Productos Inicia -->
        <main class="flex-grow-1 overflow-auto p-4">
            <h4 class="text-center mb-4 fw-bold">PRODUCTOS Y REPUESTOS DISPONIBLES</h4>

            <div class="d-flex flex-column flex-md-row justify-content-between mb-3">
                <form method="get" class="mb-3">
                    <select name="categoria_filtro" class="form-select" onchange="this.form.submit()">
                        <option value="">-- Filtrar por categoría --</option>
                        <?php foreach ($categorias as $cat): ?>
                            <option value="<?= $cat['id'] ?>" <?= ($categoria_id == $cat['id']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($cat['nombre']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </form>
            </div>

            <div class="table-responsive">
                <!-- TABLA DE PRODUCTOS -->
                <table class="table table-striped">
                    <thead>
                        <tr class="table-dark">
                            <th>ID</th>
                            <th>Imagen</th>
                            <th>Nombre</th>
                            <th>Marca</th>
                            <th>Precio</th>
                            <th>Categoría</th>
                            <th>Proveedor</th>
                            <th>Stock</th>
                            <th>Presentación</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($productos)): ?>
                            <?php foreach ($productos as $prod): ?>
                                <tr>
                                    <td><?= htmlspecialchars($prod['id']) ?></td>
                                    <td>
                                        <?php if (!empty($prod['imagen'])): ?>
                                            <img src="<?= htmlspecialchars($prod['imagen']) ?>" class="img-thumbnail-fixed" alt="Producto">
                                        <?php else: ?>
                                            <i class="bi bi-box text-muted"></i>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= htmlspecialchars($prod['nombre']) ?></td>
                                    <td><?= htmlspecialchars($prod['marca'] ?? 'N/A') ?></td>
                                    <td>$<?= number_format($prod['precio'], 2) ?></td>
                                    <td><?= htmlspecialchars($prod['categoria_nombre']) ?></td>
                                    <td><?= htmlspecialchars($prod['proveedor_nombre']) ?></td>
                                    <td>
                                        <?php if ($prod['stock'] <= 0): ?>
                                            <span class="badge bg-danger">Agotado</span>
                                        <?php else: ?>
                                            <span class="badge bg-success"><?= $prod['stock'] ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary"><?= htmlspecialchars($prod['tipo_presentacion']) ?></span>
                                        <?php if (strtolower($prod['tipo_presentacion']) === 'caja' && !empty($prod['unidades_presentacion'])): ?>
                                            <br>
                                            <small class="text-muted">
                                                Unidades por caja: <?= (int)$prod['unidades_presentacion'] ?>
                                                <?php if ($prod['stock'] > 0): ?>
                                                    - Total unidades: <?= (int)$prod['stock'] * (int)$prod['unidades_presentacion'] ?>
                                                <?php endif; ?>
                                            </small>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="9" class="text-center">No hay productos disponibles.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </main>
        <!-- Main Productos Finaliza -->
        <!-- Main Productos Finaliza -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>