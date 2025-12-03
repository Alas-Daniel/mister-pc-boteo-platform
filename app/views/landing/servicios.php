<!DOCTYPE html>
<html lang="es">

<!-- Head -->
<?php require __DIR__ . '/../layouts/landing/head.php'; ?>

<body>

    <!-- Header -->
    <?php include __DIR__ . '/../layouts/landing/header.php'; ?>

    <!-- Hero -->
    <section class="hero position-relative text-white px-2 px-lg-0">
        <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark bg-opacity-50"></div>
        <div class="container-lg h-100 position-relative">
            <div class="row h-100 align-items-center mx-lg-0">
                <div class="col-md-6">
                    <h1 class="fw-semibold display-5 mb-4">Nuestros Servicios</h1>
                    <p>En Mister PC Boteo nos especializamos en la reparación de equipos informáticos. Ofrecemos soluciones rápidas, confiables y profesionales para que tu dispositivo vuelva a funcionar como nuevo.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Servicios -->
    <section class="py-5 text-center bg-secondary px-2 px-lg-0 ">
        <div class="container-xl">
            <h3 class="fw-semibold text-primary mb-5">Servicios especializados</h3>
            <div class="row g-4">
                <!-- Reparación de hardware -->
                <div class="col-lg-4">
                    <div class=" bg-white p-5 rounded h-100">
                        <div class="d-inline-flex align-items-center justify-content-center bg-primary text-white rounded-circle mb-3"
                            style="width:100px; height:100px; font-size:2.5rem;">
                            <i class="bi bi-cpu"></i>
                        </div>
                        <h5 class="fw-semibold my-4 text-primary">Reparación de hardware</h5>
                        <p class="text-muted small mt-3">Diagnóstico preciso y reparación de fallas en componentes físicos de computadoras de escritorio, laptops y servidores.</p>
                        <ul class="text-start small my-4">
                            <li>Reemplazo de componentes defectuosos</li>
                            <li>Reparación de placas base y circuitos</li>
                            <li>Solución de problemas de encendido y arranque</li>
                        </ul>
                        <p class="fw-semibold text-primary">Desde $35.00</p>
                        <a href="#" class="btn btn-primary">Solicitar servicio</a>
                    </div>
                </div>

                <!-- Mantenimiento -->
                <div class="col-lg-4">
                    <div class=" bg-white p-5 rounded h-100">
                        <div class="d-inline-flex align-items-center justify-content-center bg-primary text-white rounded-circle mb-3"
                            style="width:100px; height:100px; font-size:2.5rem;">
                            <i class="bi bi-tools"></i>
                        </div>
                        <h5 class="fw-semibold my-4 text-primary">Mantenimiento Preventivo</h5>
                        <p class="text-muted small mt-3">Mantenimiento integral para prevenir fallas y prolongar la vida útil de tu equipo. Incluye limpieza profunda, revisión de componentes y optimización del rendimiento.</p>
                        <ul class="text-start small my-4">
                            <li>Limpieza interna y externa de tu computadora</li>
                            <li>Revisión térmica y cambio de pasta térmica</li>
                            <li>Optimización del sistema operativo</li>
                        </ul>
                        <p class="fw-semibold text-primary">Desde $35.00</p>
                        <a href="#" class="btn btn-primary">Solicitar servicio</a>
                    </div>
                </div>

                <!-- Reparación de software -->
                <div class="col-lg-4">
                    <div class=" bg-white p-5 rounded h-100">
                        <div class="d-inline-flex align-items-center justify-content-center bg-primary text-white rounded-circle mb-3"
                            style="width:100px; height:100px; font-size:2.5rem;">
                            <i class="bi bi-laptop"></i>
                        </div>
                        <h5 class="fw-semibold my-4 text-primary">Reparación de Software</h5>
                        <p class="text-muted small mt-3">Solución de problemas relacionados con el sistema operativo, programas, virus, lentitud y errores de funcionamiento en tu equipo.</p>
                        <ul class="text-start small my-4">
                            <li>Instalación y configuración de sistemas operativos</li>
                            <li>Eliminación de virus y malware</li>
                            <li>Optimización del rendimiento y corrección de errores</li>
                        </ul>
                        <p class="fw-semibold text-primary">Desde $35.00</p>
                        <a href="#" class="btn btn-primary">Solicitar servicio</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Banner -->
    <section class="bg-primary">
        <div class="container-lg py-5 text-center">
            <div class="w-75 mx-auto">
                <h4 class="fw-semibold text-white mb-4">¿Quieres un servicio personalizado para tu equipo?</h4>
                <p class="text-white my-4">En Mister PC Boteo, nos comprometemos a ofrecer soluciones tecnológicas de
                    alta calidad y un servicio al cliente excepcional. Nuestro equipo de expertos está listo para
                    ayudarte con cualquier necesidad relacionada con hardware y software.</p>
                <button href="#" class="btn btn-light text-primary fw-semibold">¡Contáctanos ahora!</button>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include __DIR__ . '/../layouts/landing/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
    crossorigin="anonymous"></script>

</body>

</html>