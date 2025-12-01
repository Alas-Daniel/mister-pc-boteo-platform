<!DOCTYPE html>
<html lang="es">

<!-- Head -->
<?php include __DIR__ . '/../layouts/landing/head.php'; ?>

<body>

    <?php include __DIR__ . '/../layouts/landing/header.php'; ?>

    <!-- Hero -->
    <section class="hero position-relative text-white px-2 px-lg-0">
        <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark bg-opacity-50"></div>
        <div class="container-lg h-100 position-relative">
            <div class="row h-100 align-items-center mx-lg-0">
                <div class="col-md-6">
                    <h1 class="fw-semibold display-5 mb-4">Soluciones tecnológicas para todos tus dispositivos</h1>
                    <p>Especialistas en repuestos de hardware y mantenimiento de equipos. Bienvenido a la clínica de tu PC.</p>

                    <a href="<?= BASE_URL ?>servicios" class="btn btn-primary text-white fw-semibold mt-3 w-auto p-2">
                        Explorar Servicios <i class="bi bi-arrow-right ms-3"></i>
                    </a>

                </div>
            </div>
        </div>
    </section>

    <!-- Nuestros Servicios -->
    <section class="bg-secondary py-5">
        <div class="container-lg">
            <div class="text-center mb-5">
                <h3 class="text-primary fw-bold mb-4">Nuestros Servicios</h3>
            </div>

            <div class="row g-4 justify-content-center">

                <!-- Servicio 1 -->
                <div class="col-12 col-sm-6 col-lg-4 d-flex">
                    <div class="bg-white rounded text-center p-4 shadow-sm flex-fill">
                        <div class="d-inline-flex align-items-center justify-content-center bg-primary text-white rounded-circle mb-3"
                            style="width:100px; height:100px; font-size:2.5rem;">
                            <i class="bi bi-tools"></i>
                        </div>
                        <h5 class="text-primary mt-3">Mantenimiento</h5>
                        <p class="my-3">Solucionamos problemas de hardware y software en computadoras de todas las marcas.</p>
                        <a href="<?= BASE_URL ?>contacto" class="btn btn-primary mt-2">Cotizar Ahora</a>
                    </div>
                </div>

                <!-- Servicio 2 -->
                <div class="col-12 col-sm-6 col-lg-4 d-flex">
                    <div class="bg-white rounded text-center p-4 shadow-sm flex-fill">
                        <div class="d-inline-flex align-items-center justify-content-center bg-primary text-white rounded-circle mb-3"
                            style="width:100px; height:100px; font-size:2.5rem;">
                            <i class="bi bi-laptop"></i>
                        </div>
                        <h5 class="text-primary mt-3">Reparación de equipos</h5>
                        <p class="my-3">Reparación rápida y profesional de laptops y PCs.</p>
                        <a href="<?= BASE_URL ?>contacto" class="btn btn-primary mt-2">Cotizar Ahora</a>
                    </div>
                </div>

                <!-- Servicio 3 -->
                <div class="col-12 col-sm-6 col-lg-4 d-flex">
                    <div class="bg-white rounded text-center p-4 shadow-sm flex-fill">
                        <div class="d-inline-flex align-items-center justify-content-center bg-primary text-white rounded-circle mb-3"
                            style="width:100px; height:100px; font-size:2.5rem;">
                            <i class="bi bi-cpu"></i>
                        </div>
                        <h5 class="text-primary mt-3">Venta de repuestos</h5>
                        <p class="my-3">Repuestos originales de las mejores marcas.</p>
                        <a href="<?= BASE_URL ?>productos" class="btn btn-primary mt-2">Ver Repuestos</a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Productos Destacados -->
    <section class="px-2 px-lg-0">
        <div class="container-lg py-5">

            <h3 class="text-primary fw-bold mb-4 text-center">Productos Destacados</h3>

            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                <p class="fw-semibold text-center">¡Los productos más destacados de nuestra tienda!</p>
                <a href="<?= BASE_URL ?>productos" class="btn btn-primary">Ver todos <i class="bi bi-arrow-right"></i></a>
            </div>

            <div class="product-container">
                <div class="product-scroll">

                    <?php if (!empty($productos_destacados)): ?>
                        <?php foreach ($productos_destacados as $prod): ?>
                            <div class="card">
                                <img src="<?= htmlspecialchars($prod['imagen']) ?>" class="img-card"
                                    alt="<?= htmlspecialchars($prod['nombre']) ?>">

                                <div class="card-body">
                                    <span class="product-label"><?= htmlspecialchars($prod['categoria_nombre']) ?></span>

                                    <h5 class="mt-1 fw-semibold"><?= htmlspecialchars($prod['nombre']) ?></h5>

                                    <p class="text-primary fw-semibold">
                                        $<?= number_format($prod['precio'], 2) ?>
                                    </p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-center w-100">No hay productos destacados por el momento.</p>
                    <?php endif; ?>

                </div>
            </div>

        </div>
    </section>

    <!-- Por qué elegirnos -->
    <section class="bg-secondary py-5 px-2 px-lg-0">
        <div class="container-lg">

            <div class="row align-items-center">

                <div class="col-lg-6 text-black">
                    <h3 class="text-primary mb-4 fw-bold">Tu aliado en tecnología</h3>

                    <p>Ofrecemos soluciones tecnológicas con calidad y atención profesional.</p>

                    <ul class="list-unstyled mt-4">

                        <li class="d-flex align-items-start mb-3 gap-3">
                            <i class="bi bi-check2-circle fs-3 text-primary"></i>
                            <div>
                                <h5 class="text-primary fw-semibold">Técnicos Certificados</h5>
                                <p class="m-0">Experiencia real y certificaciones profesionales.</p>
                            </div>
                        </li>

                        <li class="d-flex align-items-start mb-3 gap-3">
                            <i class="bi bi-patch-check fs-3 text-primary"></i>
                            <div>
                                <h5 class="text-primary fw-semibold">Repuestos Originales</h5>
                                <p>Solo trabajamos con marcas de confianza.</p>
                            </div>
                        </li>

                        <li class="d-flex align-items-start mb-3 gap-3">
                            <i class="bi bi-clock-history fs-3 text-primary"></i>
                            <div>
                                <h5 class="text-primary fw-semibold">Servicio Rápido</h5>
                                <p>Tu tiempo es valioso.</p>
                            </div>
                        </li>

                    </ul>
                </div>

                <div class="col-lg-6 text-center">
                    <img src="https://res.cloudinary.com/drztldzvn/image/upload/v1753135293/tecnicos_bdtaai.jpg"
                        alt="Técnicos" class="img-fluid rounded shadow">
                </div>

            </div>
        </div>
    </section>

    <!-- Ayuda -->
    <section class="py-5 bg-primary">
        <div class="container text-center">

            <h3 class="text-white fw-bold mb-4">¿Problemas con tus equipos?</h3>

            <p class="text-white mb-4">
                Nuestro equipo está listo para ayudarte a mantener tus dispositivos funcionando al 100%.
            </p>

            <a href="<?= BASE_URL ?>contacto" class="btn btn-light fw-semibold text-primary shadow-sm">
                Contáctanos ahora
            </a>

        </div>
    </section>

    <!-- Marcas -->
    <!-- Marcas -->
    <section class="bg-white py-5">
        <div class="container-lg text-center mb-5">
            <h3 class="fw-bold text-primary mb-4">Marcas con las que trabajamos</h3>
            <p>Repuestos, accesorios y soporte técnico de las mejores marcas.</p>
        </div>

        <div class="container-lg">
            <div class="brand-carousel">
                <div class="brand-track">

                    <?php
                    $logos = [
                        "HP" => "https://upload.wikimedia.org/wikipedia/commons/thumb/6/6f/HP_logo_630x630.png/640px-HP_logo_630x630.png",
                        "Dell" => "https://upload.wikimedia.org/wikipedia/commons/4/48/Dell_Logo.svg",
                        "Lenovo" => "https://upload.wikimedia.org/wikipedia/commons/thumb/d/d3/Logo_Lenovo_%282003%29.png/640px-Logo_Lenovo_%282003%29.png",
                        "Acer" => "https://upload.wikimedia.org/wikipedia/commons/thumb/0/00/Acer_2011.svg/640px-Acer_2011.svg.png",
                        "Asus" => "https://upload.wikimedia.org/wikipedia/commons/thumb/b/b0/ASUS_Corporate_Logo.svg/640px-ASUS_Corporate_Logo.svg.png",
                        "Intel" => "https://upload.wikimedia.org/wikipedia/commons/6/6a/Intel_logo_%282020%2C_dark_blue%29.svg",
                        "AMD" => "https://upload.wikimedia.org/wikipedia/commons/thumb/4/49/AMD_Ryzen_logo.svg/640px-AMD_Ryzen_logo.svg.png",
                        "Nvidia" => "https://upload.wikimedia.org/wikipedia/sco/2/21/Nvidia_logo.svg",
                        "Microsoft" => "https://upload.wikimedia.org/wikipedia/commons/4/44/Microsoft_logo.svg",
                        "Kingston" => "https://upload.wikimedia.org/wikipedia/commons/e/ef/Kingston_Technology_Corporation_logo.png",
                    ];

                    // Mostrar logos
                    foreach ($logos as $marca => $url): ?>
                        <img src="<?= $url ?>" class="brand-logo" alt="<?= $marca ?>">
                    <?php endforeach; ?>

                    <!-- duplicado para animación infinita -->
                    <?php foreach ($logos as $marca => $url): ?>
                        <img src="<?= $url ?>" class="brand-logo" alt="<?= $marca ?>">
                    <?php endforeach; ?>

                </div>
            </div>
        </div>
    </section>


    <?php include __DIR__ . '/../layouts/landing/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>