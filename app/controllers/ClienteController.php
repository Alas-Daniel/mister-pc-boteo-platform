<?php

require_once __DIR__ . '/../models/ClienteModel.php';

class ClienteController extends Controller
{
    private $db;
    private $clienteModel;

    public function __construct()
    {
        session_start();
        if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
            header('Location: ' . BASE_URL . 'login');
            exit;
        }
        $this->db = Database::getConnection();
        $this->clienteModel = new ClienteModel($this->db);
    }

    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($_POST['accion'] === 'crear') {
                $this->crear();
                return;
            } elseif ($_POST['accion'] === 'editar') {
                $this->editar();
                return;
            }
        }

        $clientes = $this->clienteModel->getAll();
        return $this->view('admin/clientes', [
            'clientes' => $clientes,
            'head' => ['title' => 'Gestión de Clientes']
        ]);
    }

    private function crear()
    {
        $data = [
            'nombre' => trim($_POST['nombre'] ?? ''),
            'telefono' => trim($_POST['telefono'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'direccion' => trim($_POST['direccion'] ?? '')
        ];

        if (empty($data['nombre'])) {
            $_SESSION['error'] = 'El nombre es obligatorio.';
            $this->redirect();
            return;
        }

        if (!empty($data['email'])) {
            if ($this->clienteModel->emailExists($data['email'])) {
                $_SESSION['error'] = 'Ya existe un cliente con ese correo electrónico.';
                $this->redirect();
                return;
            }
        }

        try {
            $this->clienteModel->create($data);
            $_SESSION['success'] = 'Cliente registrado exitosamente.';
        } catch (Exception $e) {
            $_SESSION['error'] = 'Error al registrar el cliente.';
        }

        $this->redirect();
    }

    private function editar()
    {
        $id = (int)($_POST['id'] ?? 0);
        if (!$id) {
            $_SESSION['error'] = 'ID de cliente inválido.';
            $this->redirect();
            return;
        }

        $data = [
            'nombre' => trim($_POST['nombre'] ?? ''),
            'telefono' => trim($_POST['telefono'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'direccion' => trim($_POST['direccion'] ?? '')
        ];

        if (empty($data['nombre'])) {
            $_SESSION['error'] = 'El nombre es obligatorio.';
            $this->redirect();
            return;
        }

        if (!empty($data['email'])) {
            if ($this->clienteModel->emailExists($data['email'], $id)) {
                $_SESSION['error'] = 'Ya existe otro cliente con ese correo electrónico.';
                $this->redirect();
                return;
            }
        }

        try {
            $this->clienteModel->update($id, $data);
            $_SESSION['success'] = 'Cliente actualizado exitosamente.';
        } catch (Exception $e) {
            $_SESSION['error'] = 'Error al actualizar el cliente.';
        }

        $this->redirect();
    }

    private function redirect()
    {
        header('Location: ' . BASE_URL . 'admin/clientes');
        exit;
    }
}