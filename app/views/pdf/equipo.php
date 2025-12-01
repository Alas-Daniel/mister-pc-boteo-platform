<table width="100%" style="border: none; margin-bottom: 10px;">
    <tr>
        <td style="text-align:center; vertical-align:middle;">
            <h2 style="margin: 0; font-size:22px;">MISTER PC BOTEO</h2>
        </td>
    </tr>
</table>

<table width="100%" style="border: none; margin-bottom: 20px;">
    <tr>
        <td style="text-align:left; vertical-align:middle;">
            <p style="margin: 0; font-size:14px;">
                Resolución del servicio técnico de mantenimiento correctivo y preventivo
            </p>
        </td>
        
    </tr>
</table>

<hr>

<h3>I. Datos Generales</h3>
<table border="1" cellpadding="5" cellspacing="0" width="100%">
    <tr>
        <td><strong>Propietario:</strong></td>
        <td><?= htmlspecialchars($equipo['propietario'] ?? 'Sin asignar') ?></td>
    </tr>
    <tr>
        <td><strong>Fecha de ingreso:</strong></td>
        <td><?= !empty($equipo['fecha_ingreso']) ? date('d/m/Y', strtotime($equipo['fecha_ingreso'])) : '' ?></td>
    </tr>
    <tr>
        <td><strong>Fecha de finalización:</strong></td>
        <td><?= !empty($equipo['fecha_finalizacion']) ? date('d/m/Y', strtotime($equipo['fecha_finalizacion'])) : '' ?></td>
    </tr>
    <tr>
        <td><strong>Tipo de problema:</strong></td>
        <td><?= htmlspecialchars($equipo['tipo_problema'] ?? '') ?></td>
    </tr>
    <tr>
        <td><strong>Técnico asignado:</strong></td>
        <td><?= htmlspecialchars($equipo['tecnico'] ?? 'Sin asignar') ?></td>
    </tr>
</table>

<h3>II. Datos previos del equipo</h3>
<table border="1" cellpadding="5" cellspacing="0" width="100%">
    <tr>
        <td><strong>Marca:</strong></td>
        <td><?= htmlspecialchars($equipo['marca'] ?? '') ?></td>
        <td><strong>Modelo:</strong></td>
        <td><?= htmlspecialchars($equipo['modelo'] ?? '') ?></td>
        <td><strong>Nombre de equipo:</strong></td>
        <td><?= htmlspecialchars($equipo['nombre_equipo'] ?? '') ?></td>
    </tr>
    <tr>
        <td colspan="2"><strong>RAM:</strong> <?= htmlspecialchars($equipo['ram_tipo'] ?? '') ?>, <?= htmlspecialchars($equipo['ram_capacidad'] ?? '') ?>, <?= htmlspecialchars($equipo['ram_velocidad'] ?? '') ?>, Slots vacíos: <?= htmlspecialchars($equipo['ram_slots_vacios'] ?? '') ?></td>
        <td colspan="2"><strong>Procesador:</strong> <?= htmlspecialchars($equipo['cpu_marca'] ?? '') ?>, <?= htmlspecialchars($equipo['cpu_modelo'] ?? '') ?>, <?= htmlspecialchars($equipo['cpu_velocidad'] ?? '') ?></td>
        <td colspan="2"><strong>Sistema Operativo:</strong> <?= htmlspecialchars($equipo['so_nombre'] ?? '') ?>, <?= htmlspecialchars($equipo['so_version'] ?? '') ?>, <?= htmlspecialchars($equipo['so_arquitectura'] ?? '') ?></td>
    </tr>
    <tr>
        <td><strong>Disco duro:</strong></td>
        <td><?= htmlspecialchars($equipo['almacenamiento_cap'] ?? '') ?>, Particiones: <?= htmlspecialchars($equipo['almacenamiento_particiones'] ?? '') ?></td>
        <td><strong>Placa madre:</strong></td>
        <td colspan="3"><?= htmlspecialchars($equipo['placa_modelo'] ?? '') ?></td>
    </tr>
    <tr>
        <td><strong>Puertos:</strong></td>
        <td colspan="5"><?= htmlspecialchars($equipo['puertos'] ?? '') ?></td>
    </tr>
    <tr>
        <td colspan="6"><strong>Información extra:</strong> <?= htmlspecialchars($equipo['info_extra'] ?? '') ?></td>
    </tr>
</table>

<h3>III. Aplicación del equipo (reparaciones)</h3>
<table border="1" cellpadding="5" cellspacing="0" width="100%">
    <tr>
        <td><strong>Descripción del proceso:</strong></td>
    </tr>
    <tr>
        <td><?= htmlspecialchars($equipo['descripcion_proceso'] ?? '') ?></td>
    </tr>
    <tr>
        <td><strong>Detalles de problemas encontrados:</strong></td>
    </tr>
    <tr>
        <td><?= htmlspecialchars($equipo['detalles_problemas'] ?? '') ?></td>
    </tr>
</table>