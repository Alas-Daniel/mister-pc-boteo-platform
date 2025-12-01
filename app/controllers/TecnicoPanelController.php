<?php

require_once __DIR__ . '/../core/TecnicoPanelBase.php';

class TecnicoPanelController extends TecnicoPanelBase
{
    public function index()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $mensaje_exito = $_SESSION['exito'] ?? null;
        $mensaje_error = $_SESSION['error'] ?? null;
        
        unset($_SESSION['exito'], $_SESSION['error']);

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'change_password') {
            $this->handlePasswordChange();
            return;
        }

        try {
            $tecnico_id = (int) $this->usuario['id'];

            // Equipos asignados: "no iniciado" (recién asignado) o "en proceso"
            $stmt = $this->db->prepare("
                SELECT COUNT(*) FROM EQUIPO 
                WHERE TecnicoId = ? AND EstadoEquipo IN ('no iniciado', 'en proceso')
            ");
            $stmt->execute([$tecnico_id]);
            $equipos_asignados = (int) $stmt->fetchColumn();

            // Equipos terminados: "finalizado" 
            $stmt = $this->db->prepare("
                SELECT COUNT(*) FROM EQUIPO 
                WHERE TecnicoId = ? AND EstadoEquipo = 'finalizado'
            ");
            $stmt->execute([$tecnico_id]);
            $equipos_terminados = (int) $stmt->fetchColumn();

            // Equipos entregados: "entregado"
            $stmt = $this->db->prepare("
                SELECT COUNT(*) FROM EQUIPO 
                WHERE TecnicoId = ? AND EstadoEquipo = 'entregado'
            ");
            $stmt->execute([$tecnico_id]);
            $equipos_reparados = (int) $stmt->fetchColumn();

            // Productos en almacén (Estado = 1)
            $stmt = $this->db->query("SELECT COUNT(*) FROM PRODUCTO WHERE Estado = 1");
            $productos_almacen = (int) $stmt->fetchColumn();

            return $this->view('tecnico/inicio', [
                'equipos_asignados'   => $equipos_asignados,
                'equipos_terminados'  => $equipos_terminados,
                'equipos_reparados'   => $equipos_reparados,
                'productos_almacen'   => $productos_almacen,
                'exito'               => $mensaje_exito,
                'error'               => $mensaje_error,
                'head'                => ['title' => 'Panel de Técnico']
            ]);

        } catch (Exception $e) {
            error_log("Error en TecnicoPanelController::index: " . $e->getMessage());
            die("Error al cargar el panel del técnico.");
        }
    }

    private function handlePasswordChange()
    {
        $currentPassword = $_POST['contrasena_actual'] ?? '';
        $newPassword = $_POST['nueva_contrasena'] ?? '';
        $confirmPassword = $_POST['confirmar_contrasena'] ?? '';

        // Validaciones
        if (empty($currentPassword) || empty($newPassword) || empty($confirmPassword)) {
            $_SESSION['error'] = 'campos_vacios';
            header('Location: ' . BASE_URL . 'tecnico/inicio');
            exit;
        }

        if ($newPassword !== $confirmPassword) {
            $_SESSION['error'] = 'contrasenas_no_coinciden';
            header('Location: ' . BASE_URL . 'tecnico/inicio');
            exit;
        }

        if (strlen($newPassword) < 6) {
            $_SESSION['error'] = 'contrasena_corta';
            header('Location: ' . BASE_URL . 'tecnico/inicio');
            exit;
        }

        // Verificar contraseña actual
        $stmt = $this->db->prepare("SELECT Clave FROM USUARIO WHERE UsuarioId = ?");
        $stmt->execute([$this->usuario['id']]);
        $currentUser = $stmt->fetch();

        if (!$currentUser || !password_verify($currentPassword, $currentUser['Clave'])) {
            $_SESSION['error'] = 'contrasena_incorrecta';
            header('Location: ' . BASE_URL . 'tecnico/inicio');
            exit;
        }

        // Actualizar contraseña
        $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("UPDATE USUARIO SET Clave = ? WHERE UsuarioId = ?");
        $stmt->execute([$newPasswordHash, $this->usuario['id']]);

        $_SESSION['exito'] = 'contrasena_actualizada';
        header('Location: ' . BASE_URL . 'tecnico/inicio');
        exit;
    }
}