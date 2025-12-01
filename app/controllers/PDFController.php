<?php
require_once __DIR__ . '/../../lib/dompdf/autoload.inc.php';
require_once __DIR__ . '/../models/Equipo.php';

use Dompdf\Dompdf;

class PdfController
{
    private $pdo;
    private $equipoModel;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
        $this->equipoModel = new Equipo($pdo);
    }

    // PDF de historial general (admin / técnico / cliente)
    public function generarHistorial($rol, $usuario_id = null)
    {
        switch ($rol) {
            case 'admin':
                $equipos = $this->equipoModel->historial();
                break;
            case 'tecnico':
                $equipos = $this->equipoModel->historialPorTecnico($usuario_id);
                break;
            case 'cliente':
                $equipos = $this->equipoModel->historialPorCliente($usuario_id);
                break;
            default:
                $equipos = [];
                break;
        }

        ob_start();
        include __DIR__ . '/../views/pdf/historial.php'; // HTML de tabla de historial
        $html = ob_get_clean();

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('letter', 'portrait');
        $dompdf->render();
        $dompdf->stream('historial.pdf', ["Attachment" => true]);
        exit;
    }

    // PDF de un equipo específico con detalles completos
    public function generarPDFEquipo($equipo_id)
    {
        $equipo = $this->equipoModel->getByIdForPdf($equipo_id);

        if (!$equipo) {
            die("Equipo no encontrado.");
        }

        ob_start();
        include __DIR__ . '/../views/pdf/equipo.php';
        $html = ob_get_clean();

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('letter', 'portrait');
        $dompdf->render();
        $dompdf->stream("equipo_{$equipo_id}.pdf", ["Attachment" => true]);
        exit;
    }
}
