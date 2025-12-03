<?php

require_once __DIR__ . '/../models/UsuarioModel.php';

//Gestion de usuarios en admin
class UsuarioController extends Controller
{
    private $db;
    private $usuarioModel;

    public function __construct()
    {
        session_start();
        if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
            header('Location: ' . BASE_URL . 'login');
            exit;
        }
        $this->db = Database::getConnection();
        $this->usuarioModel = new UsuarioModel($this->db);
    }

    public function index()
    {
        $this->handleActions();

        $usuarios = $this->usuarioModel->getAll();
        return $this->view('admin/usuarios', [
            'usuarios' => $usuarios,
            'head' => ['title' => 'Gestión de Usuarios']
        ]);
    }

    private function handleActions()
    {
        if (isset($_POST['editar_usuario'])) {
            $this->editarUsuario();
        }

        elseif (isset($_GET['toggle_usuario'])) {
            $this->toggleUsuario((int)$_GET['toggle_usuario'], (int)$_GET['estado']);
        }
    }

    private function editarUsuario()
    {
        $id = (int)($_POST['id_usuario'] ?? 0);
        $email = trim($_POST['email_usuario'] ?? '');
        $clave = $_POST['clave_usuario'] ?? '';

        if ($id <= 0 || empty($email)) {
            $_SESSION['error'] = 'Datos inválidos.';
            return;
        }

        $sql = "SELECT UsuarioId FROM USUARIO WHERE Email = ? AND UsuarioId != ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$email, $id]);
        if ($stmt->fetch()) {
            $_SESSION['error'] = 'Ya existe otro usuario con ese correo electrónico.';
            return;
        }

        try {
            $hashedClave = !empty($clave) ? password_hash($clave, PASSWORD_DEFAULT) : null;
            $this->usuarioModel->update($id, $email, $hashedClave);
            $_SESSION['success'] = 'Usuario actualizado exitosamente.';
        } catch (Exception $e) {
            $_SESSION['error'] = 'Error al actualizar el usuario.';
        }
    }

    private function toggleUsuario($id, $estado)
    {
        if ($id <= 0) {
            $_SESSION['error'] = 'ID de usuario inválido.';
            return;
        }

        try {
            $this->usuarioModel->toggleEstado($id, $estado);
            $msg = $estado ? 'Usuario activado exitosamente.' : 'Usuario desactivado exitosamente.';
            $_SESSION['success'] = $msg;
        } catch (Exception $e) {
            $_SESSION['error'] = 'Error al actualizar el estado del usuario.';
        }
    }
}