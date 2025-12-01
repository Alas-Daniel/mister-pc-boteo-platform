<?php

require_once __DIR__ . '/../models/EmpleadoModel.php';

class EmpleadoController extends Controller
{
    private $db;
    private $empleadoModel;

    public function __construct()
    {
        session_start();
        if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
            header('Location: ' . BASE_URL . 'login');
            exit;
        }
        $this->db = Database::getConnection();
        $this->empleadoModel = new EmpleadoModel($this->db);
    }

    public function index()
    {
        $empleados = $this->empleadoModel->getAll();
        $cargos = $this->empleadoModel->getCargos();

        return $this->view('admin/empleados', [
            'empleados' => $empleados,
            'cargos' => $cargos,
            'head' => ['title' => 'Gestión de Empleados']
        ]);
    }

    public function crear()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . 'empleados');
            exit;
        }

        $data = [
            'nombre' => trim($_POST['nombre'] ?? ''),
            'dui' => trim($_POST['dui'] ?? ''),
            'telefono' => trim($_POST['telefono'] ?? ''),
            'direccion' => trim($_POST['direccion'] ?? ''),
            'cargo_id' => (int)($_POST['cargo_id'] ?? 0)
        ];

        if (empty($data['nombre']) || empty($data['dui']) || empty($data['cargo_id'])) {
            $_SESSION['error'] = 'Nombre, DUI y cargo son obligatorios.';
            header('Location: ' . BASE_URL . 'empleados');
            exit;
        }

        $stmt = $this->db->prepare("SELECT EmpleadoId FROM EMPLEADO WHERE DUI = ? AND Estado = 1");
        $stmt->execute([$data['dui']]);
        if ($stmt->fetch()) {
            $_SESSION['error'] = 'Ya existe un empleado activo con ese DUI.';
            header('Location: ' . BASE_URL . 'empleados');
            exit;
        }

        try {
            $this->empleadoModel->create($data);
            $_SESSION['success'] = 'Empleado registrado exitosamente.';
        } catch (Exception $e) {
            $_SESSION['error'] = 'Error al registrar el empleado.';
        }

        header('Location: ' . BASE_URL . 'empleados');
        exit;
    }

    public function editar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . 'empleados');
            exit;
        }

        $id = (int)($_POST['id'] ?? 0);
        if (!$id) {
            header('Location: ' . BASE_URL . 'empleados');
            exit;
        }

        $data = [
            'nombre' => trim($_POST['nombre'] ?? ''),
            'dui' => trim($_POST['dui'] ?? ''),
            'telefono' => trim($_POST['telefono'] ?? ''),
            'direccion' => trim($_POST['direccion'] ?? ''),
            'cargo_id' => (int)($_POST['cargo_id'] ?? 0)
        ];

        if (empty($data['nombre']) || empty($data['dui']) || empty($data['cargo_id'])) {
            $_SESSION['error'] = 'Nombre, DUI y cargo son obligatorios.';
            header('Location: ' . BASE_URL . 'empleados');
            exit;
        }

        // Verificar DUI único (excluyendo a sí mismo)
        $stmt = $this->db->prepare("SELECT EmpleadoId FROM EMPLEADO WHERE DUI = ? AND EmpleadoId != ? AND Estado = 1");
        $stmt->execute([$data['dui'], $id]);
        if ($stmt->fetch()) {
            $_SESSION['error'] = 'Ya existe otro empleado activo con ese DUI.';
            header('Location: ' . BASE_URL . 'empleados');
            exit;
        }

        try {
            $this->empleadoModel->update($id, $data);
            $_SESSION['success'] = 'Empleado actualizado exitosamente.';
        } catch (Exception $e) {
            $_SESSION['error'] = 'Error al actualizar el empleado.';
        }

        header('Location: ' . BASE_URL . 'empleados');
        exit;
    }

    public function desactivar($id)
    {
        $id = (int)$id;
        if ($id <= 0) {
            header('Location: ' . BASE_URL . 'empleados');
            exit;
        }

        try {
            $this->empleadoModel->delete($id);
            $_SESSION['success'] = 'Empleado desactivado exitosamente.';
        } catch (Exception $e) {
            $_SESSION['error'] = 'Error al desactivar el empleado.';
        }

        header('Location: ' . BASE_URL . 'empleados');
        exit;
    }

    public function crear_usuario()
    {
        $isAjax = !empty($_SERVER['HTTP_X_REQUESTED_WITH'])
            && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            if ($isAjax) {
                echo json_encode(['error' => 'Método no permitido']);
                exit;
            }
            header('Location: ' . BASE_URL . 'empleados');
            exit;
        }

        $empleadoId = (int)($_POST['empleado_id'] ?? 0);
        $email = trim($_POST['email'] ?? '');
        $clave = $_POST['clave'] ?? '';
        $rol = $_POST['rol'] ?? '';

        if (!$empleadoId || empty($email) || empty($clave) || !in_array($rol, ['tecnico', 'admin'])) {
            if ($isAjax) {
                echo json_encode(['error' => 'Datos incompletos o inválidos.']);
                exit;
            }
            $_SESSION['error'] = 'Datos incompletos o inválidos.';
            header('Location: ' . BASE_URL . 'empleados');
            exit;
        }

        $stmt = $this->db->prepare("SELECT UsuarioId FROM USUARIO WHERE Email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            if ($isAjax) {
                echo json_encode(['error' => 'Ya existe un usuario con ese correo electrónico.']);
                exit;
            }
            $_SESSION['error'] = 'Ya existe un usuario con ese correo electrónico.';
            header('Location: ' . BASE_URL . 'empleados');
            exit;
        }

        $stmt = $this->db->prepare("SELECT EmpleadoId FROM EMPLEADO WHERE EmpleadoId = ? AND Estado = 1");
        $stmt->execute([$empleadoId]);
        if (!$stmt->fetch()) {
            if ($isAjax) {
                echo json_encode(['error' => 'Empleado no válido.']);
                exit;
            }
            $_SESSION['error'] = 'Empleado no válido.';
            header('Location: ' . BASE_URL . 'empleados');
            exit;
        }

        $stmt = $this->db->prepare("SELECT UsuarioId FROM USUARIO WHERE EmpleadoId = ?");
        $stmt->execute([$empleadoId]);
        if ($stmt->fetch()) {
            if ($isAjax) {
                echo json_encode(['error' => 'Este empleado ya tiene un usuario.']);
                exit;
            }
            $_SESSION['error'] = 'Este empleado ya tiene un usuario.';
            header('Location: ' . BASE_URL . 'empleados');
            exit;
        }

        try {
            $hashedClave = password_hash($clave, PASSWORD_DEFAULT);
            $stmt = $this->db->prepare("INSERT INTO USUARIO (EmpleadoId, Email, Clave, Rol, Estado) VALUES (?, ?, ?, ?, 1)");
            $stmt->execute([$empleadoId, $email, $hashedClave, $rol]);

            if ($isAjax) {
                echo json_encode(['success' => true, 'empleado_id' => $empleadoId]);
                exit;
            }
            $_SESSION['success'] = 'Usuario creado exitosamente.';
        } catch (Exception $e) {
            if ($isAjax) {
                echo json_encode(['error' => 'Error al crear el usuario.']);
                exit;
            }
            $_SESSION['error'] = 'Error al crear el usuario.';
        }

        if (!$isAjax) {
            header('Location: ' . BASE_URL . 'empleados');
            exit;
        }
    }
}
