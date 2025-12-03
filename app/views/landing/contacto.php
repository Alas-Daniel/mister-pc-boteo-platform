<!DOCTYPE html>
<html lang="es">

<!-- Head -->
<?php include __DIR__ . '/../layouts/landing/head.php'; ?>

<body>

    <!-- Header -->
    <?php include __DIR__ . '/../layouts/landing/header.php'; ?>

    <!-- Hero Inicia -->
    <section class="hero position-relative text-white px-2 px-lg-0">
        <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark bg-opacity-25"></div>
        <div class="container-lg h-100 position-relative">
            <div class="row h-100 align-items-center mx-lg-0">
                <div class="col-md-6">
                    <h1 class="fw-semibold display-5 mb-4">¿Tienes alguna duda?</h1>
                    <p> Estamos aquí para ayudarte. Si tienes preguntas sobre nuestros servicios, repuestos o tiempos de reparación, no dudes en contactarnos. Te responderemos con claridad y rapidez.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-secondary py-5 px-2 px-lg-0">
        <div class="container-lg">
            <div class="row">

                <!-- Formulario Inicia-->
                <div class="col-lg-8 mb-4">
                    <div class="bg-white p-4 rounded shadow-sm">
                        <h4 class="text-primary fw-bold mb-4">Envíanos un mensaje</h4>

                        <form class="needs-validation" novalidate>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label small">1. Nombre completo</label>
                                    <input type="text" name="nombre" class="form-control bg-light" placeholder="" required>
                                    <div class="invalid-feedback">Por favor, ingresa tu nombre completo.</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small">2. Correo electrónico</label>
                                    <input type="email" name="correo" class="form-control bg-light" placeholder="" required>
                                    <div class="invalid-feedback">Ingresa un correo válido.</div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label small">3. Teléfono</label>
                                    <input type="tel" name="telefono" class="form-control bg-light" placeholder="" required
                                        pattern="[0-9]{8,}">
                                    <div class="invalid-feedback">Ingresa un número válido (solo dígitos, mínimo 8).</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small">4. Departamento</label>
                                    <input type="text" name="departamento" class="form-control bg-light" placeholder="" required>
                                    <div class="invalid-feedback">Este campo es obligatorio.</div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label small">5. Asunto</label>
                                <input type="text" name="asunto" class="form-control bg-light" placeholder="" required>
                                <div class="invalid-feedback">Por favor, escribe el asunto.</div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label small">6. Mensaje</label>
                                <textarea name="mensaje" class="form-control bg-light" rows="5" placeholder="" required></textarea>
                                <div class="invalid-feedback">Escribe tu mensaje.</div>
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-primary px-4">Enviar mensaje</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Formulario Termina-->

                <!-- Información adicional Inicia -->
                <div class="col-lg-4">
                    <div class="bg-white p-4 rounded shadow-sm mb-4">
                        <h5 class="text-primary fw-bold text-center">Información adicional de contacto</h5>
                        <div class="mt-3 small">
                            <p><i class="bi bi-compass me-2 text-primary fs-5"></i>Sonzacate, Sonsonate El Salvador</p>
                            <p><i class="bi bi-telephone me-2 text-primary fs-5"></i> <strong>7070 - 7070</strong></p>
                            <p><i class="bi bi-envelope me-2 text-primary fs-5"></i> <strong>mrpcboteo@gmail.com</strong></p>
                        </div>
                    </div>

                    <!-- Redes sociales -->
                    <div class="bg-white p-4 rounded shadow-sm text-center">
                        <h6 class="text-primary fw-bold mb-3">Síguenos</h6>
                        <a href="#" class="text-primary fs-4 me-3"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="text-primary fs-4 me-3"><i class="bi bi-whatsapp"></i></a>
                        <a href="#" class="text-primary fs-4"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
                <!-- Información adicional Termina -->
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include __DIR__ . '/../layouts/landing/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>

    <script>
        // Validación de Bootstrap
        (() => {
            'use strict';
            const forms = document.querySelectorAll('.needs-validation');
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        })();
    </script>

</body>
</html>