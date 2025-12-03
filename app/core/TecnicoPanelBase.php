<?php

// Controlador base para el tecnico
class TecnicoPanelBase extends Controller
{
    protected $db;
    protected $usuario;

    public function __construct()
    {
        session_start();
        if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'tecnico') {
            header('Location: ' . BASE_URL . 'login');
            exit;
        }
        $this->usuario = $_SESSION['usuario'];
        $this->db = Database::getConnection();
    }
}