<!DOCTYPE html>
<html lang="es">

<!-- Head -->
<?php include __DIR__ . '/../layouts/landing/head.php'; ?>

<body>

    <!-- Header -->
    <?php include __DIR__ . '/../layouts/landing/header.php'; ?>

    <!-- Hero Inicia -->
    <section class="hero position-relative text-white px-2 px-lg-0">
        <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark bg-opacity-50"></div>
        <div class="container-lg h-100 position-relative">
            <div class="row h-100 align-items-center mx-lg-0">
                <div class="col-md-6">
                    <h1 class="fw-semibold display-5 mb-4">Nuestros Productos y repuestos</h1>
                    <p>Contamos con una selección de productos y repuestos de calidad, especialmente destinados a la reparación y mantenimiento de computadoras.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Finaliza -->

    <!-- Nuestros Productos Inicia -->
    <section class="py-5 px-2 px-lg-0">
        <div class="container-lg">
            <h3 class="mb-4 text-primary fw-semibold">Nuestros Productos</h3>

            <!-- Botones de categorías -->
            <div class="mb-4">
                <a href="?categoria_id=" class="btn <?= $categoria_id === null ? 'btn-dark' : 'btn-outline-dark' ?> mb-2">Todos</a>
                <?php foreach ($categorias as $categoria): ?>
                    <a href="?categoria_id=<?= $categoria['id'] ?>"
                        class="btn <?= $categoria_id == $categoria['id'] ? 'btn-dark' : 'btn-outline-dark' ?> mb-2">
                        <?= htmlspecialchars($categoria['nombre']) ?>
                    </a>
                <?php endforeach; ?>
            </div>

            <?php if (count($productos) > 0): ?>
                <div class="row g-4">
                    <?php foreach ($productos as $producto): ?>
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="card h-100 d-flex flex-column">
                                <img src="<?= htmlspecialchars($producto['imagen']) ?>"
                                    class="img-card"
                                    alt="<?= htmlspecialchars($producto['nombre']) ?>"
                                    style="height:200px; object-fit:cover;">

                                <div class="card-body bg-terciary d-flex flex-column flex-grow-1">
                                    <span class="mb-2 product-label"><?= htmlspecialchars($producto['marca']) ?></span>
                                    <h5 class="mt-1 card-title-size fw-semibold"><?= htmlspecialchars($producto['nombre']) ?></h5>
                                    <p class="card-text text-primary fw-semibold">$<?= htmlspecialchars($producto['precio']) ?></p>
                                </div>

                                <?php
                                $producto_nombre = htmlspecialchars_decode($producto['nombre'], ENT_QUOTES);
                                $mensaje = "Hola, estoy interesado en comprar este producto:\n\n" .
                                    "🔹 Producto: " . $producto_nombre . "\n" .
                                    "🔹 Precio: $" . $producto['precio'] . "\n\n" .
                                    "¿Lo tienen disponible?";
                                $mensaje_codificado = rawurlencode($mensaje);
                                $whatsapp_url = "https://wa.me/50370491519?text=" . $mensaje_codificado;
                                ?>

                                <div class="card-footer bg-terciary p-2">
                                    <a href="<?= $whatsapp_url ?>" target="_blank" class="btn btn-success w-100">
                                        <i class="bi bi-whatsapp"></i> Comprar
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="alert alert-warning text-center">
                    No hay productos disponibles para esta categoría.
                </div>
            <?php endif; ?>
        </div>
    </section>

    <?php include __DIR__ . '/../layouts/landing/footer.php'; ?>

</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
    crossorigin="anonymous"></script>

</html>