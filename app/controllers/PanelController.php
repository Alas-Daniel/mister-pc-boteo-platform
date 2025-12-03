<?php

require_once __DIR__ . '/../core/AdminController.php';

// Inicio de panel de admin
class PanelController extends AdminController
{
    public function index()
    {
        try {
            $stmt = $this->db->query("SELECT COUNT(*) FROM EQUIPO WHERE EstadoEquipo = 'en proceso'");
            $equipos = (int) $stmt->fetchColumn();

            $stmt = $this->db->query("SELECT COUNT(*) FROM PRODUCTO WHERE Estado = 1");
            $productos = (int) $stmt->fetchColumn();

            $stmt = $this->db->query("SELECT COUNT(*) FROM USUARIO WHERE Rol = 'tecnico'");
            $tecnicos = (int) $stmt->fetchColumn();

            $stmt = $this->db->query("SELECT COUNT(*) FROM CLIENTE WHERE Estado = 1");
            $clientes = (int) $stmt->fetchColumn();

            return $this->view('admin/inicio', [
                'equipos'   => $equipos,
                'productos' => $productos,
                'tecnicos'  => $tecnicos,
                'clientes'  => $clientes,
                'head'      => ['title' => 'Panel de Administración']
            ]);

        } catch (Exception $e) {
            error_log("Error en PanelController::index: " . $e->getMessage());
            die("Error al cargar el panel.");
        }
    }
}