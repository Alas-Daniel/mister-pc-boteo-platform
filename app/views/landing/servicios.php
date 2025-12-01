<!DOCTYPE html>
<html lang="es">

<!-- Head -->
<?php require __DIR__ . '/../layouts/landing/head.php'; ?>

<body>

    <?php include __DIR__ . '/../layouts/landing/header.php'; ?>

    <!-- Hero Inicia -->
    <section class="hero position-relative text-white px-2 px-lg-0">
        <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark bg-opacity-25"></div>
        <div class="container-lg h-100 position-relative">
            <div class="row h-100 align-items-center mx-lg-0">
                <div class="col-md-6">
                    <h1 class="fw-semibold display-5 mb-4">Nuestros Servicios</h1>
                    <p>Conoce la historia, misión y valores que impulsan a Mister Pc Boteo a ser líderes en el sector
                        tecnológico</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Finaliza -->

    <!-- Servicios Inicia -->
    <section class="py-5 text-center bg-secondary px-2 px-lg-0 ">
        <div class="container-xl">
            <h3 class="fw-semibold text-primary mb-5">Servicios especializados</h3>
            <div class="row g-4">
                <!-- Reparación de hardware -->
                <div class="col-lg-4">
                    <div class=" bg-white p-5 rounded h-100">
                        <img src="./img/mantenimiento.png" alt="mantenimiento" class="img-fluid" width="130">
                        <h5 class="fw-semibold my-4 text-primary">Reparación de hardware</h5>
                        <p class="text-muted small mt-3">Diagnóstico y reparación de problemas en computadoras de
                            escritorio, laptops, servidores y otros dispositivos electrónicos.</p>
                        <ul class="text-start small my-4">
                            <li>Reemplazo de componentes defectuosos.</li>
                            <li>Reparación de placa madre.</li>
                            <li>Soluciones de arranque</li>
                        </ul>
                        <p class="fw-semibold text-primary">Desde $45.00</p>
                        <a href="#" class="btn btn-primary">Solicitar servicio</a>
                    </div>
                </div>

                <!-- Reparación de hardware -->
                <div class="col-lg-4">
                    <div class=" bg-white p-5 rounded h-100">
                        <img src="./img/reparar.png" alt="hardware" class="img-fluid" width="130">
                        <h5 class="fw-semibold my-4 text-primary">Mantenimiento Preventivo</h5>
                        <p class="text-muted small mt-3">Diagnóstico y reparación de problemas en computadoras de
                            escritorio, laptops, servidores y otros dispositivos electrónicos.</p>
                        <ul class="text-start small my-4">
                            <li>Reemplazo de componentes defectuosos.</li>
                            <li>Reparación de placa madre.</li>
                            <li>Soluciones de arranque</li>
                        </ul>
                        <p class="fw-semibold text-primary">Desde $45.00</p>
                        <a href="#" class="btn btn-primary">Solicitar servicio</a>
                    </div>
                </div>

                <!-- Reparación de hardware -->
                <div class="col-lg-4">
                    <div class=" bg-white p-5 rounded h-100">
                        <img src="./img/repuestos.png" alt="hardware" class="img-fluid" width="130">
                        <h5 class="fw-semibold my-4 text-primary">Mantenimiento de Hardware</h5>
                        <p class="text-muted small mt-3">Diagnóstico y reparación de problemas en computadoras de
                            escritorio, laptops, servidores y otros dispositivos electrónicos.</p>
                        <ul class="text-start small my-4">
                            <li>Reemplazo de componentes defectuosos.</li>
                            <li>Reparación de placa madre.</li>
                            <li>Soluciones de arranque</li>
                        </ul>
                        <p class="fw-semibold text-primary">Desde $45.00</p>
                        <a href="#" class="btn btn-primary">Solicitar servicio</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Servicios Finaliza -->

    <!-- Banner Inicia -->
    <section class="bg-primary">
        <div class="container-lg py-5 text-center">
            <div class="w-75 mx-auto">
                <h4 class="fw-semibold text-white mb-4">¿Quieres un servicio personalizado para tu equipo?</h4>
                <p class="text-white my-4">En Mister Pc Boteo, nos comprometemos a ofrecer soluciones tecnológicas de
                    alta calidad y un servicio al cliente excepcional. Nuestro equipo de expertos está listo para
                    ayudarte con cualquier necesidad relacionada con hardware y software.</p>
                <button href="#" class="btn btn-light text-primary fw-semibold">¡Contáctanos ahora!</button>
            </div>
        </div>
    </section>
    <!-- Banner Finaliza -->

    <?php include __DIR__ . '/../layouts/landing/footer.php'; ?>

</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
    crossorigin="anonymous"></script>

</html>