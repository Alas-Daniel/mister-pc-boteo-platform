<?php

// Controlador base para administrador
class AdminController extends Controller
{
    protected $db;
    protected $usuario;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
            header('Location: ' . BASE_URL . 'login');
            exit;
        }
        $this->usuario = $_SESSION['usuario'];
        $this->db = Database::getConnection();
    }
}