<?php

require_once __DIR__ . '/../models/UsuarioModel.php';

//Controller de Login
class LoginController extends Controller
{
    private $db;
    private $userModel;

    public function __construct()
    {
        session_start();
        $this->db = Database::getConnection();
        $this->userModel = new UsuarioModel($this->db);
    }

    public function index()
    {
        if (isset($_SESSION['usuario'])) {
            $rol = $_SESSION['usuario']['rol'];
            header('Location: ' . BASE_URL . $rol . '/inicio');
            exit;
        }

        $head = [
            'title' => 'Iniciar Sesión - Mister PC Boteo'
        ];

        return $this->view('auth/login', [
            'head' => $head
        ]);
    }

    public function auth()
    {
        $email = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');

        if (!$email || !$password) {
            return $this->view('auth/login', [
                'head' => ['title' => 'Iniciar Sesión - Mister PC Boteo'],
                'error' => 'Por favor completa todos los campos.'
            ]);
        }

        $user = $this->userModel->findByEmail($email);

        if (!$user || !password_verify($password, $user['Clave']) || $user['Estado'] == 0) {
            return $this->view('auth/login', [
                'head' => ['title' => 'Iniciar Sesión - Mister PC Boteo'],
                'error' => 'Correo o contraseña incorrectos.'
            ]);
        }

        $_SESSION['usuario'] = [
            'id' => $user['UsuarioId'],
            'nombre' => $user['nombre_completo'],
            'rol' => $user['Rol']
        ];

        if ($user['Rol'] === 'admin') {
            header('Location: ' . BASE_URL . 'admin/panel');
            exit;
        }

        if ($user['Rol'] === 'tecnico') {
            header('Location: ' . BASE_URL . 'tecnico/inicio');
            exit;
        }
    }
}
