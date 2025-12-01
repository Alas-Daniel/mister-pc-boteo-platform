<?php

require_once __DIR__ . '/../models/ClienteModel.php';
require_once __DIR__ . '/../core/TecnicoPanelBase.php';

class TecnicoClienteController extends TecnicoPanelBase
{
    private $clienteModel;

    public function __construct()
    {
        parent::__construct();
        $this->clienteModel = new ClienteModel($this->db);
    }

    public function index()
    {
        $clientes = $this->clienteModel->getAll();
        $this->view('tecnico/clientes', [
            'clientes' => $clientes,
            'head' => ['title' => 'Clientes Registrados']
        ]);
    }

    public function nuevo()
    {
        $error = $_GET['error'] ?? null;
        $this->view('tecnico/clientes/crear', [
            'error' => $error,
            'head' => ['title' => 'Registrar Nuevo Cliente']
        ]);
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . 'tecnico/clientes/nuevo');
            exit;
        }

        $data = [
            'nombre' => trim($_POST['nombre'] ?? ''),
            'telefono' => trim($_POST['telefono'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'direccion' => trim($_POST['direccion'] ?? '')
        ];

        if (empty($data['nombre'])) {
            header('Location: ' . BASE_URL . 'tecnico/clientes/nuevo?error=nombre_requerido');
            exit;
        }

        if (!empty($data['email']) && $this->clienteModel->emailExists($data['email'])) {
            header('Location: ' . BASE_URL . 'tecnico/clientes/nuevo?error=email_existe');
            exit;
        }

        try {
            $this->clienteModel->create($data);
            header('Location: ' . BASE_URL . 'tecnico/clientes?exito=creado');
        } catch (Exception $e) {
            header('Location: ' . BASE_URL . 'tecnico/clientes/nuevo?error=guardar');
        }
        exit;
    }
}