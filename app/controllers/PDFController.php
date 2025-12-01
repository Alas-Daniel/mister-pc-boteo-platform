<?php

require_once __DIR__ . '/../../lib/dompdf/autoload.inc.php';

use Dompdf\Dompdf;

class PdfController
{
    private $db;

    public function __construct()
    {
        // No se inicia sesión aquí porque la validación se hace en el controlador que llama (TecnicoEquipoController o EquipoController)
        $this->db = Database::getConnection();
    }

    public function equipo($equipo_id)
    {
        // --- Limpieza crítica: asegurar que no haya salida previa ---
        if (ob_get_level()) {
            ob_clean();
        }
        while (ob_get_level()) {
            ob_end_clean();
        }

        // Desactivar errores visibles (evita que Notices se metan en el PDF)
        error_reporting(0);
        ini_set('display_errors', 0);

        // Validación básica de ID
        if (!is_numeric($equipo_id) || $equipo_id <= 0) {
            return;
        }

        // Consulta específica para el PDF, con aliases que coinciden EXACTAMENTE con la vista
        $sql = "SELECT 
                    c.Nombre AS propietario,
                    e.FechaIngreso AS fecha_ingreso,
                    e.FechaFinalizacion AS fecha_finalizacion,
                    e.TipoProblema AS tipo_problema,
                    emp.Nombre AS tecnico,
                    e.Marca AS marca,
                    e.Modelo AS modelo,
                    e.NombreEquipo AS nombre_equipo,
                    d.RamTipo AS ram_tipo,
                    d.RamCapacidad AS ram_capacidad,
                    d.RamVelocidad AS ram_velocidad,
                    d.RamSlotsVacios AS ram_slots_vacios,
                    d.CpuMarca AS cpu_marca,
                    d.CpuModelo AS cpu_modelo,
                    d.CpuVelocidad AS cpu_velocidad,
                    d.SoNombre AS so_nombre,
                    d.SoVersion AS so_version,
                    d.SoArquitectura AS so_arquitectura,
                    d.AlmacenamientoCap AS almacenamiento_cap,
                    d.AlmacenamientoParticiones AS almacenamiento_particiones,
                    d.PlacaModelo AS placa_modelo,
                    d.Puertos AS puertos,
                    d.InfoExtra AS info_extra,
                    r.DescripcionProceso AS descripcion_proceso,
                    r.DetallesProblema AS detalles_problemas
                FROM EQUIPO e
                JOIN CLIENTE c ON e.ClienteId = c.ClienteId
                LEFT JOIN USUARIO u ON e.TecnicoId = u.UsuarioId
                LEFT JOIN EMPLEADO emp ON u.EmpleadoId = emp.EmpleadoId
                LEFT JOIN DETALLE_EQUIPO d ON e.EquipoId = d.EquipoId
                LEFT JOIN REPARACION r ON e.EquipoId = r.EquipoId
                WHERE e.EquipoId = ? AND e.Activo = 1";

        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$equipo_id]);
            $equipo = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return; // No mostrar errores en el PDF
        }

        if (!$equipo) {
            return;
        }

        // Capturar HTML del PDF
        ob_start();
        include __DIR__ . '/../views/pdf/equipo.php';
        $html = ob_get_clean();

        // Verificar que no se hayan enviado encabezados (si sí, no se puede enviar PDF)
        if (headers_sent()) {
            return;
        }

        // Generar y enviar PDF
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('letter', 'portrait');
        $dompdf->render();
        $dompdf->stream("equipo_{$equipo_id}.pdf", ["Attachment" => true]);
        exit;
    }
}