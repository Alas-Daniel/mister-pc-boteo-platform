<?php

//Gestion de Tecnicos admin
class TecnicoController extends Controller
{
    private $db;

    public function __construct()
    {
        session_start();
        if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
            header('Location: ' . BASE_URL . 'login');
            exit;
        }
        $this->db = Database::getConnection();
    }

    public function index()
    {
        $sql = "SELECT 
                    u.usuarioid AS id,
                    e.nombre AS nombre_completo,
                    u.email AS email,
                    e.telefono AS telefono,
                    u.estado AS is_active
                FROM usuario u
                JOIN empleado e ON u.empleadoid = e.empleadoid
                WHERE u.rol = 'tecnico'
                ORDER BY e.nombre";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $this->view('admin/tecnicos', [
            'usuarios' => $usuarios,
            'head' => ['title' => 'Gestión de Técnicos']
        ]);
    }
}