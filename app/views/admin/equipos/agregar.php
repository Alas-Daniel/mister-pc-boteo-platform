<!DOCTYPE html>
<html lang="es">

<!-- Head -->
<?php include __DIR__ . '/../../layouts/panel/head.php'; ?>

<body class="vh-100 d-flex flex-column">

    <!-- Header -->
    <?php include __DIR__ . '/../../layouts/panel/header.php'; ?>

    <div class="flex-grow-1 d-flex flex-column flex-md-row" style="min-height: 0;">

        <!-- Aside admin -->
        <?php include __DIR__ . '/../../layouts/panel/aside_admin.php'; ?>

        <main class="flex-grow-1 overflow-auto p-4">
            <h4 class="text-center mb-4 fw-bold">AGREGAR EQUIPO EN REPARACIÓN</h4>

            <div class="text-end mb-3">
                <a href="<?= BASE_URL ?>admin/equipos" class="btn btn-warning text-white">
                    <i class="bi bi-box-arrow-left me-1"></i> Regresar
                </a>
            </div>

            <form method="POST" action="<?= BASE_URL ?>admin/equipos/store" class="border p-4 rounded">
                <h5 class="fw-bold">MISTER PC BOTEO</h5>
                <p class="mb-4">REGISTRO DE EQUIPO PARA REPARACIÓN O MANTENIMIENTO</p>

                <!-- I. Datos Generales -->
                <h6>I. Datos Generales</h6>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Propietario:</label>
                        <select name="cliente_id" class="form-select" required>
                            <option value="" disabled selected>Seleccione un propietario</option>
                            <?php foreach ($clientes as $cli): ?>
                                <option value="<?= $cli['id'] ?>"><?= htmlspecialchars($cli['nombre_completo']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Fecha de ingreso:</label>
                        <input type="date" name="fecha_ingreso" class="form-control" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Tipo de problema:</label>
                        <select name="tipo_problema" class="form-select" required>
                            <option value="" disabled selected>Selecciona el tipo</option>
                            <option value="hardware">Hardware</option>
                            <option value="software">Software</option>
                            <option value="ambos">Hardware y Software</option>
                        </select>
                    </div>

                    <div class="col-md-4 mt-3">
                        <label class="form-label fw-semibold">Estado del equipo:</label>
                        <select name="estado_equipo" class="form-select" required>
                            <option value="" disabled selected>Selecciona el estado</option>
                            <option value="no iniciado">No iniciado</option>
                            <option value="en proceso">En proceso</option>
                            <option value="finalizado">Finalizado</option>
                            <option value="entregado">Entregado</option>
                        </select>
                    </div>

                    <div class="col-md-4 mt-3">
                        <label class="form-label fw-semibold text-danger">Asignar técnico:</label>
                        <select name="tecnico_id" class="form-select">
                            <option value="">No asignar (por ahora)</option>
                            <?php foreach ($tecnicos as $tec): ?>
                                <option value="<?= $tec['id'] ?>"><?= htmlspecialchars($tec['nombre_completo']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <!-- II. Datos previos del equipo -->
                <h6 class="mt-5">II. Datos previos del equipo</h6>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Nombre del equipo:</label>
                        <input type="text" name="nombre_equipo" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Marca:</label>
                        <input type="text" name="marca" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Modelo:</label>
                        <input type="text" name="modelo" class="form-control">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <h6>MEMORIA RAM</h6>
                        <label class="form-label fw-semibold">Tipo:</label>
                        <input type="text" name="ram_tipo" class="form-control mb-2">
                        <label class="form-label fw-semibold">Capacidad:</label>
                        <input type="text" name="ram_capacidad" class="form-control mb-2">
                        <label class="form-label fw-semibold">Velocidad:</label>
                        <input type="text" name="ram_velocidad" class="form-control mb-2">
                        <label class="form-label fw-semibold">Slots vacíos:</label>
                        <input type="text" name="ram_slots_vacios" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <h6>PROCESADOR</h6>
                        <label class="form-label fw-semibold">Marca:</label>
                        <input type="text" name="cpu_marca" class="form-control mb-2">
                        <label class="form-label fw-semibold">Modelo:</label>
                        <input type="text" name="cpu_modelo" class="form-control mb-2">
                        <label class="form-label fw-semibold">Velocidad:</label>
                        <input type="text" name="cpu_velocidad" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <h6>SISTEMA OPERATIVO</h6>
                        <label class="form-label fw-semibold">Nombre:</label>
                        <input type="text" name="so_nombre" class="form-control mb-2">
                        <label class="form-label fw-semibold">Versión:</label>
                        <input type="text" name="so_version" class="form-control mb-2">
                        <label class="form-label fw-semibold">Arquitectura:</label>
                        <input type="text" name="so_arquitectura" class="form-control">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <h6>DISCO DURO</h6>
                        <label class="form-label fw-semibold">Capacidad:</label>
                        <input type="text" name="almacenamiento_cap" class="form-control mb-2">
                        <label class="form-label fw-semibold">Particiones:</label>
                        <input type="text" name="almacenamiento_particiones" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <h6>TARJETA MADRE</h6>
                        <label class="form-label fw-semibold">Modelo:</label>
                        <input type="text" name="placa_modelo" class="form-control mb-2">
                    </div>

                    <div class="col-md-4">
                        <h6>PUERTOS</h6>
                        <label class="form-label fw-semibold">Puertos:</label>
                        <input type="text" name="puertos" class="form-control">
                    </div>
                </div>

                <div class="mb-3">
                    <h6>OTRA INFORMACIÓN</h6>
                    <label class="form-label fw-semibold">Información extra:</label>
                    <textarea name="info_extra" class="form-control" rows="3"></textarea>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Agregar equipo</button>
                </div>
            </form>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>