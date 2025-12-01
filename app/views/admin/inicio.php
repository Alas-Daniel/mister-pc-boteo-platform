<!DOCTYPE html>
<html lang="es">

<?php include __DIR__ . '/../layouts/panel/head.php'; ?>

<body>
    <?php include __DIR__ . '/../layouts/panel/header.php'; ?>

<div class="flex-grow-1 d-flex flex-column flex-md-row" style="min-height: 0;">

    <?php include __DIR__ . '/../layouts/panel/aside_admin.php'; ?>

    <main class="flex-grow-1">
        <section class="container">
            <h4 class="text-center mt-4 mb-5 fw-bold">PANEL DE ADMINISTRACIÓN</h4>

            <div class="row align-items-center justify-content-center gy-4">

                <div class="col-md-5">
                    <div class="bg-yellow rounded p-3 text-center text-white">
                        <h5 class="fw-bold">Equipos en reparación</h5>
                        <p class="number-size mb-4"><?= $equipos ?></p>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="bg-pink rounded p-3 text-center text-white">
                        <h5 class="fw-bold">Productos disponibles</h5>
                        <p class="number-size mb-4"><?= $productos ?></p>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="bg-green rounded p-3 text-center text-white">
                        <h5 class="fw-bold">Técnicos registrados</h5>
                        <p class="number-size mb-4"><?= $tecnicos ?></p>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="bg-light-blue rounded p-3 text-center text-white">
                        <h5 class="fw-bold">Clientes registrados</h5>
                        <p class="number-size mb-4"><?= $clientes ?></p>
                    </div>
                </div>

            </div>
        </section>
    </main>

</div>

</body>
</html>
